<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<link href="<?php echo base_url('public/css/jquery-ui.css');?>" rel="stylesheet" type="text/css" />
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header-->
<div class="container detailinfo">
  <div class="row">
    <div class="col-md-10">
    <div id="msg"></div>
      <div class="row"> 
        <!--Company Info-->
        <div class="col-md-12">
        
          <div class="userinfoWrp">
            <div class="col-md-2 uploadPhoto">
      
            <img src="<?php echo base_url('public/uploads/candidate/'.$photo);?>"  />
            
            </div>
            <div class="col-md-6">
              <h1 class="username"><?php echo $row->first_name.' '.$row->last_name;?></h1>
               <div class="comtxt"><?php echo $latest_job_title;?></div>
              <div class="comtxt-blue"><?php echo $latest_job_company_name;?></div> 
            </div>
            <div class="col-md-4">
              <div class="usercel"><?php echo $row->city;?>, <?php echo $row->country;?></div>
              <?php if($this->session->userdata('is_employer')==TRUE):?><a href="javascript:;" id="sendcandidatemsg" style="margin-top: 10px;" class="btn btn-success btn-sm"><span>Send Message</span></a>
              <?php endif;?>
               </div>
            <div class="clear"></div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      
      <!--My CV-->
      <?php if($result_resume):?>
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-7"><b>My CV</b></div>
            <div class="col-md-5 text-right"></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <ul class="myjobList">
            <?php if($result_resume): 
		  			foreach($result_resume as $row_resume):
					$file_name = ($row_resume->is_uploaded_resume)?$row_resume->file_name:'';
					$file_array = explode('.',$file_name);
					$file_array = array_reverse($file_array);
					$icon_name = get_extension_name($file_array[0]);
		  ?>
            <li class="row" id="cv_<?php echo $row_resume->ID;?>">
              <div class="col-md-4">
              <i class="fa fa-file-<?php echo $icon_name;?>-o">&nbsp;</i>
              <?php if($row_resume->is_uploaded_resume): ?>
              	<a href="<?php echo base_url('resume/download/'.$row_resume->file_name);?>">My CV <small>(Download to your computer)</small></a>
              <?php else: ?>
			  	<a href="#">My CV</a>
			  <?php endif;?>
              </div>
              <div class="col-md-8"><?php echo date_formats($row_resume->dated, "d M, Y");?></div>
            </li>
            <?php 	endforeach; 
		  		else:?>
            No resume uploaded yet!
            <?php endif;?>
          </ul>
        </div>
      </div>
      <?php endif;?>
      
      <!--Job Detail-->
      <?php if($row_additional->summary):?>
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Professional Summary</b></div>
            <div class="col-md-3 text-right"></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="companydescription">
          <div class="row">
            <div class="col-md-12">
              <p><?php echo ($row_additional->summary)?character_limiter($row_additional->summary,500):'';?></p>
            </div>
          </div>
        </div>
      </div>
      <?php endif;?>
      <!--Experiance-->
      <?php if($result_experience):?>
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Experience</b></div>
            <div class="col-md-3 text-right"></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <?php 
			if($result_experience):
				foreach($result_experience as $row_experience):
				$date_to = ($row_experience->end_date)?date_formats($row_experience->end_date, 'M Y'):'Present';
		?>
          <div class="row expbox">
            <div class="col-md-12">
              <h4><?php echo $row_experience->job_title;?></h4>
              <ul class="useradon">
                <li class="company"><?php echo $row_experience->company_name;?></li>
                <?php if($row_experience->city || $row_experience->country):?>
                	<li><?php echo ($row_experience->city)?$row_experience->city.', ':'';?>, <?php echo $row_experience->country;?></li>
                <?php endif;?>
                <li><?php echo date_formats($row_experience->start_date, 'M Y');?> to <?php echo $date_to;?></li>
              </ul>
              <div class="action"> </div>
            </div>
          </div>
          <?php endforeach; endif;?>
          <div class="clear"></div>
        </div>
      </div>
      <?php endif;?>
      
      <?php if($result_qualification):?>
      <!--Education-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Education</b></div>
            <div class="col-md-3 text-right"></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <?php 
			if($result_qualification):
				foreach($result_qualification as $row_qualification):
			?>
          <div class="row expbox">
            <div class="col-md-12">
              <h4><?php echo $row_qualification->institude;?> <?php echo ($row_qualification->city)?', '.$row_qualification->city:'';?></h4>
              <ul class="useradon">
                <li><?php echo $row_qualification->degree_title;?>, <?php echo $row_qualification->completion_year;?></li>
                <li><?php echo $row_qualification->major;?></li>
              </ul>
              <div class="action"></div>
            </div>
          </div>
          <?php endforeach; endif;?>
          <div class="clear"></div>
        </div>
      </div>
       <?php endif;?>    
      
    </div>
    <!--/Job Detail-->
    
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
<div class="modal fade" id="send_msg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Send a Message to <?php echo $row->first_name;?></h4>
      </div>
      <div class="modal-body">
        <div id="emsg"></div>
        <div class="box-body">
          <div class="form-group">
            <label>Message</label>
            <textarea id="message" name="message"  class="form-control" rows="12" placeholder=""><?php echo set_value('message');?></textarea>
            <?php echo form_error('message'); ?> </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="jsid" name="jsid" value="<?php echo $this->uri->segment(2);?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" name="msg_submit" id="msg_submit" class="btn btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script type="text/javascript">
$("#sendcandidatemsg").click(function(){
		$('#send_msg').modal('show');
	});	
</script>
</body>
</html>