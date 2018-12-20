<ul class="featurlist">
      <li><a href="<?php echo base_url('jobseeker/my_account');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'my_account');?>"><i class="fa fa-user"></i> <span>Manage Account</span></a></li>
      <li><a href="<?php echo base_url('jobseeker/cv_manager');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'cv_manager');?> <?php echo is_active_like($this->uri->segment(2),'cv_builder');?>"><i class="fa fa-users"></i> <span>My Resume</span></a></li>
      <li><a href="<?php echo base_url('jobseeker/my_jobs');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'my_jobs');?>"><i class="fa fa-file-text-o"></i> <span>My Applications</span></a></li>
      <li><a href="<?php echo base_url('jobseeker/add_skills');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'add_skills');?>"><i class="fa fa-users"></i> <span>Manage Skills</span></a></li>
      <li><a href="<?php echo base_url('jobseeker/change_password');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'change_password');?>"><i class="fa fa-lock"></i> <span>Change Password</span></a></li>
      <div class="clear"></div>
    </ul>