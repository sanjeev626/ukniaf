<div class="row">
  <div class="col-xxl-9">
    <div class="card mt-xxl-n5">
      <div class="card-header"><?php //print_r($_SESSION);?>
        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
          <!-- <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"> <i class="fas fa-home"></i> Personal Details </a> </li> -->
          <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#changePassword" role="tab"> <i class="far fa-user"></i> Change Password </a> </li>
        </ul>
      </div>
      <div class="card-body p-4">
        <div class="tab-content">
          <div class="tab-pane" id="personalDetails" role="tabpanel">
            <form action="javascript:void(0);">
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="firstnameInput" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="firstnameInput" placeholder="Enter your firstname" value="Dave">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="lastnameInput" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastnameInput" placeholder="Enter your lastname" value="Adame">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="+(1) 987 6543">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="emailInput" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" value="daveadame@velzon.com">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label for="JoiningdatInput" class="form-label">Joining Date</label>
                    <input type="text" class="form-control" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label for="skillsInput" class="form-label">Skills</label>
                    <select class="form-control" name="skillsInput" data-choices data-choices-text-unique-true multiple id="skillsInput">
                      <option value="illustrator">Illustrator</option>
                      <option value="photoshop">Photoshop</option>
                      <option value="css">CSS</option>
                      <option value="html">HTML</option>
                      <option value="javascript" selected>Javascript</option>
                      <option value="python">Python</option>
                      <option value="php">PHP</option>
                    </select>
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="designationInput" class="form-label">Designation</label>
                    <input type="text" class="form-control" id="designationInput" placeholder="Designation" value="Lead Designer / Developer">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-6">
                  <div class="mb-3">
                    <label for="websiteInput1" class="form-label">Website</label>
                    <input type="text" class="form-control" id="websiteInput1" placeholder="www.example.com" value="www.velzon.com" />
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                  <div class="mb-3">
                    <label for="cityInput" class="form-label">City</label>
                    <input type="text" class="form-control" id="cityInput" placeholder="City" value="California" />
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                  <div class="mb-3">
                    <label for="countryInput" class="form-label">Country</label>
                    <input type="text" class="form-control" id="countryInput" placeholder="Country" value="United States" />
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                  <div class="mb-3">
                    <label for="zipcodeInput" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Enter zipcode" value="90011">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                  <div class="mb-3 pb-2">
                    <label for="exampleFormControlTextarea" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3">Hi I'm Anna Adame,It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.</textarea>
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                  <div class="hstack gap-2 justify-content-end">
                    <button type="submit" class="btn btn-primary">Updates</button>
                    <button type="button" class="btn btn-soft-success">Cancel</button>
                  </div>
                </div>
                <!--end col--> 
              </div>
              <!--end row-->
            </form>
          </div>
          <!--end tab-pane-->
          <div class="tab-pane active" id="changePassword" role="tabpanel">
            <form action="<?php echo base_url();?>admin/auth/change_password#changePassword" method="post">
              <div class="row g-2">                    
                <?php if(isset($message)){ ?>
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $message;?> </div>
                <?php } ?>
                <div class="col-lg-4">
                  <div>
                    <label for="oldpasswordInput" class="form-label">Old Password*</label>
                    <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Enter current password">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                  <div>
                    <label for="newpasswordInput" class="form-label">New Password*</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-4">
                  <div>
                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm password">
                  </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                  <div class="text-end">
                    <button type="submit" class="btn btn-success">Change Password</button>
                  </div>
                </div>
                <!--end col--> 
              </div>
              <!--end row-->
            </form>
          </div>
          <!--end tab-pane-->
        </div>
      </div>
    </div>
  </div>
  <!--end col--> 
</div>
<!--end row--> 