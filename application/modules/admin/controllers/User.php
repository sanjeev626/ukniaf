<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Controller
 * @user Controller
 * @subuser Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Component_model');
        $this->load->model('general_model');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    }

    public function index(){
        
        $data['user_info'] = $this->User_model->get_all_users();
        $data['title'] = 'User | UKNiAF';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'user';
        $data['panel_title'] = 'User List';
        $data['main'] = 'user/list';
        $this->load->view('home', $data);
    }

    public function deleteUser($cid){

        if (!isset($cid))
            redirect(base_url() . 'admin/user');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/user');

        $redirect_url = base_url() . 'admin/user';
        $component_id = $this->uri->segment(5);
        if(isset($component_id) && $component_id>0)
            $redirect_url .= '/list/'.$component_id;
        //echo $component_id.' --- '.$redirect_url;
        $this->User_model->delete_user($cid);
        $this->session->set_flashdata('success', 'The selected User Deleted Successfully...');
        redirect($redirect_url, 'refresh');
    }

    public function list(){
        $page_header = 'Users ';
        $component_name = '';
        $component_id = $this->uri->segment(4); //echo $component_id;
        if($component_id>0){
            $component_name = $this->general_model->getValue('title','tbl_component','id="'.$component_id.'"');
            $page_header .= ' | '.$component_name;
        }
        $data['title'] = 'Users | UKNiAF';
        $data['page_header'] = $page_header;
        $data['page_header_icone'] = 'fa-users';
        $data['nav'] = 'user';
        $data['component_id'] = $component_id;
        $data['component_name'] = $component_name;
        $data['panel_title'] = 'List All User  ';
        $data['main'] = 'user/list';
        $data['user_info'] = $this->User_model->get_all_users($component_id);
        $this->load->view('home', $data);
    }

    public function list_users($category_id){
        $cat = $this->general_model->getArray('parent_id,name','tbl_category',array('id' => $category_id));
        //print_r($cat);
        $parent_id = $cat->parent_id;
        $category_name = $cat->name;
        $parent_category_name = $this->general_model->getValue('name','tbl_category',array('id' => $parent_id));
        $data['category_id'] = $category_id;
        $data['title'] = 'List User | UKNiAF';
        $data['page_header'] = 'User List :: '.$parent_category_name.' / '.$category_name;
        $data['page_header_icone'] = 'fa-user-hunt';
        $data['nav'] = 'user';
        $data['panel_title'] = 'List User  ';
        $data['main'] = 'user/list';
        $data['user_info'] = $this->User_model->get_all_users($category_id);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = 'Add User | UKNiAF';
        $data['page_header'] = 'User ';
        $data['page_header_icone'] = 'fa-user';
        $data['nav'] = 'user';
        $data['panel_title'] = 'Add User  '; 
        $data['component_id'] = $component_id = $this->uri->segment(4); //echo $component_id;
        $data['components'] = $this->Component_model->get_all_component();
        $data['positions'] = $this->User_model->get_all_position();
        $data['main'] = 'user/add_edit';
        $this->load->view('home', $data);
    }

    public function add_user_process(){
        //print_r($_POST);
        $this->form_validation->set_rules('email', 'email', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Add User | UKNiAF';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-user-hunt';
            $data['nav'] = 'user';
            $data['panel_title'] = 'Add User ';
            
            $data['main'] = 'user/add_edit';

            $this->load->view('home', $data);

        } else {
            $identity = $_POST['email'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $count = $this->general_model->getCount('users','email="'.$_POST['email'].'"');
            if($count==0){
                $uid = $this->ion_auth->register($identity, $password, $email);
                if($uid>0){
                    $activation_code = $this->general_model->getValue('activation_code','users','id="'.$uid.'"');
                    $activate_link = base_url().'core/activate/'.$activation_code;
                    $to = $email;
                    $subject = "New Account created for UKNiAF System";
                    $message = "Dear ".$email.",<br><br>
                    We would like to inform you that your account with us has been successfully created!<br><br>To get started and unlock the full potential of your account, we kindly request you to activate it by clicking on the following link: <a href='".$activate_link."' target='_blank'>Activation Link</a>.<br><br>If you encounter any difficulties during the activation process or have any questions, feel free to reach out to Administrator.<br><br>Best regards,<br>UKNiAF Administrator";
                    $header = "From:admin@ukniaf.com \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    $retval = mail ($to,$subject,$message,$header);
                    if( $retval == true ) {
                        $this->session->set_flashdata('success', 'New User has been created and activation link sent.');
                        redirect(base_url() . 'admin/user/list/'.$_POST['component_id'], 'refresh');
                    }else {
                        $this->session->set_flashdata('error', 'New User has been created but failed to send activation link.');
                        redirect(base_url() . 'admin/user/list/'.$_POST['component_id'], 'refresh');
                    }
                }
            }
            else{
                //echo "I reached here...";  
                $this->session->set_flashdata('error', 'The email address already exists in our database.');
                redirect(base_url() . 'admin/user/list/'.$_POST['component_id'], 'refresh');                
            }
            /*$cid = $this->User_model->add_user();*/
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/user');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/user');

        $data['title'] = 'Edit User | UKNiAF';
        $data['page_header'] = 'User';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'user';
        $data['panel_title'] = 'Edit User ';
        $order_by = 'fullname ASC';
        $data['components'] = $this->Component_model->get_all_component();
        $data['positions'] = $this->User_model->get_all_position();
        $data['user_detail'] = $user_detail = $this->general_model->getById('users','id',$id);
        //print_r($user_detail);
        $data['component_id'] = $user_detail->component_id;
        $data['position_id'] = $user_detail->position_id;
        $data['main'] = 'user/add_edit';

        $this->load->view('home', $data);
    }

    public function edit_user_process($cid){
        //print_r($_POST);
        if (!isset($cid))
            redirect(base_url() . 'admin/user/list');

        if (!is_numeric($cid))
            redirect(base_url() . 'admin/user/list');

        
        $this->form_validation->set_rules('full_name', 'full_name', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Edit User | UKNiAF';
            $data['page_header'] = 'User';
            $data['page_header_icone'] = 'fa-gift';
            $data['nav'] = 'user';
            $data['panel_title'] = 'Edit User ';
            $data['User_detail'] = $this->general_model->getById('tbl_user','id',$cid);
            $data['main'] = 'user/edit/'.$cid;

            $this->load->view('home', $data);

        } else {
            $this->User_model->update_user($cid);
            $this->session->set_flashdata('success', 'User information updated successfully...');
            redirect(base_url() . 'admin/user/edit/'.$cid, 'refresh');
        }
    }

    function get_users(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->User_model->get_user($q);
        }
    }
}

/* End of file User.php
 * Location: ./application/modules/admin/controllers/User.php */