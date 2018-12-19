<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
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
    <h1> Employer Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/employers');?>">Employers</a></li>
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
      <div class="col-md-6"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Employer Information</h3>
          </div>
          
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_employer" id="frm_employer" role="form" method="post" action="<?php echo base_url('admin/employers/update/'.$row->ID);?>" onSubmit="return validate_frm_employer(this);">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" class="form-control"  id="full_name" name="full_name" value="<?php echo $row->first_name;?>">
                <?php echo form_error('full_name'); ?> </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control"  id="email" name="email" value="<?php echo $row->email;?>">
                <?php echo form_error('email'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" class="form-control" name="password" id="password" value="<?php echo $row->pass_code;?>">
                <?php echo form_error('password'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mobile Number</label>
                <input type="phone" class="form-control" name="mobile_phone" id="mobile_phone" value="<?php echo $row->mobile_phone;?>" >
                <?php echo form_error('mobile_phone'); ?> </div>
              
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
             <input type="hidden" name="eid" id="eid" value="<?php echo $row->ID;?>" >
             <input type="hidden" name="err_fld" id="err_fld" value="" >
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        <!-- /.box --> 
        
      </div>
      <div class="col-md-6"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Company Information</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_company" id="frm_company" role="form" method="post" action="<?php echo base_url('admin/companies/update/'.$row->ID.'/'.$row->CID);?>" enctype="multipart/form-data" onSubmit="return validate_frm_company();">
            <div class="box-body">
              <div class="form-group">
                <label>Company Name</label>
                <input type="text" class="form-control"  id="company_name" name="company_name" value="<?php echo $row->company_name;?>">
                <?php echo form_error('company_name'); ?>
              </div>
              <div class="form-group">
                <label>Industry</label>
                
                <select name="industry_ID" id="industry_ID" class="form-control">
                  <?php 
					foreach($result_industries as $row_industry):
					$selected = ($row_industry->ID==$row->industry_ID)?'selected="selected"':'';
				?>
                  <option value="<?php echo $row_industry->ID;?>" <?php echo $selected;?>><?php echo $row_industry->industry_name;?></option>
                  <?php endforeach;?>
                </select>
                
                
                
                <?php echo form_error('industry_ID'); ?>
              </div>
              
              <div class="form-group">
                <label>Mobile Number</label>
                <input type="phone" class="form-control" name="company_phone" id="company_phone" value="<?php echo $row->company_phone;?>">
                <?php echo form_error('company_phone'); ?>
              </div>
              
              
              <div class="form-group">
                <label>No. Of Employees</label>
                <select name="no_of_employees" id="no_of_employees" class="form-control">
              <option value="1-10" <?php echo ($row->no_of_employees=='1-10')?'selected':''; ?>>1-10</option>
              <option value="11-50" <?php echo ($row->no_of_employees=='11-50')?'selected':''; ?>>11-50</option>
              <option value="51-100" <?php echo ($row->no_of_employees=='51-100')?'selected':''; ?>>51-100</option>
              <option value="101-300" <?php echo ($row->no_of_employees=='101-300')?'selected':''; ?>>101-300</option>
              <option value="301-600" <?php echo ($row->no_of_employees=='301-600')?'selected':''; ?>>301-600</option>
              <option value="601-1000" <?php echo ($row->no_of_employees=='601-1000')?'selected':''; ?>>601-1000</option>
              <option value="1001-1500" <?php echo ($row->no_of_employees=='1001-1500')?'selected':''; ?>>1001-1500</option>
              <option value="1501-2000" <?php echo ($row->no_of_employees=='1501-2000')?'selected':''; ?>>1501-2000</option>
              <option value="More than 2000" <?php echo ($row->no_of_employees=='More than 2000')?'selected':''; ?>>More than 2000</option>
            </select>
              </div>
              <div class="form-group">
                <label>Company Location</label>
                <input type="text" class="form-control" name="company_location" id="company_location" value="<?php echo $row->company_location;?>">
                <?php echo form_error('company_location'); ?>
              </div>
              <div class="form-group">
                <label>Company Website</label>
                <input type="text" class="form-control" name="company_website" id="company_website" value="<?php echo $row->company_website;?>">
                <?php echo form_error('company_website'); ?>
              </div>
              <div class="form-group">
                <label>Company Logo</label>
                <input type="file" class="form-control" name="company_logo" id="company_logo" >
                <?php $image_name = ($row->company_logo)?$row->company_logo:'no_logo.jpg';?>
                <div style="float:right"><img src="<?php echo base_url('public/uploads/employer/thumb/'.$image_name);?>"></div>
              </div>
              
              <div class="clearfix">&nbsp;</div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
            <input type="hidden" name="cid" id="cid" value="<?php echo $row->CID;?>" >
             <input type="hidden" name="err_cfld" id="err_cfld" value="" >
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
