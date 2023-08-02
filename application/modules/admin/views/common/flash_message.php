<?php if($this->session->flashdata('success')){ ?>
  <div class="alert alert-success" role="alert">
    <strong><?php echo $this->session->flashdata('success'); ?></strong>
  </div>            
<?php } else if($this->session->flashdata('error')){ ?>
  <div class="alert alert-danger mb-xl-0" role="alert">
      <strong><?php echo $this->session->flashdata('error'); ?></strong>
  </div>
<?php } ?>