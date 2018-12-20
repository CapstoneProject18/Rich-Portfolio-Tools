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
    <h1> Manage Email Templates 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Email Templates</li>
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
            <h3 class="box-title">Email Templates</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
            <!--  <input type="button" class="btn btn-primary btn-sm" value="Add New Page" onClick="load_cms_add_form();" />-->
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Email Name</th>
                  <th>Email Subject</th>
                  <th>Preview</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo $row->email_name;?></td>
                  <td><?php echo ellipsize($row->subject,90,.8);?></td>
                  <td><a href="<?php echo base_url('admin/email_template/view/'.$row->ID);?>" target="_blank">Preview</a></td>
                  <td><a href="javascript:;" onClick="load_email_template_edit_form(<?php echo $row->ID;?>);" class="btn btn-success btn-xs">Edit</a> </td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                  <td colspan="5" align="center" class="text-red">No Record found!</td>
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
<!-- Edit Model-->
<div class="modal fade" id="edit_email_form">
  <div class="modal-dialog">
    <form name="frm_email" id="frm_email" role="form" method="post" action="<?php echo base_url('admin/email_template/update');?>" onSubmit="return validate_edit_email_template_form(this)">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Email Template</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
          	<div class="form-group">
              <input type="text" class="form-control" name="from_name" id="from_name" value="<?php echo set_value('from_name');?>" placeholder="From Name">
              <?php echo form_error('from_name'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control" name="from_email" id="from_email" value="<?php echo set_value('from_email');?>" placeholder="From Email">
              <?php echo form_error('from_email'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="subject" name="subject" value="<?php echo set_value('subject');?>" placeholder="Subject">
              <?php echo form_error('subject'); ?> </div>
            <div class="form-group">
              <label>Email Content</label>
              <textarea id="editor1" name="editor1" rows="8" cols="70"><?php echo set_value('editor1');?></textarea>
              <?php echo form_error('editor1'); ?> </div>
              <input type="hidden" name="eid" id="eid" />
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
<!--<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script type="text/javascript">
  $(function() {
   var editor = CKEDITOR.replace( 'editor1', {
	allowedContent: true,
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });  
  });
  
  
</script>-->
<?php if(validation_errors() != false){?>
<script type="text/javascript"> 
	$('#edit_email_form').modal('show');
</script>
<?php } ?>