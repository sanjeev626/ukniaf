<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @milestone Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class milestone_model extends CI_Model {

    private $table_milestone = 'milestones';

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }  

    public function save_update($milestone_id,$column_name,$value){
        $user_id = $this->session->user_id;
        if($milestone_id>0){
            //Update
            $data = array(
                $column_name => $value
            );
            $this->db->where('id',$milestone_id);
            $this->db->update('tbl_milestone_schedule',$data);
        }
        else{
            //Insert
            $data = array(
                'user_id' => $user_id,
                'update_date' => date('Y-m-d'),
                $column_name => $value
            );
            //print_r($data);
            $this->db->insert('tbl_milestone_schedule',$data);
            $tid = $this->db->insert_id();
            //echo $tid;
        }
    } 

    public function save_status($milestone_id){
        if($milestone_id>0){
            //Update
            $data = array(
                'update_status' => 'closed'
            );
            $this->db->where('id',$milestone_id);
            $this->db->update('tbl_milestone_schedule',$data);
            echo 'success';
        }
    }

    public function add(){
        $user_id = $this->session->user_id;
        //Update
        $data = array(
            'user_id' => $user_id,
            'date_modified' => date('Y-m-d'),
            'task_order' => $this->input->post('task_order'),
            'm_ref' => $this->input->post('m_ref'),
            'milestone' => $this->input->post('milestone'),
            'due_to_fcdo' => $this->input->post('due_to_fcdo'),
            'evidence_required' => $this->input->post('evidence_required'),
            'milestone_delivery_risks_to_flag' => $this->input->post('milestone_delivery_risks_to_flag'),
            'milestone_status' => $this->input->post('milestone_status'),
            'fcdo_approval' => $this->input->post('fcdo_approval')
        );
        $this->db->insert('tbl_milestone_schedule',$data);
    }

    public function update($milestone_id){
        //print_r($_POST);
        $user_id = $this->session->user_id;
        //Update
        $data = array(
            'user_id' => $user_id,
            'date_modified' => date('Y-m-d'),
            'task_order' => $this->input->post('task_order'),
            'm_ref' => $this->input->post('m_ref'),
            'milestone' => $this->input->post('milestone'),
            'due_to_fcdo' => $this->input->post('due_to_fcdo'),
            'evidence_required' => $this->input->post('evidence_required'),
            'milestone_delivery_risks_to_flag' => $this->input->post('milestone_delivery_risks_to_flag'),
            'milestone_status' => $this->input->post('milestone_status'),
            'fcdo_approval' => $this->input->post('fcdo_approval')
        );
        $this->db->where('id',$milestone_id);
        $this->db->update('tbl_milestone_schedule',$data);
        //echo $this->db->last_query();
    }

    public function create_report(){
        $urlcode = strtoupper($this->general_model->random_strings(10));
        $user_id = $this->session->user_id;
         $today = new DateTime();
        // Set the starting day of the week to Monday
        $startingDay = clone $today->modify('this week')->modify('Monday');
        $startDate = $startingDay->format('Y-m-d');
        $startingDay->modify('+5 day');
        $endDate = $startingDay->format('Y-m-d');   
        $data = array(
            'sender_id' => $user_id,
            'from_date' => $startDate,
            'to_date' => $endDate,
            'urlcode' => $urlcode
        );
        //print_r($data);
        $this->db->insert('tbl_techincal_report',$data);  
    }

    public function get_milestone($milestone_id){

        $this->db->select('*');
        $this->db->where('id', $milestone_id);
        $query = $this->db->get('tbl_milestone_schedule');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

    public function get_weekly_milestone_archieve(){
        $user_id = $this->session->user_id;
        // Get the current date
        $today = new DateTime();

        // Set the starting day of the week to Monday
        $startingDay = clone $today->modify('this week')->modify('Monday');
        $startDate = $startingDay->format('Y-m-d');
        $startingDay->modify('+5 day');
        $endDate = $startingDay->format('Y-m-d');


        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $this->db->where('update_date >=', $startDate);
        $this->db->where('update_date <=', $endDate);
        $query = $this->db->get('tbl_milestone_schedule');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_milestone_dashboard(){
        $user_id = $this->session->user_id;


        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_milestone_schedule');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_milestone_by_risk_number($risk_number){
        $this->db->select('*');
        $this->db->where('risk_number', $risk_number);
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_unique_task_order(){
        $this->db->select('task_order');
        $this->db->group_by('task_order');
        $this->db->order_by('task_order', 'ASC');
        $query = $this->db->get('tbl_milestone_schedule');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_milestones(){
        $this->db->select('*');
        $this->db->where('milestone_status','Active');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_milestones_by_date_range($startDate,$endDate){
        $this->db->select('*');
        $this->db->where('date_added >=', $startDate);
        $this->db->where('date_added <=', $endDate);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_risk_number_by_task_order($task_order){
        $this->db->select('risk_number');
        $this->db->where('task_order', $task_order);
        $this->db->group_by('risk_number');
        $this->db->order_by('risk_number', 'ASC');
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function list_risk_number_html($task_order){
        $select = ' <select name="risk_number" id="risk_number" class="form-control text-right" onchange="this.form.submit();">
          <option value="">Select Risk Number</option>';
        $risk_numbers = $this->get_risk_number_by_task_order($task_order);
        foreach($risk_numbers as $risk_number){
            $select.='<option value="'.$risk_number->risk_number.'">'.$risk_number->risk_number.'</option>';
        }
        $select.="</select>";
        return $select;
    }

    public function get_task_order_count(){ 
        $this->db->select('task_order');
        $this->db->group_by('task_order');
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    public function get_risk_number_count(){ 
        $this->db->select('risk_number');
        $this->db->group_by('risk_number');
        $query = $this->db->get('tbl_milestone_schedule');
        //echo $this->db->last_query();
        return $query->num_rows();
    }
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */