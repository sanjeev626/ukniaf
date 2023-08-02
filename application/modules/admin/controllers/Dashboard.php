<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*** Admin Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */

class Dashboard extends MY_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->model('Reporting_model');
        $this->load->model('general_model');

    }

   

    function index() {

        $data['title'] = 'UKNiAF';
        $data['page_header'] = 'Dashboard';
        $data['page_header_icone'] = 'fa-home';
        $data['main'] = 'dashboard/dashboard_view';
        $data['parent_nav'] = '';
        $data['nav'] = 'dashboard';
        /*$data['total_customers'] = $this->general_model->countTotal('tbl_customer');
        $data['total_products'] = $this->general_model->countTotal('tbl_product');
        $data['total_sales_incomplete'] = $this->general_model->countTotal('tbl_sales',array('sales_status'=>'0'));
        $data['total_sales_complete'] = $this->general_model->countTotal('tbl_sales',array('sales_status'=>'1'));*/     

        if(!isset($this->session->lang))

        {            

            $the_session = array("lang" => '1');

            $this -> session -> set_userdata($the_session);

        }



        $this->load->view('home', $data);

    }

    function dboard() {

        $data['title'] = 'UKNiAF';
        $data['page_header'] = 'Dashboard';
        $data['page_header_icone'] = 'fa-home';
        $data['main'] = 'dashboard/dashboard_temp';
        $data['parent_nav'] = '';
        $data['nav'] = 'dashboard';
        /*$data['total_customers'] = $this->general_model->countTotal('tbl_customer');
        $data['total_products'] = $this->general_model->countTotal('tbl_product');
        $data['total_sales_incomplete'] = $this->general_model->countTotal('tbl_sales',array('sales_status'=>'0'));
        $data['total_sales_complete'] = $this->general_model->countTotal('tbl_sales',array('sales_status'=>'1'));*/     

        if(!isset($this->session->lang))

        {            

            $the_session = array("lang" => '1');

            $this -> session -> set_userdata($the_session);

        }



        $this->load->view('home_temp', $data);

    }



    function setLang($lang)

    {

        $the_session = array("lang" => $lang);

        $this -> session -> set_userdata($the_session);

        redirect(base_url() . 'admin/Dashboard');

    }



}



/* End of file dashboard.php

 * Location: ./application/modules/admin/controllers/dashboard.php */