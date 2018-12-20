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
    <h1> Jobseeker Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/job_seekers');?>">Jobseeker</a></li>
      <li class="active"><?php echo $row->first_name.' '.$row->last_name;?></li>
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
          <h4>Employer information has been updated successfully.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Jobseeker Information</h3>
          </div>
          
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_job_seeker" id="frm_job_seeker" role="form" method="post" action="<?php echo base_url('admin/job_seekers/update/'.$row->ID);?>">
            <div class="box-body">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control"  id="first_name" name="first_name" value="<?php echo $row->first_name.' '.$row->last_name;?>">
                <?php echo form_error('full_name'); ?> </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"  id="email" name="email" value="<?php echo $row->email;?>">
                <?php echo form_error('email'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo $row->password;?>">
                <?php echo form_error('password'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mobile Number</label>
                <input type="phone" class="form-control" name="mobile" id="mobile" value="<?php echo $row->mobile;?>" maxlength="16" >
                <?php echo form_error('mobile'); ?> </div>
                
                <div class="form-group">
                <label>Date of Birth</label>
                <input class="form-control inputDate" id="inputDate" readonly name="dob" value="<?php echo $row->dob;?>" />
                <?php echo form_error('dob'); ?> </div>
                
              <div class="form-group">
                <label for="exampleInputPassword1">Gender</label>
                <select name="gender" id="gender" class="form-control">
                  <option value="male" <?php echo ($row->gender=='male')?'selected="selected"':'';?>>Male</option>
                  <option value="female" <?php echo ($row->gender=='female')?'selected="selected"':'';?>>Female</option>
                </select>
                <?php echo form_error('gender'); ?> </div>
                
                <div class="form-group">
                <label>Present Address</label>
                <textarea class="form-control" name="present_address" id="present_address" cols="" rows=""><?php echo $row->present_address;?></textarea>
                <?php echo form_error('present_address'); ?> </div>
                
                <div class="form-group">
                <label>Permanent Address</label>
                <textarea class="form-control" name="permanent_address" id="permanent_address" cols="" rows=""><?php echo $row->permanent_address;?></textarea>
                <?php echo form_error('permanent_address'); ?> </div>
                
              <div class="form-group">
                <label for="exampleInputPassword1">Country</label>
                <select name="country" id="country" class="form-control" onChange="grab_cities_by_country(this.value);">
                  <?php 
					foreach($result_countries as $row_country):
					$selected = ($row_country->country_name==$row->country)?'selected="selected"':'';
				?>
                  <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
                  <?php endforeach;?>
                </select>
                <?php echo form_error('country'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">City</label>
                <?php 
				 	$display_status_dropdown = 'display:none;';
					$display_status_text = '';
				 ?>
                <select name="city" id="city_dropdown" class="form-control" style=" <?php echo $display_status_dropdown;?> ">
                  <?php
					foreach($result_cities as $row_city):
					$selected = ($row_city->city_name==$row->city)?'selected="selected"':'';
				?>
                  <option value="<?php echo $row_city->city_name;?>" <?php echo $selected;?>><?php echo $row_city->city_name;?></option>
                  <?php endforeach; ?>
                </select>
                <input style=" <?php echo $display_status_text;?> " type="text" class="form-control" name="city" id="city_text" value="<?php echo $row->city;?>">
                <?php echo form_error('city'); ?> </div>
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
