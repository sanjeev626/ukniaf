<?php $this->load->view('admin/common/header');?>
<?php $this->load->view('admin/common/nav');?>
<?php $this->load->view('admin/common/sidenav');?>
<?php $this->load->helper("view_helper"); ?>    
<?php $this->load->view('admin/common/flash_message'); ?>
<?php $this->load->view($main);?>
<?php $this->load->view('admin/common/footer');?>
