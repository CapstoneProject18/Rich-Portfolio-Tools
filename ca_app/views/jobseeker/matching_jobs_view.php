<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<!--Detail Info-->
<div class="container detailinfo">
  <div class="row">
    	<div class="col-md-3">
     <div class="dashiconwrp">
    <?php $this->load->view('jobseeker/common/jobseeker_menu'); ?>
  </div>
  </div>
    
    <div class="col-md-9"><!--Job Detail-->
    
      <div class="formwraper">
        <div class="titlehead">
          <div class="row">
            <div class="col-md-12"><b>Matching Jobs</b></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="row searchlist"> 
        <!--Job Row-->
        <?php if($result):
		$CI =& get_instance();
				  			foreach($result as $row):
								$company_logo = ($row->company_logo)?$row->company_logo:'no_logo.jpg';
								$is_already_applied = $CI->is_already_applied_for_job($this->session->userdata('user_id'), $row->ID);		
				  ?>
        <div class="col-md-12">
          <div class="intlist">
            <div class="col-md-2"><a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="thumbnail" title="<?php echo $row->job_title;?>"><img src="<?php echo base_url('public/uploads/employer/thumb/'.$company_logo);?>" alt="<?php echo base_url('company/'.$row->company_slug);?>" /></a></div>
            <div class="col-md-10">
              <div class="col-md-7"> <a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="jobtitle" title="<?php echo $row->job_title;?>"><?php echo word_limiter(strip_tags(str_replace('-',' ',$row->job_title)),7);?></a>
                <div class="location"><a href="<?php echo base_url('company/'.$row->company_slug);?>" title="Jobs in <?php echo $row->company_name;?>"><?php echo $row->company_name;?></a> &nbsp;-&nbsp; <?php echo $row->city;?></div>
              </div>
              <div class="col-md-5">
              <?php
			  	if($is_already_applied=='yes'):
			  ?> 
              	<a href="javascript:;" class="applybtngray">Already Applied</a>
              <?php else:?>
              	<a href="<?php echo base_url('jobs/'.$row->job_slug.'?apply=yes');?>" class="applybtn">Apply Now</a>
              
              <?php endif;?>
             
                <div class="date"><?php echo date_formats($row->dated, 'M d, Y');?></div>
              </div>
              <div class="clear"> </div>
              <p><?php echo word_limiter(strip_tags(str_replace('-',' ',$row->job_description)),22);?></p>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <?php 
				  			endforeach;
							else: ?>
        <div class="err" align="center">
          <p><strong> <?php echo 'No matching job found.';?> </strong></p>
        </div>
        <?php endif;?>
      </div>
      </div>
    </div>
    <!--/Job Detail--> 
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>