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
                  <th scope="col">SN</th>
                  <th scope="col">Title</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Updated Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if (!empty($component)) { 
                $sn=0;
                foreach ($component as $key):
                  ?>
                <tr>
                  <td class="fw-medium"><?php echo ++$sn; ?></td>
                  <td><?php echo $key->title; ?></td>
                  <td><?php echo $key->date_added; ?></td>
                  <td><?php echo $key->date_updated; ?></td>
                  <td>
                    <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/component/edit/<?php echo $key->id; ?>"><i class="fa fa-edit tooltips" data-original-title="Edit Component"></i> Edit</a>
                    <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/user/add/<?php echo $key->id; ?>"><i class="fa fa-user tooltips" data-original-title="Add User"></i> Add User</a>
                    <a class="btn btn-success btn-sm" href="<?php echo base_url(); ?>admin/user/list/<?php echo $key->id; ?>"><i class="fa fa-users tooltips" data-original-title="Add User"></i> List Users</a>
                  </td>
                </tr>
                <?php
                endforeach;
              } else {
                ?>
                <tr>
                  <td colspan="8"><center>No Component Found !!!</center></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- end card-body --> 
    </div>
    <!-- end card --> 
  </div>
  <!-- end col --> 
</div>
<!-- end row --> 