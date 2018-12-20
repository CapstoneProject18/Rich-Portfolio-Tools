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
    <h1> Manage Newsletter
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Newsletter Management</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <?php if($this->session->flashdata('added_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>Newsletter has been added successfully.</h4>
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
      
      <?php if($this->session->flashdata('force_send_action')==true): ?>
      <div class="message-container">
      	<div class="callout callout-success">
        <h4>Force sent newsletter successfully.</h4>
      </div>
      </div>
      <?php endif;?>
      
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">All Newsletter Templates</h3>
            <!--Pagination-->
            <div class="paginationWrap"> <?php echo ($result)?$links:'';?> </div>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
              <input type="button" class="btn btn-primary btn-sm" value="Add New Newsletter" onClick="load_newsletter_add_form();" />
            </div>
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Added Date</th>
                  <th>Email Subject</th>
                  <th>Days from Enrollment</th>
                  <th>Preview</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
				if($result):
					foreach($result as $row):?>
                <tr id="row_<?php echo $row->ID;?>">
                  <td><?php echo date_formats($row->dated, 'd/m/Y');?></td>
                  <td><?php echo ellipsize($row->email_subject,36,.8);?></td>
                  <td><?php echo $row->email_interval;?></td>
                  <td><a href="<?php echo base_url('admin/manage_newsletters/preview/'.$row->ID);?>" target="_blank">Preview</a></td>
                  <td><?php
				  		if($row->status=='active')
							$class_label = 'success';
						else
							$class_label = 'danger';
				  ?>
                    <a onClick="update_newsletter_status(<?php echo $row->ID;?>);" href="javascript:;" id="sts_<?php echo $row->ID;?>" style="margin:1px;"> <span class="label label-<?php echo $class_label;?>"><?php echo camelize($row->status);?></span> </a></td>
                  <td>
                  <a href="<?php echo base_url('admin/manage_newsletters/download_newsletter/'.$row->ID);?>" class="btn btn-primary btn-xs" style="margin:1px;">Download HTML Template</a> <br />
                  <a href="javascript:;" onClick="load_newsletter_edit_form(<?php echo $row->ID;?>);" class="btn btn-primary btn-xs" style="margin:1px;">Edit HTML Template</a> <br />
                  <a href="javascript:;" onClick="load_newsletter_force_form(<?php echo $row->ID;?>);" class="btn btn-primary btn-xs" style="margin:1px;">Force Send This Email</a><br />
                  <a href="javascript:delete_newsletter(<?php echo $row->ID;?>);" class="btn btn-danger btn-xs" style="margin:1px;">Delete HTML Newsletter</a></td>
                  
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
<div class="modal fade" id="add_newsletter_form">
  <div class="modal-dialog" style="width:680px;">
    <form name="frm" id="frm" role="form" method="post" action="<?php echo base_url('admin/manage_newsletters/add');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Newsletter Template</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="from_name" name="from_name" value="<?php echo set_value('from_name');?>" placeholder="From Name">
              <?php echo form_error('from_name'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="from_email" name="from_email" value="<?php echo set_value('from_email');?>" placeholder="From Email">
              <?php echo form_error('from_email'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="email_subject" name="email_subject" value="<?php echo set_value('email_subject');?>" placeholder="Email Subject">
              <?php echo form_error('email_subject'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="email_interval" name="email_interval" value="<?php echo set_value('email_interval');?>" placeholder="Email Interval (In Days)">
              <?php echo form_error('email_interval'); ?> </div>
            <div class="form-group">
              <label>Email Content</label>
              <textarea id="editor1" name="editor1" rows="8" cols="80" placeholder="Content"><?php echo set_value('editor1');?></textarea>
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
<div class="modal fade" id="edit_newsletter_form">
  <div class="modal-dialog" style="width:680px;">
    <form name="frm" id="frm" role="form" method="post" action="<?php echo base_url('admin/manage_newsletters/update');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Newsletter Template</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_from_name" name="edit_from_name" value="<?php echo set_value('edit_from_name');?>" placeholder="From Name">
              <?php echo form_error('edit_from_name'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_from_email" name="edit_from_email" value="<?php echo set_value('edit_from_email');?>" placeholder="From Email">
              <?php echo form_error('edit_from_email'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_email_subject" name="edit_email_subject" value="<?php echo set_value('edit_email_subject');?>" placeholder="Email Subject">
              <?php echo form_error('edit_email_subject'); ?> </div>
            <div class="form-group">
              <input type="text" class="form-control"  id="edit_email_interval" name="edit_email_interval" value="<?php echo set_value('edit_email_interval');?>" placeholder="Email Interval (In Days)">
              <?php echo form_error('edit_email_interval'); ?> </div>
            <div class="form-group">
              <label>Email Content</label>
              <textarea id="edit_editor1" name="edit_editor1" rows="8" cols="80" placeholder="Content"><?php echo set_value('edit_editor1');?></textarea>
              <?php echo form_error('edit_editor1'); ?> 
              </div>
              
              <input type="hidden" name="n_id" id="n_id" />
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
<!-- Force Send Email -->
<div class="modal fade" id="force_send_newsletter_form">
  <div class="modal-dialog" style="width:680px;">
    <form name="frm" id="frm" role="form" method="post" action="<?php echo base_url('admin/manage_newsletters/force_send_newsletter');?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Force Send Newsletter</h4>
        </div>
        <div class="modal-body"> 
          <!-- /.box-header --> 
          <!-- form start -->
          
          <div class="box-body">
            <div class="form-group">
              <input type="text" class="form-control"  id="email_address" name="email_address" value="<?php echo set_value('email_address');?>" placeholder="Email Address">
              <?php echo form_error('email_address'); ?> </div>
            <input type="hidden" name="n_force_id" id="n_force_id" />
          </div>
          <!-- /.box-body --> 
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="submitter" class="btn btn-primary">Force Send Email</button>
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
	fullPage: false,
	allowedContent: true, 
    toolbar: [
     { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });
   
   var edit_editor = CKEDITOR.replace( 'edit_editor1', {
    enterMode : CKEDITOR.ENTER_BR,  
	fullPage: false,
	allowedContent: true,
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
	$('#add_newsletter_form').modal('show');
</script>
<?php } ?>
