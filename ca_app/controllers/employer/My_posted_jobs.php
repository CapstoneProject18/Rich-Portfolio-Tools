<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Posted_Jobs extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.': My Posted Jobs';
		
		$row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		
		//Pagination starts
		$total_rows = $this->posted_jobs_model->count_all_posted_jobs_by_company_id_frontend($row->company_ID);
		$config = pagination_configuration(base_url("employer/my_posted_jobs"), $total_rows, 10, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		//Jobs by company
		$result_posted_jobs = $this->posted_jobs_model->get_active_deactive_posted_job_by_company_id($row->company_ID, $config["per_page"], $page);
		$company_logo = ($row->company_logo)?$row->company_logo:'no_logo.jpg';
		
		$job_url = $row->company_slug.'-jobs-in-';
		
		$data['row'] 				= $row;
		$data['job_url']		 	= $job_url;
		$data['result_posted_jobs'] = $result_posted_jobs;
		$data['company_logo'] 		= $company_logo;
		$this->load->view('employer/my_posted_jobs_view',$data);
	}
	
}
