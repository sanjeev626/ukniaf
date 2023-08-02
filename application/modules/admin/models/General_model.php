<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin General_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class General_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function getAll($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL,$limit = NULL) {
        if ($select)
            $this->db->select($select);
        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($group_by)
            $this->db->group_by($group_by);
        if($limit)
            $this->db->limit($limit);

        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit(); 
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

     function getAllResult($table, $where = NULL, $orderBy = NULL, $select = NULL, $group_by = NULL) {
        if ($select)
            $this->db->select($select);
        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($group_by)
            $this->db->group_by($group_by);
        $query = $this->db->get($table); 
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result_array();
        }
    }

    function getResultById($table, $where, $select = '*',$limit ='') {
        $this->db->select($select);
        if ($where)
            $this->db->where($where);

        if($limit){
            $this->db->limit($limit);
        }

        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    function getById($table, $fieldId, $id, $select = '*') {
        $this->db->select($select);
        $this->db->where($fieldId . " = '" . $id . "'");
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    function getFieldById($table, $fieldId, $id, $field) {
        $this->db->select($field);
        $this->db->where($fieldId . " = '" . $id . "'");
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $ras = $query->row();
            return $ras->$field;
        }
    }

    function getValue($field,$table,$where){
        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $ras = $query->row();
            return $ras->$field;
        }
    }

    function getArray($fields,$table,$where){
        $this->db->select($fields);
        $this->db->where($where);
        $query = $this->db->get($table);
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $ras = $query->row();
            return $ras;
        }
    }

    function getQuery($select, $table, $where = NULL, $group_by = NULL, $orderBy = NULL, $limit = NULL) {
        if ($select)
            $this->db->select($select);
        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($group_by)
            $this->db->group_by($group_by);
        if($limit)
            $this->db->limit($limit);

        $query = $this->db->get($table);
        //echo $this->db->last_query(); exit(); 
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function getCount($table, $where = NULL) {
        if ($where)
            $this->db->where($where);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function getallCount($field, $table, $where = NULL) {
        $this->db->select($field); 
        if ($where)
            $this->db->where($where);
        $this->db->from($table);
        echo $this->db->last_query();
        return $this->db->count_all_results();
    }

    function getSum($field,$table,$where = NULL) {
        $this->db->select_sum($field);        
        if ($where)
            $this->db->where($where);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->row()->$field;
    }

    function getAllById($table, $fieldId, $id,$order) {
        $this->db->select();
        $this->db->where($fieldId . " = '" . $id . "'");
        $this->db->order_by($order,'DESC'); 
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }


    function get_with_limit($table, $limit, $start, $search = NULL, $orderBy = NULL) {
        if ($search)
            $this->db->where($search);
        if ($orderBy)
            $this->db->order_by($orderBy, 'ASC');
        $query = $this->db->get($table, $limit, $start);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function countTotal($table, $where = NULL) {
        if ($where)
            $this->db->where($where);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function countCheck($table, $where = NULL) {
        if ($where)
            $this->db->where($where);
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function uploadImage($uploadpath,$filename,$new_filename,$create_thumb="0")
    {
        // Set preference
        $config['upload_path'] = $uploadpath; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '5000'; // max_size in kb
        $config['file_name'] = $new_filename;
        //print_r($config);
        //Load upload library
        $this->load->library('upload',$config); 

        // File upload
        if($this->upload->do_upload($filename)){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];

            // Initialize array
            $data['filenames'][] = $filename;
            $imagename=$filename;
            if($create_thumb=="1"){
                $this->resizeImage($uploadpath,$imagename);
            }
            return $imagename;
        }
    }

    function uploadImageByColor($file_array_name,$i,$upload_path,$filename)
    {

        $_FILES['userfile']['name']     = $_FILES[$file_array_name]['name'][$i];
        $_FILES['userfile']['type']     = $_FILES[$file_array_name]['type'][$i];
        $_FILES['userfile']['tmp_name'] = $_FILES[$file_array_name]['tmp_name'][$i];
        $_FILES['userfile']['error']    = $_FILES[$file_array_name]['error'][$i];
        $_FILES['userfile']['size']     = $_FILES[$file_array_name]['size'][$i];

        /*$fn_ext = pathinfo($_FILES[$file_array_name]['name'][$i], PATHINFO_EXTENSION);
        $slug = $this->getimagecode($_FILES[$file_array_name]['name'][$i]); 
        $slug = str_replace('.'.$fn_ext, '', $slug);
        $filename = $slug.'-'.rand(1111,9999).'.'.$fn_ext;*/

        $config['file_name'] = $filename;
        $config['upload_path'] = $upload_path;
        $config['log_threshold'] = 1;
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '100000'; // 0 = no file size limit
        $config['overwrite'] = false; 

        $this->upload->initialize($config);
        $this->upload->do_upload();
        // Get data about the file
        $uploadData = $this->upload->data();
        $filename = $uploadData['file_name'];
        return $filename;
    }

    function uploadImages($file_array_name,$upload_path,$create_thumb="0")
    {
        $this->load->library('upload');
        $number_of_files_uploaded = count($_FILES[$file_array_name]['name']);
        $number_of_files_uploaded;
        // Faking upload calls to $_FILE
        for ($i = 0; $i < $number_of_files_uploaded; $i++) :          
            if(!empty($_FILES[$file_array_name]['name'][$i]))
            {
              $_FILES['userfile']['name']     = $_FILES[$file_array_name]['name'][$i];
              $_FILES['userfile']['type']     = $_FILES[$file_array_name]['type'][$i];
              $_FILES['userfile']['tmp_name'] = $_FILES[$file_array_name]['tmp_name'][$i];
              $_FILES['userfile']['error']    = $_FILES[$file_array_name]['error'][$i];
              $_FILES['userfile']['size']     = $_FILES[$file_array_name]['size'][$i];

              $fn_ext = pathinfo($_FILES[$file_array_name]['name'][$i], PATHINFO_EXTENSION);
              $slug = $this->getimagecode($_FILES[$file_array_name]['name'][$i]); 
              $slug = str_replace('.'.$fn_ext, '', $slug);
              $filename = $slug.'-'.rand(1111,9999).'.'.$fn_ext;

              $config['file_name'] = $filename;
              $config['upload_path'] = $upload_path;
              $config['log_threshold'] = 1;
              $config['allowed_types'] = 'jpg|png|jpeg|gif';
              $config['max_size'] = '100000'; // 0 = no file size limit
              $config['overwrite'] = false;           

              $imagename[] = $filename;

              $this->upload->initialize($config);
              $this->upload->do_upload();
              if($create_thumb=="1")
                $this->resizeImage($upload_path,$filename);
            }
            else
                $imagename[] = '';
        endfor;        
        return $imagename;
    }

    function resizeImage($uploadpath,$imagename){
        $source_path = FCPATH.$uploadpath.$imagename;
        $target_path = FCPATH.$uploadpath.'thumb/'.$imagename;
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => 200,
            'height' => 200
        );
        $this->load->library('image_lib', $config_manip);

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    function upload_file($folder, $file = '') {
        if ($file == '')
            $file = time();
        $config['upload_path'] = $this->config->item('uploads') . $folder;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = "10716";
        $config['max_width'] = "5000";
        $config['max_height'] = "5000";
        $config['file_name'] = $file;
        $this->load->library('upload', $config);

        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $thumb = '';
        } else {
            $finfo = $this->upload->data();
            $thumb = $finfo['raw_name'] . $finfo['file_ext'];
        }
        return $thumb;
    }

    function del_img($table, $where, $folder, $feild = 'image') {
        $this->db->where($where);
        $query = $this->db->get($table)->row();
        $img = $query->$feild;
        if ($img != '') {
            $path = $this->config->item('uploads') . $folder . '/' . $img;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return true;
    }

    function unlink_img($folder, $name) {
        if ($name != '') {
            $path = $this->config->item('uploads') . $folder . '/' . $name;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
    
    function get_all_modules(){
        $this->db->where('publish','1');
        $this->db->order_by('ordering','ASC');
        return $this->db->get('lkt_module')->result();
    }
    
    function get_children_module($id)
    {
        $this->db->where('parent_id',$id);
        return $this->db->get('lkt_module')->result();
    }
    
    function get_controller_name_of_user($modules_ids)
    {
        $this->db->select("controller");
        $this->db->where_in('id',$modules_ids);
        $query = $this->db->get("lkt_module");
        return $query->result();
    }

    function geturlcode($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

    function getimagecode($text)
    {
      $imagename = explode('.',$text);
      $ext = $imagename[count($imagename)-1];

      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }
      else{
        $text = str_replace('-'.$ext,'.'.$ext,$text);
      }

      return $text;
    }

    function getOrdering($tablename)
    {
        $this->db->select($tablename);
        $query = $this->db->get("lkt_module");
        return $query->result();        
    }

    function get_expense_by_date($date){
        //echo $date;
        $last_date = date('Y-m-d', strtotime('-365 days', strtotime($date)));
        $from_date = date("Y-m-01", strtotime($date));
        $to_date = date("Y-m-t", strtotime($from_date));

        //daily expenses calculation starts here
        $yearly_daily=0;
        $monthly_daily=0;
        $yearly_total = $this->general_model->getSum('amount','tbl_expenses','payment_type="365" AND payment_date BETWEEN "'.$last_date.'" AND "'.$to_date.'"');
        //echo $this->db->last_query();
        //echo 'yearly_total = '.$yearly_total;
        if($yearly_total>0)
            $yearly_daily = $yearly_total/365;
        $monthly_total = $this->general_model->getSum('amount','tbl_expenses','payment_type="30" AND payment_date BETWEEN "'.$from_date.'" AND "'.$to_date.'"');
        //$monthly_total;
        if($monthly_total>0)
            $monthly_daily = $monthly_total/30;
        $daily = $this->general_model->getSum('amount','tbl_expenses','payment_type="1" AND payment_date="'.$date.'"');
        $total_expense = round($yearly_daily+$monthly_daily+$daily,2);
        return $total_expense;
    }

    function display_long_date($date){
        if(!empty($date) && $date!="0000-00-00")
            return date("j F Y", strtotime($date));
        else
            return false;
    }

    function display_short_text($text,$text_length){
        $short_text = '<span title="'.$text.'">'.substr($text,0,$text_length).'</span>';
            return $short_text;
    }

    function days_difference($from_date,$to_date){
        $date1 = strtotime($from_date);
        $date2 = strtotime($to_date);
        $your_date = strtotime("2010-01-31");
        $datediff = $date2 - $date1;
        return round($datediff / (60 * 60 * 24));
    }

    // This function will return a random
    // string of specified length
    function random_strings($length_of_string)
    {
     
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
     
        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
                           0, $length_of_string);
    }

}

/* End of file General_model.php
 * Location: ./application/modules/admin/models/General_model.php */
