<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<?php $this->load->view('admin/common/datepicker'); ?>
</head>
<body class="skin-blue">
<?php $this->load->view('admin/common/after_body_open'); ?>
<?php $this->load->view('admin/common/header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php $this->load->view('admin/common/left_side'); ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Edit Admin Password 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>>
      <li class="active">Edit Password</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- title row -->
    <div class="row">
      <?php if(validation_errors() != false):?>
      <div class="message-container">
        <div class="callout callout-danger">
          <h4>Please correct the marked field(s) below.</h4>
        </div>
      </div>
      <?php endif;?>
      <?php if($this->session->flashdata('update_action')==true): ?>
      <div class="message-container">
        <div class="callout callout-success">
          <h4>Password has been updated successfully.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Admin Password</h3>
          </div>
          
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm" id="frm" role="form" method="post" action="<?php echo base_url('admin/home/editpassword');?>">
            <div class="box-body">
            <div style="color:#F00"><?php echo @$errmsg;?></div>
            <div style="color:#060"><?php echo @$msg;?></div>
              <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control"  id="oldpass" name="oldpass" autocomplete="off">
                <?php echo form_error('oldpass'); ?>
                </div>
              <div class="form-group">
                <label for="exampleInputEmail1">New Password</label>
                <input type="password" class="form-control"  id="newpass" name="newpass" autocomplete="off">
                <?php echo form_error('newpass'); ?>
                </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Re-enter New Password</label>
               <input type="password" class="form-control"  id="renewpass" name="renewpass" autocomplete="off">
               <?php echo form_error('renewpass'); ?>
                </div>
              
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
          </form>
        </div>
        <!-- /.box --> 
        
      </div>
      <div> </div>
      <!-- /.col --> 
    </div>
    <!-- info row --> 
    
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
