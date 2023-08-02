<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<style type="text/css">
  #successMessage {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: green;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  z-index: 999;
  opacity: 0;
  transition: opacity 0.5s;
}

.hidden {
  display: none;
}
</style>
<div id="successMessage" class="hidden">Success!</div>
<!-- start page title -->
<!-- <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0" id="message">
              
            </h4>
            <div class="page-title-right">
              <span class="badge text-bg-primary" style="padding:10px; font-size:16px;">Task Order : <?php //echo $this->Milestone_model->get_task_order_count();?></span>
              <span class="badge badge-pill bg-success" style="padding:10px; font-size:16px;"></span> | <span class="badge badge-pill bg-danger" style="padding:10px; font-size:16px;">Risk Number : <?php //echo $this->Milestone_model->get_risk_number_count();?></span>
            </div>

        </div>
    </div>
</div> -->
<!-- end page title -->

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Milestone Schedule</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><a href="<?php echo base_url();?>admin/milestone/add" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add New Milestone</a></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php //print_r($_SESSION);
            //$milestone_info = $this->Milestone_model->get_weekly_techincal_update_archieve();
            if(isset($milestone_info)){
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
                  <select name="milestone_status" id="milestone_status" class="form-select" data-choices="" data-choices-search-false="">
                <option value="active" selected="">Active</option>
                <option value="closed" <?php if(isset($milestone) && $milestone->milestone_status=="closed") echo 'selected="selected"';?>>Closed</option>
              </select>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <input name="fcdo_approval" id="fcdo_approval" class="form-control" data-choices data-choices-multiple-remove="true" placeholder="" type="text" value="<?php if(isset($milestone)) echo $milestone->fcdo_approval;?>" />
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
          ?>
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
      url: "<?php echo site_url('admin/milestone/save_status'); ?>",
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


</script>