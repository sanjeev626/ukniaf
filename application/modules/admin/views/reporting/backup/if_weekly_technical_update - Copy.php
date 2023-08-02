<!-- start page title -->
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-sm-0">Dashboard</h4>
      <!-- <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
          <li class="breadcrumb-item active">CRM</li>
        </ol>
      </div> -->
    </div>
  </div>
</div>
<!-- end page title -->

<div class="row">  
  <div class="col-xxl-7">
    <div class="card card-height-100">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">IF Weekly Technical Update | Add</h4>
      </div>
      <!-- end card header -->
      
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-nowrap align-middle mb-0">
            <thead>
              <tr>
                <th scope="col">Task Order</th>
                <th scope="col">Risk Number</th>
                <th scope="col">Updates</th>
                <th scope="col">Decisions<br>(This week)</th>
                <th scope="col">Actions<br>(This week)</th>
                <th scope="col">Decisions<br>(Last week)</th>
                <th scope="col">Actions<br>(Last week)</th>
                <th scope="col">Stakeholder</th>
                <th scope="col">Internal Notes</th>
                <th scope="col">FCDO Update</th>
                <th scope="col">Risk</th>
                <th scope="col">Mitigation</th>
                <th scope="col">Residual Risk</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input type="hidden" name="technical_update_id_new" id= "technical_update_id_new" value="0" />
                  <input type="text" name="task_order" id= "task_order" class="form-control" value="" oninput="save_update('0','task_order',this.value);" />
                </td>
                <td><input type="text" name="risk_number" id= "risk_number" class="form-control" value="" oninput="save_update('0','risk_number',this.value);" /></td>
                <td><textarea name="updates" id="updates" class="form-control w-200 h-100" oninput="save_update('0','updates',this.value);"></textarea></td>
                <td><textarea name="decision" id="decision" class="form-control w-200 h-100" oninput="save_update('0','decision',this.value);"></textarea></td>
                <td><textarea name="action" id="action" class="form-control w-200 h-100" oninput="save_update('','action',this.value);"></textarea></td>
                <td></td>
                <td></td>
                <td><textarea name="stakeholder" id="stakeholder" class="form-control w-200 h-100" oninput="save_update('','stakeholder',this.value);"></textarea></td>
                <td><textarea type="text" name="internal_notes" id="internal_notes" class="form-control w-200 h-100" oninput="save_update('0','internal_notes',this.value);" ></textarea></td>
                <td><textarea type="text" name="fcdo_update" id="fcdo_update" class="form-control w-200 h-100" oninput="save_update('0','fcdo_update',this.value);" ></textarea></td>
                <td><textarea type="text" name="risk" id="risk" class="form-control w-150 h-100" oninput="save_update('<?php echo $update_data->id;?>','risk',this.value);" ></textarea></td>
                <td><textarea type="text" name="mitigation" id="mitigation" class="form-control w-200 h-100" oninput="save_update('0','mitigation',this.value);" ></textarea></td>
                <td><textarea type="text" name="residual_risk" id="residual_risk" class="form-control w-200 h-100" oninput="save_update('0','residual_risk',this.value);" ></textarea></td>
            </tr>
            </tbody>
            <!-- end tbody -->
          </table>
          <!-- end table --> 
        </div>
        <!-- end table responsive --> 
      </div>
      <!-- end card body --> 
    </div>
    <!-- end card --> 
  </div>
  <!-- end col --> 
</div>
<!-- end row --> 
<div class="row">  
  <div class="col-xxl-7">
    <div class="card card-height-100">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">IF Weekly Technical Update | Archieve</h4>
      </div>
      <!-- end card header -->
      
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-nowrap align-middle mb-0">
            <thead>
              <tr>
                <th scope="col">Task Order</th>
                <th scope="col">Risk Number</th>
                <th scope="col">Updates</th>
                <th scope="col">Decisions<br>(This week)</th>
                <th scope="col">Actions<br>(This week)</th>
                <th scope="col">Decisions<br>(Last week)</th>
                <th scope="col">Actions<br>(Last week)</th>
                <th scope="col">Stakeholder</th>
                <th scope="col">Internal Notes</th>
                <th scope="col">FCDO Update</th>
                <th scope="col">Risk</th>
                <th scope="col">Mitigation</th>
                <th scope="col">Residual Risk</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($techincal_updates as $update_data) {
              ?>
              <tr>
                <td>                  
                  <input type="hidden" name="technical_update_id" id= "technical_update_id" class="form-control" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->id;?>" />
                  <input type="text" name="task_order" id= "task_order" class="form-control" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->task_order;?>" oninput="save_update('<?php echo $update_data->id;?>','task_order',this.value);" /></td>
                <td><input type="text" name="risk_number" id= "risk_number" class="form-control" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk_number;?>" oninput="save_update('<?php echo $update_data->id;?>','risk_number',this.value);" /></td>
                <td><textarea name="updates" id="updates" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','updates',this.value);"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->updates;?></textarea><!-- 
                  <input type="text" name="updates" id= "updates" class="form-control" value="<?php if(isset($update_data) && !empty($update_data)) echo $update_data->updates;?>" oninput="save_update('<?php echo $update_data->id;?>','updates',this.value);" /> --></td>
                <td><textarea name="decision" id="decision" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','decision',this.value);"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->decision;?></textarea></td>
                <td><textarea name="action" id="action" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','action',this.value);"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->action;?></textarea></td>
                <td></td>
                <td></td>
                <td><textarea name="stakeholder" id="stakeholder" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','stakeholder',this.value);"><?php if(isset($update_data) && !empty($update_data)) echo $update_data->stakeholder;?></textarea></td>
                <td><textarea type="text" name="internal_notes" id="internal_notes" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','internal_notes',this.value);" ><?php if(isset($update_data) && !empty($update_data)) echo $update_data->internal_notes;?></textarea></td>
                <td><textarea type="text" name="fcdo_update" id="fcdo_update" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','fcdo_update',this.value);" ><?php if(isset($update_data) && !empty($update_data)) echo $update_data->fcdo_update;?></textarea></td>
                <td><textarea type="text" name="risk" id="risk" class="form-control w-150 h-100" oninput="save_update('<?php echo $update_data->id;?>','risk',this.value);" ><?php if(isset($update_data) && !empty($update_data)) echo $update_data->risk;?></textarea></td>
                <td><textarea type="text" name="mitigation" id="mitigation" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','mitigation',this.value);" ><?php if(isset($update_data) && !empty($update_data)) echo $update_data->mitigation;?></textarea></td>
                <td><textarea type="text" name="residual_risk" id="residual_risk" class="form-control w-200 h-100" oninput="save_update('<?php echo $update_data->id;?>','residual_risk',this.value);" ><?php if(isset($update_data) && !empty($update_data)) echo $update_data->residual_risk;?></textarea></td>
              </tr>
              <?php
              }
              ?>
            </tbody>
            <!-- end tbody -->
          </table>
          <!-- end table --> 
        </div>
        <!-- end table responsive --> 
      </div>
      <!-- end card body --> 
    </div>
    <!-- end card --> 
  </div>
  <!-- end col --> 
</div>
<!-- end row --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script type="text/javascript">
  function save_update(technical_update_id,column_name,value){
    //alert(technical_update_id+','+column_name+','+value);
    if(technical_update_id==0)
      var technical_update_id= $('#technical_update_id_new').val();
    $.ajax({
      method: "POST",
      url: "<?php echo site_url('admin/reporting/save_update'); ?>",
      data: { technical_update_id:technical_update_id, column_name:column_name, value:value },
      success: function(result)
      {
        //alert(result);
        if(result>0)
          $('#technical_update_id_new').val(result);
        //$('#updated').show();
        //setTimeout(function(){
        //  $("#updated").hide();
        //}, 3500);
      }
    });
  }
</script>