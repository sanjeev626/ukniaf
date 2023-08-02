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
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'milestonetracker'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin/milestonetracker"> <i class="ri-timer-fill"></i> <span data-key="t-widgets">Milestone Tracker</span> </a> </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'milestone'){ echo 'active'; } ?>" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="<?php if($nav == 'milestone'){ echo 'true'; } else echo 'false'; ?>" aria-controls="sidebarApps"> <i class="ri-cpu-fill"></i> <span data-key="t-widgets">Milestone</span> </a>
            <div class="collapse menu-dropdown <?php if($nav == 'milestone'){ echo 'show'; }?>" id="sidebarApps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url();?>admin/milestone" class="nav-link <?php if($this->uri->segment(2) == 'milestone' && $this->uri->segment(3) == ''){ echo 'active'; } ?>">Schedule</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/milestone/archive'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'if_archieve'){ echo 'active'; } ?>"> Archive</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'update'){ echo 'active'; } ?>" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-controls="sidebarApps"> <i class="ri-apps-2-line"></i> <span data-key="t-apps">IF technical update</span> </a>
            <div class="collapse menu-dropdown <?php if($nav == 'update'){ echo 'show'; }?>" id="sidebarApps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url().'admin/reporting/if_weekly_technical_update_list'; ?>" class="nav-link <?php if($this->uri->segment(2) == 'update' && $this->uri->segment(3) == 'if_weekly_technical_update_list'){ echo 'active'; } ?>">Weekly technical update</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/if_archieve'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'if_archieve'){ echo 'active'; } ?>"> Archive</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'if_monthly_risk_register'){ echo 'active'; } ?>"  href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-controls="sidebarApps"> <i class="ri-honour-line"></i> <span data-key="t-widgets">IF risk register</span> </a> 
            <div class="collapse menu-dropdown <?php if($nav == 'update'){ echo 'show'; }?>" id="sidebarApps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url().'admin/component/monthly_risk_register';?>" class="nav-link <?php if($this->uri->segment(2) == 'update' && $this->uri->segment(3) == 'if_weekly_technical_update_list'){ echo 'active'; } ?>">Monthly</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/monthly_risk_register_archive'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'component/monthly_risk_register_archive'){ echo 'active'; } ?>"> Archive</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url();?>admin/tag"> <i class="ri-price-tag-3-fill"></i> <span data-key="t-widgets">Tag</span> </a> </li>
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