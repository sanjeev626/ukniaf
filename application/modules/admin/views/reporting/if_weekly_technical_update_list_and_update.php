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
            <li><a href="<?php echo base_url();?>admin/reporting/if_weekly_technical_update_add" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add New Update</a></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php //print_r($_SESSION);
            //$techincal_updates = $this->Reporting_model->get_weekly_techincal_update_archieve();
            if(isset($techincal_updates)){
              $lastweek_decision = 'Here goes last week decision.';
              $lastweek_action = 'Here goes last week action.';
            ?>
          <div class="row">
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Task Order <br> Risk Number<br>Updates</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Decisions (This week)<br>Decisions (Last week)</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Actions (This week)<br>Actions (Last week)</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Stakeholder<br>Internal Notes</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">FCDO Update<br>Risk</label>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Mitigation <br>Residual Risk</label>
              </div>
            </div>
          </div>
            <?php
            foreach ($techincal_updates as $update_data) {
            ?>
            <div class="row">
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <input type="text" class="form-control" name="task_order" id="task_order-input" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->task_order;?>" oninput="save_update('<?php echo $update_data->id;?>','task_order',this.value);" />
                  <input type="text" class="form-control" name="risk_number" id="risk_number-input" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk_number;?>" oninput="save_update('<?php echo $update_data->id;?>','risk_number',this.value);" />
                  <textarea name="updates" id="updates" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','updates',this.value);"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->updates;?></textarea>
                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="decision" id="decision" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','decision',this.value);" placeholder="Decisions (This week)"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->decision;?></textarea>
                  <?php echo $lastweek_decision;?>

                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="action" id="action" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','action',this.value);" placeholder="Actions (This week)"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->action;?></textarea>
                  <?php echo $lastweek_action;?>

                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="stakeholder" id="stakeholder" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','stakeholder',this.value);" placeholder="Stakeholder"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->stakeholder;?></textarea>
                  <textarea name="internal_notes" id="internal_notes" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','internal_notes',this.value);" placeholder="Internal Notes"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->internal_notes;?></textarea>
                </div>
              </div>
              <div class="col-lg-2 padding_2">
                <div class="mb-3">
                  <textarea name="fcdo_update" id="fcdo_update" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','fcdo_update',this.value);" placeholder="FCDO Update"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->fcdo_update;?></textarea>
                  <textarea name="risk" id="risk" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','risk',this.value);" placeholder="Risk"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk;?></textarea>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  <textarea name="mitigation" id="mitigation" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','mitigation',this.value);" placeholder="Mitigation"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->mitigation;?></textarea>
                  <textarea name="residual_risk" id="residual_risk" class="form-control" rows="3" oninput="save_update('<?php echo $update_data->id;?>','residual_risk',this.value);" placeholder="Residual Risk"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->residual_risk;?></textarea>
                </div>
              </div>
              <div class="col-lg-1 padding_2">
                <div class="mb-3">
                  
                <span>
                  <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo base_url().'admin/reporting/view/'.$update_data->id;?>" target="_blank"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                        <li><a class="dropdown-item edit-list" data-edit-id="1" href="<?php echo base_url().'admin/reporting/if_weekly_technical_update_edit/'.$update_data->id;?>"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li class="dropdown-divider"></li>
                        <?php if(isset($update_data) && !empty($update_data->document_url)){?>
                        <li><a class="dropdown-item" href="<?php echo $update_data->document_url;?>" target="_blank"><i class="ri-link-m align-bottom me-2 text-muted"></i> URL</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal" onclick="save_status('<?php echo $update_data->id;?>');"><i class="ri-archive-line align-bottom me-2 text-muted"></i> Close</a></li>
                      </ul>
                  </div>
                </span>           
                </div>
              </div>
            </div>
            <!-- <hr style="height:5px;"> -->
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
  function save_update(technical_update_id,column_name,value){
    //alert(technical_update_id+','+column_name+','+value);
    if(technical_update_id==0)
      var technical_update_id= $('#technical_update_id_new').val();
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/save_update'); ?>",
      data: { technical_update_id:technical_update_id, column_name:column_name, value:value },
      success: function(result)
      {
        //alert(result);
        if(result>0)
          $('#technical_update_id_new').val(result);
        //$('#updated').show();
        //setTimeout(function(){
        //  $("#updated").hide();
        //}, 3500);
      }
    });
  }
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


</script>