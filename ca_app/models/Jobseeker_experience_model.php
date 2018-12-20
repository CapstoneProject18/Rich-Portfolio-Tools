<?php
class Jobseeker_experience_model extends CI_Model {
	
	private $table_name = 'tbl_seeker_experience';
	
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
	
	public function get_record_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row_array();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_seeker_id($seeker_id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('seeker_ID', $seeker_id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_latest_job_by_seeker_id($seeker_id) {
       $Q = $this->db->query("SELECT job_title, company_name, IF(end_date is null,1,0) as present
							  FROM tbl_seeker_experience
							  WHERE seeker_ID = '".$seeker_id."'
							  ORDER BY present DESC, end_date DESC LIMIT 1;");
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_total_experience_by_seeker_id($seeker_id) {
       $Q = $this->db->query("SELECT SUM(DATEDIFF( IF(end_date is null,CURRENT_DATE,end_date),start_date))/365 as total
							FROM tbl_seeker_experience
							WHERE seeker_ID ='".$seeker_id."';");
        if ($Q->num_rows() > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
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
	
}