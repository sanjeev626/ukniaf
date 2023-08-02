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
                <th width="10%">Order Date</th>
                <th width="10%">Customer Information</th>
                <th width="15%">Address</th>
                <th width="5%" class="text-center">Items</th>
                <th width="20%" class="text-center" colspan="2">Amount</th>
                <th width="10%" class="text-right">Commission | Status</th>
                <th width="2%">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
              $all_total_amount=0;
              $commission_total=0;
              $charged_with_client_total=0;
              if (!empty($order_list)) { 
                //print_r($new_order);
                foreach ($order_list as $row):
                  //print_r($row);
                  $background="";
                  $commission_total+=$row->commission_paid;
                  if($row->sales_status=="cancelled")
                    $background = 'style="background:red; color:white;"';
                ?>
                <tr <?php echo $background;?>>
                  <td class="text-center">
                    <?php echo ++$counter;?>
                    <input type="hidden" value="<?php echo $row->id;?>" name="sales_id" id="sales_id" />
                  </td>
                  <td><?php echo date("d F Y", strtotime($row->sales_date));?><br><?php echo ucwords(str_replace('_',' ',$row->sales_status));?></td>
                  <td><a href="<?php echo base_url() . 'admin/sales/seller_sales_detail/' . $row->id;?>" target="_blank"><?php echo $row->full_name; ?><br><?php echo $row->contact_number; ?></a></td>
                  <td><?php echo $row->full_address; ?></td>
                  <td class="text-center"><?php echo $this->general_model->getCount('tbl_sales_detail','sales_id='.$row->id); ?></td>
                  <td>
                    <?php
                    $sales_amount = $this->general_model->getSum('total_amount','tbl_sales_detail','sales_id='.$row->id);
                    $charged_with_client = $sales_amount+$row->delivery_charge_paid_by_client-$row->discount_amount;
                    $balance = $charged_with_client-$row->delivery_charge;
                    if($row->sales_status!="cancelled")
                      $charged_with_client_total += $charged_with_client;
                    echo 'Sales Amount : '.$charged_with_client.'<br>Delivery Charged :'.$row->delivery_charge_paid_by_client;
                    ?>
                  </td>
                  <td><?php echo 'Delivery Paid : '.$row->delivery_charge.'<br>'; echo 'Balance : '.$balance; ?></td>
                  <td class="text-right"><?php echo $row->commission_paid.' | '.$row->commission_payment_status;?></td>
                  <td class="text-right"></td>
                </tr>
                <?php
                endforeach;
              }
              if($charged_with_client_total>0){
              ?>
              <tr>
                <th colspan="5"></th>
                <th class="text-right"><?php echo "Nrs ".$charged_with_client_total;?></th>
                <th class="text-right"><?php echo round($commission_total*100/$charged_with_client_total,2)."% | Nrs ".$commission_total;?></th>
                <td></td>
              </tr>
              <?php } else{ ?>
              <tr>
                <th colspan="8" class="text-center">No Sales has been placed.</th>
              </tr>
              <?php } ?>
              </tbody>
          </table>
        </div><!-- table-responsive -->
      </div><!-- col-md-6 -->
    </div>
  </div>
  <!-- /.box -->
  </section>

  <section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
        <div class="table-responsive">  
          <table class="table" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th colspan="2">Summary</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th width="20%">Total to be paid : </th>
                <td>Nrs <?php echo $commission_total;?></td>
              </tr>
              <tr>
                <th width="20%">Paid : </th>
                <td>Nrs <?php echo $paid_amount=$this->general_model->getSum('amount','tbl_commission_payment','seller_id="'.$seller_id.'"');?></td>
              </tr>
              <tr>
                <th width="20%">Balance : </th>
                <td>Nrs <?php echo $commission_total-$paid_amount;?></td>
              </tr>
              </tbody>
          </table>
        </div><!-- table-responsive -->
      </div><!-- col-md-6 -->
    </div>
  </div>
  <!-- /.box -->
  </section>