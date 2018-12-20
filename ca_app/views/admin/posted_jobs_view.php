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
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Posted Jobs</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Posted Jobs</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <form name="search_form" id="search_form" method="post" action="<?php echo base_url('admin/posted_jobs/search');?>">
              <div class="row" style="background-color:#3C8DBC; padding:10px; margin:0;">
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_title" id="search_title" type="text" placeholder="Search By Job Title" value="<?php echo (isset($search_data["job_title"]))?$search_data["job_title"]:'';?>">
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_company" id="search_company" type="text" placeholder="Search By Company Name" value="<?php echo (isset($search_data["company_name"]))?$search_data["company_name"]:'';?>">
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <input class="form-control" name="search_city" id="search_city" type="text" placeholder="Search By City" value="<?php echo (isset($search_data["city"]))?$search_data["city"]:'';?>">
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <select class="form-control" name="search_featured" id="search_featured">
                    <option value="" selected>- Featured -</option>
                    <option value="yes">Featured</option>
                    <option value="no">Non-Featured</option>
                  </select>
                </div>
                <div class="col-md-2 margin-bottom-special">
                  <select class="form-control" name="search_sts" id="search_sts">
                    <option value="" selected>- Status -</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="deactive">Deactive</option>
                    <option value="blocked">Blocked</option>
                  </select>
                </div>
                <div class="col-md-2 margin-bottom-special" style="padding:0;">
                  <input class="btn" name="submit" value="Search" type="submit">
                  &nbsp;&nbsp;
                  <input class="btn" name="button" value="View All" type="button" onClick="document.location='<?php echo base_url('admin/posted_jobs');?>';">
                </div>
              </div>
            </form>
            <div class="clearfix">&nbsp;</div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Added Date</th>
                  <th>Last Date</th>
                  <th>Job Title</th>
                  <th>Company Name</th>
                  <th>City</th>
                  <th>Featured</th>
                  <th>Job Preview</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?>
                  <br />
                  <?php echo ($row->ip_address)?'<a href="http://domaintools.com/'.$row->ip_address.'" target="_blank">'.$row->ip_address.'</a>':'';?>
                  </td>
                  <td><?php echo date_formats($row->last_date, 'd/m/Y');?></td>
                  <td><a href="<?php echo base_url('admin/posted_jobs/details/'.$row->ID);?>"> <?php echo ellipsize($row->job_title,36,.8);?></td>
                  <td align="center"><a href="<?php echo base_url('admin/employers/details/'.$row->employer_ID);?>" target="_blank">
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
                  <td>
                  <a href="javascript:;" onClick="load_quick_job_preview('<?php echo $row->ID;?>', '<?php echo $row->company_name;?>');" class="btn btn-primary btn-xs">Quick Preview</a>
                  </td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						elseif($row->sts=='blocked')
							$class_label = 'danger';
						else
							$class_label = 'warning';
				  ?>
                    <a onClick="update_posted_job_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->sts);?></span> </a></td>
                  <td><a href="<?php echo base_url('admin/edit_job/index/'.$row->ID);?>" class="btn btn-primary btn-xs">Edit</a> <a href="javascript:delete_posted_job(<?php echo camelize($row->ID);?>);" class="btn btn-danger btn-xs">Delete</a></td>
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
<div class="modal fade" id="quick_job">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Quick Preview of Job Posted By <span id="j_comp_name" style="font-weight:bold;"></span></h4>
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
<?php $this->load->view('admin/common/footer'); ?>
