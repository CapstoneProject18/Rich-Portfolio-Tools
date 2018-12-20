<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cv_Builder extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.': CV Builder';
		
		//Additional Info
		$row_additional = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		
		//Skills
		$keywords = $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		$is_keywords_provided = $keywords;
		
		if($is_keywords_provided<3){
			  redirect(base_url('jobseeker/add_skills'));
			  exit;
		}
		
		//Personal Info
		$row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
		
		//Experience
		$result_experience = $this->job_seekers_model->get_experience_by_jobseeker_id($this->session->userdata('user_id'));
		
		//Qualification
		$result_qualification = $this->job_seekers_model->get_qualification_by_jobseeker_id($this->session->userdata('user_id'));
		
		$photo = ($row->photo)?$row->photo:'no_pic.jpg';
		$data['row']= $row;
		$data['result_experience']= $result_experience;
		$data['result_qualification']= $result_qualification;
		$data['result_cities'] 			= $this->cities_model->get_all_cities();
		$data['result_countries'] 		= $this->countries_model->get_all_countries();
		$data['result_degrees'] 		= $this->qualification_model->get_all_records();
		$data['photo'] = $photo;
		$this->load->view('jobseeker/cv_builder_view',$data);
	}
	
}
