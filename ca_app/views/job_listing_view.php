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
<!--Search Block-->
  <div class="top-colSection">
  <div class="container">
    <div class="row">
      <?php $this->load->view('common/home_search');?>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--/Search Block--> 
<!--Latest Jobs Block-->
<div class="container"> 
  <!--Left Col-->
  <?php $this->load->view('common/left_job_search');?>
  <!--Mid Col-->
  <div class="searchjoblist col-md-10"> 
    <!--Jobs List-->
    <div class="boxwraper">
      <div class="titlebar">
        <div class="row">
          <div class="col-md-6"><b>Latest Jobs</b></div>
          <div class="col-md-6 text-right"><strong>Jobs <?php echo $from_record.' - '.$page*20;?> of <?php echo $total_rows;?></strong> </div>
        </div>
      </div>
      <div class="row searchlist"> 
        <!--Job Row-->
        <?php if($result):
				foreach($result as $row):
				$company_logo = ($row->company_logo)?$row->company_logo:'no_pic.jpg';
				if (!file_exists(realpath(APPPATH . '../public/uploads/employer/thumb/'.$company_logo))){
					$company_logo='no_pic.jpg';
				}
				
				$is_already_applied = $this->is_already_applied($this->session->userdata('user_id'), $job_id);
		?>
        <div class="col-md-12">
          <div class="intlist">
            <div class="col-md-2"><a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="thumbnail"><img src="<?php echo base_url('public/uploads/employer/thumb/'.$company_logo);?>" alt="<?php echo $row->company_name;?>" alt="<?php echo base_url('company/'.$row->company_slug);?>" /></a></div>
            <div class="col-md-10">
              <div class="col-md-8"> <a href="<?php echo base_url('jobs/'.$row->job_slug);?>" class="jobtitle"><?php echo word_limiter(strip_tags($row->job_title),7);?></a>
                <div class="location"><a href="<?php echo base_url('company/'.$row->company_slug);?>"><?php echo $row->company_name;?></a> &nbsp;-&nbsp; <?php echo $row->city;?></div>
              </div>
              <div class="col-md-4"> 
              <?php
			  	$apply_class = ($is_already_applied=='yes')?'applybtngray':'applybtn';
			  ?>
              <a href="<?php echo ($is_already_applied=='yes')?base_url('jobs/'.$row->job_slug.'?apply=yes'):'javascript:;';?>" class="<?php echo $apply_class;?>">Apply Now</a>
              
                <div class="date"><?php echo date_formats($row->dated, 'M d, Y');?></div>
              </div>
              <div class="clear"> </div>
              <p><?php echo word_limiter(strip_tags($row->job_description),33);?></p>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <?php 
				  endforeach;
			  endif;?>
      </div>
    </div>
    <!--Pagination-->
    <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
  </div>
</div>
<!--/Latest Jobs Block--> 
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>