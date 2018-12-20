<!DOCTYPE html>
<?php $company_loc = urlencode($row_posted_job->company_location.', '.$row_posted_job->emp_city.', '.$row_posted_job->emp_country.', ('.$row_posted_job->company_name.')'); ?>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta property="og:description" content="<?php 
			  	$pp = str_replace(chr(13),'<br />',$row_posted_job->job_description);
				echo strip_tags($pp,'<br>');
			  ?>" />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
<?php $len=0;
if($_SERVER['HTTP_REFERER']!=''){
	$len = 1;	
}
?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=sda&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); 
$s = ($currently_opened_jobs>1)?'s':'';
?>
<!--/Header--> 
<!--Detail Info-->
<div class="container detailinfo">
  <div class="row">
    <div class="col-md-10">
      <div id="msg"></div>
      <?php if($is_already_applied=='yes'):?>
      <div class="alert alert-info"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Heads up!</strong> You have already applied for this job.</div>
      <?php endif;?>
      <div class="row"> 
        
        <!--Company Info-->
        
        <div class="col-md-4">
          <div class="companyinfoWrp">
            <?php
				$job_title = word_limiter(strip_tags(str_replace('-',' ',$row_posted_job->job_title)),7);
			?>
            <h1 class="jobname"><?php echo humanize($job_title);?></h1>
            <div class="jobthumb"><img src="<?php echo base_url('public/uploads/employer/'.$company_logo);?>" alt="<?php echo base_url('company/'.$row_posted_job->company_slug);?>" /></div>
            <div class="jobloc"> <a href="<?php echo base_url('company/'.$row_posted_job->company_slug);?>" class="companyname" title="<?php echo $row_posted_job->company_name;?>"><?php echo $row_posted_job->company_name;?></a>
              <div class="location"><?php echo $row_posted_job->emp_city;?> &nbsp;-&nbsp; <?php echo $row_posted_job->emp_country;?></div>
              <a href="<?php echo base_url('company/'.$row_posted_job->company_slug);?>" class="currentopen" title="<?php echo $currently_opened_jobs.' Job'.$s.' in '.$row_posted_job->company_name;?>"><?php echo $currently_opened_jobs;?> Current Job<?php echo $s;?> Openings</a> </div>
            <div class="clear"></div>
          </div>
          
          <!--Apply-->
          
          <div class="actionBox">
            <h4><?php echo ($is_already_applied=='yes')?'You have already applied for this job':'To Apply for this job click below';?></h4>
            <p></p>
            <a href="javascript:;" class="<?php echo ($is_already_applied=='yes')?'applyjobgray':'applyjob';?>"><span>Apply Now</span></a> <!--<a href="#" class="refferbtn"><span>Email to Friend</span></a>--> </div>
          
          <div style="text-align:center;"><?php echo $row_posted_job->company_location.', '.$row_posted_job->emp_country;?></div>
        </div>
        <div class="col-md-8"> 
          
          <!--Job Detail-->
          
          <div class="boxwraper">
            <div class="titlebar">
              <div class="row">
                <div class="col-sm-6">Job Detail</div>
                <?php if($len){?>
                <div class="col-sm-6 text-right"><a href="javascript:;" onClick="window.history.back(-1);">Back to Search</a></div>
                <?php }?>
              </div>
            </div>
            
            <!--Job Detail-->
            
            <div class="row"> 
              
              <!--Requirements-->
              
              <div class="col-md-12">
                <ul class="reqlist">
                  <li>
                    <div class="col-sm-6">Industry:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->industry_name;?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Total Positions:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->vacancies;?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Job Type:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->job_mode;?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Salary:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->pay;?> </div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Job Location:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->city.', '.$row_posted_job->country;?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Minimum Education:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->qualification;?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Minimum Experience:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->experience;?> <?php echo ($row_posted_job->experience<2)?'Year':'Years';?></div>
                    <div class="clear"></div>
                  </li>
                  <?php if($row_posted_job->age_required):?>
                  <li>
                    <div class="col-sm-6">Age Required:</div>
                    <div class="col-sm-6"><?php echo $row_posted_job->age_required;?> Years</div>
                    <div class="clear"></div>
                  </li>
                  <?php endif;?>
                  <li>
                    <div class="col-sm-6">Apply By:</div>
                    <div class="col-sm-6"><?php echo date_formats($row_posted_job->last_date, 'M d, Y');?></div>
                    <div class="clear"></div>
                  </li>
                  <li>
                    <div class="col-sm-6">Job Posting Date:</div>
                    <div class="col-sm-6"><?php echo date_formats($row_posted_job->dated, 'M d, Y');?></div>
                    <div class="clear"></div>
                  </li>
                </ul>
              </div>
              
              <div class="clear"></div>
            </div>
            
            <!--Job Description-->
            
            <div class="jobdescription">
              <div class="row">
                <div class="col-md-12">
                  <div class="subtitlebar">Job Description</div>
                  <p>
                  <h2 class="normal-details">
                    <?php 
			  	$pp = str_replace(chr(13),'<br />',$row_posted_job->job_description);
				echo strip_tags($pp,'<br>');
			  ?>
                  </h2>
                  </p>
                </div>
                <?php if($required_skills && $required_skills[0]!=''):?>
                <div class="col-md-12">
                  <div class="subtitlebar">Skills Required</div>
                  <div class="skillBox">
                    <ul class="skillDetail">
                      <?php foreach($required_skills as $skill):?>
                      <li><a href="<?php echo base_url();?>search-jobs/<?php echo make_slug($skill);?>" target="_blank"><?php echo $skill;?></a></li>
                      </li>
                      <?php endforeach;?>
                      <div class="clear"></div>
                    </ul>
                  </div>
                </div>
                <?php endif;?>
              </div>
              <div class="actionBox footeraction">
                <h4><?php echo ($is_already_applied=='yes')?'You have already applied for this job':'To Apply for this job click below';?></h4>
                <a href="javascript:;" class="<?php echo ($is_already_applied=='yes')?'applyjobgray':'applyjob';?>"><span>Apply Now</span></a> </div>
              <div class="clear">&nbsp;</div>
              <div class="footeraction">
                <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a velit sed risus pulvinar faucibus. Nulla facilisi. Nullam vehicula nec ligula eu vulputate. Nunc id ultrices mi, ac tristique lectus. Suspendisse porta ultrices ultricies."</p>
                <h4 style="text-align:center;"><a href="javascript:;" id="scammer" class="btn btn-danger"><span>Report this Employer</span></a></h4>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
    
    <!--/Job Detail-->
    
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
<div class="modal fade" id="japply">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Apply For This Job</h4>
      </div>
      <div class="modal-body">
        <div id="emsg"></div>
        <div class="box-body">
          <div class="form-group">
            <label>Monthly Expected Salary:</label>
            <select name="expected_salary" id="expected_salary" class="form-control">
              <?php
					foreach($result_salaries as $row_salaries):
						$selected = (set_value('expected_salary')==$row_salaries->val)?'selected="selected"':'';
				?>
              <option value="<?php echo $row_salaries->val;?>" <?php echo $selected;?>><?php echo $row_salaries->val;?></option>
              <?php endforeach;?>
            </select>
            <?php echo form_error('expected_salary'); ?> </div>
          <div class="form-group">
            <label>Cover Letter</label>
            <textarea id="cover_letter" name="cover_letter"  class="form-control" placeholder=""><?php echo set_value('cover_letter');?></textarea>
            <?php echo form_error('cover_letter'); ?> </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="jid" name="jid" value="<?php echo $row_posted_job->ID;?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" name="submitter" id="submitter" class="btn btn-primary">Apply</button>
      </div>
    </div>
  </div>
</div>
<!--Scam-->
<div class="modal fade" id="scam">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Report this Employer</h4>
      </div>
      <div class="modal-body">
        <div id="scam_emsg"></div>
        <div class="box-body">
          <div class="form-group">
            <label>Company Name: <span style="font-weight:normal;"><?php echo $row_posted_job->company_name;?></span></label>
          </div>
          <div class="form-group">
            <label>Job: <span style="font-weight:normal;"><?php echo $row_posted_job->job_title;?></span></label>
          </div>
          <div class="form-group">
            <label>Reason</label>
            <textarea id="reason" name="reason"  class="form-control" placeholder=""><?php echo set_value('reason');?></textarea>
            <?php echo form_error('reason'); ?> </div>
          <div class="form-group">
            <label class="input-group-addon">Please enter: <span id="ccode"><?php echo $cpt_code;?></span> in the text box below:</label>
            <input type="text" class="form-control" name="captcha" id="captcha" value="" maxlength="10" autocomplete="off"/>
            <?php echo form_error('captcha'); ?> </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="scjid" name="scjid" value="<?php echo $row_posted_job->ID;?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" name="scam_submit" id="scam_submit" class="btn btn-primary">Report this Employer</button>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
<?php if($this->session->userdata('is_job_seeker')==TRUE):?>
<script type="text/javascript">
$( document ).ready(function() {
	var apply = '<?php echo $is_apply;?>';
	var is_already_applied = '<?php echo $is_already_applied;?>';
	if(apply=='yes' && is_already_applied=='no'){
		$('#japply').modal('show');
	}
	/*else{
		bootbox.alert("You have already applied for this job!");	
	}*/
	$(".applyjob").click(function(){
		if(is_already_applied=='yes')
			bootbox.alert("You have already applied for this job!");
		else
			$('#japply').modal('show');
	});	
	
	$("#scammer").click(function(){
		$('#scam').modal('show');
	});
	
	<?php 
	if(@$_GET['sc']=='yes'){?>
		$('#scam').modal('show');
	<?php } ?>
	
});
</script>
<?php else: ?>
<script type="text/javascript">
$(".applyjob").click(function(){
	<?php if($this->session->userdata('is_job_seeker')!=TRUE && $this->session->userdata('is_user_login')==TRUE):?>
	$('#msg').html('<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Error!</strong> You are not logged in with a jobseeker account. Please re-login with a jobseeker account to apply for this job. </div>');
		return false;
	<?php endif; ?>
		document.location = "<?php echo base_url('/jobs/'.$row_posted_job->job_slug.'?apply=yes');?>";
	});	
$("#scammer").click(function(){
	document.location = "<?php echo base_url('/jobs/'.$row_posted_job->job_slug.'?sc=yes');?>";
});		
</script>
<?php endif;?>
</body>
</html>