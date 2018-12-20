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
<div class="container detailinfo">
  <div class="row"> <?php echo form_open_multipart('contact_us',array('name' => 'frm_contact_us', 'id' => 'frm_contact_us', 'onSubmit' => 'return validate_contact_form(this);'));?>
    <div class="col-md-10">
      <p></p>
      <h2> Contact Us</h2>
      <!--Account info-->
		<?php echo $this->session->flashdata('success_msg');?>
      <!--Professional info-->
      <div class="formwraper">
        <div class="titlehead">Job Portal Support Form</div>
        <div class="formint">
          <div class="input-group <?php echo (form_error('full_name') || $msg)?'has-error':'';?>">
            <label class="input-group-addon">Your Full Name <span>*</span></label>
            <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo set_value('full_name'); ?>" />
            <?php echo form_error('full_name'); ?>
          </div>
          
          <div class="input-group <?php echo (form_error('email') || $msg)?'has-error':'';?>">
            <label class="input-group-addon">Your Email Address <span>*</span></label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" />
            <?php echo form_error('email'); ?>
          </div>
          
          <div class="input-group <?php echo (form_error('phone') || $msg)?'has-error':'';?>">
            <label class="input-group-addon">Your Phone Number <span>*</span></label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" />
            <?php echo form_error('phone'); ?>
          </div>
          
          <div class="input-group <?php echo (form_error('phone') || $msg)?'has-error':'';?>">
            <label class="input-group-addon">City </label>
            <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city'); ?>" />
            <?php echo form_error('city'); ?>
          </div>
          
          <div class="input-group <?php echo (form_error('message') || $msg)?'has-error':'';?>">
            <label class="input-group-addon">Message / Question<span>*</span></label>
            <textarea name="message" id="message" class="form-control" rows="8"><?php echo set_value('message'); ?></textarea>
            
            <?php echo form_error('message'); ?>
          </div>
          
          <div class="formsparator">
          </div>
          <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Submit" class="btn btn-success" />
          </div>
        </div>
      </div>
    </div>
    <!--/Job Detail--> 
    <?php echo form_close();?>
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?> 
</body>
</html>
