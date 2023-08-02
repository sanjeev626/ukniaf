<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @milestonetracker Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class milestonetracker_model extends CI_Model {

    private $table = 'tbl_milestone_tracker';

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    } 

    public function get_by_id($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_milestone_tracker');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    } 

    public function save_update($milestonetracker_id,$column_name,$value){
        $user_id = $this->session->user_id;
        if($milestonetracker_id>0){
            //Update
            $data = array(
                $column_name => $value
            );
            $this->db->where('id',$milestonetracker_id);
            $this->db->update('tbl_milestone_tracker',$data);
        }
        else{
            //Insert
            $data = array(
                'user_id' => $user_id,
                'update_date' => date('Y-m-d'),
                $column_name => $value
            );
            //print_r($data);
            $this->db->insert('tbl_milestone_tracker',$data);
            $tid = $this->db->insert_id();
            //echo $tid;
        }
    } 

    public function save_status($milestonetracker_id){
        if($milestonetracker_id>0){
            //Update
            $data = array(
                'update_status' => 'closed'
            );
            $this->db->where('id',$milestonetracker_id);
            $this->db->update('tbl_milestone_tracker',$data);
            echo 'success';
        }
    }

    public function add(){
        $user_id = $this->session->user_id;
        //Update
        $data = array(
            'user_id' => $user_id,
            'component' => $this->input->post('component'),
            'to_number' => $this->input->post('to_number'),
            'to_name' => $this->input->post('to_name'),
            'm_number' => $this->input->post('m_number'),
            'milestone_title' => $this->input->post('milestone_title'),
            'milestone_due_date' => $this->input->post('milestone_due_date'),
            'milestonetracker_status' => $this->input->post('milestonetracker_status'),
            'fcdo_status' => $this->input->post('fcdo_status'),
            'notes' => $this->input->post('notes'),
            'fcdo_url_to_ppt' => $this->input->post('fcdo_url_to_ppt')
        );
        $this->db->insert('tbl_milestone_tracker',$data);
    }

    public function update($milestonetracker_id){
        //print_r($_POST);
        $user_id = $this->session->user_id;
        //Update
        $data = array(
            'user_id' => $user_id,
            'component' => $this->input->post('component'),
            'to_number' => $this->input->post('to_number'),
            'to_name' => $this->input->post('to_name'),
            'm_number' => $this->input->post('m_number'),
            'milestone_title' => $this->input->post('milestone_title'),
            'milestone_due_date' => $this->input->post('milestone_due_date'),
            'milestonetracker_status' => $this->input->post('milestonetracker_status'),
            'fcdo_status' => $this->input->post('fcdo_status'),
            'notes' => $this->input->post('notes'),
            'fcdo_url_to_ppt' => $this->input->post('fcdo_url_to_ppt')
        );
        $this->db->where('id',$milestonetracker_id);
        $this->db->update('tbl_milestone_tracker',$data);
        //echo $this->db->last_query();
    }

    public function get_all_milestonetrackers(){

        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_milestone_tracker');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_all_milestonetrackers_by_date_range($startDate,$endDate){
        $this->db->select('*');
        $this->db->where('date_added >=', $startDate);
        $this->db->where('date_added <=', $endDate);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tbl_milestone_tracker');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */