<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tag Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Tag extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tag_model');
        $this->load->model('Component_model');
        $this->load->model('general_model');
    }

    public function index(){
        
        $data['tag_info'] = $this->Tag_model->get_all_tags();
        $data['title'] = 'Tag | UKNiAF';
        $data['page_header'] = 'Tag';
        $data['page_header_icone'] = 'fa-tags';
        $data['nav'] = 'tag';
        $data['panel_title'] = 'Tag List';
        $data['main'] = 'tag/list';
        $this->load->view('home', $data);
    }

    public function deleteTag($tid){

        if (!isset($tid))
            redirect(base_url() . 'admin/tag');

        if (!is_numeric($tid))
            redirect(base_url() . 'admin/tag');

        $this->Tag_model->delete_tag($tid);
        //$this->session->set_flashdata('success', 'Tag Deleted Successfully...');
        redirect(base_url() . 'admin/tag', 'refresh');
    }

    public function delete_tag(){
        echo $this->Tag_model->delete_tag($_POST['tag_id']);
    }

    public function list(){
        $page_header = 'Tags ';
        $data['title'] = 'Tags | UKNiAF';
        $data['page_header'] = $page_header;
        $data['page_header_icone'] = 'fa-tags';
        $data['nav'] = 'tag';
        $data['panel_title'] = 'List All Tag  ';
        $data['main'] = 'tag/list';
        $data['tag_info'] = $this->Tag_model->get_all_tags();
        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = 'Add Tag | UKNiAF';
        $data['page_header'] = 'Tag ';
        $data['page_header_icone'] = 'fa-tags';
        $data['nav'] = 'tag';
        $data['panel_title'] = 'Add Tag  '; 
        $data['project_id'] = $project_id = $this->uri->segment(4); //echo $project_id;
        $data['project_title'] = $this->general_model->getValue('title','tbl_project','id="'.$project_id.'"');
        $data['components'] = $this->Component_model->get_all_component();
        $data['main'] = 'tag/add_edit';
        $this->load->view('home', $data);
    }

    public function add_process(){
        $this->form_validation->set_rules('tag', 'Tag', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Add Tag | UKNiAF';
            $data['page_header'] = 'Tag';
            $data['page_header_icone'] = 'fa-user-hunt';
            $data['nav'] = 'tag';
            $data['panel_title'] = 'Add Tag ';
            
            $data['main'] = 'tag/add_edit';

            $this->load->view('home', $data);

        } else {
            $tid = $this->Tag_model->add_tag();
            $this->session->set_flashdata('success', 'Tag added Successfully...');
            redirect(base_url() . 'admin/tag/', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/tag');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/tag');

        $data['title'] = 'Edit Tag | UKNiAF';
        $data['page_header'] = 'Tag';
        $data['page_header_icone'] = 'fa-tags';
        $data['nav'] = 'tag';
        $data['panel_title'] = 'Edit Tag ';
        $order_by = 'fullname ASC';  
        $data['components'] = $this->Component_model->get_all_component();
        $data['tag_detail'] = $tag_detail = $this->general_model->getById('tbl_tag','id',$id);
        $data['project_id'] = $tag_detail->project_id;
        $data['project_title'] = $this->general_model->getValue('title','tbl_project','id="'.$tag_detail->project_id.'"');
        $data['main'] = 'tag/add_edit';

        $this->load->view('home', $data);
    }

    public function edit_ajax(){
        $tag_id = $_POST['tag_id'];
        $tag_info = $this->Tag_model->get_tag_info($tag_id);
        $form_action = base_url().'admin/tag/edit_process/'.$tag_id;
        $form = '
        <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
          <div class="offcanvas-body">
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Tag</label>
                  <textarea name="tag" id="tag" class="form-control" rows="3">'.$tag_info->tag.'</textarea>
              </div>
              <div class="mb-4">
                  <button type="submit" class="btn btn-success w-sm">Submit</button>
              </div>
          </div>
          <!--end offcanvas-body-->
        </form>
        ';
        echo $form;
    }

    public function edit_process($tid){
        //print_r($_POST);
        if (!isset($tid))
            redirect(base_url() . 'admin/tag/list');

        if (!is_numeric($tid))
            redirect(base_url() . 'admin/tag/list');

        
        $this->form_validation->set_rules('tag', 'tag', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Edit Tag | UKNiAF';
            $data['page_header'] = 'Tag';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'tag';
            $data['panel_title'] = 'Edit Tag ';
            $data['Tag_detail'] = $this->general_model->getById('tbl_tag','id',$tid);
            $data['main'] = 'tag/edit/'.$tid;

            $this->load->view('home', $data);

        } else {
            $this->Tag_model->update_tag($tid);
            $this->session->set_flashdata('success', 'Tag information updated successfully...');
            redirect(base_url() . 'admin/tag/', 'refresh');
        }
    }

    function get_tags(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Tag_model->get_tag($q);
        }
    }
}

/* End of file Tag.php
 * Location: ./application/modules/admin/controllers/Tag.php */