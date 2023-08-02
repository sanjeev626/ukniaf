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
<div class="row">
    <div class="col-12">
      
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div class="mb-sm-0" id="message">
              <?php /* ?>
              <form action="<?php echo base_url().'/admin/reporting/if_weekly_technical_update_list_and_update';?>" name="frmList" method="post">
                  <div class="row g-3 mb-0 align-items-center">
                      <div class="col-sm-auto">
                          <div class="input-group">
                            <h5 class="search_section_label">From : </h5> 
                            <input type="date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(isset($_POST['from_date'])) echo $_POST['from_date'];?>" required>
                          </div>
                      </div>
                      <!--end col-->
                      <div class="col-sm-auto">
                          <div class="input-group">
                            <h5 class="search_section_label">To : </h5> 
                            <input type="date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(isset($_POST['to_date'])) echo $_POST['to_date'];?>" required>
                          </div>
                      </div>
                      <!--end col-->
                      <div class="col-sm-auto">
                          <div class="input-group">
                            <h5 class="search_section_label">Status : </h5>                            
                            <select name="update_status" id="update_status" class="form-select" data-choices="" data-choices-search-false="">
                              <option value="active" selected="">Active</option>
                              <option value="closed" <?php if(isset($_POST['update_status']) && $_POST['update_status']=="closed") echo 'selected="selected"';?>>Closed</option>
                            </select>
                          </div>
                      </div>
                      <!--end col-->
                      <div class="col-auto">
                          <button type="submit" name="btnList" class="btn btn-soft-success"><i class="ri-list-check align-middle me-1"></i> List</button>
                      </div>
                      <!--end col-->
                  </div>
                  <!--end row-->
              </form>
              <?php */ ?>
            </div>
            <div class="page-title-right">
              <span class="badge text-bg-primary" style="padding:10px; font-size:16px;">Task Order : <?php echo $this->Reporting_model->get_task_order_count();?></span>
              <span class="badge badge-pill bg-success" style="padding:10px; font-size:16px;"></span> | <span class="badge badge-pill bg-danger" style="padding:10px; font-size:16px;">Risk Number : <?php echo $this->Reporting_model->get_risk_number_count();?></span>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">IF Weekly Technical Update</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><button type="button" class="btn btn-success" data-bs-toggle="offcanvas" href="#technicalupdateAdd"><i class="ri-add-line align-bottom me-1"></i> Add New</button></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php //print_r($_SESSION);
            //$techincal_updates = $this->Reporting_model->get_weekly_techincal_update_archieve();
            if(isset($techincal_updates) && !empty($techincal_updates)){
              //$lastweek_decision = '';
              $lastweek_action = '';
            ?>
        <table class="table dt-responsive align-middle" id="myTable">
          <tbody>
            <?php
            foreach ($techincal_updates as $update_data) {              
              $lastweek_decision = $this->Reporting_model->get_last_week_data('decision',$update_data->update_date,$update_data->risk_number);
              $lastweek_action = $this->Reporting_model->get_last_week_data('action',$update_data->update_date,$update_data->risk_number);
            ?>
            <form name="frmTechnicalUpdate" action="<?php echo base_url().'admin/reporting/if_weekly_technical_update_edit_process/'.$update_data->id;?>" method="post">
            <tr>
              <th>Task Order</th>
              <th>Number</th>
              <th>Updates</th>
              <th>Decisions (Last week)</th>
              <th>Actions (Last week)</th>
              <th>Decisions (This week)</th>
              <th>Actions (This week)</th>
              <th>Status/Tags</th>
            </tr>
            <tr class="row-<?php echo $update_data->id;?>">
              <td><?php if(isset($update_data) && !empty($update_data)) echo date("j F Y", strtotime($update_data->update_date)).'<br>'.$update_data->task_order;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk_number;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) ?><textarea name="updates" id="updates" class="form-control" rows="3"><?php echo $update_data->updates;?></textarea></td>
              <td><?php echo $this->general_model->display_short_text($lastweek_decision,'100');?></td>
              <td><?php echo $this->general_model->display_short_text($lastweek_action,'100');?></td>
              <td><textarea name="decision" id="decision" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->decision;?></textarea></td>
              <td><textarea name="action" id="action" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->action;?></textarea></td>
              <td>
                <select class="form-control" name="update_status" id="update_status-select">
                  <option value="Active" <?php if(isset($update_data) && $update_data->update_status=='Active') echo 'selected';?>>Active</option>
                  <option value="Closed" <?php if(isset($update_data) && $update_data->update_status=='Closed') echo 'selected';?>>Closed</option>
                </select>
                <!-- Tags-->
                <?php 
                $option = '<option value="">Select one</option>';
                $tags = $this->Tag_model->get_all_tags();
                if(isset($tags) &&!empty($tags)){
                  /*print_r($tags);
                  echo $this->db->last_query();*/
                  $option='';
                  foreach($tags as $tag){
                    $option.='<option value="'.$tag->id.'">'.$tag->tag.'</option>';
                  }
                }
                ?>
                <select name="tags[]" class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem multiple>
                  <?php echo $option;?>
                </select>
              </td>
            </tr>
            <tr>

              <th>Stakeholder</th>
              <th>Internal Notes</th>
              <th>FCDO Update</th>
              <th>Risk</th>
              <th>Mitigation</th>
              <th>Residual Risk</th>
              <th>Document URL</th>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <th>&nbsp;</th>
              <?php } ?>
            </tr>  
            <tr class="row-<?php echo $update_data->id;?>">
              <td><textarea name="stakeholder" id="stakeholder" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->stakeholder;?></textarea></td>
              <td><textarea name="internal_notes" id="internal_notes" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->internal_notes;?></textarea></td>
              <td><textarea name="fcdo_update" id="fcdo_update" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->fcdo_update;?></textarea></td>
              <td><textarea name="risk" id="risk" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk;?></textarea></td>
              <td><textarea name="mitigation" id="mitigation" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->mitigation;?></textarea></td>
              <td><textarea name="residual_risk" id="residual_risk" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->residual_risk;?></textarea></td>
              <td><textarea name="document_url" id="document_url" class="form-control" rows="3"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->document_url;?></textarea></td>
              <td data-column-id="action">
                <input type="hidden" name="technical_update_id" value="<?php echo $update_data->id;?>"/>
                <input type="submit" name="btnSave" class="btn btn-success" value="Save" /> 
                <?php /* ?>
                <span>
                  <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#technicalupdateView" onclick="viewThis('<?php echo $update_data->id;?>');"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                        <li><a class="dropdown-item edit-list" data-bs-toggle="offcanvas" href="#technicalupdateEdit" onclick="editThis('<?php echo $update_data->id;?>');"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li class="dropdown-divider"></li>
                        <?php if(isset($update_data) && !empty($update_data->document_url)){?>
                        <li><a class="dropdown-item" href="<?php echo $update_data->document_url;?>" target="_blank"><i class="ri-link-m align-bottom me-2 text-muted"></i> URL</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal" onclick="save_status('<?php echo $update_data->id;?>');"><i class="ri-archive-line align-bottom me-2 text-muted"></i> Close</a></li>
                      </ul>
                  </div>
                </span>
                <?php */ ?>
              </td>
            </tr>  
            <tr class="row-<?php echo $update_data->id;?>">
              <td colspan="8"><hr class="spacebreak"/></td>
            </tr>
            </form>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
        }
        else{
        ?>
        <div class="alert alert-success" role="alert">
          <strong>There is no IF Weekly Technical Update data available.</strong>
        </div>
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
          showSuccessMessage("Success !! The selected technical update has been closed.", 3000); // Display "Success!" for 3 seconds (3000 milliseconds)
        $(".row-"+technical_update_id).hide();
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



  function editThis(technical_update_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/technical_update_edit'); ?>",
      data: { technical_update_id:technical_update_id },
      success: function(result)
      {
        //alert(result);
        $('#edit_section').html(result);
      }
    });
  }

  function viewThis(technical_update_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/technical_update_view'); ?>",
      data: { technical_update_id:technical_update_id },
      success: function(result)
      {
        //alert(result);
        $('#view_section').html(result);
      }
    });
  }
</script>
<div class="offcanvas offcanvas-end" tabindex="-1" id="technicalupdateAdd" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Weekly Technical Update</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  <form method="post" action="<?php echo base_url().'admin/reporting/if_weekly_technical_update_add_process/';?>" class="d-flex flex-column justify-content-end h-100">
      <div class="offcanvas-body">
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Task Order</label>
          <input type="text" class="form-control" name="task_order" id="task_order-input" data-range="true" placeholder="Enter task order">
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Number</label>
          <input type="text" class="form-control" name="risk_number" id="risk_number-input" data-range="true" placeholder="Enter number">
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Updates</label>
          <textarea name="updates" id="updates" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Weekly Decision</label>
          <textarea name="decision" id="decision" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Weekly Action</label>
          <textarea name="action" id="action" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Stakeholder</label>
          <textarea name="stakeholder" id="stakeholder" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Internal Notes</label>
          <textarea name="internal_notes" id="internal_notes" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">FCDO Update</label>
          <textarea name="fcdo_update" id="fcdo_update" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk</label>
          <textarea name="risk" id="risk" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Mitigation</label>
          <textarea name="mitigation" id="mitigation" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Risk</label>
          <textarea name="residual_risk" id="residual_risk" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Document URL</label>
          <input type="text" class="form-control" name="document_url" id="document_url-input" data-range="true" placeholder="Enter document url">
        </div>
        <div class="mb-4">
          <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Status</label>
          <select class="form-control" data-choices data-choices-multiple-remove="true" name="update_status" id="update_status-select">
            <option value="Active">Active</option>
            <option value="Closed">Closed</option>
          </select>
        </div>
        <div class="mb-4">
            <label for="choices-multiple-remove-button" class="form-label text-muted">Update Tags</label>
            <p class="text-muted">Select <code>tags</code> from list.</p>
            <?php 
              $option = '<option value="">Select one</option>';
              $tags = $this->Tag_model->get_all_tags();
              if(isset($tags) &&!empty($tags)){
                /*print_r($tags);
                echo $this->db->last_query();*/
                $option='';
                foreach($tags as $tag){
                  $option.='<option value="'.$tag->id.'">'.$tag->tag.'</option>';
                }
              }
              ?>
            <select name="tags[]" class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem multiple>
              <?php echo $option;?>
            </select>
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
  </form><!-- App favicon -->


  <!-- Begin page -->
  <div id="layout-wrapper">
    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
      <!-- /.modal-dialog --> 
    </div>
  </div>
  <!-- END layout-wrapper -->
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="technicalupdateEdit" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit Weekly Technical Update</h5>
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
<!--end offcanvas-->

<div class="offcanvas offcanvas-end" tabindex="-1" id="technicalupdateView" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">View Weekly Technical Update</h5>
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