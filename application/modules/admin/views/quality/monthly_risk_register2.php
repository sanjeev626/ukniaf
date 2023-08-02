<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card">
      <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Monthly Risk Register</h4>
      </div>
      <!-- end card header -->
      <div class="card-body table-container">
        <?php //print_r($_SESSION);
            //$risks = $this->Reporting_model->get_weekly_techincal_update_archieve();
            if(isset($monthly_risks)){
            foreach ($monthly_risks as $risk) {
              $GrossRiskRating = "";
              $style = "";
              if($risk->gross_impact=='Severe'){
                $GrossRiskRating = "Severe";
                $style = "background-color:RED; color:#FFFFFF;";
              }
              else if(($risk->gross_likelihood=='Possible' || $risk->gross_likelihood=='Likely') && $risk->gross_impact=='Major'){
                $GrossRiskRating = "Major";
                $style = "background-color:#FFC000;";                
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->gross_impact=='Moderate'){
                $GrossRiskRating = "Major";
                $style = "background-color:#FFC000;";                
              }
              else if(($risk->gross_likelihood=='Almost Certain' || $risk->gross_likelihood=='Highly Likely') && $risk->gross_impact=='Major'){
                $GrossRiskRating = "Severe";
                $style = "background-color:RED; color:#FFFFFF;";                
              }

              $ResidualRiskRating = "";
              $style2 = "";
              if($risk->residual_impact=='Severe'){
                $ResidualRiskRating = "Severe";
                $style2 = "background-color:RED; color:#FFFFFF;";
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Severe";
                $style2 = "background-color:RED; color:#FFFFFF;";
              }
              else if(($risk->residual_likelihood=='Possible' || $risk->residual_likelihood=='Likely') && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if($risk->gross_likelihood=='Highly Likely' && $risk->residual_impact=='Moderate'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if(($risk->residual_likelihood=='Possible') && $risk->residual_impact=='Major'){
                $ResidualRiskRating = "Major";
                $style2 = "background-color:#FFC000;";                
              }
              else if ($risk->residual_likelihood=='Highly Likely'&& $risk->residual_impact=='Minor'){
                $ResidualRiskRating = "Moderate";
                $style2 = "background-color:YELLOW;";  
              }
              else if ($risk->residual_likelihood=='Likely'&& $risk->residual_impact=='Moderate'){
                $ResidualRiskRating = "Moderate";
                $style2 = "background-color:YELLOW;";  
              }

            ?>
            <div class="row">
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Number</label>
                <input type="text" class="form-control" name="number" id="number-input" value="<?php if(isset($risk)) echo $risk->number;?>" required />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Risk Description </label>
                <textarea name="risk_description" id="risk_description" class="form-control" rows="3"><?php if(isset($risk)) echo $risk->risk_description;?></textarea>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Risk Category</label>
                <input type="text" name="risk_category" id="risk_category" class="form-control" value="<?php if(isset($risk)) echo $risk->risk_category;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Proximity</label>
                <input type="text" name="proximity" id="proximity" class="form-control" value="<?php if(isset($risk)) echo $risk->proximity;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Gross Likelihood</label>
                <input type="text" name="gross_likelihood" id="gross_likelihood" class="form-control" value="<?php if(isset($risk)) echo $risk->gross_likelihood;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Gross Impact</label>
                <input type="text" name="gross_impact" id="gross_impact" class="form-control" value="<?php if(isset($risk)) echo $risk->gross_impact;?>" required />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Mitigation Strategy</label>
                <textarea name="mitigation_strategy" id="mitigation_strategy" class="form-control" rows="3"><?php if(isset($risk)) echo $risk->mitigation_strategy;?></textarea>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Residual Likelihood</label>
                <input type="text" name="residual_likelihood" id="residual_likelihood" class="form-control" value="<?php if(isset($risk)) echo $risk->residual_likelihood;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Residual Impact</label>
                <input type="text" name="residual_impact" id="residual_impact" class="form-control" value="<?php if(isset($risk)) echo $risk->residual_impact;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Trend</label>
                <input type="text" name="trend" id="trend" class="form-control" value="<?php if(isset($risk)) echo $risk->trend;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Risk Owner</label>
                <input type="text" name="risk_owner" id="risk_owner" class="form-control" value="<?php if(isset($risk)) echo $risk->risk_owner;?>" required />
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-name-input">Progress in implementing mitigation strategy</label>
                <textarea name="progress_in_implementing_mitigation_strategy" id="progress_in_implementing_mitigation_strategy" class="form-control" rows="3"><?php if(isset($risk)) echo $risk->progress_in_implementing_mitigation_strategy;?></textarea>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Last Updated</label>
                <input type="text" name="last_updated" id="last_updated" class="form-control" value="<?php if(isset($risk)) echo $risk->last_updated;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Monthly Status</label>
                <input type="text" name="monthly_status" id="monthly_status" class="form-control" value="<?php if(isset($risk)) echo $risk->monthly_status;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Risk Appetite</label>
                <input type="text" name="risk_appetite" id="risk_appetite" class="form-control" value="<?php if(isset($risk)) echo $risk->risk_appetite;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Within Appetite</label>
                <input type="text" name="within_appetite" id="within_appetite" class="form-control" value="<?php if(isset($risk)) echo $risk->within_appetite;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Escalated to you by</label>
                <input type="text" name="escalated_to_you_by" id="escalated_to_you_by" class="form-control" value="<?php if(isset($risk)) echo $risk->escalated_to_you_by;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Escalated to you for</label>
                <input type="text" name="escalated_to_you_for" id="escalated_to_you_for" class="form-control" value="<?php if(isset($risk)) echo $risk->escalated_to_you_for;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Date escalated to you</label>
                <input type="date" name="date_escalated_to_you" id="exampleInputdate" id="date_escalated_to_you" class="form-control" value="<?php if(isset($risk)) echo $risk->date_escalated_to_you;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Escalated onwards to</label>
                <input type="text" name="escalated_onwards_to" id="escalated_onwards_to" class="form-control" value="<?php if(isset($risk)) echo $risk->escalated_onwards_to;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Escalated onwards for</label>
                <input type="text" name="escalated_onwards_for" id="escalated_onwards_for" class="form-control" value="<?php if(isset($risk)) echo $risk->escalated_onwards_for;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Date escalated onwards</label>
                <input type="date" name="date_escalated_onwards" id="date_escalated_onwards" class="form-control" value="<?php if(isset($risk)) echo $risk->date_escalated_onwards;?>" required />
              </div>
            </div>
            <div class="col-lg-2">
              <div class="mb-3">
                <label class="form-label" for="manufacturer-brand-input">Date removed</label>
                <input type="date" class="form-control" id="exampleInputdate" name="date_removed" value="<?php if(isset($risk)) echo $risk->date_removed;?>" />
              </div>
            </div>
            <div class="col-lg-12"><hr style="height:5px;"></div>
          </div>
            <?php
          }
          }
          ?>
      </div>
    </div>
  </div>
</div>
<!--end row-->