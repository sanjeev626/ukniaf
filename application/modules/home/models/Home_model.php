<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Home_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 31, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_products_by_category_id($select="*", $category_id){
        $this->db->select($select);
        $this->db->like('categories', $category_id);
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_product.id', 'right');
        $this->db->group_by('tbl_product.id');
        $query = $this->db->get('tbl_product');
        //echo $this->db->last_query(); exit();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }    
    }

    public function get_products_by_main_category_slug($category_slug,$return_count="0"){
        $category_id = $this->get_category_id_by_slug($category_slug);
        $subcategory_id_array = $this->get_subcategory_id_array_by_category_id($category_id);
        //print_r($subcategory_id_array);
        $this->db->select('tbl_product.id,tbl_product.slug,tbl_product.name,tbl_product.marked_price,tbl_product.offer_price,tbl_product_image.imagepath,tbl_product_image.imagename');
        for($c=0;$c<count($subcategory_id_array);$c++){
            $this->db->or_like('categories', '"'.$subcategory_id_array[$c].'"');
        }
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_product.id', 'right');
        $this->db->join('tbl_product_ordering', 'tbl_product_ordering.product_id = tbl_product.id', 'right');

        $this->db->group_by('tbl_product.id');
        $this->db->order_by('tbl_product_ordering.ordering');
        $query = $this->db->get('tbl_product');
        //echo $this->db->last_query(); 

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            if($return_count==1)
                return $query->num_rows();
            else
                return $query->result();
        }    
    }

    public function get_products_by_sub_category_slug($subcategory_slug,$return_count="0"){
        $subcategory_id = $this->get_category_id_by_slug($subcategory_slug);
        $this->db->select('tbl_product.id,tbl_product.slug,tbl_product.name,tbl_product.marked_price,tbl_product.offer_price,tbl_product_image.imagepath,tbl_product_image.imagename');
            $this->db->or_like('categories', '"'.$subcategory_id.'"');
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_product.id', 'right');
        $this->db->join('tbl_product_ordering', 'tbl_product_ordering.product_id = tbl_product.id', 'right');
        $this->db->group_by('tbl_product.id');
        $this->db->order_by('tbl_product_ordering.ordering');
        $query = $this->db->get('tbl_product');
        //echo $this->db->last_query(); 

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            if($return_count==1)
                return $query->num_rows();
            else
                return $query->result();
        }    
    }

    public function get_product_by_slug($slug){
        $this->db->select('tbl_product.*,tbl_product_image.imagepath,tbl_product_image.imagename');
        $this->db->where('slug', $slug);
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_product.id', 'right');
        $query = $this->db->get('tbl_product');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }  
    }


    public function get_product_imagepath_by_color($product_id,$color_id){
        $this->db->select('imagepath,imagename');
        $this->db->where('product_id', $product_id);
        $this->db->where('color_id', $color_id);
        $query = $this->db->get('tbl_product_image_by_color');
        if($query->num_rows() > 0){
            $row = $query->result_array();    
            if(is_array($row) && count($row)>0){
                $data = array_shift($row);
                return base_url().$data['imagepath'].$data['imagename'];
            }else{
                return FALSE;
            }
        }
        else
            return FALSE;
    }

    public function get_breadcrumb($pid){
        $categories = $this->general_model->getValue('categories','tbl_product',array('id' => $pid));
        $cat = unserialize($categories);
        //print_r($cat); echo "<br>";
        $subcat = $this->general_model->getArray('parent_id,slug,name','tbl_category',array('id' => $cat['0']));
        //print_r($subcat); echo "<br>";
        $maincat = $this->general_model->getArray('slug,name','tbl_category',array('id' => $subcat->parent_id));
        //print_r($maincat); echo "<br>";

        $breadcrumb = '<a href="'.base_url().'category/'.$maincat->slug.'">'.$maincat->name.'</a> <a href="'.base_url().'category/'.$maincat->slug.'/'.$subcat->slug.'">'.$subcat->name.'</a>';
        return $breadcrumb;
    }

    public function get_breadcrumb_maincat($category_slug){
        $maincat = $this->general_model->getArray('parent_id,slug,name','tbl_category',array('slug' => $category_slug));

        $breadcrumb = '<a href="'.base_url().'category/'.$maincat->slug.'">'.$maincat->name.'</a>';
        return $breadcrumb;
    }

    public function get_breadcrumb_subcat($category_slug){
        $subcat = $this->general_model->getArray('parent_id,slug,name','tbl_category',array('slug' => $category_slug));
        $maincat = $this->general_model->getArray('slug,name','tbl_category',array('id' => $subcat->parent_id));

        $breadcrumb = '<a href="'.base_url().'category/'.$maincat->slug.'">'.$maincat->name.'</a><span>'.$subcat->name.'</span>';
        return $breadcrumb;
    }

    public function get_category_id_by_slug($category_slug){
        $this->db->select('id');
        $this->db->where('slug', $category_slug);
        $query = $this->db->get('tbl_category');

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $subcategory = $query->row();
            $category_id = $subcategory->id;
        }   return $category_id;
    }

    public function get_products_by_main_category_id($category_id){
        
        $subcategory_id_array = $this->get_subcategory_id_array_by_category_id($category_id);
        /*$this->db->select();
        $this->db->like('categories', '"'.$category_id.'"');
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id = tbl_product.id', 'right');
        $this->db->group_by('tbl_product.id');
        $query = $this->db->get('tbl_product');
        //echo $this->db->last_query(); exit();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }*/    
    }

    public function get_search_result($category_id,$size_id){
        if(isset($category_id) && $category_id>0)
            $this->db->like('categories', '"'.$category_id.'"');
        $this->db->like('size_attributes', '"'.$size_id.'"');
        $this->db->order_by('id','DESC');
        $query = $this->db->get('tbl_product');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_availability($product_id, $color_id, $size_id){
        $html = '';
        if($product_id>0 && $color_id>0 && $size_id>0)
        {
            $this->db->select('purchased_stock');
            $this->db->where('product_id',$product_id);
            $this->db->where('color_id',$color_id);
            $this->db->where('size_id',$size_id);
            $q = $this->db->get('tbl_product_stock');
            $rasStock = $q->result_array();
            $purchased_stock = $rasStock[0]['purchased_stock'];     
            $taken = $this->get_taken($product_id, $color_id, $size_id);
            $available_stock = $purchased_stock-$taken;
            $html = $available_stock;
        }
        return $html;
    }

    function count_purchased_single($product_id, $color_id, $size_id){
        //return $product_id.', '.$color_id.', '.$size_id;
        $this->db->select('purchased_stock');
        $this->db->where('product_id',$product_id);
        $this->db->where('color_id',$color_id);
        $this->db->where('size_id',$size_id);
        $query = $this->db->get('tbl_product_stock');
        //echo $this->db->last_query();
        if($query->num_rows()==0)
            $purchased_stock = 0;
        else{
            $rasPro = $query->result();
            //print_r($rasPro);
            $purchased_stock = $rasPro[0]->purchased_stock;
        }
        return $purchased_stock;
    }

    function count_availability_single($product_id, $color_id, $size_id){
        $available_stock = 0;
        if($product_id>0 && $color_id>0 && $size_id>0)
        {
            //return $product_id.', '.$color_id.', '.$size_id;
            $purchased_stock = $this->count_purchased_single($product_id, $color_id, $size_id);
            //return 'purchased_stock : '.$purchased_stock;
            $taken = $this->get_taken_single($product_id, $color_id, $size_id);
            //return 'purchased_stock : '.$purchased_stock.', Taken : '.$taken;
            $available_stock = $purchased_stock-$taken;
        }
        return $available_stock;
    }

    function get_taken_single($product_id, $color_id, $size_id){
        $taken_quantity = 0;
        if($product_id>0 && $color_id>0 && $size_id>0)
        {
            //Get Added products of order
            //$in_order_count = 
            $this->db->select_sum('tbl_sales_detail.quantity');
            $this->db->where('tbl_sales_detail.product_id',$product_id);
            $this->db->where('tbl_sales_detail.color_id',$color_id);
            $this->db->where('tbl_sales_detail.size_id',$size_id);
            $this->db->where('tbl_sales.sales_status!=','cancelled');
            $this->db->join('tbl_sales', 'tbl_sales_detail.sales_id = tbl_sales.id', 'left');
            $this->db->join('tbl_customer', 'tbl_sales.customer_id = tbl_customer.id', 'left');
            $this->db->order_by('tbl_sales_detail.created_date','ASC');
            $taken_quantity = $this->db->get('tbl_sales_detail')->row('quantity');
            //echo $this->db->last_query();
            //$taken = $query->num_rows();
        }
        return $taken_quantity;
    }

    function count_purchased($product_id, $size_id){
        $this->db->select_sum('purchased_stock');
        $this->db->where('product_id',$product_id);
        $this->db->where('size_id',$size_id);
        $query = $this->db->get('tbl_product_stock');
        //echo $this->db->last_query();

        //$rasStock = $q->result_array();
        //echo "num_rows = ".$query->num_rows()."<br>";
        if($query->num_rows()==0)
            $purchased_stock = 0;
        else{
            $rasPro = $query->result();
            //print_r($rasPro);
            $purchased_stock = $rasPro[0]->purchased_stock;
        }
        return $purchased_stock;
    }

    function get_taken($product_id, $size_id){

        $taken = 0;
        if($product_id>0 && $size_id>0)
        {
            //Get Added products of order
            //$in_order_count = 
            $this->db->select_sum('tbl_sales_detail.quantity');
            $this->db->where('tbl_sales_detail.product_id',$product_id);
            $this->db->where('tbl_sales_detail.size_id',$size_id);
            $this->db->where('tbl_sales.sales_status!=','cancelled');
            $this->db->join('tbl_sales', 'tbl_sales_detail.sales_id = tbl_sales.id', 'left');
            //$this->db->join('tbl_customer', 'tbl_sales.customer_id = tbl_customer.id', 'left');
            //$this->db->order_by('tbl_sales_detail.created_date','ASC');
            $taken_quantity = $this->db->get('tbl_sales_detail')->row('quantity');
            //echo $this->db->last_query();
            //$taken = $query->num_rows();
        }
        return $taken_quantity;
    }

    function count_availability($product_id, $size_id){
        $available_stock = 0;
        if($product_id>0 && $size_id>0)
        {
            $purchased_stock = $this->count_purchased($product_id, $size_id);
            $taken = $this->get_taken($product_id, $size_id);
            //echo 'purchased_stock : '.$purchased_stock.' | Taken : '.$taken;

            $available_stock = $purchased_stock-$taken;
        }
        return $available_stock;
    }

    function count_product_availability($product_id){
        $total_purchased_stock = $this->general_model->getSum('purchased_stock','tbl_product_stock','product_id="'.$product_id.'"');
        $total_sold_stock = $this->get_sold_stock($product_id);
        $availability = $total_purchased_stock-$total_sold_stock;
        return $availability;
    }

    function get_sold_stock($product_id){
        $this->db->select_sum('tbl_sales_detail.quantity');
        $this->db->where('tbl_sales_detail.product_id',$product_id);
        $this->db->where('tbl_sales.sales_status!=','cancelled');
        $this->db->join('tbl_sales', 'tbl_sales_detail.sales_id = tbl_sales.id', 'left');
        $this->db->join('tbl_customer', 'tbl_sales.customer_id = tbl_customer.id', 'left');
        $this->db->order_by('tbl_sales_detail.created_date','ASC');
        $sold_stock = $this->db->get('tbl_sales_detail')->row('quantity');
        return $sold_stock;
    }

    public function get_search_result_count($category_id,$size_id){
        if(isset($category_id) && $category_id>0)
            $this->db->like('categories', '"'.$category_id.'"');
        $this->db->like('size_attributes', '"'.$size_id.'"');
        $query = $this->db->get('tbl_product');
        return $query->num_rows();
    }

    public function get_subcategory_id_array_by_category_id($category_id){
        $this->db->select('id');
        $this->db->where('parent_id', $category_id);
        $query = $this->db->get('tbl_category');
        //echo $this->db->last_query(); exit();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $subcategories = $query->result();
            $subcategory_id_array = array();
            foreach($subcategories as $subcategory){
                $subcategory_id_array[] = $subcategory->id;
            }
            //print_r($subcategory_id_array);
        }   return $subcategory_id_array;
    }

    public function get_product_images($product_id){
        $this->db->select();
        $this->db->where('product_id',$product_id);
        $this->db->order_by('is_main','DESC');
        $query = $this->db->get('tbl_product_image');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_product_featured_image($product_id){
        $this->db->select('imagepath,imagename');
        $this->db->where('product_id',$product_id);
        $this->db->where('is_main','1');
        $query = $this->db->get('tbl_product_image');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }
    
    public function get_attribute_value($aid){
        $this->db->select('attribute_value');
        $this->db->where('id',$aid);
        $query = $this->db->get('tbl_attribute_values');   
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row()->attribute_value;
        }
    }

    public function get_customer_info($phone){
        $this->db->select('*');
        $this->db->where('contact_number',$phone);
        $query = $this->db->get('tbl_customer');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $customer = $query->row();
            if(!empty($customer->full_name) && $customer->full_name!="6")
                echo json_encode(array('full_name' => $customer->full_name, 'full_address' => $customer->full_address, 'email' => $customer->email));
            else
                echo json_encode(array('full_name' => '', 'full_address' => '', 'email' => ''));
        }
    }

    public function add_customer(){
        $contact_number = $_POST['contact_number'];
        $customer_id = $this->general_model->getValue('id','tbl_customer','contact_number="'.$contact_number.'"');
        if($customer_id>0){
            $data = array();
            $data = array(
                'full_name' => $_POST['name'],
                'full_address' => $_POST['address'],
                'email' => $_POST['email']
            );
            $this->db->update('tbl_customer',$data,'id="'.$customer_id.'"');
            return $customer_id;
        }
        else{
            $data = array();
            $data = array(
                'full_name' => $_POST['name'],
                'full_address' => $_POST['address'],
                'contact_number' => $_POST['contact_number'],
                'email' => $_POST['email']
            );
            $this->db->insert('tbl_customer',$data);
            $customer_id = $this->db->insert_id();
            return $customer_id;
        }
    }

    public function add_sales($customer_id){
        $data = array();
        $data = array(
            'session_id' => $_SESSION['shopping_session_id'],
            'customer_id' => $customer_id,
            'sub_total' => $_POST['total_amount'],
            'total_amount' => $_POST['total_amount'],
            'customer_remarks' => $_POST['remarks']
        );
        $this->db->insert('tbl_sales',$data);
        $sales_id = $this->db->insert_id();
        return $sales_id;
    }

    public function add_sales_items($sales_id){
        $tempsales = $this->general_model->getQuery('*','tbl_tempsales_detail','shopping_session_id="'.$_SESSION['shopping_session_id'].'"');
        foreach($tempsales as $row){
            $data = array();
            $data = array(
                'sales_id' => $sales_id,
                'product_id' => $row->product_id,
                'color_id' => $row->color_id,
                'size_id' => $row->size_id,
                'quantity' => $row->quantity,
                'rate' => $row->rate
            );
            $this->db->insert('tbl_sales_detail',$data);
        }
        $this->db->delete('tbl_tempsales_detail','shopping_session_id="'.$_SESSION['shopping_session_id'].'"');
    }

    /* -------------------- for wholesale products ----------------*/

    public function get_stock_all(){
        $this->db->select('tbl_product.id,tbl_product.name,tbl_product.offer_price,tbl_product.wholesale_price');
        $this->db->order_by("tbl_product.name","ASC");
        $this->db->group_by("name");
        $query =  $this->db->get('tbl_product');
        //echo $this->db->last_query();        
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_sales_of_product($product_id,$color_id,$size_id){
        $this->db->select('tbl_sales_detail.quantity,tbl_sales_detail.created_date,tbl_customer.full_name,tbl_sales.sales_status');
        $this->db->where('tbl_sales_detail.product_id',$product_id);
        $this->db->where('tbl_sales_detail.color_id',$color_id);
        $this->db->where('tbl_sales_detail.size_id',$size_id);
        $this->db->where('tbl_sales.sales_status!=','cancelled');
        $this->db->join('tbl_sales', 'tbl_sales_detail.sales_id = tbl_sales.id', 'left');
        $this->db->join('tbl_customer', 'tbl_sales.customer_id = tbl_customer.id', 'left');
        $this->db->order_by('tbl_sales_detail.created_date','ASC');
        $query = $this->db->get('tbl_sales_detail'); 
        //echo $this->db->last_query();      
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        } 
    }

    public function count_sold_product($product_id,$color_id,$size_id){
        $this->db->select('tbl_sales_detail.id');
        $this->db->where('tbl_sales_detail.product_id',$product_id);
        $this->db->where('tbl_sales_detail.color_id',$color_id);
        $this->db->where('tbl_sales_detail.size_id',$size_id);
        $this->db->where('tbl_sales.sales_status!=','cancelled');
        $this->db->join('tbl_sales', 'tbl_sales_detail.sales_id = tbl_sales.id', 'left');
        $this->db->join('tbl_customer', 'tbl_sales.customer_id = tbl_customer.id', 'left');
        $this->db->order_by('tbl_sales_detail.created_date','ASC');
        $query = $this->db->get('tbl_sales_detail'); 
        //echo $this->db->last_query();      
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->num_rows();
        } 
    }

    public function add_to_cart(){
        //print_r($_POST);
        //echo $this->general_model->getCount('tbl_tempsales_detail',array('shopping_session_id' => $_SESSION['shopping_session_id'], 'product_id' => $_POST['product_id'], 'color_id' => $_POST['color'], 'size_id' => $_POST['size']));
        //echo $this->db->last_query();
        if($this->general_model->getCount('tbl_tempsales_detail',array('shopping_session_id' => $_SESSION['shopping_session_id'], 'product_id' => $_POST['product_id'], 'color_id' => $_POST['color'], 'size_id' => $_POST['size']))==0){
            $data = array(
                'shopping_session_id' => $_SESSION['shopping_session_id'],
                'product_id' => $_POST['product_id'],
                'color_id' => $_POST['color'],
                'size_id' => $_POST['size'],
                'quantity' => $_POST['quantity'],
                'rate' => $_POST['rate'],
                'total_amount' => $_POST['rate']*$_POST['quantity']
            );
            $tsid = $this->db->insert('tbl_tempsales_detail',$data);
            return $tsid;
        }
    }

    public function get_tempsales(){
        $shopping_session_id = $_SESSION['shopping_session_id'];
        $this->db->select('tbl_product.id as product_id,tbl_product.name,tbl_product.offer_price,tbl_tempsales_detail.quantity');
        $this->db->join('tbl_product','tbl_tempsales_detail.product_id=tbl_product.id');
        $this->db->where('shopping_session_id',$shopping_session_id);
        $query = $this->db->get('tbl_tempsales_detail');
        //echo $this->db->last_query();

        //$rasStock = $q->result_array();
        //echo "num_rows = ".$query->num_rows()."<br>";
        if($query->num_rows()==0)
            return false;
        else{
            return $query->result();
        }
    }

    public function get_sales($sales_id){
        $this->db->select('tbl_product.id as product_id,tbl_product.name,tbl_product.offer_price,tbl_sales_detail.quantity');
        $this->db->join('tbl_product','tbl_product.id=tbl_sales_detail.product_id');
        $this->db->where('sales_id',$sales_id);
        $query = $this->db->get('tbl_sales_detail');
        //echo $this->db->last_query();

        //$rasStock = $q->result_array();
        //echo "num_rows = ".$query->num_rows()."<br>";
        if($query->num_rows()==0)
            return false;
        else{
            return $query->result();
        }
    }

}

/* End of file Home_model.php
 * Location: ./application/modules/home/models/Home_model.php */
