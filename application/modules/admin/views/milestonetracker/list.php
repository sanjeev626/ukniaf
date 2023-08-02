<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<!--datatable css-->
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
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Milestone Tracker</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><button type="button" class="btn btn-success" data-bs-toggle="offcanvas" href="#milestonetrackerAdd"><i class="ri-add-line align-bottom me-1"></i> Add New</button></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <?php if(isset($milestonetracker_info) && !empty($milestonetracker_info)){?>
                <table id="scroll-horizontal" class="table table-striped align-middle" style="width:100%">
                  <thead>
                    <tr>
                      <th>S. N.</th>
                      <th>Component</th>
                      <th>TO Number</th>
                      <th>TO Name</th>
                      <th>M#</th>
                      <th>Milestone Title</th>
                      <th>Milestone due date</th>
                      <th>Status</th>
                      <th>FCDO Status</th>
                      <th>Notes</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $text_length = 100;
                  $sn=0;
                  foreach ($milestonetracker_info as $milestonetracker) {
                  ?>
                    <tr class="row-<?php echo $milestonetracker->id;?>">
                      <td class="text-center"><?php echo ++$sn;?></td>
                      <td><?php echo $milestonetracker->component;?></td>
                      <td><?php echo $milestonetracker->to_number;?></td>
                      <td><?php echo $this->general_model->display_short_text($milestonetracker->to_name,'100');?></td>
                      <td><?php echo $milestonetracker->m_number;?></td>
                      <td><?php echo $this->general_model->display_short_text($milestonetracker->milestone_title,'100');?></td>
                      <td><?php if(!empty($milestonetracker->milestone_due_date) && $milestonetracker->milestone_due_date!="0000-00-00") echo $this->general_model->display_long_date($milestonetracker->milestone_due_date);?></td>
                      <td><?php echo $milestonetracker->milestonetracker_status;?></td>
                      <td><?php echo $milestonetracker->fcdo_status;?></td>
                      <td><?php echo $milestonetracker->notes;?></td>
                      <td>
                        <div class="dropdown d-inline-block">
                          <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ri-more-fill align-middle"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <?php if(!empty($milestonetracker->fcdo_url_to_ppt)){?>
                            <li><a href="<?php echo $milestonetracker->fcdo_url_to_ppt;?>" target="_blank" class="dropdown-item"><i class="ri-links-fill align-bottom me-2 text-muted"></i> FCDO URL to ppt</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#viewSection" onclick="viewThis('<?php echo $milestonetracker->id;?>');"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                            <li><a class="dropdown-item edit-list" data-bs-toggle="offcanvas" href="#editSection" onclick="editThis('<?php echo $milestonetracker->id;?>');"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                            <?php /*<li><a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal" onclick="save_status('<?php echo $milestonetracker->id;?>');"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete </a></li>*/?>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <?php } 
                else{
                ?>
                <div class="alert alert-success" role="alert">
                  <strong>There is no Milestone Tracker data available.</strong>
                </div>
                <?php  
                }
                ?>
              </div>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div>
    </div>
  </div>
</div>
<!--end row-->
<script src="<?php echo base_url();?>content_admin/assets/js/pages/datatables.init.js"></script>

<!-- Include jQuery library --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<!-- Include DataTables JavaScript --> 
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script> 

<script type="text/javascript">
  function save_status(milestonetracker_id){
    //alert(milestonetracker_id+','+column_name+','+value);
    if(milestonetracker_id==0)
      var milestonetracker_id= $('#milestonetracker_id_new').val();
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/milestonetracker/save_status'); ?>",
      data: { milestonetracker_id:milestonetracker_id },
      success: function(result)
      {
        if(result=="success")
        // Example usage
        showSuccessMessage("Success !! The selected milestone tracker has been deleted.", 3000); // Display "Success!" for 3 seconds (3000 milliseconds)
      }
    });
  }

  function editThis(milestonetracker_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/milestonetracker/milestonetracker_edit'); ?>",
      data: { milestonetracker_id:milestonetracker_id },
      success: function(result)
      {
        //alert(result);
        $('#edit_section').html(result);
      }
    });
  }

  function viewThis(milestonetracker_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/milestonetracker/milestonetracker_view'); ?>",
      data: { milestonetracker_id:milestonetracker_id },
      success: function(result)
      {
        //alert(result);
        $('#view_section').html(result);
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="milestonetrackerAdd" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Milestone Tracker</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  <form method="post" action="<?php echo base_url().'admin/milestonetracker/add_process/';?>" class="d-flex flex-column justify-content-end h-100">
      <div class="offcanvas-body">
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">component</label>
              <input type="text" class="form-control" name="component" id="component-input" placeholder="Enter component">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">TO Number</label>
              <input type="text" class="form-control" name="to_number" id="to_number-input" placeholder="Enter TO number" required>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">TO Name</label>
              <input type="text" class="form-control" name="to_name" id="to_name-input" placeholder="Enter TO name">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">M#</label>
              <input type="text" class="form-control" name="m_number" id="m_number-input" placeholder="Enter M#">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Milestone title</label>
              <textarea name="milestone_title" id="milestone_title" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Milestone due date</label>
              <input type="date" class="form-control" name="milestone_due_date" id="milestone_due_date-input" data-provider="flatpickr" data-range="true" placeholder="Enter milestone due date">
          </div>
          <div class="mb-4">
            <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
            <select class="form-control" data-choices data-choices-multiple-remove="true" name="milestonetracker_status" id="milestonetracker_status-select" required>
              <option value="">Choose Status</option>
              <option value="MGT APPROVED">MGT APPROVED</option>
              <option value="PASSED">PASSED</option>
              <option value="TRUNCATED">TRUNCATED</option>
              <option value="SUSPENDED">SUSPENDED</option>
              <option value="DUE THIS MONTH">DUE THIS MONTH</option>
              <option value="ONGOING">ONGOING</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO Status</label>
            <select class="form-control" data-choices data-choices-multiple-remove="true" name="fcdo_status" id="fcdo_status-select" required>
              <option value="">Choose FCDO Status</option>
              <option value="APPROVED">APPROVED</option>
              <option value="NOT APPROVED">NOT APPROVED</option>
            </select>
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Notes</label>
              <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO URL to ppt</label>
              <textarea name="fcdo_url_to_ppt" id="fcdo_url_to_ppt" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <button type="submit" class="btn btn-success w-sm">Submit</button>
          </div>
      </div>
      <!--end offcanvas-body-->
      <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
      </div>
      <!--end offcanvas-footer-->
  </form>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="editSection" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit Milestone Tracker</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  
    <div class="offcanvas-body">
      <div id="edit_section">
      </div>
    </div>
    <!--end offcanvas-body-->
       
      <div id="layout-wrapper">
          <!-- removeNotificationModal -->
          <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <!-- /.modal-dialog --> 
          </div>
      </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="viewSection" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">View Milestone Tracker</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  
    <div class="offcanvas-body">
      <div id="view_section">
      </div>
    </div>
    <!--end offcanvas-body-->
       
      <div id="layout-wrapper">
          <!-- removeNotificationModal -->
          <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <!-- /.modal-dialog --> 
          </div>
      </div>
</div>
<!--end offcanvas-->