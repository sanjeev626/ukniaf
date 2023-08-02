<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 31, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Home extends View_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {        
        redirect(base_url() . 'admin/', 'refresh');
    }    
}

/* End of file Home.php
 * Location: ./application/modules/home/controllers/home.php */
