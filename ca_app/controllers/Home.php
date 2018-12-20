<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		
		$data['title'] = 'Online Jobs around the world';
		
		//Latest jobs section
		$latest_jobs_result = $this->posted_jobs_model->get_opened_jobs_home_page(20, 0);
		$total_posted_jobs 	= $this->posted_jobs_model->record_count('tbl_post_jobs');
	
		//Top employer section
		$top_employer_result= $this->employers_model->get_all_active_top_employers(32, 0);
		$total_employers 	= $this->employers_model->record_count('tbl_employers');
		
		//Feature jobs
		$featured_job_result= $this->posted_jobs_model->get_active_featured_posted_job(10, 0);
		
		//Cities
		$data['cities_res'] = $this->cities_model->get_all_active_cities();
		
		$data['total_posted_jobs'] = $total_posted_jobs;
		$data['latest_jobs_result'] = $latest_jobs_result;
		$data['top_employer_result'] = $top_employer_result;
		$data['total_employers'] = $total_employers;
		$data['featured_job_result'] = $featured_job_result;		
		$this->load->view('home_view',$data);
	}
}
