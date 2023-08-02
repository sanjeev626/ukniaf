<!-- Layout config Js -->
<script src="<?php echo base_url();?>content_admin/assets/js/layout.js"></script>
<!-- Bootstrap Css -->
<link href="<?php echo base_url();?>content_admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="<?php echo base_url();?>content_admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="<?php echo base_url();?>content_admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="<?php echo base_url();?>content_admin/assets/css/custom.min.css" rel="stylesheet" type="text/css" />



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
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Tag</h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li><button type="button" class="btn btn-success" data-bs-toggle="offcanvas" href="#sectionAdd"><i class="ri-add-line align-bottom me-1"></i> Add New</button></li>
          </ol>
        </div>
      </div>
      <!-- end card header -->
      <div class="card-body">
        <?php //print_r($_SESSION);
        //$tag_info = $this->Reporting_model->get_weekly_techincal_update_archieve();
        if(isset($tag_info) && !empty($tag_info)){
          //$lastweek_decision = '';
          $lastweek_action = '';
        ?>
        <table class="table dt-responsive table-striped align-middle" id="myTable">
          <thead class="table-light">
            <tr>
              <th>S.N.</th>
              <th>Tag</th>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <th>&nbsp;</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $sn=1;
            foreach ($tag_info as $tag) {
            ?>
            <tr class="row-<?php echo $tag->id;?>">
              <td><?php echo $sn++;?></td>
              <td><?php if(isset($tag) && !empty($tag)) echo $tag->tag;?></td>
              <?php if(isset($_SESSION['role']) && $_SESSION['role']=="PM"){?>
              <td data-column-id="action">
                <span>
                  <div class="dropdown">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item edit-list" data-bs-toggle="offcanvas" href="#sectionEdit" onclick="editThis('<?php echo $tag->id;?>');"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal" onclick="delete_tag('<?php echo $tag->id;?>');"><i class="ri-archive-line align-bottom me-2 text-muted"></i> Remove</a></li>
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
        ?>
        <div class="alert alert-success" role="alert">
          <strong>No Tag has been added.</strong>
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
  function delete_tag(tag_id){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/tag/delete_tag'); ?>",
      data: { tag_id:tag_id },
      success: function(result)
      {
        if(result=="success")
          showSuccessMessage("Success !! The selected tag has been removed.", 3000); // Display "Success!" for 3 seconds (3000 milliseconds)
        $(".row-"+tag_id).hide();
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



  function editThis(tag_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/tag/edit_ajax'); ?>",
      data: { tag_id:tag_id },
      success: function(result)
      {
        //alert(result);
        $('#edit_section').html(result);
      }
    });
  }

  function viewThis(tag_id){
    //$('#offcanvasEdit #monthly_risk_register_id-input').val(id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/technical_update_view'); ?>",
      data: { tag_id:tag_id },
      success: function(result)
      {
        //alert(result);
        $('#view_section').html(result);
      }
    });
  }
</script>
<div class="offcanvas offcanvas-end" tabindex="-1" id="sectionAdd" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header bg-light">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add Tag</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!--end offcanvas-header-->
  <form method="post" action="<?php echo base_url().'admin/tag/add_process/'; ?>" class="d-flex flex-column justify-content-end h-100">
    <div class="offcanvas-body">
      <div class="mb-4">
        <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Tag</label>
        <input type="text" class="form-control" name="tag" id="tag-input" placeholder="Enter Tag">
      </div>
      <div class="mb-4">
        <button type="submit" class="btn btn-success w-sm">Submit</button>
      </div>
    </div>
    <!--end offcanvas-body-->
  </form>


  <!-- Begin page -->
  <div id="layout-wrapper">
    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
      <!-- /.modal-dialog --> 
    </div>
  </div>
  <!-- END layout-wrapper -->
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="sectionEdit" aria-labelledby="offcanvasExampleLabel">
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="sectionView" aria-labelledby="offcanvasExampleLabel">
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