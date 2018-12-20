<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="<?php echo $param;?> Jobs" />
<meta name="description" content="<?php echo $param;?> Jobs ,Find best Jobs. Jobs at <?php echo SITE_NAME;?>." />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<!--Search Block-->
<div class="top-colSection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="candidatesection">          
          <div class="col-md-9">            
            <?php echo form_open_multipart('job_search',array('name' => 'jsearch', 'id' => 'jsearch'));?>            
            <div class="input-group">      
       		<input type="text" name="job_params" id="job_params" class="form-control" placeholder="Job title or Skill" value="<?php echo $param;?>" />
              <span class="input-group-btn">
                 <input type="submit" name="job_submit" class="btn" id="job_submit" value="Find" />
              </span>
            </div>            
            <?php echo form_close();?> </div>
            <div class="col-md-3">           
            <input type="submit" value="Upload Resume" title="job search engine" class="postjobbtn" alt="job search engine" onClick="document.location='<?php echo base_url('login');?>'" />
            <div class="clear"></div>
          </div>            
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--/Search Block--> 
<!--Latest Jobs Block-->
<div class="innerpageWrap">
<div class="container">
  <div class="row"> 
    
    <!--Left Col-->
    
    <?php 
  $col = '10';
	if($this->uri->segment(1)!='search'):
	if($result):
		$col = '7';
  		$this->load->view('common/left_job_search');
	endif;
	endif;
	?>
    
    <!--Mid Col-->
    
    <div class="searchjoblist col-md-<?php echo $col;?>"> 
      
      <!--Jobs List-->
      
      <div class="searchpage">
        <div class="toptitlebar">
          <div class="row">
            <div class="col-md-6"><b><?php echo $param;?> Jobs</b></div>
            <div class="col-md-6 text-right"><strong>Jobs <?php echo $from_record.' - '.$page;?> of <?php echo $total_rows;?></strong> </div>
          </div>
        </div>
        
        
        <ul class="searchlist">
        <!--Job Row-->
          
          <?php if($result):
		$CI =& get_instance();
				  			foreach($result as $row):
								$company_logo = ($row->company_logo)?$row->company_logo:'no_pic.jpg';
								if (!file_exists(realpath(APPPATH . '../public/uploads/employer/thumb/'.$company_logo))){
									$company_logo='no_pic.jpg';
								}
								$is_already_applied = $CI->is_already_applied_for_job($this->session->userdata('user_id'), $row->ID);		
				  ?>
          <li>
            <div class="row">
              <div class="col-md-2"><a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="thumbnail" title="<?php echo $row->job_title;?>"><img src="<?php echo base_url('public/uploads/employer/thumb/'.$company_logo);?>" alt="<?php echo base_url('company/'.$row->company_slug);?>" /></a></div>
              <div class="col-md-10">
                <div class="col-md-7"> <a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="jobtitle" title="<?php echo $row->job_title;?>"><?php echo word_limiter(strip_tags(str_replace('-',' ',$row->job_title)),7);?></a>
                  <div class="location"><a href="<?php echo base_url('company/'.$row->company_slug);?>" title="Jobs in <?php echo $row->company_name;?>"><?php echo $row->company_name;?></a> &nbsp;-&nbsp; <?php echo $row->city;?></div>
                  <div class="date"><?php echo date_formats($row->dated, 'M d, Y');?></div>
                </div>
                <div class="col-md-5">
                  <?php
			  	if($is_already_applied=='yes'):
			  ?>
                  <a href="javascript:;" class="applybtngray">Already Applied</a>
                  <?php else:?>
                  <a href="<?php echo base_url('jobs/'.$row->job_slug.'?apply=yes');?>" class="applybtn">Apply Now</a>
                  <?php endif;?>
                  
                </div>
                <div class="clearfix"> </div>               
              </div>              
            </div>
             <p><?php echo word_limiter(strip_tags(str_replace('-',' ',$row->job_description)),22);?></p>
          </li>
          <?php 
				  			endforeach;
							else: ?>
          <div class="err" align="center">
            <p><strong> <?php echo ($param=='')?'Please enter keywords above to display the relevant opened jobs.':'Sorry, no record found';?> </strong></p>
          </div>
          <?php endif;?>
        </ul>
      </div>
      
      <!--Pagination-->
      
      <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
    </div>
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
</div>
<!--/Latest Jobs Block-->
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>