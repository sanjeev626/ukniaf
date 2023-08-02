<?php
if (!empty($tag_detail)) {
    $action = base_url() . 'admin/tag/edit_process/' . $tag_detail->id;
    $tid = $tag_detail->id;
} else {
    $action = base_url() . 'admin/tag/add_process/';
    $tid = '';
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
          <?php if (!empty($tag_detail)) { echo "Edit Tag"; } else { echo "Add Tag"; } ?>
        </h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
      <div class="form-group">
        <label class="col-sm-2 control-label">Tag Order: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <input type="text" name="tag_order" id='tag_order' class="form-control" value='<?php if (!empty($tag_detail)) echo $tag_detail->tag_order; ?>' required/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Tag: <span class="asterisk">*</span></label>
        <div class="col-sm-10">
          <input type="text" required name="tag" id='tag' class="form-control" value='<?php if (!empty($tag_detail)) echo $tag_detail->tag; ?>' />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          <button class="btn btn-success btn-flat" type="submit"><?php if (!empty($tag_detail)) { echo "Save"; } else { echo "Add"; } ?></button>
        </div>
      </div>
    </div>
  </div>
    <!-- panel-body -->
</div>