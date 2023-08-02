<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <div class="card-body">
        <form name="date_range" method="post">
          <div class="row">
            <div class="col-md-3">
              <input class="form-control inputitem ui-autocomplete-input" type="text" name="from_date" id="from_date" placeholder="From Date (yyyy-mm-dd)" autocomplete="off" value="<?php if(isset($_POST['from_date'])) echo $_POST['from_date'];?>">
            </div>
            <div class="col-md-3">
              <input class="form-control inputitem ui-autocomplete-input" type="text" name="to_date" id="to_date" placeholder="To Date (yyyy-mm-dd)" autocomplete="off" value="<?php if(isset($_POST['to_date'])) echo $_POST['to_date'];?>">
            </div>
            <div class="col-md-3">
              <input name="btnDo" type="submit" value="List" class="btn btn-success btn-flat">
            </div>
          </div>
        </form>
      </div>
        <!-- Default box -->
      <div class="row">
        <div class="table-responsive">  
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="5%" class="text-center">S.N</th>
                <th width="15%">Order Date</th>
                <th width="15%">Product Image</th>
                <th width="20%">Product Name</th>
                <th width="15%" class="text-right">Cost Price</th>
                <th width="15%" class="text-right">Selling Price</th>
                <th width="15%" class="text-right">Profit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
              $total_sales=0;
              $total_discount_amount=0;
              $total_delivery_charge_paid_by_client=0;
              $total_delivery_charge=0;
              $total_profit=0;
              if (!empty($sales)) { 
                foreach ($sales as $row):
                  //print_r($row);
                  $sales_amount = $this->general_model->getSum('total_amount','tbl_sales_detail','sales_id='.$row->id);
                  $total_sales+=$sales_amount;
                  $total_discount_amount+=$row->discount_amount;
                  $total_delivery_charge_paid_by_client+=$row->delivery_charge_paid_by_client;
                  $total_delivery_charge+=$row->delivery_charge;
                  //$resProduct = $this->general_model->getQuery('*','tbl_sales_detail','sales_id='.$row->id);
                  $where = array('sales_id' => $row->id);
                  $products = $this->general_model->getAll('tbl_sales_detail', $where, '', '*');
                  foreach ($products as $product):
                    $product_id = $product->product_id;
                    $quantity = $product->quantity;
                    $product_where = array('id' => $product_id);
                    $product_details = $this->general_model->getResultById('tbl_product', $product_where);

                    $image_where = array('product_id' => $product_id, 'is_main' => '1');
                    $product_image = $this->general_model->getResultById('tbl_product_image', $image_where);
                    $cost_price = $product_details->cost_price;
                    $sold_price = $product->rate;
                    $image = base_url().$product_image->imagepath.$product_image->imagename;
                    $profit = $sold_price*$quantity-$cost_price*$quantity;
                    $total_profit+=$profit;
                ?>
                <tr>
                  <td class="text-center">
                    <?php echo ++$counter;?>
                    <input type="hidden" value="<?php echo $row->id;?>" name="sales_id" id="sales_id" />
                  </td>
                  <td><?php echo date("d F Y", strtotime($row->sales_date));?></td>
                  <td><img src="<?php echo $image;?>" height="100" ><?php //print_r($product); ?></td>
                  <td><?php echo $product_details->name; ?></td>
                  <td class="text-right"><?php echo $cost_price; ?></td>
                  <td class="text-right"><?php echo $sold_price; ?></td>
                  <td class="text-right"><?php echo $profit; ?></td>
                </tr>
                <?php
                  
                endforeach;
                endforeach;
              }
              ?>
                <tr>
                  <td></td>
                  <td class="text-right text-bold" colspan="4">
                    <?php
                      echo "Total Sales : "; echo "<br>";
                      echo "Total Profit : "; echo "<br>";
                      echo "Total discount provided : "; echo "<br>";
                      echo "Total delivery charge paid by client : "; echo "<br>";
                      echo "Total delivery charge paid for delivery : "; echo "<br>";
                      echo "Actual Profit : "; echo "<br>";
                      echo "Cash with Us : ";
                    ?>
                  </td>
                  <td class="text-right text-bold">
                    <?php
                      echo number_format($total_sales,2)."<br>";
                      echo number_format($total_profit,2)."<br>";
                      echo $total_discount_amount; echo "<br>";
                      echo $total_delivery_charge_paid_by_client; echo "<br>";
                      echo $total_delivery_charge; echo "<br>";
                      echo $total_profit-$total_discount_amount+$total_delivery_charge_paid_by_client-$total_delivery_charge; echo "<br>";
                      echo $total_sales-$total_discount_amount+$total_delivery_charge_paid_by_client-$total_delivery_charge;
                    ?></td>
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
  

//Date picker

    $('#from_date').datepicker({

      format: 'yyyy-mm-dd',

      autoclose: true

    })

    $('#to_date').datepicker({

      format: 'yyyy-mm-dd',

      autoclose: true

    });
        
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