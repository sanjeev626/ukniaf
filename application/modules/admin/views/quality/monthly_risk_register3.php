<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Monthly Risk Register</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><button type="button" class="btn btn-success" data-bs-toggle="offcanvas" href="#offcanvasExample"><i class="ri-add-line align-bottom me-1"></i> Add New</button></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body table-container">
        <?php //print_r($_SESSION);
            //$monthly_risks = $this->Reporting_model->get_weekly_techincal_update_archieve();
            if(isset($monthly_risks)){
              $lastweek_decision = '';
              $lastweek_action = '';
            ?>
        <table class="table dt-responsive table-striped align-middle" id="myTable">
          <thead class="table-light">
            <tr>
              <th>Number</th>
              <th>Risk Description</th>
              <th>Risk Category<br>Proximity<br>Gross Likelihood<br>Gross Impact<br>Gross Risk Rating</th>
              <th>Mitigation Strategy</th>
              <th>Residual Likelihood<br>Residual Impact<br>Residual Impact<br>Trend<br>Risk Owner</th>
              <th>Progress in Implementing Mitigation Strategy</th>
              <th>Last Updated<br>Status<br>Risk Appetite<br>Within Appetite ?</th>
              <th>Escalated To You By ?<br>Escalated To You For ?<br>Date Escalated To You<br>Escalated Onwards To ?<br>Escalation Onwards For<br>Date Escalated Onwards<br>Date Removed</th>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <th>&nbsp;</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($monthly_risks as $risk) {
              $GrossRiskRating = "";
              $style = "";
              $gross = $this->component_model->get_rating($risk->gross_likelihood,$risk->gross_impact);
              $GrossRiskRating = $gross['rating'];
              $style = "background-color:".$gross['color_code'].";"; 

              /*if($risk->gross_impact=='Severe'){
                $GrossRiskRating = "Severe";
                $style = "background-color:RED; color:#FFFFFF;";
              }
              else if(($risk->gross_likelihood=='Possible' || $risk->gross_likelihood=='Likely') && $risk->gross_impact=='Major'){
                $GrossRiskRating = "Major";
                $style = "background-color:#FFC000;";                
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->gross_impact=='Moderate'){
                $GrossRiskRating = "Major";
                $style = "background-color:#FFC000;";                
              }
              else if(($risk->gross_likelihood=='Almost Certain' || $risk->gross_likelihood=='Highly Likely') && $risk->gross_impact=='Major'){
                $GrossRiskRating = "Severe";
                $style = "background-color:RED; color:#FFFFFF;";                
              }*/

              $ResidualRiskRating = "";
              $style2 = "";
              $residual = $this->component_model->get_rating($risk->residual_likelihood,$risk->residual_impact);
              $ResidualRiskRating = $residual['rating'];
              $style2 = "background-color:".$residual['color_code'].";"; 

              /*if($risk->residual_impact=='Severe'){
                $ResidualRiskRating = "Severe";
                $style2 = "background-color:RED; color:#FFFFFF;";
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Severe";
                $style2 = "background-color:RED; color:#FFFFFF;";
              }
              else if(($risk->residual_likelihood=='Possible' || $risk->residual_likelihood=='Likely') && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->residual_impact=='Moderate'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if(($risk->residual_likelihood=='Possible') && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if ($risk->residual_likelihood=='Highly Likely'&& $risk->residual_impact=='Minor'){
                $ResidualRiskRating = "Moderate";
                $style2 = "background-color:YELLOW;";  
              }
              else if ($risk->residual_likelihood=='Likely'&& $risk->residual_impact=='Moderate'){
                $ResidualRiskRating = "Moderate";
                $style2 = "background-color:YELLOW;";  
              }*/
            $trends = array('up'=>'&uarr;','right'=>'&rarr;','down'=>'&darr;');
            $trend = $trends[$risk->trend];
            ?>
            <tr>
              <td class="align-top"><?php echo $risk->number;?></td>
              <td class="align-top"><?php echo $risk->risk_description;?></td>
              <td class="align-top"><?php echo '- '.$risk->risk_category.'<br>- '.$risk->proximity.'<br>- '.$risk->gross_likelihood.'<br>- '.$risk->gross_impact.'<br><span class="p-1" style="'.$style.'">- '.$GrossRiskRating.'</span>';?></td>
              <td class="align-top"><?php echo $risk->mitigation_strategy;?></td>
              <td class="align-top"><?php echo '- '.$risk->residual_likelihood.'<br>- '.$risk->residual_impact.'<br><span class="p-1" style="'.$style2.'">- '.$ResidualRiskRating.'</span><br>- '.$trend.'<br>- '.$risk->risk_owner;?></td>
              <td class="align-top"><?php echo $risk->progress_in_implementing_mitigation_strategy;?></td>
              <td class="align-top"><?php echo '- '.$risk->last_updated.'<br>- '.$risk->monthly_status.'<br>- '.$risk->risk_appetite.'<br>- '.$risk->within_appetite;?></td>
              <td class="align-top"><?php echo '- '.$risk->escalated_to_you_by.'<br>- '.$risk->escalated_to_you_for.'<br>- '.$risk->date_escalated_to_you.'<br>- '.$risk->escalated_onwards_to.'<br>- '.$risk->escalated_onwards_for.'<br>- '.$risk->date_escalated_onwards.'<br>- '.$risk->date_removed;?></td>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <td class="align-top" data-column-id="action">
                <span>
                  <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item edit-list" data-bs-toggle="offcanvas" href="#offcanvasView" onclick="viewThis('<?php echo $risk->id;?>');"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                        <li><a class="dropdown-item edit-list" data-bs-toggle="offcanvas" href="#offcanvasEdit" onclick="editThis('<?php echo $risk->id;?>');"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                      </ul>
                  </div>
                </span>
              </td>
              <?php } ?>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
<!--end row-->

<!-- Include jQuery library --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<!-- Include DataTables JavaScript --> 
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script> 
<script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#myTable').DataTable();
  });
</script>
<script type="text/javascript">
  function save_status(technical_update_id){
    //alert(technical_update_id+','+column_name+','+value);
    if(technical_update_id==0)
      var technical_update_id= $('#technical_update_id_new').val();
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/save_status'); ?>",
      data: { technical_update_id:technical_update_id },
      success: function(result)
      {
        if(result=="success")
          
// Example usage
showSuccessMessage("Success !! The selected technical update has been closed.", 3000); // Display "Success!" for 3 seconds (3000 milliseconds)
          /*var message = '<div class="alert alert-success alert-dismissible fade show">
                <strong>Success !!</strong> The selected technical update has been closed.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
          $("#message").html(message);*/
        //alert(result);
          /*$('.alert').show();
          $('.alert').fadeIn();*/
          //$(".alert").show();

        //$(".alert").show();
        /*setTimeout(function(){
          $(".alert").hide();
        }, 3500);*/
      }
    });
  }

  function showSuccessMessage(message, duration) {
  const successMessage = document.getElementById("successMessage");
  successMessage.textContent = message;
  successMessage.classList.remove("hidden");
  setTimeout(() => {
    successMessage.style.opacity = 1;
    setTimeout(() => {
      successMessage.style.opacity = 0;
      successMessage.classList.add("hidden");
    }, duration);
  }, 0);
  }

  function editThis(risk_register_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/component/risk_register_edit'); ?>",
      data: { risk_register_id:risk_register_id },
      success: function(result)
      {
        //alert(result);
        $('#edit_section').html(result);
      }
    });
  }

  function viewThis(risk_register_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/component/risk_register_view'); ?>",
      data: { risk_register_id:risk_register_id },
      success: function(result)
      {
        //alert(result);
        $('#view_section').html(result);
      }
    });
  }
</script>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Monthly Risk Register</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  <form method="post" action="<?php echo base_url().'admin/component/monthly_risk_register_add_process/';?>" class="d-flex flex-column justify-content-end h-100">
      <div class="offcanvas-body">
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Number</label>
              <input type="text" class="form-control" name="number" id="number-input" data-provider="flatpickr" data-range="true" placeholder="Enter Number">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Description</label>
              <textarea name="risk_description" id="risk_description" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Category</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_category" id="risk_category-select">
                  <option value="">Select risk category</option>
                  <option value="Policy and Programme Delivery">Policy and Programme Delivery</option>
                  <option value="Reputational">Reputational</option>
                  <option value="Safeguarding">Safeguarding</option>
                  <option value="Strategy and Context">Strategy and Context</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Proximity</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="proximity" id="proximity-select">
                  <option value="">Select proximity</option>                  
                  <option value="< 1 Month">< 1 Month</option>
                  <option value="0-3months">0-3months</option>
                  <option value="3-6months">3-6months</option>
                  <option value="6-12months">6-12months</option>12 months
                  <option value=">12 months">>12 months</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_likelihood" id="gross_likelihood-select">
                  <option value="">Select gross likelihood</option>
                  <option value="Almost Certain">Almost Certain</option>
                  <option value="Highly Likely">Highly Likely</option>
                  <option value="Likely">Likely</option>
                  <option value="Possible">Possible</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_impact" id="gross_impact-select">
                  <option value="">Select gross impact</option>
                  <option value="Major">Major</option>
                  <option value="Minor">Minor</option>
                  <option value="Moderate">Moderate</option>
                  <option value="Severe">Severe</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Mitigation Strategy</label>
              <textarea name="mitigation_strategy" id="mitigation_strategy" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_likelihood" id="residual_likelihood-select">
                  <option value="">Select residual likelihood</option>
                  <option value="Highly Likely">Highly Likely</option>
                  <option value="Likely">Likely</option>
                  <option value="Possible">Possible</option>
                  <option value="Unlikely">Unlikely</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_impact" id="residual_impact-select">
                  <option value="">Select residual impact</option>
                  <option value="Major">Major</option>
                  <option value="Minor">Minor</option>
                  <option value="Moderate">Moderate</option>
                  <option value="Severe">Severe</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Trend</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="trend" id="trend-select">
                  <option value="">Select trend</option>
                  <option value="up">&uarr;</option>
                  <option value="right">&rarr;</option>
                  <option value="down">&darr;</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Progress in Implementing Mitigation Strategy</label>
              <textarea name="progress_in_implementing_mitigation_strategy" id="progress_in_implementing_mitigation_strategy" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Last Updated</label>
              <input type="date" class="form-control" name="last_updated" id="last_updated-input" data-provider="flatpickr" data-range="true" placeholder="Enter last updated">
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Appetite</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_appetite" id="risk_appetite-select">
                  <option value="">Select risk appetite</option>
                  <option value="Cautious">Cautious</option>
                  <option value="Minimal">Minimal</option>
                  <option value="Receptive">Receptive</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Within Appetite ?</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="within_appetite" id="within_appetite-select">
                  <option value="">Select within appetite</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
              </select>
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You By ?</label>
              <input type="text" class="form-control" name="escalated_to_you_by" id="escalated_to_you_by-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you by">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You For ?</label>
              <input type="text" class="form-control" name="escalated_to_you_for" id="escalated_to_you_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you for">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated To You</label>
              <input type="date" class="form-control" name="date_escalated_to_you" id="date_escalated_to_you-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated to you">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated Onwards To ?</label>
              <input type="text" class="form-control" name="escalated_onwards_to" id="escalated_onwards_to-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards to">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalation Onwards For ?</label>
              <input type="text" class="form-control" name="escalated_onwards_for" id="escalated_onwards_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards for">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated Onwards</label>
              <input type="date" class="form-control" name="date_escalated_onwards" id="date_escalated_onwards-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated onwards">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Removed</label>
              <input type="date" class="form-control" name="date_removed" id="date_removed-input" data-provider="flatpickr" data-range="true" placeholder="Enter date removed">
          </div>
          <div class="mb-4">
              <button type="submit" class="btn btn-success w-sm">Submit</button>
          </div>
      </div>
      <!--end offcanvas-body-->
      <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
          <button class="btn btn-light w-100"></button>
          <button type="submit" class="btn btn-success w-100"></button>
      </div>
      <!--end offcanvas-footer-->
  </form>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEdit" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit Monthly Risk Register</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  
    <div class="offcanvas-body">
      <div id="edit_section">
      </div>
    </div>
    <!--end offcanvas-body-->
</div>
<!--end offcanvas-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasView" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">View Monthly Risk Register</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  
    <div class="offcanvas-body">
      <div id="view_section">
      </div>
    </div>
    <!--end offcanvas-body-->
</div>
<!--end offcanvas-->