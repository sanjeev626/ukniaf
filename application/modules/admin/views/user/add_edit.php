<?php
if (!empty($user_detail)) {
    $action = base_url() . 'admin/user/edit_user_process/' . $user_detail->id;
    $pid = $user_detail->id;
} else {
    $action = base_url() . 'admin/user/add_user_process';
    $pid = '';
}

$attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'form1', 'enctype' => 'multipart/form-data');
echo form_open($action, $attributes);
?>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1"><?php echo $panel_title;?></h4>
      </div>
      <div class="card-body">
        <div class="live-preview">
          <div class="row gy-4">
            <div class="col-xxl-3 col-md-3">
              <div>
                <label class="form-label">Component: <span class="asterisk">*</span></label>
                <select name="component_id" id="component_id" class="form-control" required>
                  <option value="">Select One</option>
                  <?php 
          				$selected = "";
          				foreach($components as $component){
          				if(isset($component_id) && $component_id>0 && $component_id==$component->id)
          				  $selected = "selected='selected'";
          				else     
          				  $selected = "";
          				?>
                  <option value="<?php echo $component->id;?>" <?php echo $selected;?>><?php echo $component->title;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-xxl-3 col-md-3">
              <div>
                <label class="form-label">Position: <span class="asterisk">*</span></label>
                <select name="position_id" id="position_id" class="form-control" required>
                  <option value="">Select One</option>
                  <?php 
                  $selected = "";
                  foreach($positions as $position){
                  if(isset($position_id) && $position_id>0 && $position_id==$position->id)
                    $selected = "selected='selected'";
                  else     
                    $selected = "";
                  ?>
                  <option value="<?php echo $position->id;?>" <?php echo $selected;?>><?php echo $position->position_title;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-xxl-3 col-md-3">
              <div>
                <label class="form-label">Email: <span class="asterisk">*</span></label>
                <input type="email" name="email" id='email' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->email; ?>' required/>
                <p>Email address must be under <code>ukniaf.ng or tetratech.com</code> domain name</p>
              </div>
            </div>
            <div class="col-xxl-3 col-md-3">
              <div>
                <label class="form-label">Password: <span class="asterisk">*</span></label>
                <input type="password" name="password" id='password' class="form-control" value='' <?php if (empty($user_detail)) echo 'required';?>/>
                <?php if (!empty($user_detail)) {?>
                <p>Please enter <code>new password</code> if you would like to change password for this user.</p>
                <?php } else{?>
                <p>Please <code>choose password</code> for this user.</p>
                <?php } ?>
              </div>
            </div>
            <div class="col-xxl-3 col-md-4">
              <div>
                <label class="form-label">Name: <span class="asterisk">*</span></label>
                <input type="text" required name="full_name" id='full_name' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->full_name; ?>' />
              </div>
            </div>
            <div class="col-xxl-3 col-md-4">
              <div>
                <label class="form-label">Contact Number: <span class="asterisk">*</span></label>
                <input type="text" required name="contact_number" id='contact_number' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->contact_number; ?>' />
              </div>
            </div>
            <div class="col-xxl-3 col-md-4">
              <div>
                <label class="form-label">Address: <span class="asterisk">*</span></label>
                <input type="text" required name="address" id='address' class="form-control" value='<?php if (!empty($user_detail)) echo $user_detail->address; ?>' />
              </div>
            </div>
            <div class="col-xxl-3 col-md-6">
              <div>
                <label class="form-label">&nbsp;</label>
                <button class="btn btn-success btn-flat" type="submit">
                <?php if (!empty($user_detail)) { echo "Save"; } else { echo "Add"; } ?>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
