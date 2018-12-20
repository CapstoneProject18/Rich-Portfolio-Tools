<?php
class Resume_model extends CI_Model {
	
	private $table_name = 'tbl_seeker_resumes';
	
    public function __construct() {
	   $this->load->database();
    }
    
	public function add($data){
  
            $return = $this->db->insert($this->table_name, $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
			
	}	
	
	public function update($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update($this->table_name, $data);
		return $return;
	}
	
	public function delete($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table_name);
	}
	
	public function delete_by_id_seeker_id($id, $seeker_id){
		$this->db->where('ID', $id);
		$this->db->where('seeker_ID', $seeker_id);
		$this->db->delete($this->table_name);
	}
	
	public function get_all_records() {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->order_by("ID", "ASC");
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
	
	public function get_records_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_records_by_seeker_id($seeker_id, $per_page='', $page='') {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('seeker_ID', $seeker_id);
		if($per_page!='')
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
	
	public function count_records_jobseeker_id($seeker_id) {		
		$this->db->where('seeker_ID', $seeker_id);
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}
	
	//Search
	public function get_searched_resume($param, $per_page, $page) {
       $Q = $this->db->query('CALL ft_search_resume("'.$param.'", '.$page.', '.$per_page.')');
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
    }
	public function count_searched_resume_records($param) {
		$Q = $this->db->query('CALL count_ft_search_resume("'.$param.'")');	
		 if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
		
    }
}