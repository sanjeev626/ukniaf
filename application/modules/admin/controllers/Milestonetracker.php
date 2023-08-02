<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Milestonetracker Controller
 * @milestone Controller
 * @submilestone Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Milestonetracker extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Milestonetracker_model');
        //$this->load->model('Component_model');
        $this->load->model('general_model');
    }

    public function index(){
        
        $data['milestonetracker_info'] = $this->Milestonetracker_model->get_all_milestonetrackers();
        $data['title'] = 'Milestonetracker | UKNiAF';
        $data['page_header'] = 'Milestonetracker';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker List';
        $data['main'] = 'milestonetracker/list';
        $this->load->view('home', $data);
    }

    public function archive(){     
        $startDate = '0000-00-00';
        $endDate = '0000-00-00';
        if(isset($_POST['date_range']) && strlen($_POST['date_range'])>20){
            $dt = $_POST['date_range'];
            $dt_arr = explode(' to ', $dt);
            $startDate = $dt_arr['0'];
            $endDate = $dt_arr['1'];
        }        
        $data['milestonetracker_info'] = $this->Milestonetracker_model->get_all_milestones_by_date_range($startDate,$endDate);
        //echo $this->db->last_query();
        $data['title'] = 'Milestonetracker | UKNiAF';
        $data['page_header'] = 'Milestonetracker';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker List';
        $data['main'] = 'milestonetracker/archive';
        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = 'Milestonetracker Schedule | UKNiAF';
        $data['page_header'] = 'Milestonetracker Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker Schedule';
        $data['main'] = 'milestonetracker/add_edit';
        $this->load->view('home', $data);
    }

    public function add_process(){
        $this->form_validation->set_rules('to_number', 'TO Number', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Milestonetracker Schedule | UKNiAF';
            $data['page_header'] = 'Milestonetracker Schedule';
            $data['page_header_icone'] = 'fa-calendar';
            $data['nav'] = 'milestonetracker';
            $data['panel_title'] = 'Milestonetracker Schedule';
            $data['main'] = 'milestonetracker/add/';

            $this->load->view('home', $data);

        } else {
            $this->Milestonetracker_model->add();
            $this->session->set_flashdata('success', 'Milestone tracker has been added.');
            redirect(base_url() . 'admin/milestonetracker/', 'refresh');
        }
    }

    public function edit($milestonetracker_id){
        //$milestonetracker_id = $this->uri->segment('4');
        $data['title'] = 'Milestonetracker Schedule | UKNiAF';
        $data['page_header'] = 'Milestonetracker Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker Schedule';
        $data['main'] = 'milestonetracker/add_edit';
        if(isset($milestonetracker_id) && $milestonetracker_id>0)
            $data['milestone'] = $this->Milestonetracker_model->get_milestone($milestonetracker_id);
        $this->load->view('home', $data);
    }

    public function edit_process($milestonetracker_id){

        //print_r($_POST);
        if (!isset($milestonetracker_id))
            redirect(base_url() . 'admin/milestonetracker/list');

        if (!is_numeric($milestonetracker_id))
            redirect(base_url() . 'admin/milestonetracker/list');

        
        $this->form_validation->set_rules('to_number', 'TO Number', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Milestone tracker | UKNiAF';
            $data['page_header'] = 'Milestone tracker';
            $data['page_header_icone'] = 'fa-calendar';
            $data['nav'] = 'milestonetracker';
            $data['panel_title'] = 'Milestone Tracker';
            $data['main'] = 'milestonetracker/edit/'.$milestonetracker_id;

            $this->load->view('home', $data);

        } else {
            $this->Milestonetracker_model->update($milestonetracker_id);
            $this->session->set_flashdata('success', 'Milestone tracker information has been updated.');
            //redirect(base_url() . 'admin/milestonetracker/edit/'.$milestonetracker_id, 'refresh');
            redirect(base_url() . 'admin/milestonetracker', 'refresh');
        }
    }

    public function milestonetracker_edit(){
        $milestonetracker_id = $_POST['milestonetracker_id']; 
        //echo $milestonetracker_id;
        $milestonetracker = $this->Milestonetracker_model->get_by_id($milestonetracker_id);
        //print_r($technical_update);
        $form_action = base_url().'admin/milestonetracker/edit_process/'.$milestonetracker_id;
        $form = '
        <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
          <div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">component</label>
                  <input type="text" class="form-control" name="component" id="component-input" value="'.$milestonetracker->component.'" placeholder="Enter component">
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">TO Number</label>
                  <input type="text" class="form-control" name="to_number" id="to_number-input" value="'.$milestonetracker->to_number.'" placeholder="Enter TO number" required>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">TO Name</label>
                  <input type="text" class="form-control" name="to_name" id="to_name-input" value="'.$milestonetracker->to_name.'" placeholder="Enter TO name">
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">M#</label>
                  <input type="text" class="form-control" name="m_number" id="m_number-input" value="'.$milestonetracker->m_number.'" placeholder="Enter M#">
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Milestone title</label>
                  <textarea name="milestone_title" id="milestone_title" class="form-control" rows="3">'.$milestonetracker->milestone_title.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Milestone due date</label>
                  <input type="date" class="form-control" name="milestone_due_date" id="milestone_due_date-input" data-provider="flatpickr" data-range="true" value="'.$milestonetracker->milestone_due_date.'" placeholder="Enter milestone due date">
              </div>
              <div class="mb-4">
                <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
                <select class="form-control" data-choices data-choices-multiple-remove="true" name="milestonetracker_status" id="milestonetracker_status-select" required>';
                  $dropdown_values = array('MGT APPROVED','PASSED','TRUNCATED','SUSPENDED','DUE THIS MONTH','ONGOING');
                  $db_value = trim($milestonetracker->milestonetracker_status);
                  $aa = '';
                  ob_start();
                  for($i=0;$i<count($dropdown_values);$i++){
                  ?>
                  <option value="<?php echo $dropdown_values[$i];?>" <?php if($dropdown_values[$i]==$db_value) echo 'selected="selected"';?>><?php echo $dropdown_values[$i];?></option>  
                  <?php }
                  $aa = ob_get_clean();
                  $form.=$aa;
                  $form .= '
                </select>
              </div>
              <div class="mb-4">
                <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO Status</label>
                <select class="form-control" data-choices data-choices-multiple-remove="true" name="fcdo_status" id="fcdo_status-select" required>';
                  $dropdown_values = array('APPROVED','NOT APPROVED');
                  $db_value = trim($milestonetracker->fcdo_status);
                  $aa = '';
                  ob_start();
                  for($i=0;$i<count($dropdown_values);$i++){
                  ?>
                  <option value="<?php echo $dropdown_values[$i];?>" <?php if($dropdown_values[$i]==$db_value) echo 'selected="selected"';?>><?php echo $dropdown_values[$i];?></option>  
                  <?php }
                  $aa = ob_get_clean();
                  $form.=$aa;
                  $form .= '
                </select>
              </div>
              <div class="mb-4">
                  <label class="form-label text-muted text-uppercase fw-semibold mb-3">Notes</label>
                  <textarea name="notes" id="notes" class="form-control" rows="3">'.$milestonetracker->notes.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO URL to ppt</label>
                  <textarea name="fcdo_url_to_ppt" id="fcdo_url_to_ppt" class="form-control" rows="3">'.$milestonetracker->fcdo_url_to_ppt.'</textarea>
              </div>
              <div class="mb-4">
                  <button type="submit" class="btn btn-success w-sm">Submit</button>
              </div>
          </div>
          <!--end offcanvas-body-->
      </form>
        ';
        echo $form;
    }

    public function milestonetracker_view(){
        $milestonetracker_id = $_POST['milestonetracker_id']; 
        //echo $milestonetracker_id;
        $milestonetracker = $this->Milestonetracker_model->get_by_id($milestonetracker_id);
        //print_r($technical_update);
        $form_action = base_url().'admin/reporting/if_weekly_technical_update_edit_process/'.$milestonetracker_id;
        $form = '
        <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
          <div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">component</label>
                  <p>'.$milestonetracker->component.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">TO Number</label>
                  <p>'.$milestonetracker->to_number.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">TO Name</label>
                  <p>'.$milestonetracker->to_name.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">M#</label>
                  <p>'.$milestonetracker->m_number.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">Milestone title</label>
                  <p>'.$milestonetracker->milestone_title.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">Milestone due date</label>
                  <p>'.$this->general_model->display_long_date($milestonetracker->milestone_due_date).'</p>
              </div>
              <div class="mb-4">
                <label for="country-select" class="form-label text-muted fw-semibold mb-0">Status</label>
                <p>'.$milestonetracker->milestonetracker_status.'</p>
              </div>
              <div class="mb-4">
                <label for="country-select" class="form-label text-muted fw-semibold mb-0">FCDO Status</label>
                <p>'.$milestonetracker->fcdo_status.'</p>
                </select>
              </div>
              <div class="mb-4">
                  <label class="form-label text-muted fw-semibold mb-0">Notes</label>
                  <p>'.$milestonetracker->notes.'</p>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted fw-semibold mb-0">FCDO URL to ppt</label>
                  <p>'.$milestonetracker->fcdo_url_to_ppt.'</p>
              </div>
            </div>
          <!--end offcanvas-body-->
        </form> 
        ';
        echo $form;
    }

    public function list(){
        $data['title'] = 'Milestonetracker Schedule | UKNiAF';
        $data['page_header'] = 'Milestonetracker Schedule List';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker Schedule List';
        $data['main'] = 'milestonetracker/list';
        $data['task_orders'] = $this->Milestonetracker_model->get_unique_task_order();
        $data['milestones'] = $this->Milestonetracker_model->get_all_milestones();
        $this->load->view('home', $data);
    }

    public function view($milestonetracker_id){
        //$milestonetracker_id = $this->uri->segment('4');
        $data['title'] = 'Milestonetracker Schedule | UKNiAF';
        $data['page_header'] = 'Milestonetracker Schedule';
        $data['page_header_icone'] = 'fa-calendar';
        $data['nav'] = 'milestonetracker';
        $data['panel_title'] = 'Milestonetracker Schedule';
        $data['main'] = 'milestonetracker/view';
        if(isset($milestonetracker_id) && $milestonetracker_id>0)
            $data['milestone'] = $this->Milestonetracker_model->get_milestone($milestonetracker_id);
        $this->load->view('home', $data);
    }

    public function create_report(){
        $this->Milestonetracker_model->create_report();
        $this->session->set_flashdata('success', 'Report created Successfully...');
        redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    public function save_update(){
        //echo $_POST['milestonetracker_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Milestonetracker_model->save_update($_POST['milestonetracker_id'],$_POST['column_name'],$_POST['value']);
    }

    public function save_status(){
        //echo $_POST['milestonetracker_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Milestonetracker_model->save_status($_POST['milestonetracker_id']);
    }


}

/* End of file Milestonetracker.php
 * Location: ./application/modules/admin/controllers/Milestonetracker.php */