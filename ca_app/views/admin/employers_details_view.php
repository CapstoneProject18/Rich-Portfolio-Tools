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
  <section class="content invoice"> 
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> 
          <!--<i class="fa fa-globe"></i>--> <?php echo $row->first_name.' '.$row->last_name;?> <a href="<?php echo base_url('admin/employers/update/'.$row->ID);?>" style="font-size:12px;">Edit</a><small class="pull-right">Member Since: <?php echo date_formats($row->dated, 'd/m/Y');?></small> </h2>
      </div>
      <!-- /.col --> 
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col"><b>Email Address:</b> <?php echo $row->email;?><br/>
        <b>Password:</b> <?php echo $row->pass_code;?><br/>
        <b>Account Status:</b> <?php echo $row->sts;?></div>
      <div class="col-sm-4 invoice-col"><b>Mobile Number:</b> <?php echo $row->mobile_phone;?><br/>
          <b>Gender:</b> <?php echo $row->gender;?><br/>
          <b>City:</b> <?php echo $row->city;?><br>
         <b>Country:</b> <?php echo $row->country;?>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col"> 
        <b>No. of jobs posted:</b> - </div>
      <!-- /.col --> 
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> Company Information </h2>
      </div>
      <!-- /.col --> 
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col"><b>Company Name:</b> <?php echo $row->company_name;?> <br>
        <b>Company Email:</b> <?php echo $row->company_email;?> <br>
        <strong>CEO: </strong><?php echo $row->company_ceo;?><br/>
        <b>Industry:</b> <?php echo $row->industry_name;?><br/>
        <b>Established In:</b> <?php echo $row->established_in;?>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
      	<b>Company Phone:</b> <?php echo $row->company_phone;?> <br>
        <b>Company Fax:</b> <?php echo $row->company_fax;?> <br>
      	<b>No. Of Offices:</b> <?php echo $row->no_of_offices;?><br/>
      	<b>No. Of Employees:</b> <?php echo $row->no_of_employees;?><br/>
        <b>Company Address:</b> <?php echo $row->company_location;?><br/>
        <b>Company Website: </b><?php echo $row->company_website;?>
      </div>
      <!-- /.col -->
      <?php $image_name = ($row->company_logo)?$row->company_logo:'no_logo.jpg';?>
      <div class="col-sm-4 invoice-col" style="text-align:center"><img src="<?php echo base_url('public/uploads/employer/'.$image_name);?>" style="max-width:150px;"></div>
      <!-- /.col --> 
    </div>
    <div>&nbsp;</div>
    <div class="row">
     <div class="col-sm-12 invoice-col"><b>Description: </b><?php echo $row->company_description;?></div>
    </div>
    <div>&nbsp;</div>
    <!-- this row will not appear when printing -->
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
