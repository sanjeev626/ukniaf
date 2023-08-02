<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @tag Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class tag_model extends CI_Model {

    private $table_tag = 'tbl_tag';

    public function __construct() {
        parent::__construct();
    }  

    public function get_all_tags(){
        $this->db->select('*');
        $this->db->order_by("tag","ASC");
        $query =  $this->db->get($this->table_tag);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function delete_tag($id){
        if($id>0){
            // delete from tags
            $this->db->where('id',$id);
            if($this->db->delete($this->table_tag))
                return "success";
        }
    }
    
    public function add_tag(){
        $data = array(
            'tag' => $this->input->post('tag'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->insert($this->table_tag,$data);
        //echo $this->db->last_query();
        $tag_id = $this->db->insert_id();
        return $tag_id;    
    }

    public function update_tag($cid){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'tag' => $this->input->post('tag'),
            'date_updated' => date('Y-m-d')
        );
        $this->db->where('id',$cid);
        $this->db->update($this->table_tag,$data);
        //echo $this->db->last_query();
    }

    public function get_tag_info($tag_id){

        $this->db->select('*');
        $this->db->where('id', $tag_id);
        $query = $this->db->get($this->table_tag);
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
        //echo $this->db->last_query();
    }
    
    function get_tag($q){
        echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get($this->table_tag);
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