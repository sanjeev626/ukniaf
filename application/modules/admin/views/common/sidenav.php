<?php
$component_id = $this->session->userdata('component_id');
if($component_id==0){
  $this->load->view('common/topnav_admin');
}
else{
  $this->load->view('common/topnav_admin_'.$component_id); 
}
?>