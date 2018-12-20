<?php
class Posted_jobs_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function add_posted_job($data){
  
            $return = $this->db->insert('tbl_post_jobs', $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
	}	
	
	public function update_posted_job($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_post_jobs', $data);
		return $return;
	}
	
	public function delete_posted_job($id){
		$this->db->where('ID', $id);
		$this->db->delete('tbl_post_jobs');
	}
	
	public function delete_posted_job_by_employer_id($emp_id){
		$this->db->where('employer_ID', $emp_id);
		$this->db->delete('tbl_post_jobs');
	}
	
	public function delete_posted_job_by_id_emp_id($id,$emp_id){
		$this->db->where('ID', $id);
		$this->db->where('employer_ID', $emp_id);
		$return = $this->db->delete('tbl_post_jobs');
		return $return;
	}
	
	public function get_all_posted_jobs($per_page, $page) {
		$Q = $this->db->query("CALL get_all_posted_jobs(".$page.",".$per_page.")");	
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
		
	public function get_posted_job_by_id($id) {
       $Q = $this->db->query("CALL get_posted_job_by_id($id)");
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_posted_job_by_job_id($job_id) {
        $this->db->select('tbl_post_jobs.*, tbl_employers.email, tbl_employers.first_name');
        $this->db->from('tbl_post_jobs');
		$this->db->join('tbl_employers', 'tbl_post_jobs.employer_ID = tbl_employers.ID', 'inner');
        $this->db->where('tbl_post_jobs.ID', $job_id);
		$Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	
	public function get_active_posted_job_by_id($id) {
       $Q = $this->db->query("CALL get_active_posted_job_by_id($id)");
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_posted_job_by_id_employer_id($id,$employer_id) {
       $Q = $this->db->query("CALL get_posted_job_by_id_employer_id($id,$employer_id)");
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_posted_job_by_employer_ID($employer_id, $per_page, $page) {
       $Q = $this->db->query("CALL get_posted_job_by_employer_id($employer_id, $page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_posted_job_by_company_ID($company_id, $per_page, $page) {
       $Q = $this->db->query("CALL get_posted_job_by_company_ID($company_id, $page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_all_posted_jobs_by_company_id_frontend($company_id, $per_page, $page) {
       $Q = $this->db->query("CALL get_all_posted_jobs_by_company_id_frontend($company_id, $page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	public function search_all_posted_jobs($per_page, $page, $search_parameters) {
		$condition='';
		foreach($search_parameters as $key=>$val){
			$condition .= "$key LIKE '%$val%' AND ";
		}
		$condition = rtrim($condition,'AND ');
        $Q = $this->db->query('CALL search_posted_jobs("'.$condition.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
		//echo $this->db->last_query(); exit;
        return $return;
    }
	
	public function get_featured_posted_job($per_page, $page) {
       $Q = $this->db->query("CALL get_featured_job($page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	//Record Count methods
	public function record_count($table_name) {
		return $this->db->count_all($table_name);
    }
	
	public function count_records($table_name, $db_field_name, $value) {
		$this->db->where($db_field_name, $value);
		$this->db->from($table_name);
		return $this->db->count_all_results();
    }
	
	public function count_active_records($table_name, $db_field_name='', $value='') {
		if($db_field_name!='' && $value!='')
			$this->db->where($db_field_name, $value);
		$this->db->where('sts', 'active');
		$this->db->from($table_name);
		return $this->db->count_all_results();
    }
	
	public function count_opened_job_records() {
		$Q = $this->db->query("CALL count_active_opened_jobs()");	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }
	
	public function search_record_count($search_parameters) {
		$condition='';
		foreach($search_parameters as $key=>$val){
			$condition .= "$key LIKE '%$val%' AND ";
		}
		$condition = rtrim($condition,'AND ');
		$Q = $this->db->query('CALL count_search_posted_jobs("'.$condition.'")');
		if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function count_all_posted_jobs_by_company_id_frontend($company_id) {
       $Q = $this->db->query("CALL count_all_posted_jobs_by_company_id_frontend($company_id)");
        if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	
	//Specifically front end methods
	public function get_all_posted_jobs_by_status($status='active', $per_page, $page) {
		$Q = $this->db->query('CALL get_all_posted_jobs_by_status("'.$status.'",'.$page.','.$per_page.')');	
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_all_opened_jobs($per_page, $page) {
		$Q = $this->db->query('CALL get_all_opened_jobs('.$page.','.$per_page.')');	
		
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_opened_jobs_home_page($per_page, $page) {
		$Q = $this->db->query('CALL get_opened_jobs_home_page('.$page.','.$per_page.')');	
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_active_posted_job_by_company_id($company_id, $per_page, $page) {
       $Q = $this->db->query("CALL get_active_posted_job_by_company_id($company_id, $page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_active_deactive_posted_job_by_company_id($company_id, $per_page, $page) {
       $Q = $this->db->query("CALL get_active_deactive_posted_job_by_company_id($company_id, $page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }	
	
	public function get_active_featured_posted_job($per_page, $page) {
       $Q = $this->db->query("CALL get_active_featured_job($page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function count_active_opened_jobs_by_company_id($company_id) {
		$Q = $this->db->query("CALL count_active_opened_jobs_by_company_id(".$company_id.")");	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }
	
	//Search
	public function get_searched_jobs($param,$param2='', $per_page, $page) {
       $Q = $this->db->query('CALL ft_search_job("'.$param.'", "'.$param2.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	//Search Matching
	public function get_matching_searched_jobs($param, $per_page, $page) {
       $Q = $this->db->query("
	SELECT pj.ID, pj.job_title, pj.job_slug, pj.employer_ID, pj.company_ID, pj.job_description, pj.city, pj.dated, pj.last_date, pj.is_featured, pj.sts, pc.company_name, pc.company_logo, pc.company_slug

	FROM `tbl_post_jobs` pj 

	INNER JOIN tbl_companies AS pc ON pj.company_ID=pc.ID

	WHERE pj.sts = 'active' AND pc.sts = 'active' 

	AND (
			".$param."
		)

ORDER BY pj.ID DESC;
");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		@$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	
	
	public function count_searched_job_records($param,$param2) {
		$Q = $this->db->query('CALL count_ft_search_job("'.$param.'","'.$param2.'")');	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }
	
	public function get_searched_group_by_title($param) {
       $Q = $this->db->query('CALL ft_search_jobs_group_by_title("'.$param.'")');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_searched_group_by_city($param) {
       $Q = $this->db->query('CALL ft_search_jobs_group_by_city("'.$param.'")');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_searched_group_by_company($param) {
       $Q = $this->db->query('CALL ft_search_jobs_group_by_company("'.$param.'")');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function get_searched_group_by_salary_range($param) {
       $Q = $this->db->query('CALL ft_search_jobs_group_by_salary_range("'.$param.'")');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function ft_job_search_filter_3($param_city, $param_company_slug, $param_title, $per_page, $page) {
       $Q = $this->db->query('CALL ft_job_search_filter_3("'.$param_city.'", "'.$param_company_slug.'", "'.$param_title.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function count_ft_job_search_filter_3($param_city, $param_company_slug, $param_title) {
		$Q = $this->db->query('CALL count_ft_job_search_filter_3("'.$param_city.'", "'.$param_company_slug.'", "'.$param_title.'")');	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }
	public function count_records_by_city($city_name) {
		$Q = $this->db->query("CALL count_active_records_by_city_front_end('".$city_name."')");	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }	
	
	public function job_search_by_city($param_city, $per_page, $page) {
       $Q = $this->db->query('CALL job_search_by_city("'.$param_city.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	public function count_records_by_industry($industry_id) {
		$Q = $this->db->query("CALL count_active_records_by_industry_front_end('".$industry_id."')");	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }	
	
	public function job_search_by_industry($param, $per_page, $page) {
       $Q = $this->db->query('CALL job_search_by_industry("'.$param.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
}
?>
