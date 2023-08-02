<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Weekly Update</h4>
        <!-- <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><a href="<?php //echo base_url();?>admin/reporting/if_weekly_technical_update_add" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add New Update</a></li>
          </ol>
        </div> -->
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php //print_r($_SESSION);
            //$if_weekly_updates = $this->Reporting_model->get_weekly_techincal_update_archieve();
        //print($if_weekly_updates);
        if(isset($if_weekly_updates) && !empty($if_weekly_updates)){
        ?>
        <table class="table dt-responsive table-striped align-middle" id="myTable">
          <thead class="table-light">
            <tr>
              <th>Task<br>
                Order</th>
              <th>Risk<br>
                Number</th>
              <th>Updates</th>
              <th>Decisions<br>
                (Last week)</th>
              <th>Actions<br>
                (Last week)</th>
              <th>Decisions<br>
                (This week)</th>
              <th>Actions<br>
                (This week)</th>
              <th>Stakeholder</th>
              <th>Internal Notes</th>
              <th>FCDO Update</th>
              <th>Risk</th>
              <th>Mitigation</th>
              <th>Residual Risk</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($if_weekly_updates as $update_data) {              
              $lastweek_decision = $this->Reporting_model->get_last_week_data('decision',$update_data->update_date,$update_data->risk_number);
              $lastweek_action = $this->Reporting_model->get_last_week_data('action',$update_data->update_date,$update_data->risk_number);
            ?>
            <tr>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->task_order;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk_number;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo date("j F Y", strtotime($update_data->update_date)).'<br>'.$update_data->updates;?></td>
              <td><?php echo $lastweek_decision;?></td>
              <td><?php echo $lastweek_action;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->decision;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->action;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->stakeholder;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->internal_notes;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->fcdo_update;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->mitigation;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->residual_risk;?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <?php
        }
        else{
          ?>
          <div class="alert alert-danger" role="alert">
            <strong>There is no update in last week.</strong>
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