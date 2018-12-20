<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$company_name = $this->uri->segment(2);
		if($company_name==''){
			redirect(base_url(),'');
			exit;
		}
		
		$row_company = $this->employers_model->get_company_details_by_slug($company_name);
		
		if(!$row_company){
			redirect(base_url(),'');
			exit;	
		}
		
		//Jobs by company
		$result_posted_jobs = $this->posted_jobs_model->get_active_posted_job_by_company_id($row_company->ID, 100, 0);
		$total_opened_jobs = ($result_posted_jobs==0)?'0':count($result_posted_jobs);

		$company_logo = ($row_company->company_logo)?$row_company->company_logo:'no_pic.jpg';
					if (!file_exists(realpath(APPPATH . '../public/uploads/employer/'.$company_logo))){
						$company_logo='no_pic.jpg';
					}
					
		$job_url = $row_company->company_slug.'-jobs-in-';
		
		$company_website = ($row_company->company_website!='')?validate_company_url($row_company->company_website):'';
		$data['row_company'] 		= $row_company;
		$data['total_opened_jobs'] 	= $total_opened_jobs;
		$data['job_url']		 	= $job_url;
		$data['result_posted_jobs'] = $result_posted_jobs;
		$data['company_logo'] 		= $company_logo;
		$data['company_website'] 	= $company_website;
		$data['title'] 				= $row_company->company_name.' jobs in '.$row_company->city;
		$this->load->view('company_view',$data);
	}
	
	public function is_already_applied_for_job($user_id='', $job_id){
		$is_already_applied = '';
		if($this->session->userdata('is_job_seeker')==TRUE){
			$is_already_applied = $this->applied_jobs_model->get_applied_job_by_seeker_and_job_id($user_id, $job_id);
			$is_already_applied = ($is_already_applied>0)?'yes':'no';
		}	
		return $is_already_applied;
	}
}
