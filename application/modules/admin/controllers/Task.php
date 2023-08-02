<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Task Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Task extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        $this->load->model('Component_model');
        $this->load->model('general_model');
    }

    public function index(){
        
        $data['task_info'] = $this->Task_model->get_all_tasks();
        $data['title'] = 'Task | UKNiAF';
        $data['page_header'] = 'Task';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'task';
        $data['panel_title'] = 'Task List';
        $data['main'] = 'task/list';
        $this->load->view('home', $data);
    }

    public function deleteTask($cid){

        if (!isset($cid))
            redirect(base_url() . 'admin/task');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/task');

        $this->Task_model->delete_task($cid);
        $this->session->set_flashdata('success', 'Task Deleted Successfully...');
        redirect(base_url() . 'admin/task', 'refresh');
    }

    public function list(){
        $page_header = 'Tasks ';
        $component_name = '';
        $project_id = $this->uri->segment(4); //echo $component_id;
        if($project_id>0){
            $project_name = $this->general_model->getValue('title','tbl_project','id="'.$project_id.'"');
            $page_header .= ' | '.$project_name;
        }
        $data['title'] = 'Tasks | UKNiAF';
        $data['page_header'] = $page_header;
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'task';
        $data['component_name'] = $component_name;
        $data['panel_title'] = 'List All Task  ';
        $data['main'] = 'task/list';
        $data['task_info'] = $this->Task_model->get_all_tasks($project_id);
        $this->load->view('home', $data);
    }

    public function list_tasks($category_id){
        $cat = $this->general_model->getArray('parent_id,name','tbl_category',array('id' => $category_id));
        //print_r($cat);
        $parent_id = $cat->parent_id;
        $category_name = $cat->name;
        $parent_category_name = $this->general_model->getValue('name','tbl_category',array('id' => $parent_id));
        $data['category_id'] = $category_id;
        $data['title'] = 'List Task | UKNiAF';
        $data['page_header'] = 'Task List :: '.$parent_category_name.' / '.$category_name;
        $data['page_header_icone'] = 'fa-user-hunt';
        $data['nav'] = 'task';
        $data['panel_title'] = 'List Task  ';
        $data['main'] = 'task/list';
        $data['task_info'] = $this->Task_model->get_all_tasks($category_id);

        $this->load->view('home', $data);
    }

    public function list_ordering_update_process($category_id){
        //print_r($_POST);
        for($o=0;$o<count($_POST['ordering_id']);$o++){
            if(isset($_POST['ordering_id'][$o]) && $_POST['ordering_id'][$o]>0)
                $this->Task_model->update_task_ordering($_POST['ordering_id'][$o],$_POST['ordering'][$o]);
            else
                $this->Task_model->add_task_ordering($category_id,$_POST['user_id'][$o],$_POST['ordering'][$o]);
        }
        redirect(base_url() . 'admin/task/list_tasks/'.$category_id, 'refresh');

    }

    public function add(){
        $data['title'] = 'Add Task | UKNiAF';
        $data['page_header'] = 'Task ';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'task';
        $data['panel_title'] = 'Add Task  '; 
        $data['project_id'] = $project_id = $this->uri->segment(4); //echo $project_id;
        $data['project_title'] = $this->general_model->getValue('title','tbl_project','id="'.$project_id.'"');
        $data['components'] = $this->Component_model->get_all_component();
        $data['main'] = 'task/add_edit';
        $this->load->view('home', $data);
    }

    public function add_task_process(){

        $data['project_id'] = $project_id = $this->uri->segment(4); //echo $project_id;
        $this->form_validation->set_rules('task_order', 'task_order', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Add Task | UKNiAF';
            $data['page_header'] = 'Task';
            $data['page_header_icone'] = 'fa-user-hunt';
            $data['nav'] = 'task';
            $data['panel_title'] = 'Add Task ';
            
            $data['main'] = 'task/add_edit';

            $this->load->view('home', $data);

        } else {
            $cid = $this->Task_model->add_task();
            $this->session->set_flashdata('success', 'Task added Successfully...');
            redirect(base_url() . 'admin/task/list/'.$project_id, 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/task');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/task');

        $data['title'] = 'Edit Task | UKNiAF';
        $data['page_header'] = 'Task';
        $data['page_header_icone'] = 'fa-tasks';
        $data['nav'] = 'task';
        $data['panel_title'] = 'Edit Task ';
        $order_by = 'fullname ASC';  
        $data['components'] = $this->Component_model->get_all_component();
        $data['task_detail'] = $task_detail = $this->general_model->getById('tbl_task','id',$id);
        $data['project_id'] = $task_detail->project_id;
        $data['project_title'] = $this->general_model->getValue('title','tbl_project','id="'.$task_detail->project_id.'"');
        $data['main'] = 'task/add_edit';

        $this->load->view('home', $data);
    }

    public function edit_task_process($cid){
        //print_r($_POST);
        if (!isset($cid))
            redirect(base_url() . 'admin/task/list');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/task/list');

        
        $this->form_validation->set_rules('task_order', 'task_order', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Edit Task | UKNiAF';
            $data['page_header'] = 'Task';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'task';
            $data['panel_title'] = 'Edit Task ';
            $data['Task_detail'] = $this->general_model->getById('tbl_task','id',$cid);
            $data['main'] = 'task/edit/'.$cid;

            $this->load->view('home', $data);

        } else {
            $this->Task_model->update_task($cid);
            $this->session->set_flashdata('success', 'Task information updated successfully...');
            redirect(base_url() . 'admin/task/edit/'.$cid, 'refresh');
        }
    }

    function get_tasks(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Task_model->get_task($q);
        }
    }

    public function deleteImage($image_id){

        if (!isset($image_id))
            redirect(base_url() . 'admin/task');

        if (!is_numeric($image_id))
            redirect(base_url() . 'admin/task');
        $rasImage = $this->general_model->getArray('user_id,imagepath,imagename','tbl_task_image','id='.$image_id);
        $user_id = $rasImage->user_id;
        $imagepath = $rasImage->imagepath.$rasImage->imagename;
        @unlink($imagepath);
        $this->general_model->delete('tbl_task_image', 'id='.$image_id);
        $this->session->set_flashdata('success', 'Task image deleted successfully...');
        redirect(base_url() . 'admin/task/edit/'.$user_id, 'refresh');
    }
}

/* End of file Task.php
 * Location: ./application/modules/admin/controllers/Task.php */