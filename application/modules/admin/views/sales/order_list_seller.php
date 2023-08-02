<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="table-responsive">  
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="3%" class="text-center">S.N</th>
                <th width="7%">Order Date</th>
                <th width="12%">Customer Information</th>
                <th width="10%">Address</th>
                <th width="4%" class="text-center">Items</th>
                <th width="5%" class="text-right">Amount</th>
                <th width="11%">Delivery</th>
                <th width="8%">Status</th>
                <th width="12%">Instruction</th>
                <th width="9%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
              $all_total_amount=0;
              $aakash_delivery_total=0;
              $mohan_delivery_total=0;
              $safe_delivery_total=0;
              $puryaou_delivery_total=0;
              if (!empty($order_list)) { 
                //print_r($new_order);
                foreach ($order_list as $row):
                  //print_r($row);
                ?>
                <tr>
                  <td class="text-center">
                    <?php echo ++$counter;?>
                    <input type="hidden" value="<?php echo $row->id;?>" name="sales_id" id="sales_id" />
                  </td>
                  <td><?php echo date("d F Y", strtotime($row->sales_date));?></td>
                  <td><?php echo $row->full_name; ?><br><?php echo $row->contact_number; ?></td>
                  <td><?php echo $row->full_address; ?></td>
                  <td class="text-center"><?php echo $this->general_model->getCount('tbl_sales_detail','sales_id='.$row->id); ?></td>
                  <td class="text-right"><?php echo $amount = $this->general_model->getSum('total_amount','tbl_sales_detail','sales_id='.$row->id)-$row->discount_amount+$row->delivery_charge_paid_by_client-$row->commission_paid; ?><br>
                    <?php echo $total_amount = $amount-$row->delivery_charge; $all_total_amount+=$total_amount; ?>
                  </td>
                  <td><?php //echo ucwords(str_replace('_',' ',$row->delivered_by)); ?>
                    <select name="delivered_by" id="delivered_by" class="form-control" onchange="updateDeliveredby('<?php echo $row->id;?>', this.value);" style="padding:5px 8px !important;">
                      <option value="">Select One</option>
                      <?php                        
                      foreach($deliveries as $delivery){
                      ?>
                      <option value="<?php echo $delivery->code;?>" <?php if($row->delivered_by==$delivery->code) echo 'selected="selected"';?>><?php echo $delivery->name;?></option>
                      <?php                          
                      }
                      ?>
                    </select>
                    <?php
                    if($row->delivered_by=="aakash")
                      $aakash_delivery_total += $row->delivery_charge;
                    if($row->delivered_by=="mohan")
                      $mohan_delivery_total += $row->delivery_charge;
                    if($row->delivered_by=="safe_express")
                      $safe_delivery_total += $row->delivery_charge;
                    if($row->delivered_by=="puryaou")
                      $puryaou_delivery_total += $row->delivery_charge;
                    ?>
                    <input type="number" name="delivery_charge" class="form-control text-right" value="<?php echo $row->delivery_charge; ?>" onkeyup="update_delivery_charge('<?php echo $row->id;?>',this.value);" style="padding:5px !important; padding-right:0px !important;" title="Delivery charge paid to Delivery person." /></td>
                  <td>
                  <select name="status" id="status" class="form-control form-control-sm" onchange="updateStatus('<?php echo $row->id;?>', this.value);">
                    <option value="new" <?php if($status=="new") echo 'selected="selected"';?>>New</option>
                    <option value="billed" <?php if($status=="billed") echo 'selected="selected"';?>>Billed</option>
                    <option value="on_delivery" <?php if($status=="on_delivery") echo 'selected="selected"';?>>On Delivery</option>
                    <option value="completed" <?php if($status=="completed") echo 'selected="selected"';?>>Completed</option>
                    <option value="cancelled" <?php if($status=="cancelled") echo 'selected="selected"';?>>Cancelled</option>
                  </select>
                  <input type="number" name="delivery_charge_paid_by_client" class="form-control form-control-sm text-right" value="<?php if($row->delivery_charge_paid_by_client==0) echo ""; else echo $row->delivery_charge_paid_by_client; ?>"  onkeyup="update_delivery_charge_received('<?php echo $row->id;?>',this.value);" style="padding:5px !important; padding-right:0px !important;" placeholder="Delivery charge paid by client" title="Delivery charge paid by client" /></td>

                  </td>
                  <td><?php echo $row->customer_remarks; if(!empty($row->customer_remarks)) echo "<hr/>"; echo $row->admin_remarks;?></td>
                  <td class="tect-center"><a href="<?php echo base_url() . 'admin/sales/details/' . $row->id;?>" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a> | <a href="javascript:void(0)" onclick="delete_sales('<?php echo $row->id;?>')"><i class="fa fa-trash tooltips" data-original-title="Delete" style="color:red;"></i></a> | <a href="<?php echo base_url() . 'admin/sales/print_invoice/' . $row->id;?>" target="_blank" style="color:black;"><i class="fa fa-print" aria-hidden="true"></i></a><br>By : <?php if(isset($row->user_id)) echo $this->general_model->getValue('full_name','users','id="'.$row->user_id.'"'); ?><br><span style="font-size:12px;"><?php if($row->seller==0) echo 'City Store Nepal'; else echo $this->general_model->getValue('business_name','tbl_seller','id="'.$row->seller.'"'); ?></span></td>
                </tr>
                <?php
                endforeach;
              }
              ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-right text-bold" colspan="2"><?php if($all_total_amount>0){?>Nrs. <?php echo $all_total_amount; }?></td>
                  <td class="text-bold"><?php if($aakash_delivery_total>0 || $safe_delivery_total){ echo "Aakash : ".$aakash_delivery_total."<br>Safe : ".$safe_delivery_total; }?></td>
                  <td></td>
                  <td></td>
                  <td><a class="btn btn-info" href="<?php echo base_url() . 'admin/sales/export_list/' . $this->uri->segment(4);?>" target="_blank">Print</a></td>
                </tr>
              </tbody>
            </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->
      </div>
      <div class="row">
        <div class="col-md-12" style="padding-left:20px;">
          <strong>Delivered By :</strong><br>
          <?php
          //echo $status;                    
          foreach($deliveries as $delivery){
            if(isset($status) && $status == "on_delivery"){
            ?>
            <a href="<?php echo base_url() . 'admin/sales/order_list_by_delivery_staff/'.$delivery->code.'/on_delivery';?>" target="_blank"><?php echo $delivery->name;?></a><br>
            <?php                         
            }
            elseif(isset($status) && $status == "completed"){
            ?>
            <a href="<?php echo base_url() . 'admin/sales/order_list_by_completed_by/completed/'.$delivery->code;?>" target="_blank"><?php echo $delivery->name;?></a><br>
            <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box -->
  </section>

<script type="text/javascript"> 
        
  function delete_sales(sales_id){
    var aa = confirm('Are you sure to delete this Sales ?');
    if(aa)
    {
      window.location="<?php echo site_url('admin/sales/deleteSales/'); ?>"+sales_id;
    }
  }

  function updateStatus(sales_id,status){
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/sales/update_status'); ?>",
      data: { sales_id:sales_id, status:status },
      success: function(result)
      {
        $('#updated').show();
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
        $('#updated').show();
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
</script>