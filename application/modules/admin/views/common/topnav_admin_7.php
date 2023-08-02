<!-- ========== App Menu ========== -->
  <div class="app-menu navbar-menu"> 
    <!-- LOGO -->
    <div class="navbar-brand-box"> 
      <!-- Dark Logo--> 
      <a href="index.html" class="logo logo-dark"> <span class="logo-sm"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-dark.png" alt="" height="17"> </span> </a> 
      <!-- Light Logo--> 
      <a href="index.html" class="logo logo-light"> <span class="logo-sm"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-sm.png" alt="" height="22"> </span> <span class="logo-lg"> <img src="<?php echo base_url();?>content_admin/assets/images/logo-light.png" alt="" height="17"> </span> </a>
      <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"> <i class="ri-record-circle-line"></i> </button>
    </div>
    <div id="scrollbar">
      <div class="container-fluid">
        <div id="two-column-menu"> </div>
        <ul class="navbar-nav" id="navbar-nav">
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin"> <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span> </a> </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'component'){ echo 'active'; } ?>" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="<?php if($nav == 'component'){ echo 'true'; } else echo 'false'; ?>" aria-controls="sidebarApps"> <i class="ri-apps-2-line"></i> <span data-key="t-apps">Infrastructure Finance</span> </a>
            <div class="collapse menu-dropdown <?php if($nav == 'component'){ echo 'show'; }?>" id="sidebarApps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url().'admin/component/if_weekly_update'; ?>" class="nav-link <?php if($this->uri->segment(2) == 'component' && $this->uri->segment(3) == 'if_weekly_update'){ echo 'active'; } ?>">Weekly Update</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/if_archieve'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'if_archieve'){ echo 'active'; } ?>"> Weekly Update Archive</a></li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/monthly_risk_register';?>" class="nav-link <?php if($this->uri->segment(3) == 'monthly_risk_register'){ echo 'active'; } ?>">Monthly Risk Register</a></li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/monthly_risk_register_archive'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'monthly_risk_register_archieve'){ echo 'active'; } ?>"> Monthly Risk Archive</a></li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item"> <a class="nav-link menu-link <?php //if($nav == 'dashboard'){ echo 'active'; } ?>" href="<?php //echo base_url();?>admin"> <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Monthly risk register</span> </a> </li> -->
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