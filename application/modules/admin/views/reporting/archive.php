
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
        <h4 class="card-title mb-0 flex-grow-1">Weekly Technical Update archive</h4>
        <div class="page-title-right">
          <form action="" method="post" class="mb-0">
          <ol class="breadcrumb m-0">
            <li><input type="text" name="date_range" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="Y-m-d" data-range-date="true" readonly="readonly" placeholder="Enter date range" value="<?php if(isset($_POST['date_range'])) echo $_POST['date_range'];?>" style="width:200px; margin-right:10px;"></li>
            <li><button type="submit" class="btn btn-info w-sm"><i class="ri-list-check"></i> List</button></li>
          </form>
        </div>
      </div>
      <!-- end card header -->
      
      <div class="card-body">
        <?php //print_r($_SESSION);
            //$milestone_info = $this->Milestone_model->get_weekly_techincal_update_archieve();
            if(isset($milestone_info) && !empty($milestone_info)){
              $lastweek_decision = '';
              $lastweek_action = '';
            ?>

          <div class="row">
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Task Order</label>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">M Ref</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Milestone</label>
              </div>
            </div>
            <div class="col-lg-1 w-150">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Due to FCDO</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Evidence Required</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Milestone Delivery Risks to Flag</label>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Status</label>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">FCDO Approval</label>
              </div>
            </div>
          </div>
            <?php
            $sn=0;
            foreach ($milestone_info as $milestone) {
            ?>
            <form method="post" name="saveMilestone" action="<?php echo base_url().'admin/milestone/edit_process/'.$milestone->id;?>">
            <div class="row">
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <input type="text" class="form-control" name="task_order" id="task_order-input" value="<?php if(isset($milestone)) echo $milestone->task_order;?>" required />
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <input type="text" name="m_ref" id= "m_ref" class="form-control" value="<?php if(isset($milestone)) echo $milestone->m_ref;?>" required />
                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="milestone" id="milestone" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->milestone;?></textarea>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <input type="date" class="form-control padding_2" name="due_to_fcdo" id="due_to_fcdo-input" value="<?php if(isset($milestone)) echo $milestone->due_to_fcdo;?>" />
                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="evidence_required" id="evidence_required" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->evidence_required;?></textarea>
                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="milestone_delivery_risks_to_flag" id="milestone_delivery_risks_to_flag" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->milestone_delivery_risks_to_flag;?></textarea>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <select name="milestone_status" id="milestone_status" class="form-select">
                    <option value="active" selected="">Active</option>
                    <option value="closed" <?php if(isset($milestone) && $milestone->milestone_status=="closed") echo 'selected="selected"';?>>Closed</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <input name="fcdo_approval" id="fcdo_approval" class="form-control"  placeholder="" type="text" value="<?php if(isset($milestone)) echo $milestone->fcdo_approval;?>" />
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <button type="submit" class="btn btn-success w-sm">Save</button>              
                </div>
              </div>
            </div>
          </form>
          <?php
          }
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
            <strong>There is no milestone schedule between the provided date range.</strong>
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