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
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Jobseekers</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Jobseekers</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form name="search_form" id="search_form" method="post" action="<?php echo base_url('admin/job_seekers/search');?>">
              <div class="row" style="background-color:#3C8DBC; padding:10px; margin:0;">
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_name" id="search_name" type="text" placeholder="Search By Name" value="<?php echo (isset($search_data["CONCAT(first_name, ' ', last_name)"]))?$search_data["CONCAT(first_name, ' ', last_name)"]:'';?>">
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_email" id="search_email" type="text" placeholder="Search By Email" value="<?php echo (isset($search_data["email"]))?$search_data["email"]:'';?>">
                </div>
                <div class="col-md-2 margin-bottom-special">
                <select class="form-control" name="search_gender" id="search_gender">
                	<option value="" selected>-  Gender -</option>
                    <option value="male" <?php echo (@$search_data["gender"]=='ge_male')?$search_data["gender"]:'';?>>Male</option>
                    <option value="female" <?php echo (@$search_data["gender"]=='ge_female')?$search_data["gender"]:'';?>>Female</option>
                </select>
                  
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_city" id="search_city" type="text" placeholder="Search By City" value="<?php echo (isset($search_data["city"]))?$search_data["city"]:'';?>">
                </div>
                
                <div class="col-md-4 margin-bottom-special">
                  <input class="btn" name="submit" value="Search" type="submit">
                  &nbsp;&nbsp;
                  <input class="btn" name="button" value="View All" type="button" onClick="document.location='<?php echo base_url('admin/job_seekers');?>';">
                </div>
              </div>
            </form>
            <div class="clearfix">&nbsp;</div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Date Joined</th>
                  <th align="center" style="text-align:center">Candidate Name</th>
                  <th>Email Address</th>
                  <th>Street Address</th>
                  <th>City</th>
                  <th>Applied  Jobs</th>
                  <th> CVs</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?><br />
                  <?php echo ($row->ip_address)?'<a href="http://domaintools.com/'.$row->ip_address.'" target="_blank">'.$row->ip_address.'</a>':'';?>
                  </td>
                  <td align="center"><a href="<?php echo base_url('admin/job_seekers/details/'.$row->ID);?>">
                    <?php $image_name = ($row->photo)?$row->photo:'no_pic.jpg';?>
                    <img src="<?php echo base_url('public/uploads/candidate/'.$image_name);?>" style="border-radius:50%" height="60" /><br/>
                    <?php echo $row->first_name.' '.$row->last_name;?></a></td>
                  <td><?php echo $row->email;?></td>
                  <td><?php echo $row->present_address;?></td>
                  <td><?php echo $row->city;?></td>
                  <td><a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/job_seekers/applied_jobs_list/'.$row->ID);?>" target="_blank">View (<?php echo $this->applied_jobs_model->count_records('tbl_seeker_applied_for_job','seeker_ID',$row->ID);?>)</a></td>
                  <td>
                  <a class="btn btn-primary btn-xs" href="<?php echo base_url('candidate/'.$this->custom_encryption->encrypt_data($row->ID));?>" target="_blank">View CV</a>
                  
                  </td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						elseif($row->sts=='blocked')
							$class_label = 'danger';
						else
							$class_label = 'warning';
				  ?>
                    <a onClick="update_job_seeker_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->sts);?></span> </a></td>
                  <td><a href="<?php echo base_url('admin/job_seekers/update/'.$row->ID);?>" class="btn btn-primary btn-xs">Edit Candidate</a><br /><a target="_blank" href="<?php echo base_url('admin/job_seekers/login/'.$row->ID);?>" class="btn btn-primary btn-xs" style="margin:1px;">Login as Candidate</a><br /><a href="javascript:delete_job_seeker(<?php echo camelize($row->ID);?>);" class="btn btn-danger btn-xs">Delete Candidate</a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="10" align="center" class="text-red">No Record found!</td>
                </tr>
                <?php
					endif;
				?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
          
          <!--Pagination-->
          <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
        
        <!-- /.box --> 
      </div>
    </div>
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
