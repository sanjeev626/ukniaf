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
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'component'){ echo 'active'; } ?>" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="<?php if($nav == 'component'){ echo 'true'; } else echo 'false'; ?>" aria-controls="sidebarApps"> <i class="ri-apps-2-line"></i> <span data-key="t-apps">Components</span> </a>
            <div class="collapse menu-dropdown <?php if($nav == 'component'){ echo 'show'; }?>" id="sidebarApps">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url().'admin/component'; ?>" class="nav-link <?php if($this->uri->segment(2) == 'component' && $this->uri->segment(3) == ''){ echo 'active'; } ?>">List All</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/component/add'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'add'){ echo 'active'; } ?>"> Add</a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link <?php if($this->uri->segment(3) == 'edit'){ echo 'active'; } ?>"> Edit</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link menu-link <?php if($nav == 'user'){ echo 'active'; } ?>" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="<?php if($nav == 'user'){ echo 'true'; } else echo 'false'; ?>" aria-controls="sidebarUsers"> <i class="ri-account-circle-line"></i> <span data-key="t-apps">Users</span> </a>
            <div class="collapse menu-dropdown <?php if($nav == 'user'){ echo 'show'; }?>" id="sidebarUsers">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item"> <a href="<?php echo base_url().'admin/user'; ?>" class="nav-link <?php if(($this->uri->segment(2) == 'user' && $this->uri->segment(3) == '') || $this->uri->segment(3) == 'list'){ echo 'active'; } ?>">List All</a> </li>
                <li class="nav-item"><a href="<?php echo base_url().'admin/user/add'; ?>" class="nav-link <?php if($this->uri->segment(3) == 'add'){ echo 'active'; } ?>"> Add</a></li>
                <li class="nav-item"><a href="javascript:void(0);" class="nav-link <?php if($this->uri->segment(3) == 'edit'){ echo 'active'; } ?>"> Edit</a></li>
              </ul>
            </div>
          </li>
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