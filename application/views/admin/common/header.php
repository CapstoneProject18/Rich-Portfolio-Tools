<header class="header"> <a href="<?php echo base_url();?>admin/dashboard" class="logo"> Job Portal </a>
  <nav class="navbar navbar-static-top" role="navigation"> <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
    <div class="navbar-right">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span><?php echo $this->session->userdata('name');?></span> </a>
          <ul class="dropdown-menu">
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="<?php echo base_url('admin/home/editpassword');?>" class="btn btn-default btn-flat">Edit</a> </div>
              <div class="pull-right"> <a href="<?php echo base_url('admin/home/logout');?>" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
