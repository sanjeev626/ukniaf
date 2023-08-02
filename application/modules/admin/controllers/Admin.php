<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>

 */

class Admin extends CI_Controller {



    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }



    function index() {   

        if (!$this->ion_auth->logged_in()) {

            redirect(base_url() . 'core', 'refresh');

        }else{

            redirect(base_url() . 'admin/dashboard', 'refresh');

        }

    }



   /* function activate($activation_code) {
        $check = $this->general_model->getCount('users','activation_code="'.$activation_code.'"');
        echo "Activation page : ".$check;
        $data['title'] = 'User Activation | UKNiAF';
        $data['page_header'] = 'User Activation';
        $data['page_header_icone'] = 'fa-user';
        $data['nav'] = 'user';
        $data['panel_title'] = 'Task List';
        if($check==1){
            $data['main'] = 'task/list';
            $this->load->view('home', $data);
        }
        else{

        }
    }*/



}



/* End of file admin.php

 * Location: ./application/modules/admin/controllers/admin.php */