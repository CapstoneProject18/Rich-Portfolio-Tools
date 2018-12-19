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
      <li><a href="<?php echo base_url('admin/ads');?>">Adds</a></li>
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
          <h4>Ad has been updated successfully.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Ads</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_ads" id="frm_ads" role="form" method="post" action="<?php echo base_url('admin/ads/update/'.$row->ID);?>">
            <div class="box-body">
                <div class="form-group">
                <label>Rightside  Ad</label>
                1                
<textarea class="form-control" name="right_side_1" id="right_side_1" cols="" rows=""><?php echo $row->right_side_1;?></textarea>
                <?php echo form_error('right_side_1'); ?> </div>
                
                <div class="form-group">
                <label>Rightside Ad</label>
2                
<textarea class="form-control" name="right_side_2" id="right_side_2" cols="" rows=""><?php echo $row->right_side_2;?></textarea>
                <?php echo form_error('right_side_2'); ?> </div>
                <div class="form-group">
                <label> Bottom Ad</label>
                <textarea class="form-control" name="bottom" id="bottom" cols="" rows=""><?php echo $row->bottom;?></textarea>
                <?php echo form_error('bottom'); ?> </div>
                
                <div class="form-group">
                <label>Google Analytics</label>
                <textarea class="form-control" name="google_analytics" id="google_analytics" cols="" rows=""><?php echo $row->google_analytics;?></textarea>
                <?php echo form_error('google_analytics'); ?> </div>
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
