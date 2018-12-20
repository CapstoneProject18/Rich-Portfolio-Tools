<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<link href="<?php echo base_url('public/css/jquery-ui.css');?>" rel="stylesheet" type="text/css" />
<?php $this->load->view('common/before_head_close'); ?>
<link rel="stylesheet" href="http://jquery-ui.googlecode.com/svn/tags/1.8.7/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url('public/autocomplete/demo.css'); ?>">
<style>
.ui-button {
	margin-left: -1px;
}
.ui-button-icon-only .ui-button-text {
	padding: 0.35em;
}
.ui-autocomplete-input {
	margin: 0;
	padding: 0.48em 0 0.47em 0.45em;
}
</style>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
  <div class="row">
  <div class="col-md-3">
  <div class="dashiconwrp">
    <?php $this->load->view('employer/common/employer_menu');?>
  </div>
  </div>
  
  
  <?php echo form_open_multipart('employer/edit_personal_profile',array('name' => 'emp_personal_form', 'id' => 'emp_personal_form', 'onSubmit' => 'return validate_employer_personal_form(this);'));?>
    <div class="col-md-9"> 
    <?php echo $this->session->flashdata('msg');?>
      <!--Personal info-->
      <div class="formwraper">
        <div class="titlehead">Personal Information</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('full_name'))?'has-error':'';?>">
            <label class="input-group-addon">Full Name <span>*</span></label>
            <input name="full_name" type="text" class="form-control" id="full_name" placeholder="Full Name" value="<?php echo $row->first_name.' '.$row->last_name; ?>" maxlength="40">
            <?php echo form_error('full_name'); ?> </div>
          <div class="input-group <?php echo (form_error('dob_day'))?'has-error':'';?>">
            <label class="input-group-addon">Date of Birth <span>*</span></label>
            <select class="form-control" name="dob_day" id="dob_day">
              <option value="">Day</option>
              <?php 
			  	$dob = explode('-', $row->dob);
			  	for($dy=1;$dy<=31;$dy++):
				$day =sprintf("%02s", $dy);
              	$selected = ($dob[2]==$day)?'selected="selected"':'';
			  ?>
              <option value="<?php echo $day;?>" <?php echo $selected;?>><?php echo $day;?></option>
              <?php endfor;?>
            </select>
            <select class="form-control" name="dob_month" id="dob_month">
              <option value="">Month</option>
              <?php for($mnth=1;$mnth<=12;$mnth++):
			  	$month =sprintf("%02s", $mnth);
			  	$selected = ($dob[1]==$month)?'selected="selected"':'';
				$dummy_date = '2014-'.$month.'-'.'01';
			  ?>
              <option value="<?php echo $month;?>" <?php echo $selected;?>><?php echo date("M", strtotime($dummy_date));?></option>
              <?php endfor;?>
            </select>
            <select class="form-control" name="dob_year" id="dob_year">
              <option value="">Year</option>
              <?php for($year=date("Y")-10;$year>=1901;$year--):
			  	$selected = ($dob[0]==$year)?'selected="selected"':'';
				if(($dob[0]=='' && $year=='1980')){
					$selected = 'selected="selected"';
				}
			  ?>
              <option value="<?php echo $year;?>" <?php echo $selected;?>><?php echo $year;?></option>
              <?php endfor;?>
            </select>
            <?php echo form_error('dob_day'); echo form_error('dob_month'); echo form_error('dob_month'); ?> </div>
          <div class="input-group <?php echo (form_error('country'))?'has-error':'';?>">
            <label class="input-group-addon">Location <span>*</span></label>
            <select name="country" id="country" class="form-control" onChange="grab_cities_by_country(this.value);" style="width:50%">
              <?php 
					foreach($result_countries as $row_country):
						$selected = ($row->country==$row_country->country_name)?'selected="selected"':'';
						
				?>
              <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('country'); ?>
        
            
            <input name="city" type="text" class="form-control" id="city_text" style="max-width:165px;" value="<?php echo $row->city; ?>" maxlength="50">
            <?php echo form_error('city'); ?> </div>
          <div class="input-group <?php echo (form_error('mobile_phone'))?'has-error':'';?>">
            <label class="input-group-addon">Mobile Phone <span>*</span></label>
            <input name="mobile_phone" type="text" class="custom-control" id="mobile_phone" value="<?php echo $row->mobile_phone; ?>" maxlength="15" />
            <?php echo form_error('mobile_phone'); ?> </div>
          <div class="input-group">
            <label class="input-group-addon">Home Phone</label>
            <input name="home_phone" type="text" class="custom-control" id="home_phone" value="<?php echo $row->home_phone; ?>" maxlength="15">
          </div>
          <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Update" class="btn btn-success" />
          </div>
        </div>
      </div>
    </div>
    <!--/Job Detail--> 
    <?php echo form_close();?>
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/validate_employer.js');?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery-1.4.4.js'); ?>"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery.ui.core.js'); ?>"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery.ui.widget.js'); ?>"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery.ui.button.js'); ?>"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery.ui.position.js'); ?>"></script> 
<script src="<?php echo base_url('public/autocomplete/jquery.ui.autocomplete.js'); ?>"></script> 
<script type="text/javascript"> var cy = '<?php echo set_value('country');?>'; </script>
<script src="<?php echo base_url('public/autocomplete/action-js.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('button').css('display','none');
	if(cy!='USA' && cy!='')
		$(".ui-autocomplete-input.ui-widget.ui-widget-content.ui-corner-left").css('display','none');
});
</script>
</body>
</html>