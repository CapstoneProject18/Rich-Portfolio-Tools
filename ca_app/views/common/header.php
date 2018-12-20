<div class="topheader">
  <div class="navbar navbar-default" role="navigation">
        <div class="col-md-2">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="<?php echo base_url();?>"><img style="width: 20%" src="<?php echo base_url('public/images/no_pic.png');?>" /></a> </div>
        </div>
        <div class="col-md-<?php echo ($this->session->userdata('is_user_login')==TRUE)?'6':'6';?>">
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
              <?php 
				
				if($this->session->userdata('is_employer')==TRUE): 
			?>
              <li <?php echo active_link('');?>><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
              <li <?php echo active_link('employer');?>><a href="<?php echo base_url('employer/dashboard');?>" title="My Dashboard">My Dashboard</a> </li>
              <li <?php echo active_link('search-resume');?>><a href="<?php echo base_url('search-resume');?>" title="Search Resume">Search Resume</a></li>
              <li <?php echo active_link('contact-us');?>><a href="<?php echo base_url('contact-us');?>" title="Contact Us">Contact Us</a></li>
        
		<?php elseif($this->session->userdata('is_job_seeker')==TRUE):?>
              <li <?php echo active_link('');?>><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
              <li <?php echo active_link('jobseeker');?>><a href="<?php echo base_url('jobseeker/dashboard');?>" title="My Dashboard">My Dashboard</a> </li>
              <li <?php echo active_link('search-jobs');?>><a href="<?php echo base_url('search-jobs');?>" title="Search Jobs">Search Jobs</a></li>
              <li <?php echo active_link('contact-us');?>><a href="<?php echo base_url('contact-us');?>" title="Contact Us">Contact Us</a></li>
         
         <?php else:?>
              <li <?php echo active_link('');?>><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
              <li <?php echo active_link('search-jobs');?>><a href="<?php echo base_url('search-jobs');?>" title="Search Government jobs in USA">Search a Job</a> </li>
              <li <?php echo active_link('search-resume');?>><a href="<?php echo base_url('search-resume');?>" title="Search Resume">Search Resume</a></li>
              <li <?php echo active_link('contact-us');?>><a href="<?php echo base_url('contact-us');?>" title="Contact Us">Contact Us</a></li>
              <?php endif;?>
            </ul>
          </div>
        </div>
        <!--/.nav-collapse -->
        
        <div class="col-md-<?php echo ($this->session->userdata('is_user_login')==TRUE)?'4':'4';?>">
          <div class="usertopbtn">
		  <?php if($this->session->userdata('is_user_login')!=TRUE): ?>          
          <a href="<?php echo base_url('employer-signup');?>" class="lookingbtn">Employer</a>
          <a href="<?php echo base_url('jobseeker-signup');?>" class="hiringbtn">Job Seeker</a>
          <a href="<?php echo base_url('login');?>" class="loginBtn" title="Jobs openings">Login</a>
          <?php else:
			 $c_folder = ($this->session->userdata('is_employer')==TRUE)?'employer':'jobseeker';
		   ?>
          <a href="<?php echo base_url('user/logout');?>"  class="regBtn">Logout</a>
          <div class="pull-right loginusertxt">Welcome, <a href="<?php echo base_url($c_folder.'/dashboard');?>" class="username"><?php echo $this->session->userdata('first_name');?>!</a></div>
          <?php endif;?>
          <div class="clear"></div>
          </div>
        </div>
		
        <div class="clearfix"></div>
  </div>
</div>
