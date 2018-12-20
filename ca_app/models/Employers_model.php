<?php
class Employers_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function add_employer($data){
  
            $return = $this->db->insert('tbl_employers', $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
			
	}	
	
	public function update_employer($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_employers', $data);
		return $return;
	}
	
	public function update($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_employers', $data);
		return $return;
	}
	
	public function delete_employer($id){
		$this->db->where('ID', $id);
		$this->db->delete('tbl_employers');
	}
	
	public function authenticate_employer($user_name, $password) {
        $this->db->select('tbl_employers.*, tbl_companies.company_slug');
        $this->db->from('tbl_employers');
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'inner');
        $this->db->where('email', $user_name);
		$this->db->where('pass_code', $password);
		$this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function authenticate_employer_by_email($user_name) {
        $this->db->select('tbl_employers.*');
        $this->db->from('tbl_employers');
        $this->db->where('email', $user_name);
		$this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function authenticate_employer_by_password($ID, $password) {
        $this->db->select('*');
        $this->db->from('tbl_employers');
        $this->db->where('ID', $ID);
		$this->db->where('pass_code', $password);
		$this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function is_email_already_exists($ID, $email) {
        $this->db->select('ID');
        $this->db->from('tbl_employers');
        $this->db->where('ID !=', $ID);
		$this->db->where('email', $email);
		$this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row('ID');
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	public function get_all_employers($per_page, $page) {
        $this->db->select('tbl_employers.ID, tbl_employers.dated, tbl_employers.email, tbl_employers.first_name, tbl_employers.last_name, tbl_employers.company_ID, tbl_employers.sts, tbl_employers.city, tbl_employers.country, tbl_employers.top_employer, tbl_employers.ip_address, tbl_companies.ID AS CID, tbl_companies.company_name, tbl_companies.company_logo, tbl_companies.company_phone, tbl_companies.company_location, tbl_companies.company_slug');
        $this->db->from('tbl_employers');
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'left');
		$this->db->order_by("tbl_employers.ID", "DESC"); 
		$this->db->limit($per_page, $page);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function record_count($table_name) {
		return $this->db->count_all($table_name);
    }
	
	public function get_employer_by_id($id) {
        $this->db->select('tbl_employers.*, tbl_companies.ID AS CID,tbl_companies.company_name,tbl_companies.company_email,tbl_companies.ownership_type,tbl_companies.company_ceo,tbl_companies.industry_ID,tbl_companies.ownership_type,tbl_companies.company_description,tbl_companies.company_location,tbl_companies.no_of_offices,tbl_companies.company_website,tbl_companies.no_of_employees, tbl_companies.established_in, tbl_companies.company_logo, tbl_companies.company_folder, tbl_companies.company_type, tbl_companies.company_fax, tbl_companies.company_slug, tbl_companies.company_phone, tbl_job_industries.industry_name');
        $this->db->from('tbl_employers');
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'inner');
		$this->db->join('tbl_job_industries', 'tbl_companies.industry_ID = tbl_job_industries.ID', 'left');
		$this->db->where('tbl_employers.ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_employer_by_id_simple($id) {
        $this->db->select('tbl_employers.*');
        $this->db->from('tbl_employers');
		$this->db->where('tbl_employers.ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_employer_by_company_id($cid) {
        $this->db->select('tbl_employers.*, tbl_companies.ID AS CID,tbl_companies.company_name,tbl_companies.company_email,tbl_companies.company_ceo,tbl_companies.industry_ID,tbl_companies.ownership_type,tbl_companies.company_description,tbl_companies.company_location,tbl_companies.no_of_offices,tbl_companies.company_website,tbl_companies.no_of_employees, tbl_companies.established_in, tbl_companies.company_logo, tbl_companies.company_folder, tbl_companies.company_type, tbl_companies.company_fax, tbl_companies.company_phone');
        $this->db->from('tbl_employers');
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'left');
		$this->db->where('tbl_employers.company_ID', $cid);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
//====== Searching Employers =======	
	public function search_all_employers($per_page, $page, $search_parameters, $wild_card='') {
		
		$where = ($wild_card=='yes')?'where':'like';
        $this->db->select('tbl_employers.ID, tbl_employers.dated, tbl_employers.email, tbl_employers.first_name, tbl_employers.last_name, tbl_employers.company_ID, tbl_employers.sts, tbl_employers.top_employer, tbl_companies.ID AS CID, tbl_companies.company_name, tbl_companies.company_logo');
        $this->db->from('tbl_employers');
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'inner');
		$this->db->$where($search_parameters);
		$this->db->order_by("tbl_employers.ID", "DESC"); 
		$this->db->limit($per_page, $page);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
		//echo $this->db->last_query(); exit;
        return $return;
    }
	
	public function search_record_count($table_name, $search_parameters) {
		//return $this->db->count_all($table_name);
		$this->db->like($search_parameters);
		$this->db->from($table_name);
		$this->db->join('tbl_companies', 'tbl_employers.company_ID = tbl_companies.ID', 'left');
		return $this->db->count_all_results();
		//exit;
    }
//====== Specifically front end methods =======	
	public function get_all_active_employers($per_page, $page) {
        $Q = $this->db->query("CALL get_all_active_employers($page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }	
	
	public function get_all_active_top_employers($per_page, $page) {
        $Q = $this->db->query("CALL get_all_active_top_employers($page, $per_page)");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	
	
	public function get_company_details_by_slug($slug) {
        $Q = $this->db->query('CALL get_company_by_slug("'.$slug.'")');
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }	
}
?>
