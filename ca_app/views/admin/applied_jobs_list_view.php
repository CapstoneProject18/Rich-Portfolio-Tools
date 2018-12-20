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
    <h1> Jobseeker Jobs Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Jobseeker Application</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><span id="seeker_name"></span>'s Job Applications</h3><div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            
            <div class="clearfix">&nbsp;</div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Applied On</th>
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
<script type="text/javascript">
<?php $image_name = ($row->photo)?$row->photo:'no_pic.jpg';?>            
$( document ).ready(function() {
	$("#seeker_name").html('<img src="<?php echo base_url('public/uploads/candidate/'.$image_name);?>" style="border-radius:50%" height="60" /> <?php echo $row->first_name;?>');
});
//company_name
</script>
