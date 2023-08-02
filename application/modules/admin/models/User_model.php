<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin User Model
 * @user Model
 * Date created:August 8, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class user_model extends CI_Model {

    private $table_user = 'users';

    public function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }  

    public function get_all_users($component_id=''){
        $this->db->select('*');
        if($component_id!='')
            $this->db->where('component_id',$component_id);
        $this->db->order_by("id","ASC");
        $query =  $this->db->get($this->table_user);
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
        $q = $this->db->get($this->table_user);
        $data1 = $q->result_array();
        $data = array_shift($data1);
        return $data[$field];
    }

    public function delete_user($id){
        // delete from users
        $this->db->where('id',$id);
        $this->db->delete('users');
    }
    
    public function add_user(){
        $hashed_new_password  = $this->ion_auth_model->hash_password($_POST['password'], 'SANJEEVBIKASH');
        $data = array(
            'component_id' => $this->input->post('component_id'),
            'email' => $this->input->post('email'),
            'password' => $hashed_new_password,
            'full_name' => $this->input->post('full_name'),
            'contact_number' => $this->input->post('contact_number'),
            'address' => $this->input->post('address'),
            'created_on' => time()
        );
        //print_r($data);
        $this->db->insert($this->table_user,$data);
        //echo $this->db->last_query();
        $user_id = $this->db->insert_id();

        return $user_id;  
    }    

    function uploadPhoto($user_id,$imagepath,$imagename)
    {
        $data2 = array(
            'user_id' => $user_id,
            'imagepath' => $imagepath,
            'imagename' => $imagename
        );

        //Insert in Photo table
        $this->db->insert('tbl_photo', $data2);
        return $this->db->insert_id();
    }

    public function update_user($cid){
        //echo $cid.' - '.$image.' - '.$imagepath;
        $data = array(
            'component_id' => $this->input->post('component_id'),
            'position_id' => $this->input->post('position_id'),
            'email' => $this->input->post('email'),
            'full_name' => $this->input->post('full_name'),
            'contact_number' => $this->input->post('contact_number'),
            'address' => $this->input->post('address')
        );
        if(!empty($_POST['password'])){
            $hashed_new_password  = $this->ion_auth_model->hash_password($_POST['password'], 'SANJEEVBIKASH');
            $data['password'] = $hashed_new_password;
        }
        $this->db->where('id',$cid);
        $this->db->update($this->table_user,$data);
        //echo $this->db->last_query();
    }

    public function get_all_position(){
        $this->db->select('*');
        $query =  $this->db->get('tbl_position');
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
    function get_user($q){
        echo $q;
        $this->db->select('*');
        $this->db->like('full_name', $q,'after');
        $query = $this->db->get('users');
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