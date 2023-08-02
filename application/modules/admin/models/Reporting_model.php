<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @reporting Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class reporting_model extends CI_Model {

    private $table_reporting = 'reportings';

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }  

    public function save_update($technical_update_id,$column_name,$value){
        $user_id = $this->session->user_id;
        if($technical_update_id>0){
            //Update
            $data = array(
                $column_name => $value
            );
            $this->db->where('id',$technical_update_id);
            $this->db->update('tbl_technical_update',$data);
        }
        else{
            //Insert
            $data = array(
                'user_id' => $user_id,
                'update_date' => date('Y-m-d'),
                $column_name => $value
            );
            //print_r($data);
            $this->db->insert('tbl_technical_update',$data);
            $tid = $this->db->insert_id();
            //echo $tid;
        }
    } 

    public function save_status($technical_update_id){
        if($technical_update_id>0){
            //Update
            $data = array(
                'update_status' => 'closed'
            );
            $this->db->where('id',$technical_update_id);
            $this->db->update('tbl_technical_update',$data);
            echo 'success';
        }
    }



    public function add_technical_update(){
        $user_id = $this->session->user_id;
        //Update
        $data = array(
            'user_id' => $user_id,
            'update_date' => date('Y-m-d'),
            'modified_date' => date('Y-m-d'),
            'task_order' => $this->input->post('task_order'),
            'risk_number' => $this->input->post('risk_number'),
            'updates' => $this->input->post('updates'),
            'decision' => $this->input->post('decision'),
            'action' => $this->input->post('action'),
            'stakeholder' => $this->input->post('stakeholder'),
            'internal_notes' => $this->input->post('internal_notes'),
            'fcdo_update' => $this->input->post('fcdo_update'),
            'risk' => $this->input->post('risk'),
            'mitigation' => $this->input->post('mitigation'),
            'residual_risk' => $this->input->post('residual_risk'),
            'update_status' => $this->input->post('update_status'),
            'tags' => $this->input->post('tags'),
            'document_url' => $this->input->post('document_url')
        );
        $this->db->insert('tbl_technical_update',$data);
    }  

    public function update_technical_update($id){
        $user_id = $this->session->user_id;
        //Update
        $tags = '';
        if(isset($_POST['tags']) && !empty($_POST['tags']))
            $tags = serialize($_POST['tags']);

        $data = array(
            'user_id' => $user_id,
            'modified_date' => date('Y-m-d'),
            'task_order' => $this->input->post('task_order'),
            'risk_number' => $this->input->post('risk_number'),
            'updates' => $this->input->post('updates'),
            'decision' => $this->input->post('decision'),
            'action' => $this->input->post('action'),
            'stakeholder' => $this->input->post('stakeholder'),
            'internal_notes' => $this->input->post('internal_notes'),
            'fcdo_update' => $this->input->post('fcdo_update'),
            'risk' => $this->input->post('risk'),
            'mitigation' => $this->input->post('mitigation'),
            'residual_risk' => $this->input->post('residual_risk'),
            'update_status' => $this->input->post('update_status'),
            'tags' => $tags,
            'document_url' => $this->input->post('document_url')
        );
        $this->db->where('id',$id);
        $this->db->update('tbl_technical_update',$data);
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

    public function get_techincal_update($technical_update_id){

        $this->db->select('*');
        $this->db->where('id', $technical_update_id);
        $query = $this->db->get('tbl_technical_update');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
        //echo $this->db->last_query();
    }

    public function get_all_techincal_update_by_date_range($startDate,$endDate){
        $this->db->select('*');
        $this->db->where('update_date >=', $startDate);
        $this->db->where('update_date <=', $endDate);
        $query = $this->db->get('tbl_technical_update');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_weekly_techincal_update_archieve(){
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
        $query = $this->db->get('tbl_technical_update');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_last_week_data($type,$update_date,$risk_number){
        $user_id = $this->session->user_id;
        $today = new DateTime($update_date);
        //print_r($today);
        // Set the starting day of the week to Monday
        $startingDay = clone $today->modify('last week')->modify('Monday');
        $startDate = $startingDay->format('Y-m-d');
        $startingDay->modify('+4 day');
        $endDate = $startingDay->format('Y-m-d');

        $this->db->select($type);
        //$this->db->where('user_id', $user_id);
        $this->db->where('risk_number', $risk_number);
        $this->db->where('update_date >=', $startDate);
        $this->db->where('update_date <=', $endDate);
        $query = $this->db->get('tbl_technical_update');
        //return $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            $row = $query->row();
            return $row->$type;
        }

        //return $this->db->last_query();
    }

    public function get_techincal_update_dashboard(){
        $user_id = $this->session->user_id;


        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_technical_update');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_techincal_update_by_risk_number($risk_number){
        $this->db->select('*');
        $this->db->where('risk_number', $risk_number);
        $query = $this->db->get('tbl_technical_update');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_techincal_update_by_date_range($from_date,$to_date,$update_status){
        $this->db->select('*');
        $this->db->where('update_status', $update_status);
        $this->db->where('update_date >=', $from_date);
        $this->db->where('update_date <=', $to_date);
        $query = $this->db->get('tbl_technical_update');
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
        $query = $this->db->get('tbl_technical_update');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_technical_updates(){
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_technical_update');
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
        $query = $this->db->get('tbl_technical_update');
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
        $query = $this->db->get('tbl_technical_update');
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    public function get_risk_number_count(){ 
        $this->db->select('risk_number');
        $this->db->group_by('risk_number');
        $query = $this->db->get('tbl_technical_update');
        //echo $this->db->last_query();
        return $query->num_rows();
    }
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */