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
<div class="container innerpages">
 
 <?php $this->load->view('common/bottom_ads');?>
  <div class="row"> 
    
    <!--Signup-->
    <div class="col-md-6 col-md-offset-3">
    <!--Login-->
    <form name="forgot_form" id="forgot_form" action="" method="post">
      <div class="loginbox">
        <h3>Account Recovery</h3>
        <?php if($msg):?>
        <div class="alert alert-danger"><?php echo $msg;?></div>
        <?php endif;?>
        <?php echo validation_errors(); ?> <?php echo $this->session->flashdata('msg');?>
        <div class="row">
          <div class="col-md-3">
            <label class="input-group-addon">Email <span>*</span></label>
          </div>
          <div class="col-md-9">
            <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="input-group-addon">Please enter: <?php echo $cpt_code;?> in the text box below:</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="input-group-addon"></label>
          </div>
          <div class="col-md-9">
            <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Verification Code" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-9">
            <input type="submit" value="Recover Password" class="btn btn-success" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-9">Already a member? <a href="<?php echo base_url('login');?>">Click Here</a></div>
        </div>
      </div>
    </form>
    <!--/Login-->
    
      <div class="signupbox">
        <h4>Not a member yet? Click Below to Sign Up</h4>
        <a href="<?php echo base_url('jobseeker-signup');?>" class="btn btn-success">Sign Up Now</a>
        <div class="clear"></div>
      </div>
    </div>
    <!--/Signup-->   
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>