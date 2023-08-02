<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Component_model Model
 * @package Model
 * @subpackage Model
 * Date created:January 24, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Component_model extends CI_Model {

    private $table_component = 'tbl_component';

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }


    public function get_all_component(){
    	$this->db->select('id , title, date_added, date_updated');
    	$query =  $this->db->get($this->table_component);
    	if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_component_by_id($id){
    	$this->db->select();
    	$this->db->where('id',$id);
    	$query = $this->db->get($this->table_component);
    	if($query->num_rows() == 0){
    		return FALSE;
    	}else {
    		return $query->row();
    	}
    }

    public function add_component(){
        $date_updated = date('Y-m-d h:i:s');
        $data = array(
            'title' => $this->input->post('title'),
            'date_added' =>$date_updated,
            'date_updated' =>$date_updated
            );
        $this->db->insert($this->table_component,$data);
    }

    public function update_component($id){
    	$date_updated = date('Y-m-d h:i:s');
    	$data = array(
            'title' => $this->input->post('title'),
    		'date_updated' =>$date_updated
    		);
    	$this->db->where('id',$id);
    	$this->db->update($this->table_component,$data);
    }

/* Quality Component begins here*/

    public function get_all_monthly_risk_register(){
        $this->db->select('*');
        $query =  $this->db->get('tbl_if_monthly_risk_register');
        echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_monthly_risk_register($id){
        $this->db->select();
        $this->db->where('id',$id);
        $query = $this->db->get('tbl_if_monthly_risk_register');
        if($query->num_rows() == 0){
            return FALSE;
        }else {
            return $query->row();
        }
    }

    public function get_all_monthly_risk_register_by_date_range($startDate,$endDate){
        $this->db->select('*');
        $this->db->where('last_updated >=', $startDate);
        $this->db->where('last_updated <=', $endDate);
        $query = $this->db->get('tbl_if_monthly_risk_register');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function add_monthly_risk_register(){
        $date_updated = date('Y-m-d h:i:s');
        $data = array();
        foreach($_POST as $key=>$value){
            $data[$key] = $value;
        }
        $this->db->insert('tbl_if_monthly_risk_register',$data);
    }

    public function update_monthly_risk_register($id){
        $date_updated = date('Y-m-d h:i:s');
        $data = array();
        foreach($_POST as $key=>$value){
            $data[$key] = $value;
        }
        //print_r($data);
        $this->db->where('id',$id);
        $this->db->update('tbl_if_monthly_risk_register',$data);
    }

    public function get_if_weekly_update(){
        $today = new DateTime();
        // Set the starting day of the week to Monday
        $startingDay = clone $today->modify('last week')->modify('Monday');
        $startDate = $startingDay->format('Y-m-d');
        $startingDay->modify('+5 day');
        $endDate = $startingDay->format('Y-m-d');   
        //echo $startDate.' to '.$endDate;

        $this->db->select('*');
        $this->db->where('update_date >=', $startDate);
        $this->db->where('update_date <=', $endDate);
        $query = $this->db->get('tbl_technical_update');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_if_weekly_update_by_date_range($startDate,$endDate){
        $this->db->select('*');
        $this->db->where('update_date >=', $startDate);
        $this->db->where('update_date <=', $endDate);
        $query = $this->db->get('tbl_technical_update');
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_rating($likelihood,$impact){
        $rating="";
        $color_code = "";
        if($impact=="Insignificant" && $likelihood=="Unlikely") $rating="Minor";
        if($impact=="Insignificant" && $likelihood=="Possible") $rating="Minor";
        if($impact=="Insignificant" && $likelihood=="Likely") $rating="Minor";
        if($impact=="Insignificant" && $likelihood=="Highly Likely") $rating="Minor";
        if($impact=="Insignificant" && $likelihood=="Almost Certain") $rating="Minor";

        if($impact=="Minor" && $likelihood=="Unlikely") $rating="Minor";
        if($impact=="Minor" && $likelihood=="Possible") $rating="Minor";
        if($impact=="Minor" && $likelihood=="Likely") $rating="Minor";
        if($impact=="Minor" && $likelihood=="Highly Likely") $rating="Moderate";
        if($impact=="Minor" && $likelihood=="Almost Certain") $rating="Moderate";

        if($impact=="Moderate" && $likelihood=="Unlikely") $rating="Minor";
        if($impact=="Moderate" && $likelihood=="Possible") $rating="Moderate";
        if($impact=="Moderate" && $likelihood=="Likely") $rating="Moderate";
        if($impact=="Moderate" && $likelihood=="Highly Likely") $rating="Major";
        if($impact=="Moderate" && $likelihood=="Almost Certain") $rating="Major";

        if($impact=="Major" && $likelihood=="Unlikely") $rating="Moderate";
        if($impact=="Major" && $likelihood=="Possible") $rating="Major";
        if($impact=="Major" && $likelihood=="Likely") $rating="Major";
        if($impact=="Major" && $likelihood=="Highly Likely") $rating="Severe";
        if($impact=="Major" && $likelihood=="Almost Certain") $rating="Severe";

        if($impact=="Severe" && $likelihood=="Unlikely") $rating="Major";
        if($impact=="Severe" && $likelihood=="Possible") $rating="Severe";
        if($impact=="Severe" && $likelihood=="Likely") $rating="Severe";
        if($impact=="Severe" && $likelihood=="Highly Likely") $rating="Severe";
        if($impact=="Severe" && $likelihood=="Almost Certain") $rating="Severe";

        //echo $impact.' + '.$likelihood.' = '.$rating; echo "<br>";

        if($rating=="Severe") $color_code = "#FF8989";
        if($rating=="Major") $color_code = "#FCAE74";
        if($rating=="Moderate") $color_code = "#FFFF99";
        if($rating=="Minor") $color_code = "#99FFCC";
        if($color_code=="")
            $color_code="#FFFFFF";

        $data = '';
        $data = array('rating' => $rating,'color_code' => $color_code);
        return $data;
    }

}

/* End of file Component_model.php
 * Location: ./application/modules/admin/models/Component_model.php */