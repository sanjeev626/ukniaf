<?php
$action = base_url();

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="row">
          <div class="table-responsive">  
            <table class="table table-hover" id="table1" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th width="5%" class="text-center">Ordering</th>
                  <th width="10%">Order Date</th>
                  <th width="20%">Customer Name</th>
                  <th width="25%">Address</th>
                  <th width="20%">Contact Number</th>
                  <th width="5%">Items</th>
                  <th width="5%">Amount</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(4) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(4) + 1;
                }
                if (!empty($new_order)) { 
                  $counter=0;
                  //print_r($new_order);
                  foreach ($new_order as $row):
                    //print_r($row);
                  ?>
                  <tr>
                    <td class="text-center"><?php echo ++$counter;?></td>
                    <td><?php echo date("d F Y", strtotime($row->sales_date));?></td>
                    <td><?php echo $row->full_name; ?></td>
                    <td><?php echo $row->full_address; ?></td>
                    <td><?php echo $row->contact_number; ?></td>
                    <td><?php echo $this->general_model->getCount('tbl_sales_detail','sales_id='.$row->id); ?></td>
                    <td><?php echo $row->total_amount; ?></td>
                    <td><a href="<?php echo base_url() . 'admin/sales/details/' . $row->id;?>" target="_blank">Details</a></td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                }
                ?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
           <?php echo $this->pagination->create_links();?>
          </div><!-- col-md-6 -->
        </div>


      </div>
    </div>
    <!-- /.box -->
  </section>
<?php echo form_close(); ?> 

  <!-- Delete Modal -->
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title green">Are you sure to delete this Product ?</h4>
        </div>
        <div class="modal-body center">
           
          <a class="btn btn-success get_link" href="">Yes</a>
          &nbsp; | &nbsp; 
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
    $('document').ready(function(){
      $('.delete_Product').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "../Product/get_coupons",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script>