<?php
if (!empty($task_detail)) {
    $action = base_url() . 'admin/task/edit_task_process/' . $task_detail->id;
    $pid = $task_detail->id;
} else {

    $project_id = $this->uri->segment(4); //echo $project_id;
    $action = base_url() . 'admin/task/add_task_process/'.$project_id;
    $pid = '';
}
?>
<div>
<?php
$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>


  <div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>
          <?php if (!empty($task_detail)) { echo "Edit Task"; } else { echo "Add Task"; } ?>
        </h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
      <div class="form-group">
        <label class="col-sm-2 control-label">Project: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <input type="hidden" name="project_id" value="<?php echo $project_id;?>" />
          <input type="text" name="project_title" id='project_title' class="form-control" value='<?php if (!empty($project_title)) echo $project_title; ?>' readonly/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Task Order: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <input type="text" name="task_order" id='task_order' class="form-control" value='<?php if (!empty($task_detail)) echo $task_detail->task_order; ?>' required/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Task: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <input type="text" required name="task" id='task' class="form-control" value='<?php if (!empty($task_detail)) echo $task_detail->task; ?>' />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Remarks: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <textarea required name="remarks" id='remarks' class="form-control" style="height:150px;"><?php if (!empty($task_detail)) echo $task_detail->remarks; ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <button class="btn btn-success btn-flat" type="submit"><?php if (!empty($task_detail)) { echo "Save"; } else { echo "Add"; } ?></button>
        </div>
      </div>
    </div>
  </div>
    <!-- panel-body -->
</div>