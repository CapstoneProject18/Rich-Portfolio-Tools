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
    <h1> Contact Employer 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/invite_employer');?>">Contact Employer</a></li>
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
      <?php if($this->session->flashdata('done')==true): ?>
      <div class="message-container">
        <div class="callout callout-success">
          <h4>Email sent.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
           
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_invite_employer" id="frm_invite_employer" role="form" method="post" action="<?php echo base_url('admin/invite_employer/');?>">
            <div class="box-body">
                <div class="form-group">
                    <label>Employer Name</label>
                    <input type="text" class="form-control"  id="employer_name" name="employer_name" required value="" placeholder="Employer Name">
                    <?php echo form_error('employer_name'); ?> 
                </div>
                <div class="form-group">
                    <label>Employer Email</label>
                    <input type="email" class="form-control"  id="employer_email" name="employer_email"  required value="" placeholder="Employer Email">
                    <?php echo form_error('employer_email'); ?> 
                </div>
                
                <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" id="message" cols="" rows="" required></textarea>
                <?php echo form_error('message'); ?> </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
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