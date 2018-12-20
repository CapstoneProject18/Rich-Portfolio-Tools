<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Jobs extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.': My Jobs';
		
		//Additional Info
		$row_additional = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		
		//Skills
		$keywords = $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		$is_keywords_provided = $keywords;
		
		if($is_keywords_provided<3){
			  redirect(base_url('jobseeker/add_skills'));
			  exit;
		}
		
		//Pagination starts
		$total_rows = $this->applied_jobs_model->count_applied_job_jobseeker_id($this->session->userdata('user_id'));
		$config = pagination_configuration(base_url("jobseeker/my_jobs"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		//Applied Jobs by Employer ID
		$result_applied_jobs = $this->applied_jobs_model->get_applied_jobs_by_jobseeker_id($this->session->userdata('user_id'), $config["per_page"], $page);
		$data['result_applied_jobs']= $result_applied_jobs;
		$this->load->view('jobseeker/my_jobs_view',$data);
	}
	
}
