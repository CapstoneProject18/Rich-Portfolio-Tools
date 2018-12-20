<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
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
<div class="row"> <?php echo form_open_multipart('jobseeker_signup',array('name' => 'seeker_form', 'id' => 'seeker_form', 'onSubmit' => 'return validate_form(this);'));?>
  <div class="col-md-10">
    <h2> Create New Account</h2>
    <!--Account info-->
    <div class="formwraper">
      <div class="titlehead">Account Information</div>
      <div class="formint">
        <div class="input-group <?php echo (form_error('email'))?'has-error':'';?>">
          <label class="input-group-addon">Email <span>*</span></label>
          <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>" maxlength="150">
          <?php echo form_error('email'); ?> </div>
        <div class="input-group <?php echo (form_error('pass'))?'has-error':'';?>">
          <label class="input-group-addon">Password <span>*</span></label>
          <input name="pass" type="password" class="form-control" id="pass" autocomplete="off" placeholder="Password" value="<?php echo set_value('pass'); ?>" maxlength="100">
          <?php echo form_error('pass'); ?> </div>
        <div class="input-group <?php echo (form_error('confirm_pass'))?'has-error':'';?>">
          <label class="input-group-addon">Confirm Password <span>*</span></label>
          <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" value="<?php echo set_value('confirm_pass'); ?>" maxlength="100">
          <?php echo form_error('confirm_pass'); ?> </div>
      </div>
    </div>
    
    <!--Personal info-->
    <div class="formwraper">
      <div class="titlehead">Personal Information</div>
      <div class="formint">
        <div class="input-group <?php echo (form_error('full_name'))?'has-error':'';?>">
          <label class="input-group-addon">Full Name <span>*</span></label>
          <input name="full_name" type="text" class="form-control" id="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" maxlength="40">
          <?php echo form_error('full_name'); ?> </div>
        <div class="input-group <?php echo (form_error('gender'))?'has-error':'';?>">
          <label class="input-group-addon">Gender <span>*</span></label>
          <select class="form-control" name="gender" id="gender">
            <option value="male" <?php echo (set_value('gender')=='male')?'selected':''; ?>>Male</option>
            <option value="female" <?php echo (set_value('gender')=='female')?'selected':''; ?>>Female</option>
          </select>
          <?php echo form_error('gender'); ?> </div>
        <div class="input-group <?php echo (form_error('dob_day'))?'has-error':'';?>">
          <label class="input-group-addon">Date of Birth <span>*</span></label>
          <select class="form-control" name="dob_day" id="dob_day">
            <option value="">Day</option>
            <?php 
			  	for($dy=1;$dy<=31;$dy++):
				$day =sprintf("%02s", $dy);
              	$selected = (set_value('dob_day')==$day)?'selected="selected"':'';
			  ?>
            <option value="<?php echo $day;?>" <?php echo $selected;?>><?php echo $day;?></option>
            <?php endfor;?>
          </select>
          <select class="form-control" name="dob_month" id="dob_month">
            <option value="">Month</option>
            <?php for($mnth=1;$mnth<=12;$mnth++):
			  	$month =sprintf("%02s", $mnth);
				$dummy_date = '2014-'.$month.'-'.'01';
			  	$selected = (set_value('dob_month')==$month)?'selected="selected"':'';
			  ?>
            <option value="<?php echo $month;?>" <?php echo $selected;?>><?php echo date("M", strtotime($dummy_date));?></option>
            <?php endfor;?>
          </select>
          <select class="form-control" name="dob_year" id="dob_year">
            <option value="">Year</option>
            <?php for($year=date("Y")-10;$year>=1901;$year--):
			  	$selected = (set_value('dob_year')==$year)?'selected="selected"':'';
				if((set_value('dob_year')=='' && $year=='1980')){
					$selected = 'selected="selected"';
				}
			  ?>
            <option value="<?php echo $year;?>" <?php echo $selected;?>><?php echo $year;?></option>
            <?php endfor;?>
          </select>
          <?php echo form_error('dob_day'); echo form_error('dob_month'); echo form_error('dob_month'); ?> </div>
        <div class="input-group <?php echo (form_error('current_address'))?'has-error':'';?>">
          <label class="input-group-addon">Current Address <span>*</span></label>
          <textarea class="form-control" name="current_address" id="current_address" ><?php echo set_value('current_address'); ?></textarea>
          <?php echo form_error('current_address'); ?> </div>
        <div class="input-group <?php echo (form_error('country'))?'has-error':'';?>">
          <label class="input-group-addon">Location <span>*</span></label>
          <select name="country" id="country" class="form-control" style="width:50%">
            <?php 
					foreach($result_countries as $row_country):
						$selected = (set_value('country')==$row_country->country_name)?'selected="selected"':'';
						
						
						
				?>
            <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
            <?php endforeach;?>
          </select>
          <?php echo form_error('country'); ?>
         
          <div class="demo">
            <input name="city" type="text" class="form-control" id="city_text" style="max-width:165px; " value="<?php echo set_value("city"); ?>" maxlength="50">
          </div>
          
          <?php echo form_error('city'); ?> </div>
        <div class="input-group <?php echo (form_error('nationality'))?'has-error':'';?>">
          <label class="input-group-addon" name="nationality" id="nationality">Nationality <span>*</span></label>
          <select class="form-control" name="nationality" id="nationality" style="width:100%;">
            <?php foreach($result_countries as $row_country): 
			  if($row_country->country_citizen!=''):
			  			$selected = (set_value('nationality')==$row_country->country_citizen)?'selected="selected"':'';
						
			  ?>
            <option value="<?php echo $row_country->country_citizen;?>" <?php echo $selected;?>><?php echo $row_country->country_citizen;?></option>
            <?php endif; endforeach;?>
          </select>
          <?php echo form_error('nationality'); ?> </div>
        <div class="input-group <?php echo (form_error('mobile_number'))?'has-error':'';?>">
          <label class="input-group-addon">Mobile Phone <span>*</span></label>
          <input name="mobile_number" type="text" class="form-control" id="mobile_number" value="<?php echo set_value('mobile_number'); ?>" maxlength="15" />
          <?php echo form_error('mobile_number'); ?> </div>
        <div class="input-group">
          <label class="input-group-addon">Home Phone</label>
          <input name="phone" type="text" class="form-control" id="phone" value="<?php echo set_value('phone'); ?>" maxlength="15">
        </div>
      </div>
    </div>
    
    <!--Professional info-->
    <div class="formwraper">
      <div class="titlehead">Upload Resume</div>
      <div class="formint">
        <div class="input-group <?php echo (form_error('cv_file') || $msg)?'has-error':'';?>">
          <label class="input-group-addon">Upload Resume <span>*</span></label>
          <input type="file" class="form-control" name="cv_file" id="cv_file" value="<?php echo set_value('cv_file'); ?>" />
          <p>Upload files only in .doc, .docx or .pdf format with maximum size of 6 MB.</p>
          <?php 
					echo form_error('cv_file'); 
					echo ($msg!='')?'<div class="alert alert-error"> <a class="close" data-dismiss="alert">×</a>'.$msg.'</div>':'';
			?>
        </div>
        <div class="formsparator">

          <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Sign Up" class="btn btn-success" />
          </div>
        </div>
      </div>
    </div>
    <!--/Job Detail--> 
    <?php echo form_close();?>    
  </div>
  
  <?php $this->load->view('common/right_ads');?>
  
</div>
<?php $this->load->view('common/bottom_ads');?>
</div>
</div>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/validate_jobseeker.js');?>" type="text/javascript"></script> 
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
