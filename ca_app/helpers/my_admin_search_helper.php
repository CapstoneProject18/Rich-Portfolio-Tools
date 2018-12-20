<?php
if ( ! function_exists('pagination_configuration_search')){
	function pagination_configuration_search($base_url, $total_rows, $per_page='50', $uri_segment='3', $num_links='4', $use_page_numbers=TRUE) {
		$config = array();
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_rows;
	    $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
		$config['num_links'] = $num_links;
		$config['use_page_numbers'] = $use_page_numbers;
		$config['page_query_string'] = TRUE;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
        
		//First Link
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		//Last Link
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		//Next Link
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		//Previous Link
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		//Current link
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</li></a>';
		
		//Digits Link
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		return $config;
	}
}
//Employers
if ( ! function_exists('params_to_array')){
	function params_to_array($param1, $param2, $param3, $param4) {
		$new_array = array();
		
		$indexer = substr($param1, 0,2);
		if (!array_key_exists($indexer, $new_array)) {
    		$new_array[$indexer] = substr($param1, 3);
		}
		$indexer2 = substr($param2, 0,2);
		if (!array_key_exists($indexer2, $new_array)) {
			$new_array[$indexer2] = substr($param2, 3);
		}
		$indexer3 = substr($param3, 0,2);
		if (!array_key_exists($indexer3, $new_array)) {
			$new_array[$indexer3] = substr($param3, 3);
		}
		$indexer4 = substr($param4, 0,2);
		if (!array_key_exists($indexer4, $new_array)) {
			$new_array[$indexer4] = substr($param4, 3);
		}
		
		return $new_array;
		
	}
}
if ( ! function_exists('array_key_changer')){
	function array_key_changer($param_array) {
		$new_array = array();
		
		if(@$param_array['nm']!='')
			$new_array["CONCAT(first_name, ' ', last_name)"] = url_decode($param_array['nm']);
		if(@$param_array['em']!='')
			$new_array["email"] = url_decode($param_array['em']);
		if(@$param_array['co']!='')
			$new_array["company_name"] 	= url_decode($param_array['co']);
		if(@$param_array['ct']!='')
			$new_array["city"] = url_decode($param_array['ct']);
		unset($param_array);
		return $new_array;
		
	}
}
//Job Seekers
if ( ! function_exists('array_key_changer_job_seeker')){
	function array_key_changer_job_seeker($param_array) {
		$new_array = array();
		
		if(@$param_array['nm']!='')
			$new_array["first_name"] = url_decode($param_array['nm']);
		if(@$param_array['em']!='')
			$new_array["email"] = url_decode($param_array['em']);
		if(@$param_array['ge']!='')
			$new_array["gender"] 	= url_decode($param_array['ge']);
		if(@$param_array['ct']!='')
			$new_array["city"] = url_decode($param_array['ct']);
		unset($param_array);
		return $new_array;
	}
}
//Posted Jobs
if ( ! function_exists('array_key_changer_posted_jobs')){
	function array_key_changer_posted_jobs($param_array) {
		$new_array = array();
		if(@$param_array['te']!='')
			$new_array["job_title"] = url_decode($param_array['te']);
		if(@$param_array['co']!='')
			$new_array["company_name"] = url_decode($param_array['co']);
		if(@$param_array['ct']!='')
			$new_array["city"] 	= url_decode($param_array['ct']);
		if(@$param_array['fe']!='')
			$new_array["is_featured"] = url_decode($param_array['fe']);
		if(@$param_array['st']!='')
			$new_array["pj.sts"] = url_decode($param_array['st']);
		unset($param_array);
		return $new_array;
	}
}
if ( ! function_exists('params_to_array_posted_jobs')){
	function params_to_array_posted_jobs($param1, $param2, $param3, $param4, $param5) {
		$new_array = array();
		
		$indexer = substr($param1, 0,2);
		if (!array_key_exists($indexer, $new_array)) {
    		$new_array[$indexer] = substr($param1, 3);
		}
		$indexer2 = substr($param2, 0,2);
		if (!array_key_exists($indexer2, $new_array)) {
			$new_array[$indexer2] = substr($param2, 3);
		}
		$indexer3 = substr($param3, 0,2);
		if (!array_key_exists($indexer3, $new_array)) {
			$new_array[$indexer3] = substr($param3, 3);
		}
		$indexer4 = substr($param4, 0,2);
		if (!array_key_exists($indexer4, $new_array)) {
			$new_array[$indexer4] = substr($param4, 3);
		}
		
		$indexer5 = substr($param5, 0,2);
		if (!array_key_exists($indexer5, $new_array)) {
			$new_array[$indexer5] = substr($param5, 3);
		}
		
		return $new_array;
		
	}
}