<?php
class Companies_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function add_company($data){
  
            $return = $this->db->insert('tbl_companies', $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
			
	}	
	
	public function update_company($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_companies', $data);
		return $return;
	}
	
	public function delete_company($id){
		$this->db->where('ID', $id);
		$this->db->delete('tbl_companies');
		return true;
	}
	
	
	
	/*public function get_all_companies($per_page, $page) {
        $this->db->select('tbl_companies.*');
        $this->db->from('tbl_companies');
		$this->db->order_by("tbl_companies.ID", "DESC"); 
		$this->db->limit($per_page, $page);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }*/
	
	public function get_all_companies($per_page, $page) {
        $this->db->select('tbl_employers.ID, tbl_employers.dated, tbl_employers.email, tbl_employers.first_name, tbl_employers.last_name, tbl_employers.company_ID, tbl_employers.sts, tbl_companies.ID AS CID, tbl_companies.company_name, tbl_companies.company_phone, tbl_companies.company_website, tbl_companies.industry_ID, tbl_companies.company_logo');
        $this->db->from('tbl_companies');
		$this->db->join('tbl_employers', 'tbl_employers.company_ID = tbl_companies.ID', 'inner');
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
	
	public function get_company_by_id($id) {
        $this->db->select('tbl_companies.*');
        $this->db->from('tbl_companies');
		$this->db->where('tbl_companies.ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function check_slug($slug) {
		
		$this->db->where('company_slug', $slug);
		$this->db->from('tbl_companies');
		return $this->db->count_all_results();
    }
	
	public function check_slug_edit($CID, $slug) {
		
		$this->db->where('company_slug', $slug);
		$this->db->where('ID !=', $CID);
		$this->db->from('tbl_companies');
		return $this->db->count_all_results();
    }
	
	
	
	public function get_company_by_old_id($id) {
        $this->db->select('tbl_companies.*');
        $this->db->from('tbl_companies');
		$this->db->where('tbl_companies.old_company_id', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
}
?>
