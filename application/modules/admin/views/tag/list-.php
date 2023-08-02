<?php
$action = base_url() . 'admin/task/list_ordering_update_process/';

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<section> 
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border" style="padding:20px;">
      <div class="row">
          <div class="card"> 
            <!-- /.card-header -->
            <div class="card-body">
              <table id="mydatatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>S.N</th>
                    <th>Task Order</th>
                    <th>Task</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                $sn=0;
                if (!empty($task_info)) { 
                  $counter=0;
                  foreach ($task_info as $row):
                  //echo $this->db->last_query();
                  ?>
                  <tr>
                    <td class="text-center"><?php echo ++$sn;?></td>
                    <td><?php echo $row->task_order; ?></td>
                    <td><?php echo $row->task; ?></td>
                    <td><?php echo $row->remarks; ?></td>
                    <td><?php echo $row->date_added; ?></td>
                    <td class="table-action text-center"><a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/task/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Customer"></i> Edit</a>
                      <button type="button" class="btn btn-success btn-sm delete_Customer" link="<?php echo base_url(); ?>admin/task/deleteCustomer/<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Customer"></i> Delete</button></td>
                  </tr>
                  <?php
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>
                        No Tasks !!!
                      </center></td>
                  </tr>
                  <?php } ?>
              </table>
            </div>
            <!-- /.card-body --> 
          </div>
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
        <h4 class="modal-title green">Are you sure to delete this Task ?</h4>
      </div>
      <div class="modal-body center"> <a class="btn btn-success get_link" href="">Yes</a> &nbsp; | &nbsp;
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
      $('.delete_Customer').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 

      });
      $("#search").autocomplete({
        source: "../Customer/get_coupons",
            minLength: 1,
            select: function (e, ui) {
                location.href = ui.item.the_link;
            }
      });
    });
  </script> 
<script>
  $(function () {
    $("#mydatatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>