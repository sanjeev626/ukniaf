<?php
$color_attributes_array = unserialize($color_attributes);
$no_of_colors = count($color_attributes_array);
$size_attributes_array = unserialize($size_attributes);
$no_of_sizes = count($size_attributes_array);

/*for($c=0;$c<$no_of_colors;$c++){
	for($s=0;$s<$no_of_sizes;$s++){
		echo $color_attributes_array[$c].' - '.$size_attributes_array[$s];
		echo "<br>";
	}
}*/
?>
<?php
    $action = base_url() . 'admin/product/stock_manage_process/' . $pid;
$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<div class="col-md-12">
  <div class="box box-info">
    <div class="panel-body panel-body-nopadding">
      <div class="form-group">
      	<label class="col-sm-4 text-center">Color</label>
      	<label class="col-sm-4 text-center">Size</label>
      	<label class="col-sm-4 text-center">Stock</label>
      </div>
      <?php
      for($c=0;$c<$no_of_colors;$c++){
      	$color_name = $this->general_model->getFieldById('tbl_attribute_values', 'id', $color_attributes_array[$c], 'attribute_value');
		for($s=0;$s<$no_of_sizes;$s++){
		  $size_name = $this->general_model->getFieldById('tbl_attribute_values', 'id', $size_attributes_array[$s], 'attribute_value');

      	?>
      	<div class="form-group">
          <div class="col-sm-4">
          	<input type="hidden" name="color_id[]" id='color_id[]' value='<?php echo $color_attributes_array[$c]; ?>' />
          	<input type="text" name="color" id='name' class="form-control" value='<?php echo $color_name; ?>' disabled />
          </div>
          <div class="col-sm-4">
          	<input type="hidden" name="size_id[]" id='size_id[]' value='<?php echo $size_attributes_array[$s]; ?>' />
          	<input type="text" name="size" id='name' class="form-control" value='<?php echo $size_name; ?>' disabled />
          </div>
          <div class="col-sm-4">
          	<?php
          	$where = array('product_id' => $pid,'color_id' => $color_attributes_array[$c],'size_id' => $size_attributes_array[$s]);
          	$purchased_stock = $this->general_model->getValue('purchased_stock','tbl_product_stock',$where);
          	$purchased_stock_id = $this->general_model->getValue('id','tbl_product_stock',$where);
          	?>
          	<input type="hidden" name="purchased_stock_id[]" id='purchased_stock_id[]' class="form-control" value='<?php echo $purchased_stock_id;?>' />
          	<input type="text" name="purchased_stock[]" id='purchased_stock[]' class="form-control" value='<?php echo $purchased_stock;?>' />
          </div>
      	</div>
      	<?php
		}
	  }
	  ?>
      <div class="form-group">        
        <div class="col-sm-12 text-right">
          <input type="hidden" name="medium" id='medium' value='admin' />
          <button class="btn btn-success btn-flat" type="submit">Save</button>
        </div>
      </div>
    </div>
  </div>
    <!-- panel-body -->
</div>
<?php echo form_close(); ?> 
<!-- panel -->