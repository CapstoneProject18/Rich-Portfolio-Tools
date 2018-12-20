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
  <div class="row"> <?php echo form_open_multipart('employer_signup',array('name' => 'emp_form', 'id' => 'emp_form', 'onSubmit' => 'return validate_employer_form(this);'));?>
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
          <div class="input-group <?php echo (form_error('pass_code'))?'has-error':'';?>">
            <label class="input-group-addon">Password <span>*</span></label>
            <input name="pass" type="password" class="form-control" id="pass" placeholder="Password" value="<?php echo set_value('pass_code'); ?>" maxlength="100">
            <?php echo form_error('pass_code'); ?> </div>
          <div class="input-group <?php echo (form_error('confirm_pass'))?'has-error':'';?>">
            <label class="input-group-addon">Confirm Password <span>*</span></label>
            <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" value="<?php echo set_value('confirm_pass'); ?>" maxlength="100">
            <?php echo form_error('confirm_pass'); ?> </div>
        </div>
      </div>
      
      <!--Personal info-->
      <div class="formwraper">
        <div class="titlehead">Company Information</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('full_name'))?'has-error':'';?>">
            <label class="input-group-addon">Your Name <span>*</span></label>
            <input name="full_name" type="text" class="form-control" id="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" maxlength="40">
            <?php echo form_error('full_name'); ?> </div>
          <div class="input-group <?php echo (form_error('company_name'))?'has-error':'';?>">
            <label class="input-group-addon">Company Name <span>*</span></label>
            <input name="company_name" type="text" class="form-control" id="company_name" value="<?php echo set_value('company_name'); ?>" maxlength="50" />
            <?php echo form_error('company_name'); ?> </div>
          
          <div class="input-group <?php echo (form_error('industry_id'))?'has-error':'';?>">
            <label class="input-group-addon">Industry <span>*</span></label>
            <select name="industry_id" id="industry_id" class="form-control" style="max-width:350px;">
              <option value="" selected>Select Industry</option>
              <?php foreach($result_industries as $row_industry):
				  			$selected = (set_value('industry_id')==$row_industry->ID)?'selected="selected"':'';
				  ?>
              <option value="<?php echo $row_industry->ID;?>" <?php echo $selected;?>><?php echo $row_industry->industry_name;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('industry_id'); ?> </div>
          
          <div class="input-group <?php echo (form_error('ownership_type'))?'has-error':'';?>">
            <label class="input-group-addon">Org. Type </label>
            <select class="form-control" name="ownership_type" id="ownership_type">
              <option value="Private">Private</option>
              <option value="Public">Public</option>
              <option value="Government">Government</option>
              <option value="Semi-Government">Semi-Government</option>
              <option value="NGO">NGO</option>
            </select>
            <?php echo form_error('ownership_type'); ?> </div>
          
          <div class="input-group <?php echo (form_error('company_location'))?'has-error':'';?>">
            <label class="input-group-addon">Address <span>*</span></label>
            <textarea class="form-control" name="company_location" id="company_location" ><?php echo set_value('company_location'); ?></textarea>
            <?php echo form_error('company_location'); ?> </div>
          
          <div class="input-group <?php echo (form_error('country'))?'has-error':'';?>">
            <label class="input-group-addon">Location <span>*</span></label>
            <select name="country" id="country" class="form-control" onChange="grab_cities_by_country(this.value);" style="width:50%">
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
          
          <div class="input-group <?php echo (form_error('company_phone'))?'has-error':'';?>">
            <label class="input-group-addon">Landline Phone <span>*</span></label>
            <input type="phone" class="form-control" name="company_phone" id="company_phone" value="<?php echo set_value('company_phone'); ?>" maxlength="20" />
            <?php echo form_error('company_phone'); ?> </div>
          
          <div class="input-group <?php echo (form_error('mobile_phone'))?'has-error':'';?>">
            <label class="input-group-addon">Cell Phone <span>*</span></label>
            <input name="mobile_phone" type="text" class="custom-control" id="mobile_phone" value="<?php echo set_value('mobile_phone'); ?>" maxlength="15" />
            <?php echo form_error('mobile_phone'); ?> </div>
          
          <div class="input-group <?php echo (form_error('company_website'))?'has-error':'';?>">
            <label class="input-group-addon">Company Website <span>*</span></label>
            <input name="company_website" type="text" class="form-control" id="company_website" value="<?php echo set_value('company_website'); ?>" maxlength="155">
            <?php echo form_error('company_website'); ?> </div>
          
          
          <div class="input-group <?php echo (form_error('no_of_employees'))?'has-error':'';?>">
            <label class="input-group-addon">No. of Employees <span>*</span></label>
            <select name="no_of_employees" id="no_of_employees" class="form-control">
              <option value="1-10" <?php echo (set_value('no_of_employees')=='1-10')?'selected':''; ?>>1-10</option>
              <option value="11-50" <?php echo (set_value('no_of_employees')=='11-50')?'selected':''; ?>>11-50</option>
              <option value="51-100" <?php echo (set_value('no_of_employees')=='51-100')?'selected':''; ?>>51-100</option>
              <option value="101-300" <?php echo (set_value('no_of_employees')=='101-300')?'selected':''; ?>>101-300</option>
              <option value="301-600" <?php echo (set_value('no_of_employees')=='301-600')?'selected':''; ?>>301-600</option>
              <option value="601-1000" <?php echo (set_value('no_of_employees')=='601-1000')?'selected':''; ?>>601-1000</option>
              <option value="1001-1500" <?php echo (set_value('no_of_employees')=='1001-1500')?'selected':''; ?>>1001-1500</option>
              <option value="1501-2000" <?php echo (set_value('no_of_employees')=='1501-2000')?'selected':''; ?>>1501-2000</option>
              <option value="More than 2000" <?php echo (set_value('no_of_employees')=='More than 2000')?'selected':''; ?>>More than 2000</option>
            </select>
            <?php echo form_error('no_of_employees'); ?> </div>
          
          <div class="input-group <?php echo (form_error('company_description'))?'has-error':'';?>">
            <label class="input-group-addon">Company Description <span>*</span></label>
            <textarea class="form-control" name="company_description" id="company_description" ><?php echo set_value('company_description'); ?></textarea>
            <?php echo form_error('company_description'); ?> </div>
          
          <div class="input-group <?php echo (form_error('company_logo'))?'has-error':'';?>">
            <label class="input-group-addon">Company Logo <span>*</span></label>
            <input type="file" class="form-control" name="company_logo" id="company_logo" accept="image/*" />
            <p>Upload files only in .jpg, .jpeg, .gif or .png format with max size of 6 MB.</p>
            <?php echo form_error('company_logo'); ?> </div>
          
			 <div class="formsparator">
            <div class="input-group">
             </div>
              </div>
          <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Sign Up" class="btn btn-success" />
          </div>
          
          
        </div>
      </div>
      
      <!--Professional info-->
      
    </div>
    <!--/Job Detail--> 
    <?php echo form_close();?>
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url('public/js/bad_words.js'); ?>"></script>
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