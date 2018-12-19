<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resume_search extends CI_Controller {
	
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
		$data['msg'] = '';
		
		$total_rows = $this->resume_model->count_searched_resume_records($param);
		$obj_result = $this->resume_model->get_searched_resume($param, 20, 0);
		
		//Left Side Starts
			//$left_side_array = $this->left_side_data($param);
		//Left Side Ends
		
		$current_records = ($this->uri->segment(3)) ? $this->uri->segment(3)*20 : 20;
		$current_records = ($current_records>$total_rows)?$total_rows:$current_records;
		$data['total_rows'] = $total_rows;
		$data['page'] = $current_records;
		$data['from_record'] = 1;
		$data['result'] = $obj_result;
		$data['param'] = $param;
		$data['url_param'] = $this->uri->segment(2);
		/*$data['left_side_title'] = $left_side_array['title_group'];
		$data['left_side_city'] = $left_side_array['city_group'];
		$data['left_side_company'] = $left_side_array['company_group'];
		$data['left_side_salary_range'] = $left_side_array['salary_range_group'];*/
		$data['title'] = $param.' Search Resume';
		$this->load->view('resume_search_view',$data);
	}
	
	public function search()
	{
		$this->form_validation->set_rules('resume_params', 'keywords', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			redirect(base_url('resume_search'),'');
			return;
		}
		
		$job_param = $this->input->post('resume_params');
		
		$string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $job_param);
		$param = strtolower(preg_replace('/\s+/', '-', $string1));
	
		redirect(base_url('search-resume/'.$param),'');
		
	}
	
	public function left_side_data($param)
	{
		/*//Group By Title
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
		
		return $left_array;*/
	}
}
