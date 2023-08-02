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
                <th width="40%">Color and Size</th>
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
                <td><?php echo $this->Product_model->fetch_image($item->product_id);?></td>
                <td><?php echo $this->Product_model->get_field_by_id('name',$item->product_id);?></td>
                <td>
                  <?php echo $this->general_model->getValue('attribute_value','tbl_attribute_values','id="'.$item->color_id.'"').' | '.$this->general_model->getValue('attribute_value','tbl_attribute_values','id="'.$item->size_id.'"');?>
                </td>
                <td class="text-center"><?php echo $item->quantity;?></td>
                <td class="text-right"><?php echo $item->rate;?></td>
                <td class="text-right"><?php echo $total_amount;?></td>
                <td class="text-right"></td>
              </tr>
              <?php
              }
              ?>              
              <tr>
                <th colspan="6" class="text-right">Sub Total : </th>
                <th class="text-right"><span id="total_amount_sum"><?php echo $total_amount_sum;?></span></th>
                <td class="text-right"></td>
              </tr>              
              <tr>
                <th colspan="6" class="text-right">Discount : </th>
                <th class="text-right"><?php echo $sales->discount_amount;?></th>
                <td class="text-right"></td>
              </tr>                        
              <tr>
                <th colspan="6" class="text-right">Delivery charge paid by client : </th>
                <th class="text-right"><?php echo $sales->delivery_charge_paid_by_client;?></th>
                <td class="text-right"></td>
              </tr>                       
              <tr>
                <th colspan="6" class="text-right">Delivery charge paid : </th>
                <th class="text-right"><?php echo $sales->delivery_charge;?></th>
                <td class="text-right"></td>
              </tr>
              <tr>
                <th colspan="6" class="text-right">Total Amount : </th>
                <th class="text-right"><?php echo $total_amount_sum-$sales->discount_amount+$sales->delivery_charge_paid_by_client-$sales->delivery_charge;?></th>
                <td class="text-right"></td>
              </tr>                         
              <tr>
                <th colspan="6" class="text-right">Commission amount : </th>
                <th class="text-right"><?php echo $sales->commission_paid;?></th>
                <td class="text-right"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- table-responsive --> 
      <!-- col-md-6 --> 
    </div>
  </div>
</section>
</form>