<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="">
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


<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<!-- FlexSlider --> 
<script src="<?php echo base_url('public/js/jquery.flexslider.js');?>" type="text/javascript"></script> 
<script>
// Can also be used with $(document).ready()
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 250,
    minItems: 1,
    maxItems: 1
  });
});
</script>
</body>
</html>