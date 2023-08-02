<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @task Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class task_model extends CI_Model {

    private $table_task = 'tbl_task';

    public function __construct() {
        parent::__construct();
    }  

    public function get_all_tasks($project_id=''){
        $this->db->select('*');
        if($project_id!='')
            $this->db->where('project_id',$project_id);
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_task);
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
        $q = $this->db->get($this->table_task);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function delete_task($id){
        // delete from tasks
        $this->db->where('id',$id);
        $this->db->delete($this->table_task);
    }
    
    public function add_task(){
        $data = array(
            'project_id' => $this->input->post('project_id'),
            'task_order' => $this->input->post('task_order'),
            'task' => $this->input->post('task'),
            'remarks' => $this->input->post('remarks'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->insert($this->table_task,$data);
        //echo $this->db->last_query();
        $task_id = $this->db->insert_id();
        return $task_id;    
    }

    public function update_task($cid){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'project_id' => $this->input->post('project_id'),
            'task_order' => $this->input->post('task_order'),
            'task' => $this->input->post('task'),
            'remarks' => $this->input->post('remarks'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_task,$data);
        //echo $this->db->last_query();
    }
    
    function get_task($q){
        echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get($this->table_task);
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