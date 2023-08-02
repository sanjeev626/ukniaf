<?php
$action = base_url() . 'admin/user/list_ordering_update_process/';

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<div class="row">      
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $panel_title;?></h4>
      </div>
      <!-- end card header -->
      
      <div class="card-body">
        <div class="live-preview">
          <div class="table-responsive">
            <table class="table table-striped table-nowrap align-middle mb-0">
                <thead>
                  <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                $sn=0;
                if (!empty($user_info)) { 
                  $counter=0;
                  foreach ($user_info as $row):
                  //echo $this->db->last_query();
                    $delete_url = base_url().'admin/user/deleteUser/'.$row->id;
                    if(isset($component_id) && $component_id>0)
                      $delete_url.='/'.$component_id;
                  ?>
                  <tr>
                    <td class="text-center"><?php echo ++$sn;?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->full_name; ?></td>
                    <td><?php echo $this->general_model->getValue('position_title','tbl_position','id='.$row->position_id); ?></td>
                    <td><?php echo $row->contact_number; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td class="table-action text-center"><a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/user/edit/<?php echo $row->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit User"></i> Edit</a>
                      <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="deleteThis('<?php echo $delete_url; ?>');">Delete</a>
                    </td>
                  </tr>
                  <?php
                  endforeach;
                } else {
                  ?>
                  <tr>
                    <td colspan="8"><center>
                        No Users Found!!!
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
<?php echo form_close(); ?> 

<script type="text/javascript">
  function deleteThis(delete_url){
    var aa = confirm('Are you sure to delete this User ?');
    if(aa){
      window.location=delete_url;
    }
  }
</script>