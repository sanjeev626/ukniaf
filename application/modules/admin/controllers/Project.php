<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Project extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Project_model');
        $this->load->model('Component_model');
        $this->load->model('general_model');
    }

    public function index(){
        
        $data['project_info'] = $this->Project_model->get_all_projects();
        $data['title'] = 'Project | UKNiAF';
        $data['page_header'] = 'Project';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'project';
        $data['panel_title'] = 'Project List';
        $data['main'] = 'project/list';
        $this->load->view('home', $data);
    }

    public function deleteProject($cid){

        if (!isset($cid))
            redirect(base_url() . 'admin/project');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/project');

        $this->Project_model->delete_task($cid);
        $this->Project_model->delete_project($cid);
        $this->session->set_flashdata('success', 'The selected Project and all the task under this project has been successfully deleted ...');
        redirect(base_url() . 'admin/project', 'refresh');
    }

    public function list(){
        $page_header = 'Projects ';
        $component_name = '';
        $component_id = $this->uri->segment(4); //echo $component_id;
        if($component_id>0){
            $component_name = $this->general_model->getValue('title','tbl_component','id="'.$component_id.'"');
            $page_header .= ' | '.$component_name;
        }
        $data['title'] = 'Projects | UKNiAF';
        $data['page_header'] = $page_header;
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'project';
        $data['component_name'] = $component_name;
        $data['panel_title'] = 'List All Project  ';
        $data['main'] = 'project/list';
        $data['user_info'] = $this->Project_model->get_all_projects($component_id);
        $this->load->view('home', $data);
    }

    public function list_projects($category_id){
        $cat = $this->general_model->getArray('parent_id,name','tbl_category',array('id' => $category_id));
        //print_r($cat);
        $parent_id = $cat->parent_id;
        $category_name = $cat->name;
        $parent_category_name = $this->general_model->getValue('name','tbl_category',array('id' => $parent_id));
        $data['category_id'] = $category_id;
        $data['title'] = 'List Project | UKNiAF';
        $data['page_header'] = 'Project List :: '.$parent_category_name.' / '.$category_name;
        $data['page_header_icone'] = 'fa-user-hunt';
        $data['nav'] = 'project';
        $data['panel_title'] = 'List Project  ';
        $data['main'] = 'project/list';
        $data['user_info'] = $this->Project_model->get_all_projects($category_id);

        $this->load->view('home', $data);
    }

    public function list_ordering_update_process($category_id){
        //print_r($_POST);
        for($o=0;$o<count($_POST['ordering_id']);$o++){
            if(isset($_POST['ordering_id'][$o]) && $_POST['ordering_id'][$o]>0)
                $this->Project_model->update_project_ordering($_POST['ordering_id'][$o],$_POST['ordering'][$o]);
            else
                $this->Project_model->add_project_ordering($category_id,$_POST['user_id'][$o],$_POST['ordering'][$o]);
        }
        redirect(base_url() . 'admin/project/list_projects/'.$category_id, 'refresh');

    }

    public function add(){
        $data['title'] = 'Add Project | UKNiAF';
        $data['page_header'] = 'Project ';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'project';
        $data['panel_title'] = 'Add Project  '; 
        $data['component_id'] = $component_id = $this->uri->segment(4); //echo $component_id;
        $data['components'] = $this->Component_model->get_all_component();
        $data['main'] = 'project/add_edit';
        $this->load->view('home', $data);
    }

    public function add_project_process(){

        $this->form_validation->set_rules('title', 'title', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Add Project | UKNiAF';
            $data['page_header'] = 'Project';
            $data['page_header_icone'] = 'fa-user-hunt';
            $data['nav'] = 'project';
            $data['panel_title'] = 'Add Project ';
            
            $data['main'] = 'project/add_edit';

            $this->load->view('home', $data);

        } else {
            $cid = $this->Project_model->add_project();
            $this->session->set_flashdata('success', 'Project added Successfully...');
            redirect(base_url() . 'admin/project', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/project');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/project');

        $data['title'] = 'Edit Project | UKNiAF';
        $data['page_header'] = 'Project';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'project';
        $data['panel_title'] = 'Edit Project ';
        $order_by = 'fullname ASC';  
        $data['components'] = $this->Component_model->get_all_component();
        $data['project_detail'] = $project_detail = $this->general_model->getById('tbl_project','id',$id);
        //print_r($project_detail);
        $data['component_id'] = $project_detail->component_id;
        $data['main'] = 'project/add_edit';

        $this->load->view('home', $data);
    }

    public function edit_project_process($cid){
        //print_r($_POST);
        if (!isset($cid))
            redirect(base_url() . 'admin/project/list');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/project/list');

        
        $this->form_validation->set_rules('title', 'title', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Edit Project | UKNiAF';
            $data['page_header'] = 'Project';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'project';
            $data['panel_title'] = 'Edit Project ';
            $data['Project_detail'] = $this->general_model->getById('tbl_project','id',$cid);
            $data['main'] = 'project/edit/'.$cid;

            $this->load->view('home', $data);

        } else {
            $this->Project_model->update_project($cid);
            $this->session->set_flashdata('success', 'Project information updated successfully...');
            redirect(base_url() . 'admin/project/edit/'.$cid, 'refresh');
        }
    }

    function stock_manage($cid){

        if (!isset($cid))
            redirect(base_url() . 'admin/project');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/project');

        $data['project_detail'] = $project_detail = $this->general_model->getById('tbl_project','id',$cid);
        $data['title'] = 'Stock Management | UKNiAF';
        $data['page_header'] = 'Stock Management for '.$project_detail->name;
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'project';
        $data['panel_title'] = 'Stock Management ';
        $order_by = 'fullname ASC';  
        $data['parent_categories'] = $this->Category_model->get_all_parent();
        $data['cid'] = $cid;
        $data['color_attributes'] = $project_detail->color_attributes;
        $data['size_attributes'] = $project_detail->size_attributes;
        $data['main'] = 'project/stock_manage';
        $this->load->view('home', $data);
    }

    function stock_manage_process($cid){
        for($s=0;$s<count($_POST['purchased_stock_id']);$s++){
            if(isset($_POST['purchased_stock_id'][$s]) && $_POST['purchased_stock_id'][$s]>0){
                $this->Project_model->update_project_stock($cid,$_POST['color_id'][$s],$_POST['size_id'][$s],$_POST['purchased_stock'][$s],$_POST['purchased_stock_id'][$s]);
            }
            else{
                $this->Project_model->add_project_stock($cid,$_POST['color_id'][$s],$_POST['size_id'][$s],$_POST['purchased_stock'][$s]);
            }
        }
        redirect(base_url() . 'admin/project/stock_manage/'.$cid, 'refresh');
    }

    function stock_all(){
        //print_r($cat);
        $data['title'] = 'List Project | UKNiAF';
        $data['page_header'] = 'Project List :: ';
        $data['page_header_icone'] = 'fa-user-hunt';
        $data['nav'] = 'project';
        $data['panel_title'] = 'List Project  ';
        $data['main'] = 'project/stock_all';
        $data['user_info'] = $this->Project_model->get_stock_all();

        $this->load->view('home', $data);

    }

    function get_projects(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Project_model->get_project($q);
        }
    }

    public function deleteImage($image_id){

        if (!isset($image_id))
            redirect(base_url() . 'admin/project');

        if (!is_numeric($image_id))
            redirect(base_url() . 'admin/project');
        $rasImage = $this->general_model->getArray('user_id,imagepath,imagename','tbl_project_image','id='.$image_id);
        $user_id = $rasImage->user_id;
        $imagepath = $rasImage->imagepath.$rasImage->imagename;
        @unlink($imagepath);
        $this->general_model->delete('tbl_project_image', 'id='.$image_id);
        $this->session->set_flashdata('success', 'Project image deleted successfully...');
        redirect(base_url() . 'admin/project/edit/'.$user_id, 'refresh');
    }
}

/* End of file Project.php
 * Location: ./application/modules/admin/controllers/Project.php */