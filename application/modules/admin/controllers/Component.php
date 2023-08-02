<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Component Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 24, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Component extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('component_model');
        $this->load->model('Reporting_model');
    }

    public function index(){

        $data['title'] = '.:: CONTENT ::.';
        $data['page_header'] = 'Component Manager';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'component';
        $data['panel_title'] = 'Component | List';
        $data['component'] = $this->component_model->get_all_component();
        $data['main'] = 'component/component_manager_view';

        $this->load->view('admin/home', $data);
    }

    public function add(){

        $data['title'] = '.:: ADD CONTENT ::.';
        $data['page_header'] = 'Add Component';
        $data['page_header_icone'] = 'fa-plus';
        $data['nav'] = 'component';
        $data['panel_title'] = 'Add Component ';
        //$data['component_detail'] = $this->component_model->get_component_by_id($id);
        $data['main'] = 'component/add-edit-component';

        $this->load->view('home', $data);
    }

    public function addComponent(){

        $this->component_model->add_component();
        $this->session->set_flashdata('success', 'Component Added Successfully...');
        redirect(base_url() . 'admin/component', 'refresh');
    }

    public function edit($id){
            
        if (!isset($id))
            redirect(base_url() . 'admin/Component');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Component');

        $data['title'] = '.:: EDIT CONTENT ::.';
        $data['page_header'] = 'Edit Component';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'component';
        $data['panel_title'] = 'Edit Component ';
        $data['component_detail'] = $this->component_model->get_component_by_id($id);
        $data['main'] = 'component/add-edit-component';

        $this->load->view('home', $data);
    }

    public function editComponent($id){

        if (!isset($id))
        redirect(base_url() . 'admin/Component');

        if (!is_numeric($id))
        redirect(base_url() . 'admin/Component');

        $this->component_model->update_component($id);
        $this->session->set_flashdata('success', 'Component Updated Successfully...');
        redirect(base_url() . 'admin/component/edit/'.$id, 'refresh');
    }

/* Quality Component begins here*/
    public function monthly_risk_register_add(){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | Add';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | Add';
        $data['main'] = 'quality/add_edit_monthly_risk_register';
        $this->load->view('admin/home', $data);
    }

    public function monthly_risk_register_add_process(){
        $this->component_model->add_monthly_risk_register();
        $this->session->set_flashdata('success', 'Monthly risk registe added successfully...');
        redirect(base_url() . 'admin/component/monthly_risk_register', 'refresh');
    }

    public function monthly_risk_register_edit($id){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | Add';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | Add';
        $data['monthly_risk'] = $this->component_model->get_monthly_risk_register($id);
        $data['main'] = 'quality/add_edit_monthly_risk_register';
        $this->load->view('admin/home', $data);
    }

    public function monthly_risk_register_edit_process($id){

        if (!isset($id))
        redirect(base_url() . 'admin/Component');

        if (!is_numeric($id))
        redirect(base_url() . 'admin/Component');

        $this->component_model->update_monthly_risk_register($id);
        $this->session->set_flashdata('success', 'Monthly risk register updated successfully...');
        //redirect(base_url() . 'admin/component/monthly_risk_register_edit/'.$id, 'refresh');
        redirect(base_url() . 'admin/component/monthly_risk_register', 'refresh');
    }

    public function monthly_risk_register(){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['monthly_risks'] = $this->component_model->get_all_monthly_risk_register();
        $data['main'] = 'quality/monthly_risk_register';
        $this->load->view('admin/home', $data);
    }

    public function monthly_risk_register3(){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['monthly_risks'] = $this->component_model->get_all_monthly_risk_register();
        $data['main'] = 'quality/monthly_risk_register3';
        $this->load->view('admin/home', $data);
    }

    public function monthly_risk_register_archive(){      
      $from_date = '0000-00-00';
      $to_date = '0000-00-00';
      if(isset($_POST['date_range']) && strlen($_POST['date_range'])>20){
        $dt = $_POST['date_range'];
        $dt_arr = explode(' to ', $dt);
        //print_r($dt_arr);
        $from_date = $dt_arr['0'];
        $to_date = $dt_arr['1'];
      }
      $data['title'] = 'Monthly Risk Register Archive | UKNIaF';
      $data['page_header'] = 'Monthly Risk Register | Archive';
      $data['page_header_icone'] = 'fa-edit';
      $data['nav'] = 'infrastructure';
      $data['panel_title'] = 'Monthly Risk Register | Archive';
      $data['monthly_risks'] = $this->component_model->get_all_monthly_risk_register_by_date_range($from_date,$to_date);
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['main'] = 'quality/monthly_risk_register_archive';   
      $this->load->view('admin/home', $data);  
    }

    public function monthly_risk_register_list(){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['monthly_risks'] = $this->component_model->get_all_monthly_risk_register();
        //$data['main'] = 'quality/monthly_risk_register';
        $this->load->view('admin/quality/monthly_risk_register_list', $data);
    }

    public function monthly_risk_register2(){

        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['monthly_risks'] = $this->component_model->get_all_monthly_risk_register();
        $data['main'] = 'quality/monthly_risk_register2';
        $this->load->view('admin/home', $data);
    }

    public function if_weekly_update(){
        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['if_weekly_updates'] = $this->component_model->get_if_weekly_update();
        $data['main'] = 'quality/if_weekly_update';
        $this->load->view('admin/home', $data);        
    }

    public function if_archieve(){
        //print_r($_POST);
        
        $from_date = '0000-00-00';
        $to_date = '0000-00-00';
        if(isset($_POST['date_range']) && strlen($_POST['date_range'])>20){
          $dt = $_POST['date_range'];
          $dt_arr = explode(' to ', $dt);
          //print_r($dt_arr);
          $from_date = $dt_arr['0'];
          $to_date = $dt_arr['1'];
        }
        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['if_weekly_updates'] = $this->component_model->get_if_weekly_update_by_date_range($from_date,$to_date);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $data['main'] = 'quality/if_archieve';
        $this->load->view('admin/home', $data);        
    }

    public function if_archieve_date_range(){
        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['if_weekly_updates'] = $this->component_model->get_if_weekly_update();
        $data['main'] = 'quality/if_archieve_date_range';
        $this->load->view('admin/quality/if_archieve_date_range', $data);
        //$this->load->view('admin/home', $data);        
    }

    public function datatable(){
        $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $this->load->view('admin/quality/datatable', $data);
        //$this->load->view('admin/home', $data);        
    }

    public function risk_register_edit(){
       /* $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['if_weekly_updates'] = $this->component_model->get_if_weekly_update();
        $data['main'] = 'quality/if_weekly_update';
        $this->load->view('admin/home', $data);*/ 
        $id = $_POST['risk_register_id']; 
        $monthly_risk = $this->component_model->get_monthly_risk_register($id);  
        //echo $_POST['risk_register_id'];
        $data['main'] = 'quality/add_edit_monthly_risk_register';
        //$this->load->view('admin/home', $data);
        $form_action = base_url().'admin/component/monthly_risk_register_edit_process/'.$monthly_risk->id;
        $form = '
          <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">

          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Number</label>
              <input type="text" class="form-control" name="number" id="number-input" data-provider="flatpickr" data-range="true" placeholder="Enter Number" value="'.$monthly_risk->number.'">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Description</label>
              <textarea name="risk_description" id="risk_description" class="form-control" rows="3">'.$monthly_risk->risk_description.'</textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Category</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_category" id="risk_category-select">
                  <option value="">Select risk category</option>';
                  $dropdown_values = array('Policy and Programme Delivery','Reputational','Safeguarding','Strategy and Context');
                  $db_value = trim($monthly_risk->risk_category);
                  $aa = '';
                  ob_start();
                  for($i=0;$i<count($dropdown_values);$i++){
                  ?>
                  <option value="<?php echo $dropdown_values[$i];?>" <?php if($dropdown_values[$i]==$db_value) echo 'selected="selected"';?>><?php echo $dropdown_values[$i];?></option>  
                  <?php }
                  $aa = ob_get_clean();
                  $form.=$aa;
            $form .= '  </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Proximity</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="proximity" id="proximity-select">
                  <option value="">Select proximity</option>' ;
                  $dropdown_values = array('< 1 Month','0-3months','3-6months','6-12months','> 12 months');
                  $db_value = trim($monthly_risk->proximity);
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
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_likelihood" id="gross_likelihood-select">
                  <option value="">Select gross likelihood</option>' ;
                  $dropdown_values = array('Unlikely','Possible','Likely','Highly Likely','Almost Certain');
                  $db_value = trim($monthly_risk->gross_likelihood);
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
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_impact" id="gross_impact-select">
                  <option value="">Select gross impact</option>';
                  $dropdown_values = array('Insignificant','Minor','Moderate','Major','Severe');
                  $db_value = trim($monthly_risk->gross_impact);
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
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Mitigation Strategy</label>
              <textarea name="mitigation_strategy" id="mitigation_strategy" class="form-control" rows="3">'.$monthly_risk->mitigation_strategy.'</textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_likelihood" id="residual_likelihood-select">
                  <option value="">Select residual likelihood</option>';
                  $dropdown_values = array('Unlikely','Possible','Likely','Highly Likely','Almost Certain');
                  $db_value = trim($monthly_risk->residual_likelihood);
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
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_impact" id="residual_impact-select">
                  <option value="">Select residual impact</option>';
                  $dropdown_values = array('Major','Minor','Moderate','Severe');
                  $db_value = trim($monthly_risk->residual_impact);
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
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Trend</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="trend" id="trend-select" required>
                  <option value="">Select trend</option>';
                  $dropdown_values = array('up'=>'&uarr;','right'=>'&rarr;','down'=>'&darr;');
                  $db_value = trim($monthly_risk->trend);
                  $aa = '';
                  ob_start();
                  foreach($dropdown_values as $key=>$value){
                  ?>
                  <option value="<?php echo $key;?>" <?php if($key==$db_value) echo 'selected="selected"';?>><?php echo $value;?></option>  
                  <?php }
                  $aa = ob_get_clean();
                  $form.=$aa;
            $form .= '
              </select>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Progress in Implementing Mitigation Strategy</label>
              <textarea name="progress_in_implementing_mitigation_strategy" id="progress_in_implementing_mitigation_strategy" class="form-control" rows="3">'.$monthly_risk->progress_in_implementing_mitigation_strategy.'</textarea>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Last Updated</label>
              <input type="date" class="form-control" name="last_updated" id="last_updated-input" data-provider="flatpickr" data-range="true" placeholder="Enter last updated" value="'.$monthly_risk->last_updated.'">
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Appetite</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_appetite" id="risk_appetite-select">
                  <option value="">Select risk appetite</option>';
                  $dropdown_values = array('Cautious','Minimal','Receptive');
                  $db_value = trim($monthly_risk->risk_appetite);
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
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Within Appetite ?</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="within_appetite" id="within_appetite-select">
                  <option value="">Select within appetite</option>';
                  $dropdown_values = array('Yes','No');
                  $db_value = trim($monthly_risk->within_appetite);
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
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You By ?</label>
              <input type="text" class="form-control" name="escalated_to_you_by" id="escalated_to_you_by-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you by" value="'.$monthly_risk->escalated_to_you_by.'">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You For ?</label>
              <input type="text" class="form-control" name="escalated_to_you_for" id="escalated_to_you_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you for" value="'.$monthly_risk->escalated_to_you_for.'">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated To You</label>
              <input type="date" class="form-control" name="date_escalated_to_you" id="date_escalated_to_you-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated to you" value="'.$monthly_risk->date_escalated_to_you.'">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated Onwards To ?</label>
              <input type="text" class="form-control" name="escalated_onwards_to" id="escalated_onwards_to-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards to" value="'.$monthly_risk->escalated_onwards_to.'">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalation Onwards For ?</label>
              <input type="text" class="form-control" name="escalated_onwards_for" id="escalated_onwards_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards for" value="'.$monthly_risk->escalated_onwards_for.'">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated Onwards</label>
              <input type="date" class="form-control" name="date_escalated_onwards" id="date_escalated_onwards-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated onwards" value="'.$monthly_risk->date_escalated_onwards.'">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Removed</label>
              <input type="date" class="form-control" name="date_removed" id="date_removed-input" data-provider="flatpickr" data-range="true" placeholder="Enter date removed" value="'.$monthly_risk->date_removed.'">
          </div>
          <div class="mb-4">
            <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
            <select class="form-control" data-choices data-choices-multiple-remove="true" name="monthly_status" id="monthly_status-select">';
              $dropdown_values = array('Active','Closed');
              $db_value = trim($monthly_risk->monthly_status);
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
              <button type="submit" class="btn btn-success w-sm">Save</button>
          </div>
        </form>  
        ';
        echo $form;
    }

    public function risk_register_view(){
       /* $data['title'] = 'Monthly Risk Register | UKNIaF';
        $data['page_header'] = 'Monthly Risk Register | List';
        $data['page_header_icone'] = 'fa-edit';
        $data['nav'] = 'infrastructure';
        $data['panel_title'] = 'Monthly Risk Register | List';
        $data['if_weekly_updates'] = $this->component_model->get_if_weekly_update();
        $data['main'] = 'quality/if_weekly_update';
        $this->load->view('admin/home', $data);*/ 
        $id = $_POST['risk_register_id']; 
        $monthly_risk = $this->component_model->get_monthly_risk_register($id);  
        //echo $_POST['risk_register_id'];
        $data['main'] = 'quality/add_edit_monthly_risk_register';
        //$this->load->view('admin/home', $data);
        $form_action = base_url().'admin/component/monthly_risk_register_edit_process/'.$monthly_risk->id;
        $form = '
          <form method="post" action="'.$form_action.'" class="d-flex flex-column justify-content-end h-100">
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Number</label>
              <p>'.$monthly_risk->number.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Risk Description</label>
              <p>'.$monthly_risk->risk_description.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Risk Category</label>
              <p>'.$monthly_risk->risk_category.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Proximity</label>
              <p>'.$monthly_risk->proximity.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Gross Likelihood</label>
              <p>'.$monthly_risk->gross_likelihood.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Gross Impact</label>
              <p>'.$monthly_risk->gross_impact.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Mitigation Strategy</label>
              <p>'.$monthly_risk->mitigation_strategy.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Residual Likelihood</label>
              <p>'.$monthly_risk->residual_likelihood.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Residual Impact</label>
              <p>'.$monthly_risk->residual_impact.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Trend</label>
              <p>'.$monthly_risk->trend.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Progress in Implementing Mitigation Strategy</label>
              <p>'.$monthly_risk->progress_in_implementing_mitigation_strategy.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Last Updated</label>
              <p>'.$monthly_risk->last_updated.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Risk Appetite</label>
              <p>'.$monthly_risk->risk_appetite.'</p>
            </div>
            <div>
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-1">Within Appetite ?</label>
              <p>'.$monthly_risk->within_appetite.'</p>
            </div>
            <div>
              <label class="form-label text-muted text-uppercase fw-semibold mb-1">Escalated To You By ?</label>
              <p>'.$monthly_risk->escalated_to_you_by.'</p>
            </div>
            <div>
              <label class="form-label text-muted text-uppercase fw-semibold mb-1">Escalated To You For ?</label>
              <p>'.$monthly_risk->escalated_to_you_for.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Date Escalated To You</label>
              <p>'.$monthly_risk->date_escalated_to_you.'</p>
            </div>
            <div>
              <label class="form-label text-muted text-uppercase fw-semibold mb-1">Escalated Onwards To ?</label>
              <p>'.$monthly_risk->escalated_onwards_to.'</p>
            </div>
            <div>
              <label class="form-label text-muted text-uppercase fw-semibold mb-1">Escalation Onwards For ?</label>
              <p>'.$monthly_risk->escalated_onwards_for.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Date Escalated Onwards</label>
              <p>'.$monthly_risk->date_escalated_onwards.'</p>
            </div>
            <div>
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-1">Date Removed</label>
              <p>'.$monthly_risk->date_removed.'</p>
            </div>
          </form>
        ';
        echo $form;
    }


}


/* End of file Component.php
 * Location: ./application/modules/admin/controllers/Component.php */
   