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
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Task Order</label>
                <input type="text" class="form-control" name="task_order" id="task_order-input" value="<?php if(isset($techincal_update)) echo $techincal_update->task_order;?>" required />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Risk Number</label>
                <input type="text" name="risk_number" id= "risk_number" class="form-control" value="<?php if(isset($techincal_update)) echo $techincal_update->risk_number;?>" required />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Updates</label>
                <textarea name="updates" id="updates" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->updates;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Weekly Decision</label>
                <textarea name="decision" id="decision" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->decision;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Weekly Action</label>
                <textarea name="action" id="action" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->action;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Stakeholder</label>
                <textarea name="stakeholder" id="stakeholder" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->stakeholder;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Internal Notes</label>
                <textarea name="internal_notes" id="internal_notes" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->internal_notes;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">FCDO Update</label>
                <textarea name="fcdo_update" id="fcdo_update" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->fcdo_update;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Risk</label>
                <textarea name="risk" id="risk" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->risk;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Mitigation</label>
                <textarea name="mitigation" id="mitigation" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->mitigation;?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Residual Risk</label>
                <textarea name="residual_risk" id="residual_risk" class="form-control" rows="3"><?php if(isset($techincal_update)) echo $techincal_update->residual_risk;?></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Document URL</label>
                <input type="text" class="form-control" name="document_url" id="document_url-input" value="<?php if(isset($techincal_update)) echo $techincal_update->document_url;?>" required />
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
            <select name="update_status" id="update_status" class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false>
              <option value="active" selected>Active</option>
              <option value="closed" <?php if(isset($techincal_update) && $techincal_update->update_status=="closed") echo 'selected="selected"';?>>Closed</option>
            </select>
          </div>
        </div>
        <!-- end card body --> 
      </div>
      <!-- end card -->
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Update Tags</h5>
        </div>
        <div class="card-body">
          <div class="hstack gap-3 align-items-start">
            <div class="flex-grow-1">
              <input name="tags" id="tags" class="form-control" data-choices data-choices-multiple-remove="true" placeholder="Enter tags" type="text" value="<?php if(isset($techincal_update)) echo $techincal_update->tags;?>" />
              <p class="text-muted">Seperate tags with a <code>comma(,)</code>.</p>
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
