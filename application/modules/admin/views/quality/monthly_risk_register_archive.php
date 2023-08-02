
  <!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Monthly risk register archive</h4>
        <div class="page-title-right">
          <form action="" method="post" class="mb-0">
          <ol class="breadcrumb m-0">
            <li><input type="text" name="date_range" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="Y-m-d" data-range-date="true" readonly="readonly" placeholder="Enter date range" value="<?php if(isset($_POST['date_range'])) echo $_POST['date_range'];?>" style="width:200px; margin-right:10px;"></li>
            <li><button type="submit" class="btn btn-info w-sm"><i class="ri-list-check"></i> List</button></li>
          </form>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body table-container">
        <?php //print_r($_SESSION);
        //$monthly_risks = $this->Reporting_model->get_weekly_techincal_update_archieve();
        if(isset($monthly_risks) && !empty($monthly_risks)){
          $lastweek_decision = '';
          $lastweek_action = '';
        ?>
        <table class="table dt-responsive table-striped align-middle" id="myTable">
          <thead class="table-light">
            <tr>
              <th>Number</th>
              <th>Risk Description</th>
              <th>Risk Category</th>
              <th>Gross Likelihood</th>
              <th>Gross Impact</th>
              <th>Gross Risk Rating</th>
              <th>Mitigation Strategy</th>
              <th>Residual Likelihood</th>
              <th>Residual Impact</th>
              <th>Residual Risk Rating</th>
              <th>Trend</th>
              <th>Progress in Implementing Mitigation Strategy</th>
              <th>Last Updated</th>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <th>&nbsp;</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $text_length = 100;
            foreach ($monthly_risks as $risk) {
              $GrossRiskRating = "";
              $style = "";
              $gross = $this->component_model->get_rating($risk->gross_likelihood,$risk->gross_impact);
              $GrossRiskRating = $gross['rating'];
              $style = "background-color:".$gross['color_code'].";"; 

              $ResidualRiskRating = "";
              $style2 = "";
              $residual = $this->component_model->get_rating($risk->residual_likelihood,$risk->residual_impact);
              $ResidualRiskRating = $residual['rating'];
              $style2 = "background-color:".$residual['color_code'].";"; 
            $trends = array('up'=>'&uarr;','right'=>'&rarr;','down'=>'&darr;');
            if(!empty($risk->trend))
              $trend = $trends[$risk->trend];
            else
              $trend = '';
            ?>
            <tr>
              <td class="align-top"><?php echo $risk->number;?></td>
              <td class="align-top"><span title="<?php echo $risk->risk_description;?>"><?php echo substr($risk->risk_description,0,$text_length);?></span></td>
              <td class="align-top"><?php echo $risk->risk_category;?></td>
              <td class="align-top"><?php echo $risk->gross_likelihood;?></td>
              <td class="align-top"><?php echo $risk->gross_impact;?></td>
              <td class="align-top" style="<?php echo $style;?>"><?php echo $GrossRiskRating;?></td>
              <td class="align-top"><span title="<?php echo $risk->mitigation_strategy;?>"><?php echo substr($risk->mitigation_strategy,0,$text_length);?></span></td>
              <td class="align-top"><?php echo $risk->residual_likelihood;?></td>
              <td class="align-top"><?php echo $risk->residual_impact;?></td>
              <td class="align-top" style="<?php echo $style2;?>"><?php echo $ResidualRiskRating;?></td>
              <td class="align-top"><?php echo $trend;?></td>
              <td class="align-top"><span title="<?php echo $risk->progress_in_implementing_mitigation_strategy;?>"><?php echo substr($risk->progress_in_implementing_mitigation_strategy,0,$text_length);?></span></td>
              <td class="align-top"><?php if(!empty($risk->last_updated)) echo date("j F Y", strtotime($risk->last_updated));?></td>
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
        else{
          if(isset($_POST['date_range']) && $from_date=="0000-00-00" && $to_date=="0000-00-00"){
          ?>
          <div class="alert alert-danger" role="alert">
            <strong>Invalid Date!! Please enter a date range. Start and End date.</strong>
          </div>
          <?php            
          }
          else if(isset($_POST['date_range'])){
          ?>
          <div class="alert alert-danger" role="alert">
            <strong>There is no monthly risk register between the provided date range.</strong>
          </div>
          <?php
          }else{
          ?>
          <div class="alert alert-success" role="alert">
            <strong>Please enter a date range.</strong>
          </div>
          <?php

          }
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