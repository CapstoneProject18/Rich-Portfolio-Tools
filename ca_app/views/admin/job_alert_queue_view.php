<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<script type="text/javascript">
function delete_job(job_id){
	var act = confirm('Are you sure you want to delete this queue?');	
	if(act==true){
		document.location='<?php echo base_url('admin/job_alert_queue/delete_queue');?>/'+job_id;	
	}
	else
	return false;
}
</script>
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
    <h1> Job Alerts Queue 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Job Alerts Queue Listing</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <?php if($this->session->flashdata('added_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>New page has been created successfully.</h4>
      </div>
      </div>
      <?php endif;?>
      
      <?php if($this->session->flashdata('update_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>Record has been updated successfully.</h4>
      </div>
      </div>
      <?php endif;?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Job Alert Queue</h3>
            <!--Pagination-->
          
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form method="post" action="<?php echo base_url('admin/job_alert_queue/update_email_rate');?>">
            <div class="text-right" style="padding-bottom:2px;">
             Per Hour Emails Rate: <input type="text" class="form-control" name="per_hour" id="per_hour" value="<?php echo $settings->emails_per_hour;?>" style="width:150px; display:inline; margin-right:4px;" /><input class="btn btn-primary btn-sm" type="submit" name="sub" value="Update" />
            </div>
            </form>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Created Date</th>
                  <th>Job Title</th>
                  <th>Emails in Queue</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td><a href="<?php echo base_url('jobs/'.$row->job_slug);?>" target="_blank"><?php echo ellipsize($row->job_title,36,.8);?></a></td>
                  <td><?php echo $row->in_queue;?></td>
                  <td><a href="javascript:;" onClick="delete_job(<?php echo $row->job_ID;?>)" class="btn btn-danger btn-xs">Delete This Queue</a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="6" align="center" class="text-red">No Record found!</td>
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
