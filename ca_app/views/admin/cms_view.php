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
    <h1> Content Management System 
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
            <h3 class="box-title">All pages</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
              <input type="button" class="btn btn-primary btn-sm" value="Add New Page" onClick="load_cms_add_form();" />
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Added Date</th>
                  <th>Page Heading</th>
                  <th>Preview</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->pageID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td><?php echo ellipsize($row->pageTitle,36,.8);?></td>
                  <td><a href="<?php echo base_url('content/'.$row->pageSlug);?>" target="_blank">Preview</a></td>
                  <td><?php
				  		if($row->pageStatus=='Published')
							$class_label = 'success';
						else
							$class_label = 'danger';
				  ?>
                    <a onClick="update_cms_status(<?php echo $row->pageID;?>);" href="javascript:;" id="sts_<?php echo $row->pageID;?>"> <span class="label label-<?php echo $class_label;?>"><?php echo $row->pageStatus;?></span> </a></td>
                  <td><a href="javascript:;" onClick="load_cms_edit_form(<?php echo $row->pageID;?>);" class="btn btn-success btn-xs">Edit</a> <a href="javascript:delete_cms(<?php echo $row->pageID;?>);" class="btn btn-danger btn-xs">Delete</a></td>
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
    <form name="frm_cms" id="frm_cms" role="form" method="post" action="<?php echo base_url('admin/cms/add');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Page</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="heading" name="heading" value="<?php echo set_value('heading');?>" placeholder="Heading">
              <?php echo form_error('heading'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control" name="page_slug" id="page_slug" value="<?php echo set_value('page_slug');?>" placeholder="Page Slug">
              <?php echo form_error('page_slug'); ?> </div>
            <div class="form-group">
              <label>Page Content</label>
              <textarea id="editor1" name="editor1" rows="8" cols="80" placeholder="Describe yourself with 4 words..."><?php echo set_value('editor1');?></textarea>
              <?php echo form_error('editor1'); ?> </div>
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
    <form name="frm_cms" id="frm_cms" role="form" method="post" action="<?php echo base_url('admin/cms/update');?>" onSubmit="return validate_edit_cms_form(this)">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Page</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_heading" name="edit_heading" value="<?php echo set_value('heading');?>" placeholder="Heading">
              <?php echo form_error('heading'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control" name="edit_page_slug" id="edit_page_slug" value="<?php echo set_value('page_slug');?>" placeholder="Page Slug">
              <?php echo form_error('page_slug'); ?> </div>
            <div class="form-group">
              <label>Page Content</label>
              <textarea id="edit_editor1" name="edit_editor1" rows="8" cols="80"><?php echo set_value('edit_editor1');?></textarea>
              <?php echo form_error('edit_editor1'); ?> </div>
              <input type="hidden" name="cms_id" id="cms_id" />
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
<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script type="text/javascript">
  $(function() {
   var editor = CKEDITOR.replace( 'editor1', {
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });
   
   var edit_editor = CKEDITOR.replace( 'edit_editor1', {
    enterMode : CKEDITOR.ENTER_BR,    
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });
  
  });
  
  
</script>
<?php if(validation_errors() != false){?>
<script type="text/javascript"> 
	$('#add_page_form').modal('show');
</script>
<?php } ?>
