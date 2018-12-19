<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_listing extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->posted_jobs_model->count_opened_job_records();
		$config = pagination_configuration(base_url("job_listing"), $total_rows, 20, 2, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(1)) ? $this->uri->segment(2) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->posted_jobs_model->get_all_opened_jobs($config["per_page"], $page);
		$data['total_rows'] = $total_rows;
		$data['page'] = $this->uri->segment(2);
		$data['from_record'] = $page+1;
		$data['result'] = $obj_result;
		
		$data['title'] = 'Jobs Listing';
		$this->load->view('job_listing_view',$data);
	}
	
	public function is_already_applied($user_id, $job_id){
		$is_already_applied = '';
		if($this->session->userdata('is_job_seeker')==TRUE){
			$is_already_applied = $this->applied_jobs_model->get_applied_job_by_seeker_and_job_id($user_id, $job_id);
			$is_already_applied = ($is_already_applied>0)?'yes':'no';
		}	
		return $is_already_applied;
	}
}
