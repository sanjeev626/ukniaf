<?php
if(isset($milestone)){
    //Do Update
    $evidence_required = base_url().'admin/milestone/edit_process/'.$milestone->id;
}else{
    //Insert
    $evidence_required = base_url().'admin/milestone/add_process/';
}
?>
<form id="createproduct-form" autocomplete="off" method="post" class="needs-validation" action="<?php echo $evidence_required;?>">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <h4 class="card-title mb-0 flex-grow-1">Milestone Schedule</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Task Order</label>
                <input type="text" class="form-control" name="task_order" id="task_order-input" value="<?php if(isset($milestone)) echo $milestone->task_order;?>" required />
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">M Ref</label>
                <input type="text" name="m_ref" id= "m_ref" class="form-control" value="<?php if(isset($milestone)) echo $milestone->m_ref;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Milestone</label>
                <textarea name="milestone" id="milestone" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->milestone;?></textarea>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Due to FCDO</label>
                <input type="date" class="form-control" id="exampleInputdate" name="due_to_fcdo" value="<?php if(isset($milestone)) echo $milestone->due_to_fcdo;?>" />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Evidence Required</label>
                <textarea name="evidence_required" id="evidence_required" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->evidence_required;?></textarea>
              </div>
            </div>
            <div class="col-lg-1">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Milestone Delivery Risks to Flag</label>
                <textarea name="milestone_delivery_risks_to_flag" id="milestone_delivery_risks_to_flag" class="form-control" rows="3"><?php if(isset($milestone)) echo $milestone->milestone_delivery_risks_to_flag;?></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end col -->
    
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Status</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <select name="milestone_status" id="milestone_status" class="form-select" data-choices="" data-choices-search-false="">
              <option value="active" selected="">Active</option>
              <option value="closed" <?php if(isset($milestone) && $milestone->milestone_status=="closed") echo 'selected="selected"';?>>Closed</option>
            </select>
          </div>
        </div>
        <!-- end card body --> 
      </div>
      <!-- end card -->
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">FCDO Approval</h5>
        </div>
        <div class="card-body">
          <div class="hstack gap-3 align-items-start">
            <div class="flex-grow-1">
              <input name="fcdo_approval" id="fcdo_approval" class="form-control" data-choices data-choices-multiple-remove="true" placeholder="" type="text" value="<?php if(isset($milestone)) echo $milestone->fcdo_approval;?>" />
            </div>
          </div>
        </div>
        <!-- end card body --> 
      </div>
      <!-- end card --> 
      <!-- end card -->
      <div class="text-end mb-3">
        <button type="submit" class="btn btn-success w-sm">Submit</button>
      </div>
    </div>
    <!-- end col --> 
  </div>
  <!-- end row -->
  
</form>
<script src="<?php echo base_url();?>content_admin/assets/js/pages/ecommerce-product-create.init.js"></script> 
