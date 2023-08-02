<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<section class="content">
  <!-- Default box -->
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
      <div class="row">
        <div class="table-responsive">  
          <table class="table table-hover" id="table1" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="5%" class="text-center">S.N</th>
                <th width="15%">Order Date</th>
                <th width="20%">Customer Information</th>
                <th width="25%">Address</th>
                <th width="15%" class="text-center">Items</th>
                <th width="5%" class="text-right">Amount</th>
                <th width="15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $counter=0;
              $total_sales=0;
              $total_discount_amount=0;
              $total_delivery_charge_paid_by_client=0;
              $total_delivery_charge=0;
              if (!empty($sales)) { 
                foreach ($sales as $row):
                  //print_r($row);
                  $sales_amount = $this->general_model->getSum('total_amount','tbl_sales_detail','sales_id='.$row->id);
                  $total_sales+=$sales_amount;
                  $total_discount_amount+=$row->discount_amount;
                  $total_delivery_charge_paid_by_client+=$row->delivery_charge_paid_by_client;
                  $total_delivery_charge+=$row->delivery_charge;
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
                  <td class="text-right"><?php echo $sales_amount; ?></td>
                  <td><a href="<?php echo base_url() . 'admin/sales/details/' . $row->id;?>" target="_blank">Details</a></td>
                </tr>
                <?php
                endforeach;
              }
              ?>
                <tr>
                  <td></td>
                  <td class="text-right text-bold" colspan="4">
                    <?php
                      echo "Total Sales : "; echo "<br>";
                      echo "Total discountamount : "; echo "<br>";
                      echo "Total delivery charge paid by client : "; echo "<br>";
                      echo "Total delivery charge paid for delivery : "; echo "<br>";
                      echo "Cash with Us : ";
                    ?>
                  </td>
                  <td class="text-right text-bold">
                    <?php
                      echo $total_sales."<br>";
                      echo $total_discount_amount; echo "<br>";
                      echo $total_delivery_charge_paid_by_client; echo "<br>";
                      echo $total_delivery_charge; echo "<br>";
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