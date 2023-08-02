<div class="row">

  <div class="col-xl-12 col-lg-12">
      <div>
          <div class="card">
              <div class="card-header border-0">
                  <div class="row g-4">
                      <div class="col-sm-auto">
                          <div>
                              <a href="apps-ecommerce-add-product.html" class="btn btn-success" id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
                          </div>
                      </div>
                      <div class="col-sm">
                          <div class="d-flex justify-content-sm-end">
                              <div class="search-box ms-2">
                                  <input type="text" class="form-control" id="searchProductList" placeholder="Search Products...">
                                  <i class="ri-search-line search-icon"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="card-header">
                  <div class="row align-items-center">
                      <div class="col">
                          <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#productnav-all" role="tab">
                                      All <span class="badge badge-soft-danger align-middle rounded-pill ms-1">12</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published" role="tab">
                                      Published <span class="badge badge-soft-danger align-middle rounded-pill ms-1">5</span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft" role="tab">
                                      Draft
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-auto">
                          <div id="selection-element">
                              <div class="my-n1 d-flex align-items-center text-muted">
                                  Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end card header -->
              <div class="card-body">

                  <div class="tab-content text-muted">
                      <div class="tab-pane active" id="productnav-all" role="tabpanel">
                          <div id="table-product-list-all" class="table-card gridjs-border-none"></div>
                      </div>
                      <!-- end tab pane -->

                      <div class="tab-pane" id="productnav-published" role="tabpanel">
                          <div id="table-product-list-published" class="table-card gridjs-border-none"></div>
                      </div>
                      <!-- end tab pane -->

                      <div class="tab-pane" id="productnav-draft" role="tabpanel">
                          <div class="py-4 text-center">
                              <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:72px;height:72px">
                              </lord-icon>
                              <h5 class="mt-4">Sorry! No Result Found</h5>
                          </div>
                      </div>
                      <!-- end tab pane -->
                  </div>
                  <!-- end tab content -->

              </div>
              <!-- end card body -->
          </div>
          <!-- end card -->
      </div>
  </div>
  <!-- end col -->
</div>
<!-- end row -->









<?php /* ?>
<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">Dashboard</h4>
      <!-- <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
          <li class="breadcrumb-item active">CRM</li>
        </ol>
      </div> -->
    </div>
  </div>
</div>
<!-- end page title -->
<?php */ ?>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
          
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">IF Weekly Technical Update</h4>
        <form method="post" name="frmRiskorder">
        <select name="task_order" id="task_order" class="form-control text-right" onchange="list_risk_number(this.value)">
          <option value="">Select Task Order</option>
          <?php if(isset($task_orders)){
            foreach($task_orders as $task_order){
            ?>
            <option value="<?php echo $task_order->task_order;?>" <?php if(isset($_POST['task_order']) && $_POST['task_order']==$task_order->task_order) echo 'selected="selected"'; ?>><?php echo $task_order->task_order;?></option>
            <?php
            }
          }
          ?>
        </select>
        <div id="select_risk_number_section">
        <select name="risk_number" id="risk_number" class="form-control text-right" onchange="this.form.submit();">
          <option value="">Select Risk Number</option>
          <?php
          if(isset($_POST['task_order'])){
            $task_order = $_POST['task_order'];
            $risk_numbers = $this->Reporting_model->get_risk_number_by_task_order($task_order);
            foreach($risk_numbers as $risk_number){
            ?>
            <option value="<?php echo $risk_number->risk_number;?>" <?php if(isset($_POST['risk_number']) && $_POST['risk_number']==$risk_number->risk_number) echo 'selected="selected"'; ?>><?php echo $risk_number->risk_number;?></option>
            <?php
            }/**/
          }
          ?>
        </select>
        </div>
        </form>
      </div>
      <!-- end card header -->
          <div class="card-body">
            <?php
            //$techincal_updates = $this->Reporting_model->get_weekly_techincal_update_archieve();
            if(isset($techincal_updates)){
              $lastweek_decision = '';
              $lastweek_action = '';
            ?>
              <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Updates</th>
                      <th>Decisions<br>(This week)</th>
                      <th>Actions<br>(This week)</th>
                      <th>Decisions<br>(Last week)</th>
                      <th>Actions<br>(Last week)</th>
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
                  foreach ($techincal_updates as $update_data) {
                  ?>
                  <tr>
                    <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->updates;?></td>
                    <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->decision;?></td>
                    <td><?php if(isset($update_data) && !empty($update_data)) echo $update_data->action;?></td>
                    <td><?php echo $lastweek_decision;?></td>
                    <td><?php echo $lastweek_action;?></td>
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
              <div class="alert alert-warning" role="alert">
                Please select risk number to view all the techincal update under it.  
              </div>
              <?php
              }
              ?>
          </div>
      </div>
  </div>
</div><!--end row-->
<script type="text/javascript">
  function list_risk_number(task_order){
    //alert(task_order);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/list_risk_number'); ?>",
      data: { task_order:task_order },
      success: function(result)
      {
        //alert(result);
        /*if(result>0)
          alert(result);*/

          $('#select_risk_number_section').html(result);
        //$('#updated').show();
        //setTimeout(function(){
        //  $("#updated").hide();
        //}, 3500);
      }
    });
  }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <?php /* <script src="<?php echo base_url();?>content_admin/assets/js/pages/datatables.init.js"></script> */ ?>

<!-- ecommerce product list -->
<script src="<?php echo base_url();?>content_admin/assets/js/pages/ecommerce-product-list.init.js"></script>