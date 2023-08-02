<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Milestone Controller
 * @milestone Controller
 * @submilestone Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Milestone extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Milestone_model');
        //$this->load->model('Component_model');
        $this->load->model('general_model');
    }

    public function index(){
        
        $data['milestone_info'] = $this->Milestone_model->get_all_milestones();
        $data['title'] = 'Milestone | UKNiAF';
        $data['page_header'] = 'Milestone';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone List';
        $data['main'] = 'milestone/list';
        $this->load->view('home', $data);
    }

    public function archive(){     
        $startDate = '0000-00-00';
        $endDate = '0000-00-00';
        if(isset($_POST['date_range']) && strlen($_POST['date_range'])>20){
            $dt = $_POST['date_range'];
            $dt_arr = explode(' to ', $dt);
            $startDate = $dt_arr['0'];
            $endDate = $dt_arr['1'];
        }        
        $data['milestone_info'] = $this->Milestone_model->get_all_milestones_by_date_range($startDate,$endDate);
        //echo $this->db->last_query();
        $data['title'] = 'Milestone | UKNiAF';
        $data['page_header'] = 'Milestone';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone List';
        $data['main'] = 'milestone/archive';
        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = 'Milestone Schedule | UKNiAF';
        $data['page_header'] = 'Milestone Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone Schedule';
        $data['main'] = 'milestone/add_edit';
        $this->load->view('home', $data);
    }

    public function add_process(){
        $this->form_validation->set_rules('task_order', 'task_order', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Milestone Schedule | UKNiAF';
            $data['page_header'] = 'Milestone Schedule';
            $data['page_header_icone'] = 'fa-calendar';
            $data['nav'] = 'milestone';
            $data['panel_title'] = 'Milestone Schedule';
            $data['main'] = 'milestone/add/';

            $this->load->view('home', $data);

        } else {
            $this->Milestone_model->add();
            $this->session->set_flashdata('success', 'Milestone information added successfully...');
            redirect(base_url() . 'admin/milestone/', 'refresh');
        }
    }

    public function edit($milestone_id){
        //$milestone_id = $this->uri->segment('4');
        $data['title'] = 'Milestone Schedule | UKNiAF';
        $data['page_header'] = 'Milestone Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone Schedule';
        $data['main'] = 'milestone/add_edit';
        if(isset($milestone_id) && $milestone_id>0)
            $data['milestone'] = $this->Milestone_model->get_milestone($milestone_id);
        $this->load->view('home', $data);
    }

    public function edit_process($milestone_id){

        //print_r($_POST);
        if (!isset($milestone_id))
            redirect(base_url() . 'admin/milestone/list');

        if (!is_numeric($milestone_id))
            redirect(base_url() . 'admin/milestone/list');

        
        $this->form_validation->set_rules('task_order', 'task_order', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Milestone Schedule | UKNiAF';
            $data['page_header'] = 'Milestone Schedule';
            $data['page_header_icone'] = 'fa-calendar';
            $data['nav'] = 'milestone';
            $data['panel_title'] = 'Milestone Schedule';
            $data['main'] = 'milestone/edit/'.$milestone_id;

            $this->load->view('home', $data);

        } else {
            $this->Milestone_model->update($milestone_id);
            $this->session->set_flashdata('success', 'Milestone information updated successfully...');
            //redirect(base_url() . 'admin/milestone/edit/'.$milestone_id, 'refresh');
            redirect(base_url() . 'admin/milestone', 'refresh');
        }
    }

    public function list(){
        $data['title'] = 'Milestone Schedule | UKNiAF';
        $data['page_header'] = 'Milestone Schedule List';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone Schedule List';
        $data['main'] = 'milestone/list';
        $data['task_orders'] = $this->Milestone_model->get_unique_task_order();
        $data['milestones'] = $this->Milestone_model->get_all_milestones();
        $this->load->view('home', $data);
    }

    public function view($milestone_id){
        //$milestone_id = $this->uri->segment('4');
        $data['title'] = 'Milestone Schedule | UKNiAF';
        $data['page_header'] = 'Milestone Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestone';
        $data['panel_title'] = 'Milestone Schedule';
        $data['main'] = 'milestone/view';
        if(isset($milestone_id) && $milestone_id>0)
            $data['milestone'] = $this->Milestone_model->get_milestone($milestone_id);
        $this->load->view('home', $data);
    }

    public function create_report(){
        $this->Milestone_model->create_report();
        $this->session->set_flashdata('success', 'Report created Successfully...');
        redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    public function save_update(){
        //echo $_POST['milestone_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Milestone_model->save_update($_POST['milestone_id'],$_POST['column_name'],$_POST['value']);
    }

    public function save_status(){
        //echo $_POST['milestone_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Milestone_model->save_status($_POST['milestone_id']);
    }


}

/* End of file Milestone.php
 * Location: ./application/modules/admin/controllers/Milestone.php */