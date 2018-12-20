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
    <h1> Posted Jobs Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/posted_jobs');?>">Posted Jobs</a></li>
      <li class="active"><?php echo ellipsize($row->job_title,32,.7);?></li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content invoice"> 
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> 
          <!--<i class="fa fa-globe"></i>--> Job Requirements<small class="pull-right">Job Posted Date <?php echo date_formats($row->dated, 'd/m/Y');?></small> </h2>
      </div>
      <!-- /.col --> 
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-7 invoice-col">
      	<b>Job Title:</b> <?php echo $row->job_title;?><br/>
      	<b>Job Category:</b> <?php echo $row->industry_name;?><br/>
        <b><span id="ctl00_ContentPlaceHolder1_lblpayheading">Salary</span>:</b> Rs. <?php echo $row->pay;?><br/>
        <b><span id="ctl00_ContentPlaceHolder1_lblqualificationheading">Qualification</span>:</b> <?php echo $row->qualification;?><br />
        <b><span id="ctl00_ContentPlaceHolder1_lblexperienceheading">Experience</span>:</b> <?php echo (is_numeric($row->experience))?$row->experience.' year':$row->experience;?>
        </div>
      <div class="col-sm-3 invoice-col"><b><span id="ctl00_ContentPlaceHolder1_lbljobmodeheading">Job Mode</span>:</b> <?php echo $row->job_mode;?><br/>
          <b>Last Date To Apply:</b> <?php echo date_formats($row->last_date, 'd/m/Y');?> <br>
          <b><span id="ctl00_ContentPlaceHolder1_lblvacanciesheading">Vacancies</span>:</b> <?php echo $row->vacancies;?>
      </div>
      <!-- /.col -->
      <div class="col-sm-2 invoice-col" style="text-align:right"> 
      
      <!-- /.col --> 
    </div>
    <!-- /.row -->
    </div>
    <div>&nbsp;</div>
   <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">Job Description &amp;  Details</h2>
      </div>
      <!-- /.col --> 
    </div>
    <div class="row">
     <div class="col-sm-12 invoice-col"><?php echo ($row->job_description=='')?'Not provided.':$row->job_description;?></div>
    </div>
    <div>&nbsp;</div>
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">Contact Information</h2>
      </div>
      <!-- /.col --> 
    </div>
    <div class="row invoice-info">
      <div class="col-sm-12 invoice-col"><b>Contact Name:</b> <?php echo $row->contact_person;?><br/>
        <b><span id="ctl00_ContentPlaceHolder1_lblpayheading">Contact Phone#</span>:</b> <?php echo $row->contact_phone;?><br/>
        <b><span id="ctl00_ContentPlaceHolder1_lblqualificationheading">Email:</span>:</b> <?php echo $row->contact_email;?><br />
      </div>
      
      <!-- /.col -->
      
    <!-- /.row -->
    </div>
    <div>&nbsp;</div>
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">Company Information</h2>
      </div>
      <!-- /.col --> 
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col"><b>Company Name:</b> <?php echo $row->company_name;?> <br>
        <strong>CEO: </strong><?php echo $row->company_ceo;?><br/>
        <b>Industry:</b> <?php echo $row->industry_ID;?><br/>
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
      <div class="col-sm-4 invoice-col" style="text-align:center"><img src="<?php echo base_url('public/uploads/employer/'.$image_name);?>" style="max-height:130px;" max-height="130"></div>
      <!-- /.col --> 
    </div>
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
