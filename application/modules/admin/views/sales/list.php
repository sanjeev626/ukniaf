<?php
$action = base_url() . 'admin/product/list_ordering_update_process/' . $category_id;

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
                  <th width="10%">Image </th>
                  <th width="45%">Product </th>
                  <th width="40%" class="table-action text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($this->uri->segment(4) == NULL) {
                  $i = 1;
                } else {
                  $i = $this->uri->segment(4) + 1;
                }
                if (!empty($product_info)) { 
                  $counter=0;
                  foreach ($product_info as $row):
                    //print_r($key);
                  //echo $key->ordering;
                  $product_image = $this->general_model->getArray('imagepath,imagename',' tbl_product_image',array('product_id' => $row->id, 'is_main' => '1'));                  

                  $product_ordering_prev = '1000';
                  $ordering_id = '';
                  $product_ordering = $this->general_model->getArray('id,ordering',' tbl_product_ordering',array('product_id' => $row->id, 'category_id' => $category_id));  
                  //echo $this->db->last_query();
                  if(!empty($product_ordering)){
                    $product_ordering_prev = $product_ordering->ordering;
                    $ordering_id = $product_ordering->id;
                  }
                  ?>
                  <tr>
                    <td class="text-center">
                      <input type="hidden" name="product_id[]" id='product_id[]' value="<?php echo $row->id;?>" />
                      <input type="hidden" name="ordering_id[]" id='ordering_id[]' value="<?php echo $ordering_id;?>" />
                      <input type="text" name="ordering[]" id='ordering[]' value="<?php echo $product_ordering_prev;?>" class="form-control" />
                    </td>
                    <td><img src="<?php echo base_url().$product_image->imagepath.$product_image->imagename; ?>" height="60px" /></td>
                    <td><?php echo $row->name; ?></td>
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/product/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Product"></i> Edit</a>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/product/stock_manage/<?php echo $row->id; ?>" target="_blank"><i class="fa fa-houzz tooltips" data-original-title="Edit Product"></i> Stock</a>
                      <button type="button" class="btn btn-success btn-sm delete_Product" link="<?php echo base_url(); ?>admin/product/deleteProduct/<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Product"></i> Delete</button>
                    </td>
                  </tr>
                  <?php
                  $i++;
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>No Product has been taken !!!</center></td>
                  </tr>
                  <?php } ?>

                  <tr>
                    <td class="text-center">
                      <button type="submit" class="btn btn-success btn-sm delete_Product" ><i class="fa fa-save tooltips" data-original-title="Delete Product"></i> Save</button>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
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