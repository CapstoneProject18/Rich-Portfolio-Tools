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
    <h1> Industry Management System 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Industry Management</li>
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
            <h3 class="box-title">All Industries</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
              <input type="button" class="btn btn-primary btn-sm" value="Add New Industry" onClick="load_industries_add_form();" />
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Industry Name</th>
                  <th>No. Of Employers Listing</th>
                  <th>Top Industry</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):
						if($row->top_category=='yes')
							$top_class_label = 'success';
						else
							$top_class_label = 'warning';
				?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo $row->industry_name?></td>
                  <td><a href="<?php echo base_url('admin/employers/search?industry_ID='.$row->ID);?>" target="_blank">View (<?php echo $this->posted_jobs_model->count_records('tbl_companies','industry_ID',$row->ID);?>)</a></td>
                  <td><a onClick="update_top_industry_status(<?php echo $row->ID;?>);" href="javascript:;" id="ti_<?php echo $row->ID;?>"> <span class="label label-<?php echo $top_class_label;?>"><?php echo $row->top_category;?></span> </a></td>
                  <td><?php
				  		if($row->sts=='active')
							$class_label = 'success';
						else
							$class_label = 'danger';
				  ?>
                    <a onClick="update_industries_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo $row->sts;?></span> </a></td>
                  <td><a href="javascript:;" onClick="load_industries_edit_form(<?php echo $row->ID;?>);" class="btn btn-success btn-xs">Edit</a> <a href="javascript:delete_industries(<?php echo $row->ID;?>);" class="btn btn-danger btn-xs">Delete</a></td>
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
<div class="modal fade" id="add_page_form">
  <div class="modal-dialog">
    <form name="frm_industries" id="frm_industries" role="form" method="post" action="<?php echo base_url('admin/industries/add');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Industry</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="industries" name="industries" value="<?php echo set_value('industries_name');?>" placeholder="Heading">
              <?php echo form_error('industries'); ?> </div>
          </div>
          <!-- /.box-body --> 
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitter" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- Edit Model-->
<div class="modal fade" id="edit_page_form">
  <div class="modal-dialog">
    <form name="frm_industries" id="frm_industries" role="form" method="post" action="<?php echo base_url('admin/industries/update');?>" onSubmit="return validate_edit_industries_form(this)">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Industry</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_industries" name="edit_industries" value="<?php echo set_value('industries_name');?>" placeholder="Heading">
              <?php echo form_error('heading'); ?> </div>
              <input type="hidden" name="industries_id" id="industries_id" />
          </div>
          <!-- /.box-body --> 
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitter" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
<?php if(validation_errors() != false){?>
<script type="text/javascript"> 
	$('#add_page_form').modal('show');
</script>
<?php } ?>
