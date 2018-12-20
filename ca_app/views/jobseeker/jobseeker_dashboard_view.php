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
    <div class="col-md-3">
    	<div class="dashiconwrp">
    		<?php $this->load->view('jobseeker/common/jobseeker_menu'); ?>
  		</div>
    </div>
    <div class="col-md-9">
    <div id="msg"></div>
    <div><?php echo $this->session->flashdata('msg');?></div>
    <div class="pagetitlebar">
                <i class="fa fa-tachometer"></i> <span>Dashboard</span>
                </div>
      <div class="row"> 
        <!--Company Info-->
        <div class="col-md-12">
          <div class="userinfoWrp">
            <div class="col-md-2 uploadPhoto">
            <img src="<?php echo base_url('public/uploads/candidate/'.$photo);?>"  />
            <div class="stripBox">
            <form name="frm_js_up" id="frm_js_up" method="post" action="<?php echo base_url('jobseeker/edit_jobseeker/upload_photo');?>" enctype="multipart/form-data"><input type="file" name="upload_pic" id="upload_pic" accept="image/*" style="display:none;"></form>
            <a href="javascript:;" class="upload" title="Upload Photo"><i class="fa fa-upload"></i></a>
            <?php if($row->photo!=''):?>
            <a href="javascript:;" class="remove" id="remove_pic" title="Delete Photo"><i class="fa fa-trash-o"></i></a>
            <?php endif;?>
            </div>
            </div>
            <div class="col-md-6">
              <h1 class="username"><?php echo $row->first_name.' '.$row->last_name;?></h1>
               <div class="comtxt"><?php echo $latest_job_title;?></div>
              <div class="comtxt-blue"><?php echo $latest_job_company_name;?></div> 
             <!-- <div class="socialemp">
              	<a href="javascript:;"><i class="fa fa-facebook-square"></i></a>
                <a href="javascript:;"><i class="fa fa-linkedin-square"></i></a>
              </div>-->
              
            </div>
            <div class="col-md-4">
              <div class="usercel"><?php echo $row->mobile;?></div>
              <div class="usercel"><?php echo $row->email;?></div>
              <div class="usercel"><?php echo $row->city;?>, <?php echo $row->country;?></div>
              <a href="<?php echo base_url('jobseeker/my_account');?>" id="edit_jobseeker_profileee" class="editLink"><i class="fa fa-pencil">&nbsp;</i> Edit Profile</a> </div>
            <div class="clear"></div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      
      <!--Job Detail-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Professional Summary</b></div>
            <div class="col-md-3 text-right"><a href="#" class="editlink" id="edit_desc" title="Edit"><i class="fa fa-pencil">&nbsp;</i></a></div>
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
      
      <!--Experiance-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Experience</b></div>
            <div class="col-md-3 text-right"><a href="javascript:;" id="add_exp">Add Another</a> <a href="javascript:;" id="add_exp" class="editlink" title="Edit"><i class="fa fa-plus-square">&nbsp;</i></a></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <?php 
			if($result_experience):
				foreach($result_experience as $row_experience):
				$date_to = ($row_experience->end_date)?date_formats($row_experience->end_date, 'M Y'):'Present';
		?>
          <div class="row expbox" id="exp_<?php echo $row_experience->ID;?>">
            <div class="col-md-12">
              <h4><?php echo $row_experience->job_title;?></h4>
              <ul class="useradon">
                <li class="company"><?php echo $row_experience->company_name;?></li>
                <li><?php echo $row_experience->city;?>, <?php echo $row_experience->country;?></li>
                <li><?php echo date_formats($row_experience->start_date, 'M Y');?> to <?php echo $date_to;?></li>
              </ul>
              <div class="action"><a href="javascript:;" onClick="load_edit_js_exp(<?php echo $row_experience->ID;?>);" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="javascript:;" onClick="del_exp(<?php echo $row_experience->ID;?>);" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a></div>
            </div>
          </div>
          <?php endforeach; endif;?>
          <div class="clear"></div>
        </div>
      </div>
      
      <!--Education-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>Education</b></div>
            <div class="col-md-3 text-right"><a href="javascript:;" id="add_education">Add Another</a> <a href="javascript:;" id="add_education" class="editlink" title="Edit"><i class="fa fa-plus-square">&nbsp;</i></a></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <?php 
			if($result_qualification):
				foreach($result_qualification as $row_qualification):
			?>
          <div class="row expbox" id="edu_<?php echo $row_qualification->ID;?>">
            <div class="col-md-12">
              <h4><?php echo $row_qualification->institude;?>, <?php echo $row_qualification->city;?></h4>
              <ul class="useradon">
                <li><?php echo $row_qualification->degree_title;?>, <?php echo $row_qualification->completion_year;?></li>
                <li><?php echo $row_qualification->major;?></li>
              </ul>
              <div class="action"><a href="javascript:;" onClick="load_edit_js_edu(<?php echo $row_qualification->ID;?>);" title="Edit" class="edit-ico"><i class="fa fa-pencil">&nbsp;</i></a> <a href="javascript:;" onClick="del_edu(<?php echo $row_qualification->ID;?>);"title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a></div>
            </div>
          </div>
          <?php endforeach; endif;?>
          <div class="clear"></div>
        </div>
      </div>
      
      <!--Job Application-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>My Job Applications</b></div>
            <div class="col-md-3 text-right"><a href="<?php echo base_url('jobseeker/my_jobs');?>">View All/Manage</a></div>
          </div>
        </div>
        
        <!--Job Description-->
        <div class="experiance">
          <ul class="myjobList">
            <?php if($result_applied_jobs): 
		  			foreach($result_applied_jobs as $row_applied_job):
		  ?>
            <li class="row" id="aplied_<?php echo $row_applied_job->applied_id;?>">
              <div class="col-md-4"><a href="<?php echo base_url('jobs/'.$row_applied_job->job_slug);?>"><?php echo $row_applied_job->job_title;?></a></div>
              <div class="col-md-4"><a href="<?php echo base_url('company/'.$row_applied_job->company_slug);?>"><?php echo $row_applied_job->company_name;?></a></div>
              <div class="col-md-2 text-right"><?php echo date_formats($row_applied_job->applied_date, 'M d, Y');?></div>
              <div class="col-md-2 text-right"> <a href="javascript:;" onClick="del_applied_job(<?php echo $row_applied_job->applied_id;?>);" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a></div>
            </li>
            <?php 	endforeach; 
		  		else:?>
            No record found!
            <?php endif;?>
          </ul>
        </div>
      </div>
      
      <!--Languages-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-9"><b>My Additional Information</b></div>
            <div class="col-md-3 text-right"><a href="<?php echo base_url('jobseeker/additional_info');?>">Add/Edit</a></div>
          </div>
        </div>
        
        
        <div class="experiance"> 
           <ul class="myjobList">
            <li class="row">
              <div class="col-md-2"><strong>Interest:</strong></div>
              <div class="col-md-10"><?php echo ($row_additional->interest)?character_limiter($row_additional->interest,150):' - ';?></div>
            </li>
            <li class="row">
              <div class="col-md-2"><strong>Career Objective:</strong></div>
              <div class="col-md-10"><?php echo ($row_additional->description)?character_limiter($row_additional->description,500):' - ';?></div>
            </li>
            
            <li class="row">
              <div class="col-md-2"><strong>Achievements:</strong></div>
              <div class="col-md-10"><?php echo ($row_additional->awards)?character_limiter($row_additional->awards,350):' - ';?></div>
            </li>
            
          </ul> 
        </div>
      </div>
      
      <!--My CV-->
      <div class="innerbox2">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-7"><b>My CV</b></div>
            <div class="col-md-5 text-right"><a href="<?php echo base_url('jobseeker/cv_manager');?>">CV Manager</a> <!--<a href="#">Upload CV</a>--> <a href="<?php echo base_url('jobseeker/cv_builder');?>">CV Builder</a></div>
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
              	<a href="<?php echo base_url('resume/download/'.$row_resume->file_name);?>">My CV</a>
              <?php else: ?>
			  	<a href="#">My CV</a>
			  <?php endif;?>
              </div>
              <div class="col-md-4"><?php echo date_formats($row_resume->dated, "d M, Y");?></div>
              <div class="col-md-2"><?php //echo ($row_resume->is_default_resume=='yes')?'Default':'Mark as Default';?></div>
              <div class="col-md-2 text-right"> <a href="javascript:;" onClick="del_cv(<?php echo $row_resume->ID;?>, '<?php echo $row_resume->file_name;?>')" title="Delete" class="delete-ico"><i class="fa fa-times">&nbsp;</i></a></div>
            </li>
            <?php 	endforeach; 
		  		else:?>
            No resume uploaded yet!
            <?php endif;?>
          </ul>
        </div>
      </div>
    </div>
    <!--/Job Detail-->   
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<!-- Profile Popups -->
<?php $this->load->view('jobseeker/common/jobseekes_popup_forms'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<script src="<?php echo base_url('public/js/jquery-ui.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/js/validate_jobseeker.js');?>" type="text/javascript"></script>
</body>
</html>