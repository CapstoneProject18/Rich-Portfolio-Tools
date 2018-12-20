<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<link href="<?php echo base_url('public/css/jquery-ui.css');?>" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
<div class="row">
<div class="col-md-10">
<div><?php echo $this->session->flashdata('msg');?></div>
<div class="dashiconwrp">
    <?php $this->load->view('jobseeker/common/jobseeker_menu'); ?>
  </div>
<!--CV Builder-->
<!--<div class="cvtopWraper">
  <h2>Additional CV Sections</h2>
  <div class="row">
    <div class="col-md-12">
      <ul class="cvadonslist">
        <li><a href="#">Languages</a></li>
        <li><a href="#">Military History</a></li>
        <li><a href="#">Patent History</a></li>
        <li><a href="#">Publication History</a></li>
        <li><a href="#">References</a></li>
        <li><a href="#">Volunteer</a></li>
        <li><a href="#">Speech History</a></li>
        <li><a href="#">Achievement / Awards</a></li>
        <li><a href="#">Hobbies / Activities</a></li>
        <div class="clearfix"></div>
      </ul>
    </div>
  </div>
</div>-->
<!--Basic-->
<div class="cvBuildWrap">
<!--Basic-->
<div class="vBasicBox">
  <div class="username"><?php echo $row->first_name.' '.$row->last_name;?></div>
  <div class="row">
    <div class="action"> <a href="javascript:;" title="Edit" id="edit_jobseeker_profile" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> </div>
    <div class="col-md-2"><img src="<?php echo base_url('public/uploads/candidate/'.$photo);?>"></div>
    <div class="col-md-10">
      <div class="txtfont"><?php echo $row->city.', '.$row->country;?></div>
      <div class="txtfont">Phone: <?php echo $row->mobile;?></div>
      <div class="txtfont">Email: <?php echo $row->email;?></div>
    </div>
  </div>
</div>
<!--Education-->
<div class="vBasicBox">
  <div class="action"> <a href="javascript:;" id="add_education" title="Add Another" class="green-ico"><i class="fa fa-plus-square-o">&nbsp;</i></a> </div>
  <div class="username">EDUCATION AND QUALIFICATION</div>
  <ul class="edurowlist">
  <?php 
		if($result_qualification):
			foreach($result_qualification as $row_qualification):
  ?>
    <li  id="edu_<?php echo $row_qualification->ID;?>">
      <div class="action"> <a href="javascript:;" onClick="load_edit_js_edu(<?php echo $row_qualification->ID;?>);" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="javascript:;" onClick="del_edu(<?php echo $row_qualification->ID;?>);"title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a> </div>
      <div class="txtfont"><?php echo $row_qualification->degree_title;?></div>
      <strong><?php echo $row_qualification->institude;?></strong>
      <div class="loctxt"><?php echo $row_qualification->city;?>, <?php echo $row_qualification->country;?></div>
    </li>
	<?php endforeach; endif;?>
  </ul>
</div>
<!--PROFESSIONAL EXPERIENCE-->
<div class="vBasicBox">
  <div class="action"> <a href="javascript:;" id="add_exp" title="Add Another" class="green-ico"><i class="fa fa-plus-square-o">&nbsp;</i></a> </div>
  <div class="username">PROFESSIONAL EXPERIENCE</div>
  <ul class="edurowlist">
   <?php 
			if($result_experience):
				foreach($result_experience as $row_experience):
				$date_to = ($row_experience->end_date)?date_formats($row_experience->end_date, 'M Y'):'Present';
		?>
    <li id="exp_<?php echo $row_experience->ID;?>">
      <div class="action"><a href="javascript:;" onClick="load_edit_js_exp(<?php echo $row_experience->ID;?>);" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="javascript:;" onClick="del_exp(<?php echo $row_experience->ID;?>);" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a> </div>
      <strong> <?php echo $row_experience->company_name;?></strong>
      <div class="loctxt"><?php echo $row_experience->city;?>, <?php echo $row_experience->country;?></div>
      <div class="txtfont"><?php echo $row_experience->job_title;?></div>
      <div class="txtfont">Duration: <?php echo date_formats($row_experience->start_date, 'M Y');?> to <?php echo $date_to;?></div>
    </li>
    <?php endforeach; endif;?>
    
  </ul>
</div>
<!--PROJECTS-->
<!--<div class="vBasicBox">
<div class="action"> <a href="#" title="Add Another" class="green-ico"><i class="fa fa-plus-square-o">&nbsp;</i></a> </div>
<div class="username">PROJECTS</div>
<ul class="edurowlist">
<li>
  <div class="action"> <a href="#" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="#" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a> </div>
  <strong>Job Portal</strong>
  <div class="loctxt">Apr 2014</div>
  <div class="txtfont"><a href="http://www.samplesite.com">http://www.samplesite.com</a></div>
  <div class="txtfont">Thanks for floating the idea of hiring through Job Portal. I am glad to inform that I received an amazing response for hiring my IT</div>
</li>
<li>
  <div class="action"> <a href="#" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="#" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a> </div>
  <strong>Job Portal</strong>
  <div class="loctxt">Apr 2014</div>
  <div class="txtfont"><a href="http://www.samplesite.com">http://www.samplesite.com</a></div>
  <div class="txtfont">Thanks for floating the idea of hiring through Job Portal. I am glad to inform that I received an amazing response for hiring my IT</div>
</li>
<li>
  <div class="action"> <a href="#" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="#" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a> </div>
  <strong>Job Portal</strong>
  <div class="loctxt">Apr 2014</div>
  <div class="txtfont"><a href="http://www.samplesite.com">http://www.samplesite.com</a></div>
  <div class="txtfont">Thanks for floating the idea of hiring through Job Portal. I am glad to inform that I received an amazing response for hiring my IT</div>
</li>
</div>-->
</div>
</div>
<!--/CV Builder-->
<?php $this->load->view('common/right_ads');?>
</div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('jobseeker/common/jobseekes_popup_forms'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/jquery-ui.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/validate_jobseeker.js');?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$( "#start_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#end_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#ed_start_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$( "#ed_end_date" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
	
  });
</script>
</body>
</html>
