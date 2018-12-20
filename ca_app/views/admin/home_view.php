<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
</head>
<body>
<div class="loginwrap">
  <div class="loginfrm">
    <img src="<?php echo base_url('public/images/admin_images/jobportal-logo.png');?>" class="mainlogologin">
     <div class="err"><?php echo $msg;?></div>
    <form method="post" action="">
      <div class="formwrp">
        <label>Username</label>
        <input name="username" class="frmfield" id="username" type="text">
        <?php echo form_error('username', '<div class="err"><span>', '</span></div>'); ?>
        <label>Password</label>
        <input name="password" class="frmfield" id="password" type="password">
        <?php echo form_error('password', '<div class="err"><span>', '</span></div>'); ?>
        <div class="logbtnwr">
          <input value="Login" class="loginbtn" type="submit">
        </div>
      </div>
    </form>
  </div>
  
  <div class="clearfix"></div>
</div>
</body>
</html>