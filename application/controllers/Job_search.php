<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_search extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		if($_POST){
			$this->search();
		}
		
		$param = str_replace('-',' ', $this->uri->segment(2));
		$param = strip_tags($param);
		
		$param2 = str_replace('-',' ', $this->uri->segment(3));
		$param2 = strip_tags($param2);
		
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->posted_jobs_model->count_searched_job_records($param,$param2);
		$config = pagination_configuration(base_url("search-jobs/".$this->uri->segment(2)), $total_rows, 500, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->posted_jobs_model->get_searched_jobs($param,$param2, $config["per_page"], $page);
		
		//Left Side Starts
			$left_side_array = $this->left_side_data($param);
		//Left Side Ends
		$searched_title = ($total_rows==0)?' Search ':'';
		$current_records = ($this->uri->segment(3)) ? $this->uri->segment(3)*20 : 20;
		$current_records = ($current_records>$total_rows)?$total_rows:$current_records;
		$data['total_rows'] = $total_rows;
		$data['page'] = $current_records;
		$data['from_record'] = $page+1;
		$data['result'] = $obj_result;
		$data['param'] = $param;
		$data['url_param'] = $this->uri->segment(2); //make_job_url_from_segments($this->uri->segment_array());	
		$data['left_side_title'] = $left_side_array['title_group'];
		$data['left_side_city'] = $left_side_array['city_group'];
		$data['left_side_company'] = $left_side_array['company_group'];
		$data['left_side_salary_range'] = $left_side_array['salary_range_group'];
		$data['title'] = $param.$searched_title.' Jobs';
		$this->load->view('job_search_view',$data);
	}
	
	public function search()
	{
		//City/JobTitle/Company/
		
		$this->form_validation->set_rules('job_params', 'keywords', 'trim|required');
		$this->form_validation->set_rules('jcity', 'city', 'trim');
		if ($this->form_validation->run() === FALSE) {
			redirect(base_url('job_search'),'');
			return;
		}
		
		$job_param = $this->input->post('job_params');
		$jcity = $this->input->post('jcity');
		
		$string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $job_param);
		$param = strtolower(preg_replace('/\s+/', '-', $string1));
	
		$jstring1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $jcity);
		$param2 = strtolower(preg_replace('/\s+/', '-', $jstring1));
		
		redirect(base_url('search-jobs/'.$param.'/'.$param2),'');
		
	}
	
	public function left_side_data($param)
	{
		//Group By Title
		$title_group = $this->posted_jobs_model->get_searched_group_by_title($param);
		
		//Group By City
		$city_group = $this->posted_jobs_model->get_searched_group_by_city($param);
		
		//Group By Companies
		$company_group = $this->posted_jobs_model->get_searched_group_by_company($param);
		//Group By Salary Range
		$salary_range_group = $this->posted_jobs_model->get_searched_group_by_salary_range($param);
		
		$left_array =  array(
							'title_group' => $title_group,
							'city_group' => $city_group,
							'company_group' => $company_group,
							'salary_range_group' => $salary_range_group
		);
		
		return $left_array;
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
