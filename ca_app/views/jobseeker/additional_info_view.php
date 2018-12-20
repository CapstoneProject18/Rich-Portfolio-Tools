<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
  <div class="row"> <?php echo form_open_multipart('jobseeker/additional_info',array('name' => 'additional_form', 'id' => 'additional_form', 'onSubmit' => 'return validate_additional_form(this);'));?>
    
    
   <div class="col-md-3"> <div class="dashiconwrp">
        <?php $this->load->view('jobseeker/common/jobseeker_menu'); ?>
      </div>
      </div>
    
    <div class="col-md-9">
    <?php echo $this->session->flashdata('msg');?>
      
      
      <!--Personal info-->
      <div class="formwraper">
        <div class="titlehead">Additional Information</div>
        <div class="formint">
         <div class="input-group <?php echo (form_error('description'))?'has-error':'';?>">
            <label class="input-group-addon">Career Objective <span>*</span></label>
            <textarea name="description" id="description" class="form-control" rows="4"><?php echo @$row->description; ?></textarea>
            <?php echo form_error('description'); ?> </div>
            
          <div class="input-group <?php echo (form_error('awards'))?'has-error':'';?>">
            <label class="input-group-addon">Achievements <span>*</span></label>
            <textarea name="awards" id="awards" class="form-control" rows="4"><?php echo @$row->awards; ?></textarea>
            <?php echo form_error('awards'); ?> </div>
          <div align="center">
            <input type="submit" name="js_additional_submit" id="js_additional_submit" value="Update" class="btn btn-success" />
          </div>
        </div>
      </div>
    </div>
    <!--/Job Detail--> 
    <?php echo form_close();?>
   
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/validate_jobseeker.js');?>" type="text/javascript"></script>
</body>
</html>
