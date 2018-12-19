<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = 'Dashboard - Welcome '.$this->session->userdata('first_name');
		$row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
		
		//Latest Job
		$row_latest_exp = $this->jobseeker_experience_model->get_latest_job_by_seeker_id($row->ID);
		
		//Applied Jobs by Seeker ID
		$result_applied_jobs = $this->applied_jobs_model->get_applied_jobs_by_jobseeker_id($row->ID, 5, 0);
		
		//Experience
		$result_experience = $this->job_seekers_model->get_experience_by_jobseeker_id($this->session->userdata('user_id'));
		
		//Qualification
		$result_qualification = $this->job_seekers_model->get_qualification_by_jobseeker_id($this->session->userdata('user_id'));
		
		//Resumes
		$result_resume = $this->resume_model->get_records_by_seeker_id($this->session->userdata('user_id'), 5, 0);
		
		//Additional Info
		$row_additional = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		
		//Skills
		$keywords = $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		$is_keywords_provided = $keywords;
		
		if($is_keywords_provided<3){
			  redirect(base_url('jobseeker/add_skills'));
			  exit;
		}
		
		
		$photo = ($row->photo)?'thumb/'.$row->photo:'no_pic.jpg';
		$data['row'] 					= $row;
		$data['result_experience'] 		= $result_experience;
		$data['result_qualification'] 	= $result_qualification;
		$data['result_applied_jobs']	= $result_applied_jobs;
		$data['result_cities'] 			= $this->cities_model->get_all_cities();
		$data['result_countries'] 		= $this->countries_model->get_all_countries();
		$data['result_degrees'] 		= $this->qualification_model->get_all_records();
		$data['result_resume'] 			= $result_resume;
		$data['row_additional'] 		= $row_additional;
		$data['photo'] 					= $photo;
		$data['latest_job_title']		= ($row_latest_exp)?$row_latest_exp->job_title:'';
		$data['latest_job_company_name']= ($row_latest_exp)?$row_latest_exp->company_name:'';
		$this->load->view('jobseeker/jobseeker_dashboard_view',$data);
	}
}
