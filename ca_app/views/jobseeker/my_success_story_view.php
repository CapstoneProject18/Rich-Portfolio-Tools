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
  <div class="row">
  <?php echo form_open_multipart('jobseeker/my_success_story',array('name' => 's_frm', 'id' => 's_frm'));?>
    
    <div class="col-md-3">
    <div class="dashiconwrp">
    <?php $this->load->view('jobseeker/common/jobseeker_menu'); ?>
  </div>
    </div>
    
    <div class="col-md-9">
    
    <?php echo $this->session->flashdata('msg');?>
      <!--Account info-->
      <div class="formwraper">
        <div class="titlehead">Post Your Success Story</div>
        <div class="formint">
          
          <div class="input-group <?php echo (form_error('title'))?'has-error':'';?>">
            <label class="input-group-addon">Title <span>*</span></label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="<?php echo set_value('title'); ?>" maxlength="100">
            <?php echo form_error('title'); ?>
            </div>
          
          <div class="input-group <?php echo (form_error('story'))?'has-error':'';?>">
            <label class="input-group-addon">Story <span>*</span></label>
            <textarea class="form-control" name="story" id="story" rows="12"><?php echo set_value('story'); ?></textarea>
            <?php echo form_error('story'); ?> </div>
            
            <div align="center">
            <input type="submit" name="submit_button" id="submit_button" value="Submit" class="btn btn-success" />
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
</body>
</html>
