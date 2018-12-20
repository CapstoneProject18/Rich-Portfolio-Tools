<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title>Page not found</title>
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
    <div class="col-md-12"><!--Job Detail-->
      
      <div class="row">
        <div class="col-md-12 text-center"><a href="<?php echo base_url();?>"><img src="<?php echo base_url() ;?>/public/images/not-found.jpg" /></a></div>
      </div>
    </div>
    <!--/Job Detail--> 
    
  </div>
</div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>