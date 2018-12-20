<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('common/meta_tags'); ?>
<meta name="keywords" content="<?php echo $param;?> Jobs" />
<meta name="description" content="<?php echo $param;?> Jobs ,Find best Jobs. Jobs at <?php echo SITE_NAME;?>." />
<title><?php echo $title;?></title>
<?php $this->load->view('common/before_head_close'); ?>
</head>
<body>
<?php $this->load->view('common/after_body_open'); ?>
<div class="siteWraper">
<!--Header-->
<?php $this->load->view('common/header'); ?>
<!--/Header--> 
<!--Search Block-->
<div class="top-colSection">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="employersection">
          
          <div class="col-md-9">            
            <?php echo form_open_multipart('resume_search/search',array('name' => 'rsearch', 'id' => 'rsearch'));?>
            
            <div class="input-group">      
       		<input type="text" name="resume_params" id="resume_params" class="form-control" placeholder="Skill or Job Title" value="<?php echo $param;?>" />
              <span class="input-group-btn">
                 <input type="submit" name="resume_submit" class="btn" id="resume_submit" value="Search Job" />
              </span>
            </div> 
            
            <?php echo form_close();?> </div>
            
            <div class="col-md-3">            
            <a href="<?php echo base_url('employer/post_new_job');?>" title="jobs" class="postjobbtn">Post a Job</a>
            <div class="clear"></div>
          </div>
            
          <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--/Search Block--> 
<!--Latest Jobs Block-->
<div class="innerpageWrap">
<div class="container">
  <div class="row"> 
    
    <!--Left Col-->
    
    <?php 
	/*if($this->uri->segment(1)!='search'):
	if($result):
  		$this->load->view('common/left_job_search');
	endif;
	endif;*/
	?>
    
    <!--Mid Col-->
    
    <div class="searchjoblist col-md-<?php echo ($result)?'10':'10';?>"> 
      
      <!--Jobs List-->
      
      <div class="boxwraper">
        <div class="titlebar">
          <div class="row">
            <div class="col-md-6"><b><?php echo $param;?> resume</b></div>
            <div class="col-md-6 text-right"><strong>Resume <?php echo $from_record.' - '.$page;?> of <?php echo ($total_rows>20)?'20':$total_rows;?></strong> </div>
          </div>
        </div>
        <div class="row searchlist"> 
          
          <!--Job Row-->
          
          <?php 
		if($result):
			foreach($result as $row):
				$candidate_logo = ($row->photo)?$row->photo:'no_pic.jpg';
				if (!file_exists(realpath(APPPATH . '../public/uploads/candidate/thumb/'.$candidate_logo))){
					$candidate_logo='no_pic.jpg';
				}
				$age = date_difference_in_years($row->dob, date("Y-m-d"));
				$encrypt_id = $this->custom_encryption->encrypt_data($row->ID);
				$row_latest_exp = $this->jobseeker_experience_model->get_latest_job_by_seeker_id($row->ID);
				
				$lastest_job_title = ($row_latest_exp)?word_limiter(strip_tags(ucwords($row_latest_exp->job_title)),15):'';
				$edu_row = $this->jobseeker_academic_model->get_record_by_seeker_id($row->ID);
				
				$latest_education = ($edu_row)?$edu_row->degree_title.' - '.$edu_row->institude.', '.$edu_row->city:'';
				$latest_education = trim(ucwords($latest_education),', ');
				
				$total_experience = $this->jobseeker_experience_model->get_total_experience_by_seeker_id($row->ID);
				$total_experience = number_format($total_experience,'1','.','');
				$total_experience = ($total_experience>0)?$total_experience.' years':'';
				$final_exp ='';
				$total_experience_array = explode('.',$total_experience);
				
				if(count($total_experience_array)>1){
					
					$year = ($total_experience_array[0]>0)?$total_experience_array[0]:'';
					$year = $year.' '.get_singular_plural($year, 'Year', 'Years');
					
					$monthval = substr($total_experience_array[1],0,1);
					$month = ($monthval>0)?$monthval:'';
					$month = $month.' '.get_singular_plural($month, 'Month', 'Months');
					
					$final_exp = (trim($year)!='' && trim($month)!='')?$year.' and '.$month:$year.' '.$month;
					$final_exp = trim($final_exp);
				}
				else{
					$final_exp ='No Experience';	
				}
				
				$keywords_array = explode(', ',@$row->keywords);
		?>
          <div class="col-md-12">
            <div class="intlist">
              <div class="col-md-2"><a href="<?php echo base_url('candidate/'.$encrypt_id);?>" target="_blank" class="thumbnail"><img src="<?php echo base_url('public/uploads/candidate/thumb/'.$candidate_logo);?>" alt="<?php echo $row->first_name;?>" style="max-height:80px;" /></a></div>
              <div class="col-md-10">
                <div class="col-md-7">
                  <div> <a href="<?php echo base_url('candidate/'.$encrypt_id);?>" target="_blank" class="devtitle"><?php echo word_limiter(strip_tags($row->first_name),7);?></a> <span class="aboutloc">[ <?php echo ucwords($row->gender);?>, <?php echo $age;?>, <?php echo ucwords($row->city);?> ]</span> </div>
                  <div class="devinfo"><?php echo $lastest_job_title;?></div>
                  <div class="devexp"><?php echo $final_exp;?></div>
                  <div class="devedu"><?php echo $latest_education;?></div>
                  <?php if($keywords_array):?>
                  <div class="devinfo"><strong>Skills:</strong>
                    <?php 
				  		$i=0;
				  		foreach($this->jobseeker_skills_model->get_records_by_seeker_id($row->ID) as $keyword_row):
				  		$i++;
						if($i<5):
				  ?>
                    <a href="<?php echo base_url('search-resume/'.make_slug($keyword_row->skill_name));?>" class="keyword" target="_blank"><?php echo $keyword_row->skill_name;?></a>
                    <?php endif; endforeach;?>
                  </div>
                  <?php endif;?>
                </div>
                <div class="col-md-5"> <a href="<?php echo base_url('candidate/'.$encrypt_id);?>" target="_blank" class="applybtn">View Profile</a>
                  <div class="date"></div>
                </div>
                <div class="clear"> </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <?php 
				  			endforeach;
							else: ?>
          <div class="err" align="center">
            <p><strong> <?php echo ($param=='')?'Please enter keywords above to display the relevant opened jobs.':'Sorry, no record found';?> </strong></p>
          </div>
          <?php endif;?>
        </div>
      </div>
      
      <!--Pagination-->
      
      <div class="paginationWrap">
        <?php //echo ($result)?$links:'';?>
      </div>
    </div>
    <?php $this->load->view('common/right_ads');?>
  </div>
</div>
</div>
<!--/Latest Jobs Block-->
<?php $this->load->view('common/bottom_ads');?>
<!--Footer-->
<?php $this->load->view('common/footer'); ?>
<?php $this->load->view('common/before_body_close'); ?>
</body>
</html>