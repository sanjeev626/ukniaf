<?php
$action = base_url() . 'admin/project/list_ordering_update_process/';

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<!-- <section class="content">  -->
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
                    <th>Title</th>
                    <th>Remarks</th>
                    <th>Date Added</th>
                    <th>Date UPdated</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                $sn=0;
                if (!empty($project_info)) { 
                  $counter=0;
                  foreach ($project_info as $row):
                  //echo $this->db->last_query();
                  ?>
                  <tr>
                    <td class="text-center"><?php echo ++$sn;?></td>
                    <td><?php echo $row->title; ?></td>
                    <td><?php echo $row->remarks; ?></td>
                    <td><?php echo $row->date_added; ?></td>
                    <td><?php echo $row->date_updated; ?></td>
                    <td class="table-action text-center">
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/project/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Project"></i> Edit</a>
                      <button type="button" class="btn btn-success btn-sm delete_Project" link="<?php echo base_url(); ?>admin/project/deleteProject/<?php echo $row->id; ?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash tooltips" data-original-title="Delete Project"></i> Delete</button>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/task/add/<?php echo $row->id; ?>"><i class="fa fa-plus tooltips" data-original-title="Add Task"></i> Add Task</a>
                      <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/task/list/<?php echo $row->id; ?>"><i class="fa fa-tasks tooltips" data-original-title="Add Task"></i> List Task</a>
                    </td>
                  </tr>
                  <?php
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>
                        No Projects !!!
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
        <h4 class="modal-title green">Are you sure to delete this project and all the task under this project ? <br>The process is irreversible.</h4>
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
      $('.delete_Project').on('click',function(){ 
        var link  = $(this).attr('link');
        $('.get_link').attr('href',link); 
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