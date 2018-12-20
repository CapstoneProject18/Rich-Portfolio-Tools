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
    <h1> Salary Management System 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Content Management</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <?php if($this->session->flashdata('added_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>New salary has been created successfully.</h4>
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
            <h3 class="box-title">Manage Salary List</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
              <input type="button" class="btn btn-primary btn-sm" value="Add New Page" onClick="load_salary_add_form();" />
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>salary Value</th>
                  <th>Text</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo $row->val;?></td>
                  <td><?php echo $row->text;?></td>
                  <td><a href="javascript:;" onClick="load_salary_edit_form(<?php echo $row->ID;?>);" class="btn btn-success btn-xs">Edit</a> <a href="javascript:delete_salary(<?php echo $row->ID;?>);" class="btn btn-danger btn-xs">Delete</a></td>
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
    <form name="frm_salary" id="frm_salary" role="form" method="post" action="<?php echo base_url('admin/salary/add');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Salary Range</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="salary_val" name="salary_val" value="<?php echo set_value('val');?>" placeholder="Salary Value">
              <?php echo form_error('salary_val'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control" name="salary_text" id="salary_text" value="<?php echo set_value('text');?>" placeholder="Text">
              <?php echo form_error('salary_text'); ?> </div>
            
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
    <form name="frm_salary" id="frm_salary" role="form" method="post" action="<?php echo base_url('admin/salary/update');?>" onSubmit="return validate_edit_salary_form(this)">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Salary Range</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_salary_value" name="edit_salary_value" value="<?php echo set_value('val');?>" placeholder="Salary Value">
              <?php echo form_error('val'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control" name="edit_salary_text" id="edit_salary_text" value="<?php echo set_value('text');?>" placeholder="Text">
              <?php echo form_error('text'); ?> </div>
              <input type="hidden" name="salary_id" id="salary_id" />
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
  
  
</script>
<?php if(validation_errors() != false){?>
<script type="text/javascript"> 
	$('#add_page_form').modal('show');
</script>
<?php } ?>
