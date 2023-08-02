<?php
if (!empty($sales_detail)) {
    $action = base_url() . 'admin/sales/edit_sales_process/' . $sales_detail->id;
    $pid = $sales_detail->id;
} else {
    $action = base_url() . 'admin/sales/add_sales_process';
    $pid = '';
}
?>
<?php

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<div class="col-md-9">
  <div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>
          <?php if (!empty($sales_detail)) { echo "Edit Order"; } else { echo "Add Order"; } ?>
        </h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">      
      <?php
      if(isset($error_message))
        echo '<div class="alert alert-danger" role="alert">'.$error_message.'</div>'; 
      /*
      Notes by Sanjeev
      Every nodes must be calculated by row number which is in this case
      */
      for($row_number=1;$row_number<=10;$row_number++){?>
      <div class="form-group">        
        <div class="col-md-1 text-center row_number">
          <?php echo $row_number;?>
        </div>
        <div class="col-md-3">
          <!-- <select name="product_id<?php echo '_'.$row_number;?>" id="product_id<?php echo '_'.$row_number;?>" class="form-control" onchange="showAttributes(this.value,'<?php echo $row_number;?>')">
            <option value="">Select Products</option>
            <?php
            foreach ($products as $product):
            ?>
            <option value="<?php echo $product->id;?>"><?php echo $product->name;?></option>
            <?php
            endforeach;
            ?>
          </select> -->
          <input type="hidden" class="product_id" id="product_id_<?php echo $row_number;?>" name="product_id_<?php echo $row_number;?>" value="">
          <input class="form-control product_name" type="text" name="product_id2<?php echo '_'.$row_number;?>" id="product_id2<?php echo '_'.$row_number;?>" onchange="showAttributes(this.value,'<?php echo $row_number;?>')">
          <div id="productPrices<?php echo '_'.$row_number;?>"></div>
          <div id="productAVailability<?php echo '_'.$row_number;?>"></div>

        </div>
        <div class="col-md-6">
          <div id="productAttributes<?php echo '_'.$row_number;?>"> </div>
        </div>
        <div class="col-md-2">
          <input type="number" class="form-control" name="quantity<?php echo '_'.$row_number;?>" id="quantity<?php echo '_'.$row_number;?>" placeholder="Qty" value="" min="0" max="0">
          <div id="imagecontainer<?php echo '_'.$row_number;?>"></div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <!-- panel-body --> 
</div>
<div class="col-md-3">
  <div class="box box-info">
    <div class="box-header with-border">
      <section class="content-header">
        <h1>Customer Information</h1>
      </section>
    </div>
    <div class="panel-body panel-body-nopadding">
      <div id="check"></div>
      <div class="form-group">
        <label class="col-sm-12">Phone</label>
        <div class="col-sm-12" id="options">
          <input type="text" class="form-control" name="custPhone" id="custPhone" placeholder="Customer Phone" value="" required onchange="getCustomer(this.value)" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label for="prodTitle" class="col-sm-12">Name</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" name="custName" id="custName" placeholder="Customer Name" value="" required>
        </div>
      </div>      <div class="form-group">
        <label class="col-sm-12">Address</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" name="custAddress" id="custAddress" placeholder="Customer Address" value="" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-12">Email</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" name="custEmail" id="custEmail" placeholder="Customer Email" value="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-12">Delivery Charge by Customer</label>
        <div class="col-sm-12">
          <input type="text" class="form-control" name="delivery_charge_paid_by_client" id="delivery_charge_paid_by_client" placeholder="Delivery Charge" value="0">
        </div>
      </div>
      <div class="form-group">
        <label for="excerpt" class="col-sm-12">Customer Remarks</label>
        <div class="col-sm-12">
          <textarea class="form-control" name="custMsg" id="custMsg" placeholder="This will be printed on invoice"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="excerpt" class="col-sm-12">Admin Remarks</label>
        <div class="col-sm-12">
          <textarea class="form-control" name="admin_remarks" id="admin_remarks" placeholder="Admin Remarks"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="excerpt" class="col-sm-12">Sold By</label>
        <div class="col-sm-12">
          <select name="seller" id="seller" class="form-control">
            <option value="0">City Store Nepal</option>                    
            <?php                        
            foreach($sellers as $seller){
            ?>
            <option value="<?php echo $seller->id;?>"><?php echo $seller->business_name;?></option>
            <?php                          
            }
            ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="box box-info">
    <div class="panel-body panel-body-nopadding">
      <div class="form-group">
        <div class="col-sm-12">
          <input type="hidden" name="medium" id='medium' value='admin' />
          <button class="btn btn-success btn-flat" type="submit">
          <?php
            if (!empty($sales_detail)) {
                echo 'Update';
            } else {
                echo 'Add';
            }
            ?>
          </button>
          <?php
            if (!empty($sales_detail)) {
              $stock_url = base_url() . 'admin/sales/stock_manage/' . $sales_detail->id;
            ?>
          <a class="btn btn-success btn-flat" href="<?php echo $stock_url;?>">Stock</a>
          <?php
            }
            ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?> 
<!-- panel --> 
<!-- Script --> 
<script>
  $(function () {
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  })
</script>

<script>
  /*$(document).ready(function(){
    $('#product_name').autocomplete({
      source: "<?php echo base_url();?>admin/sales/search_product_for_sales/",
      minLength: 1,
      select: function(event, ui)
      {
        var row_number = $('.row_number').html();
        $(this).closest('div').find('input.product_id').val(ui.item.product_id);
        //$('#product_name').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };

  });*/
</script>
<script>

  $(".product_name").autocomplete({
    //source: 'search.php',
    source: '<?php echo base_url();?>admin/sales/search_product_for_sales/',
    minLength: 1,
    select: function(event, ui) {
      var row_number = $('.row_number').html();
      //alert(ui.item.product_id);
      //Here $(this) points to the current autocomplete input element
      $(this).closest('div').find('input.product_id').val(ui.item.product_id);
    }
  });
  function showAttributes(product_id,row_number)
  {
    var product_id = $('#product_id_'+row_number).val();
    //alert(product_id);
    if(product_id != '')
    {

     $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_prices",
      method:"POST",
      data:{product_id:product_id, row_number:row_number},
      success:function(data)
      {
       $('#productPrices_'+row_number).html(data);
      }
     });

     $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_image",
      method:"POST",
      data:{product_id:product_id, row_number:row_number},
      success:function(data)
      {
       $('#imagecontainer_'+row_number).html(data);
      }
     });
     
     $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_attributes",
      method:"POST",
      data:{product_id:product_id, row_number:row_number},
      success:function(data)
      {
       $('#productAttributes_'+row_number).html(data);
       $('#imagecontainer_'+row_number).html();
      }
     });
    }
    else
    {
      $('#productAttributes_'+counter).html('');
    }
  }

  function calculate_available_quantity(product_id,row_number)
  {
    //alert(product_id+' - '+i);
    //var color = $('#color_'+product_id).selected();
    //var color = $('#color_'+product_id+':checked').val();
    var color = $('input[name="color_'+row_number+'"]:checked').val();
    var size = $('input[name="size_'+row_number+'"]:checked').val();
    //alert(color+' -- '+size);

     $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_availability",
      method:"POST",
      data:{product_id:product_id, color:color, size:size},
      success:function(data)
      {
       //alert(data);
       if(data>0)
       {
        html_content = '<strong>Available : '+data+'</strong>';
        $("#quantity_"+row_number).attr("required","required");
        $("#quantity_"+row_number).attr("max",data);
        $("#quantity_"+row_number).attr("value",'1');
       }
       else if(color>0 && size>0)
       {
        html_content = '<strong>Available : 0</strong>';
        $("#quantity_"+row_number).attr("required","required");
        $("#quantity_"+row_number).attr("max",'0');
        $("#quantity_"+row_number).attr("value",'');
       }
       else
       {
        html_content = '';
        $("#quantity_"+row_number).attr("max",'0');
        $("#quantity_"+row_number).attr("value",'');
       }
       $('#productAVailability_'+row_number).show();
       $('#productAVailability_'+row_number).html(html_content);
      }
     });
  }

  function show_image_by_color(product_id,row_number){
    var color_id = $('input[name="color_'+row_number+'"]:checked').val();
    //alert(color_id);
    $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_image_by_color",
      method:"POST",
      data:{product_id:product_id, color_id:color_id, row_number:row_number},
      success:function(data)
      {
       if(data.length>0)
       {
        html_content = data;
        $("#imagecontainer_"+row_number).html(data);
       }
      }
    });
  }

  function getCustomer(phone){
    $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/show_customer_info",
      method:"POST",
      data:{phone:phone},
      dataType: "json",
      success:function(data)
      {
        //alert(data);
        $('#custName').val(data.full_name);
        $('#custAddress').val(data.full_address);
        $('#custEmail').val(data.email);
      }
    });
  }
</script>