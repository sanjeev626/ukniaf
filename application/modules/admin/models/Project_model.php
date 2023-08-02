<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @project Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class project_model extends CI_Model {

    private $table_project = 'tbl_project';

    public function __construct() {
        parent::__construct();
    }  

    public function get_all_projects($component_id=''){
        $this->db->select('*');
        if($component_id!='')
            $this->db->where('component_id',$component_id);
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_project);
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_field_by_id($field,$cid){
        $this->db->select($field);
        $this->db->where('id',$cid);
        $q = $this->db->get($this->table_project);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function delete_project($id){
        // delete from projects
        $this->db->where('id',$id);
        $this->db->delete('tbl_project');
    }

    public function delete_task($project_id){
        // delete from projects
        $this->db->where('project_id',$project_id);
        $this->db->delete('tbl_task');
    }
    
    public function add_project(){
        $data = array(
            'component_id' => $this->input->post('component_id'),
            'title' => $this->input->post('title'),
            'remarks' => $this->input->post('remarks'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->insert($this->table_project,$data);
        //echo $this->db->last_query();
        $project_id = $this->db->insert_id();
        return $project_id;    
    }

    public function update_project($cid){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'component_id' => $this->input->post('component_id'),
            'title' => $this->input->post('title'),
            'remarks' => $this->input->post('remarks'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_project,$data);
        //echo $this->db->last_query();
    }
    
    function get_project($q){
        echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('tbl_project');
        if($query->num_rows() > 0){
          foreach ($query->result_array() as $row){
            $new_row['label']=htmlentities(stripslashes($row['full_name']));
            $new_row['value']=htmlentities(stripslashes($row['full_name']));
            $new_row['the_link']=base_url()."admin/User/edit/".$row['id'];
            $row_set[] = $new_row; //build an array
          }
          echo json_encode($row_set); //format the array into json data
        }
    }
}

/* End of file User_model.php
 * Location: ./application/modules/admin/models/User_model.php */