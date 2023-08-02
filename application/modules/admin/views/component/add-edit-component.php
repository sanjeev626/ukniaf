<?php
if(isset($component_detail)){
    $action = base_url() . 'admin/component/editComponent/' . $component_detail->id;
}
else {
    $action = base_url() . 'admin/component/addComponent/';
}
?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $panel_title;?></h4>
      </div>
      <!-- end card header -->
    <?php
    $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1');
    echo form_open_multipart($action, $attributes);
    ?>
      <div class="card-body">
        <div class="live-preview">
          <div class="row gy-4">
            <div class="col-xxl-3 col-md-12">
              <div>
                <label for="basiInput" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if (!empty($component_detail)) echo $component_detail->title; ?>" required>
              </div>
            </div>
            <!--end col-->
            <div class="col-xxl-3 col-md-12">
              <div>
                <button class="btn btn-success btn-flat" type="submit">
                <?php
                if (!empty($component_detail)) {
                    echo 'Update';
                } else {
                    echo 'Add';
                }
                ?>
                </button>
              </div>
            </div>
            <!--end col--> 
          </div>
          <!--end row--> 
        </div>
      </div>
      <?php echo form_close(); ?> </div>
  </div>
  <!--end col--> 
</div>
<!--end row--> 