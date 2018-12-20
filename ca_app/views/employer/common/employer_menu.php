<ul class="featurlist">
      <li><a href="<?php echo base_url('employer/dashboard');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'dashboard');?>"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
      <li><a href="<?php echo base_url('employer/edit_company');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'edit_company');?>"><i class="fa fa-users"></i> <span>Company Profile</span></a></li>
      
      <li><a href="<?php echo base_url('employer/post_new_job');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'post_new_job');?>"><i class="fa fa-file-text-o"></i> <span>Post New Job</span></a></li>
        
      <li><a href="<?php echo base_url('employer/my_posted_jobs');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'my_posted_jobs');?>"><i class="fa fa-cogs"></i> <span>Manage My Jobs</span></a></li>
      
      <li><a href="<?php echo base_url('employer/job_applications');?>" class="innerfetbox <?php echo is_active_like($this->uri->segment(2),'job_applications');?>"><i class="fa fa-users"></i> <span>View Candidates</span></a></li>
      
      <li><a href="<?php echo base_url('search-resume');?>" class="innerfetbox"><i class="fa fa-search"></i> <span>Resume Search</span></a></li>
      
      <li><a href="<?php echo base_url('employer/change_password');?>" class="innerfetbox" <?php echo is_active_like($this->uri->segment(2),'change_password');?>><i class="fa fa-lock"></i> <span>Password Change</span></a></li>      
      <div class="clear"></div>
</ul>