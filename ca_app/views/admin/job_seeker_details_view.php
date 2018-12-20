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
    <h1> Jobseeker Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/job_seekers');?>">Jobseekers</a></li>
      <li class="active"><?php echo $row->first_name.' '.$row->last_name;?></li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content invoice"> 
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> 
          <!--<i class="fa fa-globe"></i>--> <?php echo $row->first_name.' '.$row->last_name;?> <a href="<?php echo base_url('admin/job_seekers/update/'.$row->ID);?>" style="font-size:12px;">Edit</a><small class="pull-right">Member Since: <?php echo date_formats($row->dated, 'd/m/Y');?></small> </h2>
      </div>
      <!-- /.col --> 
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-7 invoice-col"><b>Email Address:</b> <?php echo $row->email;?><br/>
        <b>Password:</b> <?php echo $row->password;?><br/>
        <b>Account Status:</b> <?php echo $row->sts;?><br />
        <b>Current Address:</b> <?php echo $row->present_address;?><br>
        <b>Permanent Address:</b> <?php echo $row->permanent_address;?>
        </div>
      <div class="col-sm-3 invoice-col"><b>Contact Number:</b> <?php echo $row->mobile;?><br/>
          <b>Gender:</b> <?php echo $row->gender;?><br>
          <b>Date of Birth:</b> <?php echo $row->dob;?> <br/>
          <b>City:</b> <?php echo $row->city;?><br>
          <b>Country:</b> <?php echo $row->country;?>
      </div>
      <!-- /.col -->
      <div class="col-sm-2 invoice-col" style="text-align:right"> 
      <?php $image_name = ($row->photo)?$row->photo:'no_pic.jpg';?>
      	<img style="border-radius:50%;" src="<?php echo base_url('public/uploads/candidate/'.$image_name);?>" height="100">
      <!-- /.col --> 
    </div>
    <!-- /.row -->
    </div>
    <div>&nbsp;</div>
    <?php if($row->career_objective):?>
    <div class="row">
     <div class="col-sm-12 invoice-col"><strong>Career Objective:</strong> <?php echo $row->career_objective;?></div>
    </div>
    <div>&nbsp;</div>
    <?php endif;?>
    
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> Jobs Applied For</h2>
      </div>
      <!-- /.col --> 
    </div>
    <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Applied Date</th>
                  <th>Job Title</th>
                  <th>Company Name</th>
                  <th>City</th>
                  <th>Featured</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):
					?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td><a href="<?php echo base_url('admin/posted_jobs/details/'.$row->posted_job_id);?>"> <?php echo ellipsize($row->job_title,36,.8);?></td>
                  <td align="center"><a href="<?php echo base_url('admin/employers/details/'.$row->employer_ID);?>">
                    <?php $image_name = ($row->company_logo)?$row->company_logo:'no_logo.jpg';?>
                    <img src="<?php echo base_url('public/uploads/employer/thumb/'.$image_name);?>" mar-height="60"/><br />
                    <?php echo ($row->company_name)?$row->company_name:' - ';?></a></td>
                  <td><?php echo $row->city;?></td>
                  <td align="center"><?php
				  		if($row->is_featured=='yes')
							$class_label = 'success';
						else
							$class_label = 'warning';
				  ?>
                    <a onClick="update_featured_job(<?php echo $row->ID;?>);" href="javascript:;" id="f_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->is_featured);?></span> </a></td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						elseif($row->sts=='closed')
							$class_label = 'danger';
						else
							$class_label = 'warning';
				  ?>
                    <a onClick="update_posted_job_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->sts);?></span> </a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="7" align="center" class="text-red">No Record found!</td>
                </tr>
                <?php
					endif;
				?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
    <div>&nbsp;</div>
    <div class="row no-print">
      <div class="col-xs-12">
        <a href="<?php echo base_url('admin/employers/update/'.$row->ID);?>"><button class="btn btn-default"><i class="fa fa-edit"></i> Edit This Record</button> </a><!--&nbsp;&nbsp;
        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->
      </div>
    </div>
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
