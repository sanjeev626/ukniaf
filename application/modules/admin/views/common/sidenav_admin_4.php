<!-- ========== App Menu ========== -->
  <div class="app-menu navbar-menu"> 
    <!-- LOGO -->
    <div class="navbar-brand-box"> 
      <!-- Dark Logo--> 
      <a href="<?php echo base_url();?>admin/" class="logo logo-dark"> <span class="logo-sm"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-dark.png" alt="" height="17"> </span> </a> 
      <!-- Light Logo--> 
      <a href="<?php echo base_url();?>admin/" class="logo logo-light"> <span class="logo-sm"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-light.png" alt="" height="17"> </span> </a>
      <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"> <i class="ri-record-circle-line"></i> </button>
    </div>
    <div id="scrollbar">
      <div class="container-fluid">
        <div id="two-column-menu"> </div>
        <ul class="navbar-nav" id="navbar-nav">
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin"> <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span> </a> </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'milestone'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin/milestone/"> <i class="ri-cpu-fill"></i> <span data-key="t-widgets">Milestone Schedule</span> </a> </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'if_weekly_technical_update'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin/reporting/if_weekly_technical_update"> <i class="ri-apps-2-line"></i> <span data-key="t-widgets">IF weekly technical update</span> </a> </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'if_monthly_risk_register'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin/reporting/if_monthly_risk_register"> <i class="ri-honour-line"></i> <span data-key="t-widgets">IF monthly risk register</span> </a> </li>
        </ul>
      </div>
      <!-- Sidebar --> 
    </div>
    <div class="sidebar-background"></div>
  </div>
  <!-- Left Sidebar End --> 
  <!-- Vertical Overlay-->
  <div class="vertical-overlay"></div>
  
  <!-- ============================================================== --> 
  <!-- Start right Content here --> 
  <!-- ============================================================== -->
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">