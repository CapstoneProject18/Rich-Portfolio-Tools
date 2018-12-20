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
    <h1> Companies Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Companies</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Companies</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <?php $this->load->view('admin/common/employer_quick_search_bar'); ?>
            <div class="clearfix">&nbsp;</div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Company Name</th>
                  <th>Company Phone</th>
                  <th>Employer Name</th>
                  <th>Industry</th>
                  <th>Job Posted</th>
                  <th>Company Website</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):
						$image_name = ($row->company_logo)?$row->company_logo:'no_logo.jpg';
					?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td align="center"><a href="<?php echo base_url('admin/employers/details/'.$row->ID);?>"> <img src="<?php echo base_url('public/uploads/employer/thumb/'.$image_name);?>" /><br />
                    <?php echo $row->company_name;?></a></td>
                  <td><?php echo $row->company_phone;?></td>
                  <td><?php echo $row->first_name.' '.$row->last_name;?></td>
                  <td><?php echo $row->industry_ID;?></td>
                  <td><a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/posted_jobs/jobs_by_company/'.$row->ID);?>" target="_blank">View (<?php echo $this->posted_jobs_model->count_records('tbl_post_jobs','employer_id',$row->ID);?>)</a></td>
                  <td><?php echo $row->company_website;?></td>
                  <td><a href="<?php echo base_url('admin/employers/update/'.$row->ID);?>" class="btn btn-primary btn-xs">Edit</a> <a href="javascript:delete_employer(<?php echo camelize($row->ID);?>);" class="btn btn-danger btn-xs">Delete</a></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="8" align="center" class="text-red">No Record found!</td>
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
