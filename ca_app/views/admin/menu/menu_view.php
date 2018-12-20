<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/before_head_close');?>
<link href="<?php echo base_url('public/css/admin/bootstrap-editable.css');?>" rel="stylesheet" type="text/css" />
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
    <h1> Menu Management
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <!--<li><a href="#">Examples</a></li>-->
      <li class="active">Manage Menus</li>
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
            <h3 class="box-title">All Menu</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div class="text-right" style="padding-bottom:2px;">
              <div style="background-color:#fbfbfb; padding:10px; margin:0; border:1px solid #e5e5e5;" class="row">
                <div class="col-md-2 margin-bottom-special" style="line-height:29px;"><label>Select a menu to edit:</label></div>
                <div class="col-md-4 margin-bottom-special" style="padding-right:2px;">
                
                  <select id="menus" name="menus" class="form-control">
                  <?php if($result_menu):
				  			foreach($result_menu as $menu_row):
				  ?>
                    <option value="<?php echo $menu_row->menuID;?>"><?php echo $menu_row->menuName;?></option>
                  <?php endforeach; endif; ?>
                </select>
                </div>
                <div class="col-md-4 margin-bottom-special text-left" style="padding-left:2px;">
                  <input type="button" value="Select" id="select_menu_btn" name="select_menu_btn" class="btn btn-primary">
                  or <a href="javascript:;" class="btn btn-success" onClick="load_menu_popup('add','');">Create a new menu</a>
                </div>
                <div class="col-md-2 margin-bottom-special">&nbsp;</div>
              </div>
         
            
            <!--<a type="button" class="btn btn-primary btn-sm" id="addpage" href="javascript:;" onClick="load_menu_popup('add','');">Add New Menu</a>-->
            </div>
            <div class="clearfix">&nbsp;</div>
            
            
            
            <div class="row">
            	<div class="col-md-4">
                	<div class="box">
          				<div class="box-header">
            				<h3 class="box-title">All Published Pages</h3>
            			<div>
                    </div>
          		</div>
          
          <!-- /.box-header -->
          <form name="pselectedfrm" id="pselectedfrm" method="post">
          <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <tbody>
              <?php if($result_pages):
			  		 foreach($result_pages as $row_page):
              ?>
                <tr>
                  <td width="20"><input type="checkbox" id="pselected[]" name="pselected[]" value="<?php echo $row_page->pageID;?>" />
                  </td>
                  <td><?php echo $row_page->pageTitle;?></td>
                </tr>
              <?php endforeach; endif;?>
              <tr>
              <td colspan="2">
              <a href="javascript:;" class="clscustom" id="idcustom" data-type="text" data-send="always" data-pk="001" title="Enter Custom URL" data-name="custom" data-url="<?php echo base_url("admin/menu/update_page_display_name");?>" data-original-title="Enter Custom URL">Custom URL</a>
              </td>
              </tr>
                </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
          <div class="row" style="padding: 0px 10px 0px 10px;">
          <div class="col-md-12" id="msg_page_section" style="color:red; text-align:right;"></div>
          	<div class="col-md-6">
          		<a href="javascript:;">Select All</a>
            </div>
            <div class="col-md-6 text-right">
            	<input type="hidden" id="menu_selected_id" name="menu_selected_id" value="" />
          		<input type="submit" name="psubmit" class="btn" id="psubmit" value="Add To Menu" />
            </div>
          </div>
          </form>
          <div class="clearfix">&nbsp;</div>
          <!-- /.box-body --> 
        </div>
                </div>
                
                <div class="col-md-8">
                    <div class="box">
          				<div class="box-header">
            				<h3 class="box-title">Menu Structure</h3>
            			<div>
                    </div>
          		</div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover">
              <tbody id="menu_pages">
               
                </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
          <div class="row" style="padding: 0px 10px 0px 10px;">
          	<div class="col-md-6">
            <div id="d_m_p"></div>
            </div>
            <div class="col-md-6 text-right">
          		
            </div>
          </div>
          <div class="clearfix">&nbsp;</div>
          <!-- /.box-body --> 
        </div>
                </div>
            </div>
            
            
          </div>
          
          <!-- /.box-body --> 
        </div>
        <!-- /.box --> 
        
        <!-- /.box --> 
      </div>
    </div>
  </section>
  <!-- /.content --> 
</aside>
<form name="frm_menu" id="frm_menu" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="menu_popup_box">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage Menu</h4>
        </div>
        <div class="modal-body">
          <div id="msg_box" style="padding-bottom:5px;"></div>
          <div class="box-body">
            <div id="load_menu_form"><i class="fa fa-refresh fa-spin" style="font-size:20px;"></i></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="page_submit" id="page_submit" class="btn btn-primary">Sumbit <span id="spinner_profile" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span></button>
          </div>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
</form>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('admin/common/before_body_close');?>
<?php $this->load->view('admin/common/footer'); ?>

<script src="<?php echo base_url('public/js/admin/bootstrap-editable.min.js'); ?>"></script>
<script>
//$(".clscustom").editable();

$('.clscustom').editable({
	success: function(response, newValue) {
        if(response.msg == 'done') {
			alert('Success..');	
		}
    }
});

</script>

<script type="text/javascript" src="<?php echo base_url('public/js/admin/menu.js');?>"></script>
