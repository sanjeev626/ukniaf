<?php
if (!empty($project_detail)) {
    $action = base_url() . 'admin/project/edit_project_process/' . $project_detail->id;
    $pid = $project_detail->id;
} else {
    $action = base_url() . 'admin/project/add_project_process';
    $pid = '';
}
?>
<script src='<?php echo base_url() ?>resources/tinymce/tinymce.min.js'></script>
<?php
$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<div class="col-md-12">
  <div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>
          <?php if (!empty($project_detail)) { echo "Edit Project"; } else { echo "Add Project"; } ?>
        </h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
      <div class="form-group">
        <label class="col-sm-3 control-label">Component: <span class="asterisk">*</span></label>
        <div class="col-sm-9">
          <select name="component_id" id="component_id" class="form-control" required>
            <option value="">Select One</option>
            <?php 
            $selected = "";
            foreach($components as $component){
            if(isset($component_id) && $component_id>0 && $component_id==$component->id)
              $selected = "selected='selected'";
            else     
              $selected = "";
            ?>
            <option value="<?php echo $component->id;?>" <?php echo $selected;?>><?php echo $component->title;?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Project: <span class="asterisk">*</span></label>
        <div class="col-sm-9">
          <input type="text" required name="title" id='title' class="form-control" value='<?php if (!empty($project_detail)) echo $project_detail->title; ?>' />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Remarks: <span class="asterisk">*</span></label>
        <div class="col-sm-9">
          <textarea required name="remarks" id='remarks' class="form-control" style="height:150px;"><?php if (!empty($project_detail)) echo $project_detail->remarks; ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">&nbsp;</label>
        <div class="col-sm-9">
          <button class="btn btn-success btn-flat" type="submit"><?php if (!empty($project_detail)) { echo "Save"; } else { echo "Add"; } ?></button>
        </div>
      </div>
    </div>
  </div>
    <!-- panel-body -->
</div>