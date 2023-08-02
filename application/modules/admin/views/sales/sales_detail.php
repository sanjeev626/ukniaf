<?php
//echo $sales->id;
//print_r($_POST);
?>
<form method="post" name="frmProducts" id="frmProducts" action="<?php echo base_url() . 'admin/sales/details_save/' . $sales->id;?>">
<section class="content"> 
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="table-responsive">
          <div id="updated" class="alert alert-success" role="alert" style="display:none;">
            Information updated successfully.
          </div>
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Order Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo date("d F Y", strtotime($sales->sales_date));?></td>
                <td><?php echo $customer->full_name;?></td>
                <td><?php echo $customer->contact_number;?></td>
                <td><?php echo $customer->full_address;?></td>
                <td><?php echo $customer->email;?></td>
              </tr>
              <tr>
                <td colspan="5">
                  <label>Admin Remarks</label>
                  <textarea name="admin_remarks" id="admin_remarks" class="form-control" onkeyup="updateRemarks('<?php echo $sales->id;?>');"><?php echo $sales->admin_remarks;?></textarea>
                  </td>
              </tr>
              <tr>
                <td colspan="5">
                  <label>Customer Remarks (This is printed on Invoice)</label>
                  <textarea name="customer_remarks" id="customer_remarks" class="form-control" onkeyup="updateRemarks('<?php echo $sales->id;?>');"><?php echo $sales->customer_remarks;?></textarea>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- table-responsive --> 
      <!-- col-md-6 --> 
    </div>
  </div>
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="table-responsive">
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center" width="3%">S.N</th>
                <th class="text-center" width="5%">Image</th>
                <th>Product Name</th>
                <th width="40%">Attributes</th>
                <th class="text-center" width="5%">Quantity</th>
                <th class="text-right" width="5%">Rate</th>
                <th class="text-right" width="5%">Total Amount</th>
                <th width="2%">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $row_number=0;
              $total_amount_sum=0;       
              foreach($sales_items as $item)
              {
              $total_amount = $item->quantity*$item->rate;
              $total_amount_sum+=$total_amount;
              ?>
              <tr>
                <td class="text-center"><?php echo ++$row_number; //echo "Sales detail ID : ".$item->id;?></td>
                <td><?php echo $this->Product_model->fetch_image_by_color($item->product_id,$item->color_id);?></td>
                <td><?php echo $this->Product_model->get_field_by_id('name',$item->product_id);?>
                  <div id="successMsg" class="alert alert-success" role="alert" style="display:none;">
                    <strong>Successfully Updated..</strong>
                  </div>
                  <div id="failureMsg" class="alert alert-danger" role="alert" style="display:none;">
                    <strong>Update Failed ! Not sufficient Stock.</strong>
                  </div>
                </td>
                <td>
                  <?php echo $this->Product_model->fetch_attributes_color($row_number,$item->product_id,$item->id,$item->color_id);?>
                  <?php echo $this->Product_model->fetch_attributes_size($row_number,$item->product_id,$item->id,$item->size_id);?>
                  <?php //echo "Color : ".$this->general_model->getValue('attribute_value','tbl_attribute_values','id='.$item->color_id);?>
                  <?php //echo 'Size : '.$this->general_model->getValue('attribute_value','tbl_attribute_values','id='.$item->size_id);?>
                </td>
                <td class="text-center"><?php echo $item->quantity;?></td>
                <td class="text-right"><?php echo $item->rate;?></td>
                <td class="text-right"><?php echo $total_amount;?></td>
                <td class="text-right"><?php if($sales->sales_status=="completed"){?><a href="">Cancel This</a><?php } else {?><a href="javascript:void(0);" onclick="callRemove('<?php echo $sales->id;?>','<?php echo $item->id;?>');"><i class="fa fa-trash tooltips" data-original-title="Delete Product"></i></a><?php } ?></td>
              </tr>
              <?php
              }
              ?>              
              <tr>
                <th colspan="4" class="text-right">Sub Total : </th>
                <th colspan="4" class="text-right"><span id="total_amount_sum"><?php echo $total_amount_sum;?></span></th>
              </tr>              
              <tr>
                <th colspan="4" class="text-right">Discount : </th>
                <th colspan="4" class="text-right"><input type="text" name="discount_amount" id="discount_amount" class="form-control text-right" value="<?php echo $sales->discount_amount;?>" onkeyup="calculateTotal('<?php echo $sales->id;?>',this.value);" /></th>
              </tr>              
              <tr>
                <th colspan="4" class="text-right">Clothing Total : </th>
                <th colspan="4" class="text-right"><span id="total_amount"><?php echo $total_amount_sum-$sales->discount_amount;?></span></th>
              </tr>             
              <tr>
                <th colspan="4" class="text-right">Status : </th>
                <th colspan="4" class="text-right">
                  <select name="status" id="status" class="form-control" onchange="updateStatus('<?php echo $sales->id;?>', this.value);">
                    <option value="new" <?php if($sales->sales_status=="new") echo 'selected="selected"';?>>New</option>
                    <option value="billed" <?php if($sales->sales_status=="billed") echo 'selected="selected"';?>>Billed</option>
                    <option value="on_delivery" <?php if($sales->sales_status=="on_delivery") echo 'selected="selected"';?>>On Delivery</option>
                    <option value="completed" <?php if($sales->sales_status=="completed") echo 'selected="selected"';?>>Completed</option>
                    <option value="cancelled" <?php if($sales->sales_status=="cancelled") echo 'selected="selected"';?>>Cancelled</option>
                  </select>
                </th>
              </tr>             
              <tr>
                <th colspan="4" class="text-right">Delivered By : </th>
                <th colspan="4" class="text-right">
                  <select name="delivered_by" id="delivered_by" class="form-control" onchange="updateDeliveredby('<?php echo $sales->id;?>', this.value);">
                    <option value="">Select One</option>                    
                    <?php                        
                    foreach($deliveries as $delivery){
                    ?>
                    <option value="<?php echo $delivery->code;?>" <?php if($sales->delivered_by==$delivery->code) echo 'selected="selected"';?>><?php echo $delivery->name;?></option>
                    <?php                          
                    }
                    ?>
                  </select>
                </th>
              </tr>            
              <tr>
                <th colspan="4" class="text-right">Delivery Charge paid for delivery : </th>
                <th colspan="4" class="text-right">
                  <input type="number" name="delivery_charge" id="delivery_charge" class="form-control text-right" value="<?php echo $sales->delivery_charge;?>" onkeyup="update_delivery_charge('<?php echo $sales->id;?>',this.value);" />                  
                </th>
              </tr>                        
              <tr>
                <th colspan="4" class="text-right">Delivery charge paid by client : </th>
                <th colspan="4" class="text-right">
                  <input type="number" name="delivery_charge_paid_by_client" id="delivery_charge_paid_by_client" class="form-control text-right" value="<?php echo $sales->delivery_charge_paid_by_client;?>" onkeyup="update_delivery_charge_received('<?php echo $sales->id;?>',this.value);" />                  
                </th>
              </tr>
              <tr>
                <th colspan="4" class="text-right">Total : </th>
                <th colspan="4" class="text-right"><?php echo $total_amount_sum-$sales->delivery_charge-$sales->discount_amount+$sales->delivery_charge_paid_by_client;?></th>
              </tr>              
              <tr>
                <th colspan="4" class="text-right">Sold By : </th>
                <th colspan="4" class="text-right">
                  <select name="seller" id="seller" class="form-control" onchange="updateSeller('<?php echo $sales->id;?>', this.value);">
                    <option value="">City Store Nepal</option>                    
                    <?php                        
                    foreach($sellers as $seller){
                    ?>
                    <option value="<?php echo $seller->id;?>" <?php if($sales->seller==$seller->id) echo 'selected="selected"';?>><?php echo $seller->business_name;?></option>
                    <?php                          
                    }
                    ?>
                  </select>
                </th>
              </tr>                
              <tr>
                <th colspan="4" class="text-right">Payment received By : </th>
                <th colspan="4" class="text-right">
                  <select name="payment_receiver" id="payment_receiver" class="form-control" onchange="updatePaymentReceiver('<?php echo $sales->id;?>', this.value);">
                    <option value="">City Store Nepal</option>                    
                    <?php                        
                    foreach($sellers as $seller){
                    ?>
                    <option value="<?php echo $seller->id;?>" <?php if($sales->payment_receiver==$seller->id) echo 'selected="selected"';?>><?php echo $seller->business_name;?></option>
                    <?php                          
                    }
                    ?>
                  </select>
                </th>
              </tr>                        
              <tr>
                <th colspan="4" class="text-right">Commission percentage : </th>
                <th colspan="4" class="text-right">
                  <input type="number" name="commission_percentage" id="commission_percentage" class="form-control text-right" value="<?php echo $sales->commission_percentage;?>" onkeyup="calculate_commission('<?php echo $sales->id;?>', this.value);" />                  
                </th>
              </tr>                        
              <tr>
                <th colspan="4" class="text-right">Commission paid : </th>
                <th colspan="4" class="text-right">
                  <input type="number" name="commission_paid" id="commission_paid" class="form-control text-right" value="<?php echo $sales->commission_paid;?>" onkeyup="update_commission_paid('<?php echo $sales->id;?>',this.value);" />                  
                </th>
              </tr> 
              <tr>
                <th colspan="4" class="text-right">Grand Total : </th>
                <th colspan="4" class="text-right"><?php echo $total_amount_sum-$sales->delivery_charge-$sales->discount_amount+$sales->delivery_charge_paid_by_client-$sales->commission_paid;?></th>
              </tr>               
              <tr>
                <th colspan="4" class="text-right">Payment Mode : </th>
                <th colspan="4" class="text-right">
                  <select name="seller" id="seller" class="form-control" onchange="updateMode('<?php echo $sales->id;?>', this.value);">
                    <option value="">Select One</option>                    
                    <?php                        
                    foreach($paymentmodes as $paymentmode){
                      if($paymentmode->id=="1" || $paymentmode->id=="2" || $paymentmode->id=="8" || $paymentmode->id=="9")
                    ?>
                    <option value="<?php echo $paymentmode->id;?>" <?php if($sales->payment_mode==$paymentmode->id) echo 'selected="selected"';?>><?php echo $paymentmode->mode_name;?></option>
                    <?php                          
                    }
                    ?>
                  </select>
                </th>
              </tr>           
              <tr>
                <th colspan="4" class="text-right"></th>
                <th colspan="4" class="text-right"><a href="<?php echo base_url() . 'admin/sales/print_invoice/' . $sales->id;?>" class="btn btn-info" target="_blank">Print</a></th>
              </tr> 
            </tbody>
          </table>
        </div>
        <!-- table-responsive --> 
      <!-- col-md-6 --> 
    </div>
  </div>
  <div class="box">
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
        <div class="col-md-1 text-center">
          <?php echo $row_number;?>
        </div>
        <div class="col-md-3">
          <select name="product_id<?php echo '_'.$row_number;?>" id="product_id<?php echo '_'.$row_number;?>" class="form-control" onchange="showAttributes(this.value,'<?php echo $row_number;?>')">
            <option value="">Select Products</option>
            <?php
            foreach ($products as $product):
            ?>
            <option value="<?php echo $product->id;?>"><?php echo $product->name;?></option>
            <?php
            endforeach;
            ?>
          </select>
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
      <div class="form-group">        
        <div class="col-md-12">
          <button class="btn btn-info" name="btnSave">Save</button>
        </div>
      </div>
    </div>
  </div>  
  <!-- /.box --> 
</section>
</form>
<script>
  function calculateTotal(sales_id, discount)
  {
    var total_amount_sum = $('#total_amount_sum').html();
    //alert(total_amount_sum+' -- '+discount);
    //var total = $().val();
    total_amount = total_amount_sum-discount;
    $('#total_amount').html(total_amount);

    $.ajax({
      url:"<?php echo base_url(); ?>admin/sales/update_discount",
      method:"POST",
      data:{sales_id:sales_id, discount:discount},
      success:function(data)
      {
        $('#updated').show();
      }
    });
  }
        
  function updateStatus(sales_id,status){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_status'); ?>",
      data: { sales_id:sales_id, status:status },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
      }
    });
  }

  function updateRemarks(sales_id){
    var admin_remarks = $('#admin_remarks').val();
    var customer_remarks = $('#customer_remarks').val();
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_customer_remarks'); ?>",
      data: { sales_id:sales_id, admin_remarks:admin_remarks, customer_remarks:customer_remarks },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }  
        
  function updateDeliveredby(sales_id,delivered_by){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_delivered_by'); ?>",
      data: { sales_id:sales_id, delivered_by:delivered_by },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  } 
        
  function updateSeller(sales_id,seller){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_seller'); ?>",
      data: { sales_id:sales_id, seller:seller },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }

  function updatePaymentReceiver(sales_id,seller){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_payment_receiver'); ?>",
      data: { sales_id:sales_id, seller:seller },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }
    
  function update_delivery_charge(sales_id,delivery_charge){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_delivery_charge'); ?>",
      data: { sales_id:sales_id, delivery_charge:delivery_charge },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }

  function update_delivery_charge_received(sales_id,delivery_charge){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_delivery_charge_received'); ?>",
      data: { sales_id:sales_id, delivery_charge:delivery_charge },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }
    
  function update_commission_paid(sales_id,commission){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_commission_amount'); ?>",
      data: { sales_id:sales_id, commission:commission },
      success: function(result)
      {
        //alert(result);
        $('#updated').show();
        setTimeout(function(){
          $("#updated").hide();
        }, 3500);
      }
    });
  }

  function callRemove(sales_id,item_detail_id){
    if(confirm('Are you sure to remove this item ?'))
    {
      $.ajax({
        method: "POST",
        url: "<?php echo site_url('admin/sales/remove_added_item'); ?>",
        data: { sales_id : sales_id, item_detail_id:item_detail_id },
        success: function(result)
        {
          //alert(result);
          if(result==0)
            window.location="<?php echo base_url();?>admin/sales/order_list/new";
          else
            window.location="<?php echo base_url();?>admin/sales/details/"+sales_id;
        }
      });
    }
  }

  function update_size_n_color_of_sold_item(row_number,sales_detail_id, product_id){
    //, size_id, color_id
    size_id = $('input[name="size_'+row_number+'"]:checked').val();
    color_id = $('input[name="color_'+row_number+'"]:checked').val();
    //alert(product_id+' '+sales_detail_id+' '+color_id+' '+size_id);

    /*
    Not Avaibale stock
    product_id = 25;
    sales_detail_id = 44;
    color_id = 49;
    size_id = 8;*/
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_size_n_color_of_sold_item'); ?>",
      data: { sales_detail_id:sales_detail_id, product_id:product_id, size_id:size_id, color_id:color_id },
      success: function(result)
      {
        if(result==""){
          $('#successMsg').show();
          $('#successMsg').html();
          setTimeout(function(){
            $("#successMsg").hide();
          }, 2500);
        }
        else{
          $('#failureMsg').show();
          $('#failureMsg').html();
          setTimeout(function(){
            $("#failureMsg").hide();
          }, 3000);
        }
      }
    });
  }

  function update_size_of_sold_item(sales_detail_id, size_id){
    //alert(product_id+' '+sales_detail_id+' '+size_id);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_size_of_sold_item'); ?>",
      data: { sales_detail_id:sales_detail_id, size_id:size_id },
      success: function(result)
      {
        $('#successMsg').show();
        setTimeout(function(){
          $("#successMsg").hide();
        }, 2000);
      }
    });
  }

  function update_color_of_sold_item(sales_detail_id, color_id){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_color_of_sold_item'); ?>",
      data: { sales_detail_id:sales_detail_id, color_id:color_id },
      success: function(result)
      {
        //alert(result);
        $('#successMsg').show();
        setTimeout(function(){
          $("#successMsg").hide();
        }, 2500);
      }
    });
  }

  function calculate_commission(sales_id,commission_percentage){
    var total_amount_sum = $('#total_amount_sum').html();
    var discount_amount = $('#discount_amount').val();
    var delivery_charge = $('#delivery_charge').val();
    var delivery_charge_paid_by_client = $('#delivery_charge_paid_by_client').val();
    //alert(commission_percentage+'%'+total_amount_sum+'-'+discount_amount+'-'+delivery_charge+'+'+delivery_charge_paid_by_client);
    var sales_amount = parseFloat(total_amount_sum)-parseFloat(discount_amount)-parseFloat(delivery_charge)+parseFloat(delivery_charge_paid_by_client);
    commission = parseFloat(commission_percentage)*parseFloat(sales_amount)/100;
    $('#commission_paid').val(commission);
    update_commission(sales_id,commission_percentage,commission);
  }

  function update_commission(sales_id,commission_percentage,commission){
    //alert(sales_id+'-'+commission_percentage+'-'+commission);
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_commission'); ?>",
      data: { sales_id:sales_id, commission_percentage:commission_percentage, commission:commission },
      success: function(result)
      {
        $('#successMsg').show();
        setTimeout(function(){
          $("#successMsg").hide();
        }, 2000);
      }
    });
  }

  //For additional products

  function showAttributes(product_id,row_number)
  {
    var product_id = $('#product_id_'+row_number).val();
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
</script>