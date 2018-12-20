<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>
<?php $this->load->view('admin/common/meta_tags'); ?>
<?php $this->load->view('admin/common/before_head_close'); ?>
<?php $this->load->view('admin/common/datepicker'); ?>
<link rel="stylesheet" href="http://jquery-ui.googlecode.com/svn/tags/1.8.7/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo base_url('public/autocomplete/demo.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
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
    <h1> Jobseeker Management 
      <!--<small>advanced tables</small>--> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('admin/job_seekers');?>">Jobseeker</a></li>
      <li class="active">Edit Job</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content"> 
    <!-- title row -->
    <div class="row">
      <?php if(validation_errors() != false):?>
      <div class="message-container">
        <div class="callout callout-danger">
          <h4>Please correct the marked field(s) below.</h4>
        </div>
      </div>
      <?php endif;?>
      <?php if($this->session->flashdata('update_action')==true): ?>
      <div class="message-container">
        <div class="callout callout-success">
          <h4>Job has been updated successfully.</h4>
        </div>
      </div>
      <?php endif;?>
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Edit Jobseeker Information</h3>
          </div>
          
          <!-- /.box-header --> 
          <!-- form start -->
          <form name="frm_job_seeker" id="frm_job_seeker" role="form" method="post" action="<?php echo base_url('admin/edit_job/index/'.$row->ID);?>">
            <div class="box-body">
              <div class="form-group">
                <label>Category Name</label>
                <select name="industry_id" id="industry_id" class="form-control">
              <option value="" selected>Select Industry</option>
              <?php foreach($result_industries as $row_industry):
				  			$selected = ($row->industry_ID==$row_industry->ID)?'selected="selected"':'';
				  ?>
              <option value="<?php echo $row_industry->ID;?>" <?php echo $selected;?>><?php echo $row_industry->industry_name;?></option>
              <?php endforeach;?>
            </select>
                <?php echo form_error('industry_id'); ?> </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Job Title</label>
                <input name="job_title" type="text" class="form-control" id="job_title" placeholder="Job Title" value="<?php echo $row->job_title; ?>" maxlength="150">
                <?php echo form_error('job_title'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Vacancies</label>
                <select name="vacancies" id="vacancies" class="form-control">
              <?php for($i=1;$i<=50;$i++):
			  		$selected = ($row->vacancies==$i)?'selected="selected"':'';
			  ?>
              <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
              <?php endfor;?>
            </select>
                <?php echo form_error('vacancies'); ?> </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Experience</label>
                <select name="experience" id="experience" class="form-control">
              <option value="Fresh" <?php echo ($row->experience=='Fresh')?'selected="selected"':'';?>>Fresh</option>
              <option value="Less than 1" <?php echo ($row->experience=='Less than 1 year')?'selected="selected"':'';?>>Less than 1 year</option>
              <?php for($i=1;$i<=10;$i++):
			  		$selected = ($row->experience==$i)?'selected="selected"':'';
					$year = ($i<2)?'year':'years';
			  ?>
              <option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i?></option>
              <?php endfor;?>
              <option value="10+" <?php echo ($row->experience=='10+')?'selected="selected"':'';?>>10+</option>
            </select>
                <?php echo form_error('experience'); ?> </div>
              <div class="form-group">
                <label>Job Mode</label>
                <select name="job_mode" id="job_mode" class="form-control">
              <option value="Full Time" <?php echo ($row->job_mode=='Full Time')?'selected="selected"':'';?>>Full Time</option>
              <option value="Part Time" <?php echo ($row->job_mode=='Part Time')?'selected="selected"':'';?>>Part Time</option>
              <option value="Home Based" <?php echo ($row->job_mode=='Home Based')?'selected="selected"':'';?>>Home Based</option>
            </select>
                <?php echo form_error('job_mode'); ?> </div>
                
              <div class="form-group">
                <label for="exampleInputPassword1">Pay</label>
                <select name="pay" id="pay" class="form-control">
              <?php
					foreach($result_salaries as $row_salaries):
						$selected = ($row->pay==$row_salaries->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_salaries->val;?>" <?php echo $selected;?>><?php echo $row_salaries->text;?></option>
              <?php endforeach;?>
            </select>(<em>in thousands</em>)
                <?php echo form_error('pay'); ?> </div>
                
                <div class="form-group">
                <label>Apply By</label>
                <input name="last_date" type="text" readonly class="form-control" id="last_date" placeholder="Apply Before" value="<?php echo date_formats($row->last_date,'m/d/Y'); ?>" maxlength="40">
                <?php echo form_error('last_date'); ?> </div>
                
                <div class="form-group">
                <label>Country</label>
                <select name="country" id="country" class="form-control" onChange="grab_cities_by_country(this.value);" style="width:50%">
              <?php 
					foreach($result_countries as $row_country):
						$selected = ($row->country==$row_country->country_name)?'selected="selected"':'';
						
				?>
              <option value="<?php echo $row_country->country_name;?>" <?php echo $selected;?>><?php echo $row_country->country_name;?></option>
              <?php endforeach;?>
            </select>
                <?php echo form_error('country'); ?> 
                </div>
                
                <div class="form-group">
                <label for="exampleInputPassword1">City</label>
                <input name="city" type="text" class="form-control" id="city" value="<?php echo $row->city; ?>" maxlength="50">
                <?php echo form_error('city'); ?> 
                </div>
                
              <div class="form-group">
                <label for="exampleInputPassword1">Qualification</label>
                <select name="qualification" id="qualification" class="form-control" style="width:50%">
              <option value="">Select Qualification</option>
              <?php 
					foreach($result_qualification as $row_qualification):
						$selected = ($row->qualification==$row_qualification->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_qualification->val;?>" <?php echo $selected;?>><?php echo $row_qualification->text;?></option>
              <?php endforeach;?>
            </select>
                <?php echo form_error('qualification'); ?> </div>
                
                
              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="editor1" id="editor1" cols="60" rows="10" ><?php echo $row->job_description; ?></textarea>
                <?php echo form_error('editor1'); ?> </div>
                
                
                
                <!--Required Skills-->
      <div class="formwraper">
        <h3 class="box-title">Required Skills</h3>
        <div class="formint">
          <div class="jobdescription" style="border-top:0px;">
            <div class="row">
              <div class="col-md-12">
                <div class="skillBox">
                  <ul class="skillDetail" id="myskills">
                    <?php 
				  	if($row->required_skills):
						$selected_skills = explode(', ',$row->required_skills);
				  		foreach($selected_skills as $each_skill):
						if(trim($each_skill)!=''): ?>
                    <li><?php echo trim($each_skill);?> <a href="javascript:remove_job_skill('<?php echo trim($each_skill);?>');" class="delete"><i class="fa fa-times-circle"></i></a></li>
                   <?php 
				   		endif;
				   		endforeach;
				   	endif;
				   ?>
                  </ul>
                  <div class="clear"></div>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="input-group">
            <label class="input-group-addon">Add Skill<span>*</span></label>
            <div class="row">
              <div class="col-md-8">
              <div class="ui-widget">
                <input type="text" name="skill" id="skill" value="" autocomplete="off" class="form-control" />
                <input type="hidden" name="s_val" id="s_val" value="<?php echo (set_value('s_val'))?set_value('s_val'):$row->required_skills; ?>" class="form-control" />
              </div>
              </div>
              <div class="col-md-2">
                <input type="button" name="js_skill_add" id="js_skill_add" value="Add" class="btn btn-success" />
              </div>
            </div>
          </div>
        </div>
      </div>
      
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        <!-- /.box --> 
        
      </div>
      <div> </div>
      <!-- /.col --> 
    </div>
    <!-- info row --> 
    
  </section>
  <!-- /.content --> 
</aside>
<!-- /.right-side -->
<?php $this->load->view('admin/common/footer'); ?>
<script src="<?php echo base_url('public/js/jquery-ui.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/functions.js');?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/validate_employer.js');?>" type="text/javascript"></script> 
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
    });
	//$.noConflict(); 
	$(document).ready(function($) {
    $( "#last_date" ).datepicker({ minDate: 0, maxDate: "+5M +10D" });
  });
   </script>
<script>
$(function() {
    var availableSkills = <?php echo $available_skills;?>;
    $( "#skill" ).autocomplete({source: availableSkills});
  });
</script>