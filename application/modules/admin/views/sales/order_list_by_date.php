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
                <th width="8%" class="text-right">Amount</th>
                <th width="8%" class="text-right">Incentive</th>
                <th width="9%">Seller</th>
                <th width="8%">Status</th>
                <th width="12%">Instruction</th>
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
              $incentive_total = 0;
              if (!empty($order_list)) { 
                //print_r($new_order);
                foreach ($order_list as $row):
                  //print_r($row);
                  if($row->seller>0)
                    $commission_percentage=$this->general_model->getValue('commission_percentage','tbl_seller','id="'.$row->seller.'"');
                  else                    
                    $commission_percentage=10;
                ?>
                <tr>
                  <td class="text-center">
                    <?php echo ++$counter;?>
                    <input type="hidden" value="<?php echo $row->id;?>" name="sales_id" id="sales_id" />
                  </td>
                  <td><?php echo date("d F Y", strtotime($row->sales_date));?></td>
                  <td><a href="<?php echo base_url() . 'admin/sales/details/' . $row->id;?>" target="_blank"><?php echo $row->full_name; ?></a><br><?php echo $row->contact_number; ?></td>
                  <td><?php echo $row->full_address; ?></td>
                  <td class="text-center"><?php echo $this->general_model->getCount('tbl_sales_detail','sales_id='.$row->id); ?></td>
                  <td class="text-right">
                    <?php 
                    $amount = $this->general_model->getSum('total_amount','tbl_sales_detail','sales_id='.$row->id)-$row->discount_amount+$row->delivery_charge_paid_by_client-$row->delivery_charge;
                    $all_total_amount+=$amount; 
                    echo $amount;
                    ?>
                  </td>
                  <td class="text-right"><?php echo $incentive = $commission_percentage/100*$amount; $incentive_total+=$incentive;?></td>
                  <td><?php if($row->seller>0) echo $this->general_model->getValue('business_name','tbl_seller','id="'.$row->seller.'"'); else echo $this->general_model->getValue('full_name','users','id="'.$row->user_id.'"'); ?></td>
                  <td><?php echo $row->sales_status.'<br>'.$row->delivered_by;?></td>
                  <td><?php echo $row->customer_remarks; if(!empty($row->customer_remarks)) echo "<hr/>"; echo $row->admin_remarks;?></td>
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
                  <td class="text-right text-bold"><?php echo $incentive_total;?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->
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