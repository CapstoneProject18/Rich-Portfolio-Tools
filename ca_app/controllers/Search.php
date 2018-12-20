<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		//$make_url = $this->make_url($this->uri->segment_array());
		//$search_filter = $this->search_filter($this->uri->segment_array());
		
		$param = 'Search';
		$param = str_replace('-',' ', $this->uri->segment(2));
		$data['msg'] = '';
		$search_filter = $this->cities_search($param);
		//Pagination starts
		$total_rows = $search_filter['total_rows'];
		//Pagination ends
		
		$obj_result = $search_filter['result'];
		
		//Left Side Starts
			$left_side_array = array(); //$this->left_side_data($param);
		//Left Side Ends
		$searched_title = ($total_rows==0)?' Search ':'';
		$current_records = ($this->uri->segment(3)) ? $this->uri->segment(3)*20 : 20;
		$current_records = ($current_records>$total_rows)?$total_rows:$current_records;
		$data['total_rows'] = $total_rows;
		$data['page'] = $current_records;
		$data['from_record'] = $search_filter['pagenation']['page']+1;
		$data['result'] = $obj_result;
		$data['param'] = ucwords($param);
		$data['links'] = $search_filter['pagenation']['links'];
		/*$data['left_side_title'] = $left_side_array['title_group'];
		$data['left_side_city'] = $left_side_array['city_group'];
		$data['left_side_company'] = $left_side_array['company_group'];
		$data['left_side_salary_range'] = $left_side_array['salary_range_group'];*/
		+
		$data['title'] = ucwords($param).$searched_title.' Jobs in USA';
		$this->load->view('job_search_view',$data);
	}
	
	public function make_url($segment_array){
		//City/Company/JobTitle
		
		print_r($segment_array);
		exit;	
	}
	
	public function search_filter($segment_array){
		//Removing the paging element
		foreach($segment_array as $key=>$val){
			 if(is_numeric($val)){
			 	unset($segment_array[$key]);
			 }
		}
		$total_segments = count($segment_array)-1;
		if($total_segments=3){
			
			$paging = (is_numeric($this->uri->segment(5)))?$this->uri->segment(5):'1';
			$total_rows = $this->posted_jobs_model->count_ft_job_search_filter_3($this->uri->segment(2),$this->uri->segment(3),$this->uri->segment(4));
			$config = pagination_configuration(base_url("search/".$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4)), $total_rows, 20, 5, 5, true);
			$pagenation = $this->create_pagination($config, $paging);
			
			$result = $this->posted_jobs_model->ft_job_search_filter_3($this->uri->segment(2),$this->uri->segment(3),$this->uri->segment(4), $pagenation['per_page'],$pagenation['page']);
		}
		else{
			if($total_segments==2){
					
			}
		}
		
		
		return array ('total_rows' => $total_rows, 'result' => $result, 'pagenation' => $pagenation);
	
	}
	
	public function create_pagination($config, $segment){
		$segment=($segment!='')?$segment:0;
		$this->pagination->initialize($config);
        $page 		= $segment;
		$page_num 	= $page-1;
		$page_num 	= ($page_num<0)?'0':$page_num;
		$page 		= $page_num*$config["per_page"];
		$links 		= $this->pagination->create_links();
		
		return array(
					'page' => $page,
					'page_num' => $page_num,
					'links' => $links,
					'per_page' => $config["per_page"]
		);
	}
	
	public function cities_search($city_name){
		$city_name = strtolower($city_name);
		$paging = (is_numeric($this->uri->segment(3)))?$this->uri->segment(3):'1';
		$total_rows = $this->posted_jobs_model->count_records_by_city($city_name);
		$config = pagination_configuration(base_url("search/".$city_name), $total_rows, 20, 3, 5, true);
		$pagenation = $this->create_pagination($config, $paging);
		$result = $this->posted_jobs_model->job_search_by_city($city_name, $pagenation['per_page'],$pagenation['page']);
		return array ('total_rows' => $total_rows, 'result' => $result, 'pagenation' => $pagenation);
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