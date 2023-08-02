<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reporting Controller
 * @reporting Controller
 * @subreporting Controller
 * Date created:August 04, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Reporting extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reporting_model');
        //$this->load->model('Component_model');
        $this->load->model('general_model');
        $this->load->model('Tag_model');
    }

    public function index(){
        
        $data['reporting_info'] = $this->Reporting_model->get_all_reportings();
        $data['title'] = 'Reporting | UKNiAF';
        $data['page_header'] = 'Reporting';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'reporting';
        $data['panel_title'] = 'Reporting List';
        $data['main'] = 'reporting/list';
        $this->load->view('home', $data);
    }

    public function if_weekly_technical_update_add(){
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Weekly Technical Update';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'update';
        $data['panel_title'] = 'Weekly Technical Update';
        $data['main'] = 'reporting/if_weekly_technical_update';
        $this->load->view('home', $data);
    }

    public function if_weekly_technical_update_add_process(){
        //print_r($_POST); exit();
        $this->form_validation->set_rules('task_order', 'task_order', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Weekly Technical Update | UKNiAF';
            $data['page_header'] = 'Weekly Technical Update';
            $data['page_header_icone'] = 'fa-reportings';
            $data['nav'] = 'update';
            $data['panel_title'] = 'Weekly Technical Update';
            $data['main'] = 'reporting/if_weekly_technical_update_add/';

            $this->load->view('home', $data);

        } else {
            $this->Reporting_model->add_technical_update();
            $this->session->set_flashdata('success', 'Weekly technical update information updated successfully...');
            redirect(base_url() . 'admin/reporting/if_weekly_technical_update_list/', 'refresh');
        }
    }

    public function if_weekly_technical_update_edit($technical_update_id){
        //$technical_update_id = $this->uri->segment('4');
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Weekly Technical Update';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'update';
        $data['panel_title'] = 'Weekly Technical Update';
        $data['main'] = 'reporting/if_weekly_technical_update';
        if(isset($technical_update_id) && $technical_update_id>0)
            $data['techincal_update'] = $this->Reporting_model->get_techincal_update($technical_update_id);
        $this->load->view('home', $data);
    }

    public function if_weekly_technical_update_edit_process($technical_update_id){

        //print_r($_POST);
        //echo $technical_update_id;
        if (!isset($technical_update_id))
            redirect(base_url() . 'admin/reporting/if_weekly_technical_update_list');

        if (!is_numeric($technical_update_id))
            redirect(base_url() . 'admin/reporting/if_weekly_technical_update_list');

        
        $this->form_validation->set_rules('technical_update_id', 'technical_update_id', 'required');
        
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = 'Weekly Technical Update | UKNiAF';
            $data['page_header'] = 'Weekly Technical Update';
            $data['page_header_icone'] = 'fa-reportings';
            $data['nav'] = 'update';
            $data['panel_title'] = 'Weekly Technical Update';
            $data['main'] = 'reporting/if_weekly_technical_update_edit/'.$technical_update_id;

            $this->load->view('home', $data);

        } else {
            $this->Reporting_model->update_technical_update($technical_update_id);
            $this->session->set_flashdata('success', 'Weekly technical update information updated successfully...');
            redirect(base_url() . 'admin/reporting/if_weekly_technical_update_list/', 'refresh');
        }
    }

    public function if_weekly_technical_update_list(){
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Weekly Technical Update List';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'update';
        $data['panel_title'] = 'Weekly Technical Update List';
        $data['main'] = 'reporting/if_weekly_technical_update_list';
        $data['task_orders'] = $this->Reporting_model->get_unique_task_order();
        //$data['risk_numbers'] = $this->Reporting_model->get_unique_risk_number();
        if(isset($_POST['risk_number'])){
            $data['techincal_updates'] = $this->Reporting_model->get_techincal_update_by_risk_number($_POST['risk_number']);
        }
        else if(isset($_POST['btnList'])){
            $data['techincal_updates'] = $this->Reporting_model->get_techincal_update_by_date_range($_POST['from_date'],$_POST['to_date'],$_POST['update_status']);
        }
        else{
            $data['techincal_updates'] = $this->Reporting_model->get_all_technical_updates();
        }
        $this->load->view('home', $data);
    }

    public function if_weekly_technical_update_list_and_update(){
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Weekly Technical Update List';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'update';
        $data['panel_title'] = 'Weekly Technical Update List';
        $data['main'] = 'reporting/if_weekly_technical_update_list_and_update';
        $data['techincal_updates'] = $this->Reporting_model->get_techincal_update_by_date_range($_POST['from_date'],$_POST['to_date'],$_POST['update_status']);
        $this->load->view('home', $data);
    }

    public function view($technical_update_id){
        //$technical_update_id = $this->uri->segment('4');
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Weekly Technical Update';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'update';
        $data['panel_title'] = 'Weekly Technical Update';
        $data['main'] = 'reporting/if_weekly_technical_update_view';
        if(isset($technical_update_id) && $technical_update_id>0)
            $data['techincal_update'] = $this->Reporting_model->get_techincal_update($technical_update_id);
        $this->load->view('home', $data);
    }

    public function archive(){      
      $from_date = '0000-00-00';
      $to_date = '0000-00-00';
      if(isset($_POST['date_range']) && strlen($_POST['date_range'])>20){
        $dt = $_POST['date_range'];
        $dt_arr = explode(' to ', $dt);
        //print_r($dt_arr);
        $from_date = $dt_arr['0'];
        $to_date = $dt_arr['1'];
      }
      $data['title'] = 'Weekly Technical Update Archive | UKNIaF';
      $data['page_header'] = 'Weekly Technical Update | Archive';
      $data['page_header_icone'] = 'fa-edit';
      $data['nav'] = 'infrastructure';
      $data['panel_title'] = 'Weekly Technical Update | Archive';
      $data['monthly_risks'] = $this->Reporting_model->get_all_techincal_update_by_date_range($from_date,$to_date);
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['main'] = 'quality/monthly_risk_register_archive';   
      $this->load->view('admin/home', $data);  
    }

    public function if_weekly_technical_update_insert(){
        $task_orders = array('IF101','IF102','IF103','IF104','IF105','IF106','IF107','IF108','IF109','IF110');
        //print_r($task_orders );
        //$risk_number =
        for($i=0;$i<10;$i++){ 
            $order = $i+100;
            $task_order = 'IF'.$order;
            $risk_number = 1001+$i;
            $data = '';
            $loop = rand(8,10);
            for($j=0;$j<$loop;$j++){
            $random_string = $this->general_model->random_strings(10);
            $data= array(
                'user_id' => rand(1,3),
                'update_date' => date('Y-m-d'),
                'task_order' => $task_order,
                'risk_number' => $risk_number,
                'updates' => $random_string.' is update content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'decision' => $random_string.' is decision content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'action' => $random_string.' is action content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'stakeholder' => $random_string.' is stakeholder content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'internal_notes' => $random_string.' is internal notes content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'fcdo_update' => $random_string.' is fcdo update content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'risk' => $random_string.' is risk content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'mitigation' => $random_string.' is mitigation content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'residual_risk' => $random_string.' is residual risk content for risk number '.$risk_number.'. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                );
            print_r($data);
            echo "<br>";
            //$this->db->insert('tbl_technical_update',$data);
           }
        }
    }

    public function create_report(){
        $this->Reporting_model->create_report();
        $this->session->set_flashdata('success', 'Report created Successfully...');
        redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    public function save_update(){
        //echo $_POST['technical_update_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Reporting_model->save_update($_POST['technical_update_id'],$_POST['column_name'],$_POST['value']);
    }

    public function save_status(){
        //echo $_POST['technical_update_id'].' | '.$_POST['column_name'].' | '.$_POST['value'];
        $this->Reporting_model->save_status($_POST['technical_update_id']);
    }

    public function list_risk_number(){
        $task_order = $_POST['task_order'];
        echo $this->Reporting_model->list_risk_number_html($task_order);
    }

    public function if_priorities_this_week(){
        $data['title'] = 'Priorities this Week | UKNiAF';
        $data['page_header'] = 'Priorities this Week';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'if_priorities_this_week';
        $data['panel_title'] = 'Priorities this Week';
        $data['main'] = 'common/under_development';
        //$data['techincal_updates'] = $this->Reporting_model->get_weekly_techincal_update_archieve();
        $this->load->view('home', $data);

    }

    public function submitted($urlcode){
        $data['title'] = 'Report this Week | UKNiAF';
        $data['page_header'] = 'Report this Week';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'if_priorities_this_week';
        $data['panel_title'] = 'Report this Week';
        $data['main'] = 'reporting/submitted';
        //$data['techincal_updates'] = $this->Reporting_model->get_weekly_techincal_update_archieve();
        $this->load->view('home', $data);

    }

    public function if_monthly_risk_register(){
        $data['title'] = 'Weekly Technical Update | UKNiAF';
        $data['page_header'] = 'Priorities this Week';
        $data['page_header_icone'] = 'fa-reportings';
        $data['nav'] = 'if_monthly_risk_register';
        $data['panel_title'] = 'Priorities this Week';
        $data['main'] = 'common/under_development';
        //$data['techincal_updates'] = $this->Reporting_model->get_weekly_techincal_update_archieve();
        $this->load->view('home', $data);

    }

    public function listing(){
        $data['nav'] = 'technical_update';
        $data['main'] = 'reporting/listing';
        $data['techincal_updates'] = $this->Reporting_model->get_all_technical_updates();
        //$data['techincal_updates'] = $this->Reporting_model->get_weekly_techincal_update_archieve();
        $this->load->view('home', $data);
    }

    public function add(){
        $data['nav'] = 'technical_update';
        $data['main'] = 'reporting/if_weekly_technical_update_2';
        //$data['techincal_updates'] = $this->Reporting_model->get_weekly_techincal_update_archieve();
        $this->load->view('home2', $data);
    }



    public function technical_update_edit(){
        $technical_update_id = $_POST['technical_update_id']; 
        //echo $technical_update_id;
        $technical_update = $this->Reporting_model->get_techincal_update($technical_update_id);
        //print_r($technical_update);
        $form_action = base_url().'admin/reporting/if_weekly_technical_update_edit_process/'.$technical_update_id;
        $form = '
        <!--jquery cdn-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!--select2 cdn-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
          <div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Task Order</label>
                  <input type="text" class="form-control" name="task_order" id="task_order-input" placeholder="Enter task order" value="'.$technical_update->task_order.'">
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Number</label>
                  <input type="text" class="form-control" name="risk_number" id="risk_number-input" placeholder="Enter number" value="'.$technical_update->risk_number.'">
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Updates</label>
                  <textarea name="updates" id="updates" class="form-control" rows="3">'.$technical_update->updates.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Weekly Decision</label>
                  <textarea name="decision" id="decision" class="form-control" rows="3">'.$technical_update->decision.'</textarea>
              </div>
              <div class="mb-4">
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Weekly Action</label>
                <textarea name="action" id="action" class="form-control" rows="3">'.$technical_update->action.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Stakeholder</label>
                  <textarea name="stakeholder" id="stakeholder" class="form-control" rows="3">'.$technical_update->stakeholder.'</textarea>
              </div>
              <div class="mb-4">
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Internal Notes</label>
                <textarea name="internal_notes" id="internal_notes" class="form-control" rows="3">'.$technical_update->internal_notes.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO Update</label>
                  <textarea name="fcdo_update" id="fcdo_update" class="form-control" rows="3">'.$technical_update->fcdo_update.'</textarea>
              </div>
              <div class="mb-4">
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk</label>
                <textarea name="risk" id="risk" class="form-control" rows="3">'.$technical_update->risk.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Mitigation</label>
                  <textarea name="mitigation" id="mitigation" class="form-control" rows="3">'.$technical_update->mitigation.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Risk</label>
                  <textarea name="residual_risk" id="residual_risk" class="form-control" rows="3">'.$technical_update->residual_risk.'</textarea>
              </div>
              <div class="mb-4">
                  <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Document URL</label>
                  <input type="text" class="form-control" name="document_url" id="document_url-input" placeholder="Enter document url" value="'.$technical_update->document_url.'">
              </div>
              <div class="mb-4">
                <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
                <select class="form-control" data-choices data-choices-multiple-remove="true" name="update_status" id="update_status-select">';
                  $dropdown_values = array('Active','Closed');
                  $db_value = trim($technical_update->update_status);
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
                  <label for="choices-multiple-remove-button" class="form-label text-muted">Update Tags</label>
                  <p class="text-muted">Select <code>tags</code> from list. Please press <code>Ctrl</code> to select multiple tags.</p>';
                    $tags_db = $technical_update->tags;
                    $tags_array = unserialize($technical_update->tags);
                    $option = '<option value="">Select one</option>';
                    $tags = $this->Tag_model->get_all_tags();
                    if(isset($tags) &&!empty($tags)){
                        $option='';
                        foreach($tags as $tag){
                          $selected = '';
                          if(in_array($tag->id,$tags_array))
                            $selected = ' selected="selected"';
                          $option.='<option value="'.$tag->id.'"'.$selected.'>'.$tag->tag.'</option>';
                        }
                    }
                  $form .= '<select name="tags[]" class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem multiple>'.$option.'
                  </select>
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

    public function technical_update_view(){
        $technical_update_id = $_POST['technical_update_id']; 
        //echo $technical_update_id;
        $technical_update = $this->Reporting_model->get_techincal_update($technical_update_id);
        //print_r($technical_update);
        $form_action = base_url().'admin/reporting/if_weekly_technical_update_edit_process/'.$technical_update_id;
        $form = '
        <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
          <div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Task Order</label>
                <p>'.$technical_update->task_order.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Number</label>
                <p>'.$technical_update->risk_number.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Updates</label>
                <p>'.$technical_update->updates.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Weekly Decision</label>
                <p>'.$technical_update->decision.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Weekly Action</label>
              <p>'.$technical_update->action.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Stakeholder</label>
                <p>'.$technical_update->stakeholder.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Internal Notes</label>
              <p>'.$technical_update->internal_notes.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">FCDO Update</label>
                <p>'.$technical_update->fcdo_update.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Risk</label>
              <p>'.$technical_update->risk.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Mitigation</label>
                <p>'.$technical_update->mitigation.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Residual Risk</label>
                <p>'.$technical_update->residual_risk.'</p>
            </div>
            <div>
                <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Document URL</label>
                <p>'.$technical_update->document_url.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Status</label>
              <p>'.$technical_update->update_status.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Update Tags</label>
              <p>'.$technical_update->tags.'</p>
            </div>
          </div>
          <!--end offcanvas-body-->
        </form> 
        ';
        echo $form;
    }

}

/* End of file Reporting.php
 * Location: ./application/modules/admin/controllers/Reporting.php */