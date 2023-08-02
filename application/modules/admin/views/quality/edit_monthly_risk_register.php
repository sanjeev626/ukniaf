<?php
//ob_start();
?>
  <form method="post" action="<?php echo base_url().'admin/component/monthly_risk_register_edit_process/';?>" class="d-flex flex-column justify-content-end h-100">
      <input type="text" class="form-control" name="monthly_risk_register_id" id="monthly_risk_register_id-input" data-provider="flatpickr" data-range="true" placeholder="Enter Number">
      <div class="offcanvas-body">
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Number</label>
              <input type="text" class="form-control" name="number" id="number-input" data-provider="flatpickr" data-range="true" placeholder="Enter Number" value="test">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Description</label>
              <textarea name="risk_description" id="risk_description" class="form-control" rows="3">another test</textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Category</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_category" id="risk_category-select">
                  <option value="">Select risk category</option>
                  <option value="Policy and Programme Delivery">Policy and Programme Delivery</option>
                  <option value="Reputational">Reputational</option>
                  <option value="Safeguarding">Safeguarding</option>
                  <option value="Strategy and Context">Strategy and Context</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Proximity</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="proximity" id="proximity-select">
                  <option value="">Select proximity</option>                  
                  <option value="< 1 Month">< 1 Month</option>
                  <option value="0-3months">0-3months</option>
                  <option value="3-6months">3-6months</option>
                  <option value="6-12months">6-12months</option>12 months
                  <option value=">12 months">>12 months</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_likelihood" id="gross_likelihood-select">
                  <option value="">Select gross likelihood</option>
                  <option value="Almost Certain">Almost Certain</option>
                  <option value="Highly Likely">Highly Likely</option>
                  <option value="Likely">Likely</option>
                  <option value="Possible">Possible</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Gross Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="gross_impact" id="gross_impact-select">
                  <option value="">Select gross impact</option>
                  <option value="Major">Major</option>
                  <option value="Minor">Minor</option>
                  <option value="Moderate">Moderate</option>
                  <option value="Severe">Severe</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Mitigation Strategy</label>
              <textarea name="mitigation_strategy" id="mitigation_strategy" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Likelihood</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_likelihood" id="residual_likelihood-select">
                  <option value="">Select residual likelihood</option>
                  <option value="Highly Likely">Highly Likely</option>
                  <option value="Likely">Likely</option>
                  <option value="Possible">Possible</option>
                  <option value="Unlikely">Unlikely</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Residual Impact</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="residual_impact" id="residual_impact-select">
                  <option value="">Select residual impact</option>
                  <option value="Major">Major</option>
                  <option value="Minor">Minor</option>
                  <option value="Moderate">Moderate</option>
                  <option value="Severe">Severe</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Trend</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="trend" id="trend-select">
                  <option value="">Select trend</option>
                  <option value="up">&uarr;</option>
                  <option value="right">&rarr;</option>
                  <option value="down">&darr;</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Progress in Implementing Mitigation Strategy</label>
              <textarea name="progress_in_implementing_mitigation_strategy" id="progress_in_implementing_mitigation_strategy" class="form-control" rows="3"></textarea>
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Last Updated</label>
              <input type="date" class="form-control" name="last_updated" id="last_updated-input" data-provider="flatpickr" data-range="true" placeholder="Enter last updated">
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Risk Appetite</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="risk_appetite" id="risk_appetite-select">
                  <option value="">Select risk appetite</option>
                  <option value="Cautious">Cautious</option>
                  <option value="Minimal">Minimal</option>
                  <option value="Receptive">Receptive</option>
              </select>
          </div>
          <div class="mb-4">
              <label for="country-select" class="form-label text-muted text-uppercase fw-semibold mb-3">Within Appetite ?</label>
              <select class="form-control" data-choices data-choices-multiple-remove="true" name="within_appetite" id="within_appetite-select">
                  <option value="">Select within appetite</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
              </select>
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You By ?</label>
              <input type="text" class="form-control" name="escalated_to_you_by" id="escalated_to_you_by-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you by">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated To You For ?</label>
              <input type="text" class="form-control" name="escalated_to_you_for" id="escalated_to_you_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated to you for">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated To You</label>
              <input type="date" class="form-control" name="date_escalated_to_you" id="date_escalated_to_you-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated to you">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalated Onwards To ?</label>
              <input type="text" class="form-control" name="escalated_onwards_to" id="escalated_onwards_to-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards to">
          </div>
          <div class="mb-4">
              <label class="form-label text-muted text-uppercase fw-semibold mb-3">Escalation Onwards For ?</label>
              <input type="text" class="form-control" name="escalated_onwards_for" id="escalated_onwards_for-input" data-provider="flatpickr" data-range="true" placeholder="Enter escalated onwards for">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Escalated Onwards</label>
              <input type="date" class="form-control" name="date_escalated_onwards" id="date_escalated_onwards-input" data-provider="flatpickr" data-range="true" placeholder="Enter date escalated onwards">
          </div>
          <div class="mb-4">
              <label for="datepicker-range" class="form-label text-muted text-uppercase fw-semibold mb-3">Date Removed</label>
              <input type="date" class="form-control" name="date_removed" id="date_removed-input" data-provider="flatpickr" data-range="true" placeholder="Enter date removed">
          </div>
          <div class="mb-4">
              <button type="submit" class="btn btn-success w-sm">Submit</button>
          </div>
      </div>
      <!--end offcanvas-body-->
      <div class="offcanvas-footer border-top p-3 text-center hstack gap-2">
          <button class="btn btn-light w-100"></button>
          <button type="submit" class="btn btn-success w-100"></button>
      </div>
      <!--end offcanvas-footer-->
  </form>
<?php
//$form = ob_get_clean();
//echo $form;
?>