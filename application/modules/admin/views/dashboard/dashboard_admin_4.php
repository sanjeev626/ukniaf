<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Dashboard</h4>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php
        if(isset($_SESSION['role']) && $_SESSION['role']=="PM")
          $techincal_updates = $this->Reporting_model->get_all_technical_updates();
        else
          $techincal_updates = $this->Reporting_model->get_techincal_update_dashboard();
        if($techincal_updates){
        ?>
        <table class="table table-striped align-middle" id="scroll-horizontal">
          <thead class="table-light">
            <tr>
              <th>Task<br>
                Order</th>
              <th>Number</th>
              <th>Updates</th>
              <th>Decisions<br>
                (Last week)</th>
              <th>Actions<br>
                (Last week)</th>
              <th>Decisions<br>
                (This week)</th>
              <th>Actions<br>
                (This week)</th>
              <th>Internal Notes</th>
              <th>Risk</th>
              <th>Mitigation</th>
              <!-- <th>&nbsp;</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($techincal_updates as $update_data) {
              $lastweek_decision = $this->Reporting_model->get_last_week_data('decision',$update_data->update_date,$update_data->risk_number);
              $lastweek_action = '';
            ?>
            <tr>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->task_order;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk_number;?><?php echo "<br>".$this->general_model->display_long_date($update_data->update_date);?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->updates;?></td>
              <td><?php echo $this->general_model->display_short_text($lastweek_decision,'100');?></td>
              <td><?php echo $this->general_model->display_short_text($lastweek_action,'100');?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $this->general_model->display_short_text($update_data->decision,'100');?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $this->general_model->display_short_text($update_data->action,'100');?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->internal_notes;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk;?></td>
              <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->mitigation;?></td>
              <!-- <td data-column-id="action">
                <span>
                  <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="apps-ecommerce-product-details.html"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                        <li><a class="dropdown-item edit-list" data-edit-id="1" href="<?php echo base_url().'admin/reporting/if_weekly_technical_update_edit/'.$update_data->id;?>"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-archive-line align-bottom me-2 text-muted"></i> Close</a></li>
                      </ul>
                  </div>
                </span>
              </td> -->
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

<script src="<?php echo base_url();?>content_admin/assets/js/pages/datatables.init.js"></script>

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