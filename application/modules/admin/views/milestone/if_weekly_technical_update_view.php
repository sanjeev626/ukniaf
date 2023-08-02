<?php
if(isset($techincal_update)){
    //Do Update
    $action = base_url().'admin/reporting/if_weekly_technical_update_edit_process/'.$techincal_update->id;
}else{
    //Insert
    $action = base_url().'admin/reporting/if_weekly_technical_update_add_process/';
}
?>
<form id="createproduct-form" autocomplete="off" method="post" class="needs-validation" action="<?php echo $action;?>">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Weekly Technical Update</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Task Order :</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->task_order;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Risk Number</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->risk_number;?></p>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Updates</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->updates;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Weekly Decision</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->decision;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Weekly Action</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->action;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Stakeholder</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->stakeholder;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Internal Notes</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->internal_notes;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">FCDO Update</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->fcdo_update;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Risk</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->risk;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Mitigation</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->mitigation;?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mt-4 text-muted">
                <h5 class="fs-14">Residual Risk</h5>
                <p><?php if(isset($techincal_update)) echo $techincal_update->residual_risk;?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end col -->    
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-12">
            <div class="mt-4 text-muted">
              <h5 class="fs-14">Status</h5>
              <p><?php if(isset($techincal_update)) echo ucwords($techincal_update->update_status);?></p>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="mt-4 text-muted">
              <h5 class="fs-14">Tags</h5>
              <p><?php if(isset($techincal_update)) echo $techincal_update->tags;?></p>
            </div>
          </div>
        </div>
        <!-- end card body --> 
      </div>
      <!-- end card -->
    </div>
    <!-- end col --> 
  </div>
  <!-- end row -->
  
</form>
<script src="<?php echo base_url();?>content_admin/assets/js/pages/ecommerce-product-create.init.js"></script> 
