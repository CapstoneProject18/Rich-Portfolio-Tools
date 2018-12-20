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
    <h1> Employers Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Employers</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Employers</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?></div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <?php $this->load->view('admin/common/employer_quick_search_bar'); ?>
            <div class="clearfix text-right" style="padding:10px;"> Total Records: <strong><?php echo $total_rows;?></strong> </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Date Joined</th>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Posted Jobs</th>
                  <th align="center">Company</th>
                  
                  <th>Quick Views</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):
						$total_posted_jobs = $this->posted_jobs_model->count_records('tbl_post_jobs','employer_id',$row->ID);
						$json_string1 = str_replace('"',"dquote",json_encode($row));
						$json_string = str_replace("'","squote",$json_string1);
					?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td valign="middle"><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td valign="middle"><a href="<?php echo base_url('admin/employers/details/'.$row->ID);?>"><?php echo $row->first_name.' '.$row->last_name;?></a></td>
                  <td valign="middle"><?php echo $row->email;?></td>
                  <td valign="middle"><a class="btn btn-primary btn-xs" href="<?php echo base_url('admin/posted_jobs/jobs_by_company/'.$row->ID);?>">View (<?php echo $total_posted_jobs;?>)</a></td>
                  <td align="center" valign="middle"><a href="<?php echo base_url('admin/employers/details/'.$row->ID);?>">
                    <?php $image_name = ($row->company_logo)?$row->company_logo:'no_logo.jpg';?>
                    <img src="<?php echo base_url('public/uploads/employer/thumb/'.$image_name);?>" mar-height="60"/><br />
                    <?php echo ($row->company_name)?$row->company_name:' - ';?></a></td>
        
                  
                    <a onClick="update_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->sts);?></span> </a></td>
                  <td valign="middle"><a href="javascript:;" class="btn btn-primary btn-xs" onClick="load_quick_profile_view('<?php echo $json_string;?>', '<?php echo $total_posted_jobs;?>');">Profile View</a> <a href="javascript:;" onClick="load_quick_job_view('<?php echo $row->ID;?>', '<?php echo $row->company_name;?>');" class="btn btn-primary btn-xs">Job View</a></td>
                  <td valign="middle"><a href="<?php echo base_url('admin/employers/update/'.$row->ID);?>" class="btn btn-primary btn-xs">Edit</a> <a href="javascript:delete_employer(<?php echo camelize($row->ID);?>);" class="btn btn-danger btn-xs">Delete</a></td>
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
<div class="modal fade" id="quick_profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Quick Preview of <span id="comp_name" style="font-weight:bold;"></span></h4>
      </div>
      <div class="modal-body"> 
        <!-- /.box-header --> 
        <!-- form start -->
        <div class="box-body">
          <table width="95%" border="0">
            <tr>
              <td width="25%"><strong><span class="form-group">Email Address:</span></strong></td>
              <td id="email"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Street Address</span>:</strong></td>
              <td id="address"></span></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Company Phone</span>:</strong></td>
              <td id="phone"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">City / Country:</span></strong></td>
              <td id="city_country"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">No. of jobs posted</span>:</strong></td>
              <td id="no_of_jobs"></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body --> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<div class="modal fade" id="quick_job">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Quick Preview of Latest Job Posted By <span id="j_comp_name" style="font-weight:bold;"></span></h4>
      </div>
      <div class="modal-body"> 
        <!-- /.box-header --> 
        <!-- form start -->
        <div id="errbox" style="display:none;"></div>
        <div class="box-body" id="j_box">
          <table width="95%" border="0">
            <tr>
              <td width="25%"><strong><span class="form-group">Job Title:</span></strong></td>
              <td id="job_title"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Job Category:</span></strong></td>
              <td id="job_cat"></span></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Job Description:</span></strong></td>
              <td id="job_desc"></span></td>
            </tr>
            <tr>
              <td colspan="2"><strong>&nbsp;</strong></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Contact Name:</span></strong></td>
              <td id="contact_name"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Contact Phone:</span></strong></td>
              <td id="contact_phone"></td>
            </tr>
            <tr>
              <td><strong><span class="form-group">Contact Email:</span></strong></td>
              <td id="contact_email"></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body --> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
