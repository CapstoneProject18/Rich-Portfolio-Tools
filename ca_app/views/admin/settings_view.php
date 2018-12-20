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
    <h1> Ads Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/ads');?>">Settings</a></li>
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
          <h4>Settings have been updated successfully.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Settings</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm" id="frm" role="form" method="post" action="<?php echo base_url('admin/settings/update/'.$row->ID);?>">
            <div class="box-body">
                <div class="form-group">
                <label>Payment Package System</label>
                         <select name="payment_plan" id="payment_plan" required>
                         <option value="0" <?php echo ($row->payment_plan=='0' || $row->payment_plan=='')?'selected':'';?>>Disabled</option>
                         <option value="1" <?php echo ($row->payment_plan=='1')?'selected':'';?>>Enabled</option>
                         
                         </select>
                <?php echo form_error('payment_plan'); ?> </div>
                
                <div class="form-group">
                <label>Currency (<em>valid 3 character code like: USD, GBP etc</em>)</label>
           
<input class="form-control" name="currency" id="currency" maxlength="3" max="3" required value="<?php echo $row->currency;?>" />
                <?php echo form_error('currency'); ?> </div>
  
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
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
