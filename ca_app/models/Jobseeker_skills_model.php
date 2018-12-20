<?php
class Jobseeker_skills_model extends CI_Model {
	
	private $table_name = 'tbl_seeker_skills';
	
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
	
	public function update_skill_frequency($original_skill, $replace_with){
		$this->db->query("UPDATE tbl_seeker_skills SET skill_name = '".$replace_with."' WHERE skill_name = '".$original_skill."'");
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
	
	public function get_all_records() {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->order_by("skill_name", "ASC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_grouped_skills() {
        $this->db->select('*, COUNT(skill_name) AS total_times');
        $this->db->from($this->table_name);
		$this->db->group_by("skill_name");
		$this->db->order_by("skill_name", "ASC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	public function get_all_grouped_skills_by_limit($end,$start) {
        $this->db->select('*, COUNT(skill_name) AS total_times');
        $this->db->from($this->table_name);
		$this->db->group_by("skill_name");
		$this->db->order_by("total_times", "DESC");
		$this->db->limit($end, $start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	public function get_all_skills() {
        $this->db->select('skill_name');
        $this->db->from($this->table_name);
		$this->db->order_by("skill_name", "ASC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_skills_by_skill_name($skill_name) {
        $this->db->select('skill_name');
        $this->db->from($this->table_name);
		$this->db->where("skill_name", $skill_name);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function record_count($table_name) {
		return $this->db->count_all($table_name);
    }
	
	public function count_jobseeker_skills_by_seeker_id($seeker_id) {
       $this->db->where('seeker_ID', $seeker_id);
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
    }
	
	public function count_jobseeker_skills_by_skill_name($skill_name) {
       $this->db->where('skill_name', $skill_name);
		$this->db->from('tbl_seeker_skills');
		return $this->db->count_all_results();
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
	
	public function get_records_by_seeker_id($seeker_id) {
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
	
	public function get_records_by_seeker_id_skill_name($seeker_id, $skill_name) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('seeker_ID', $seeker_id);
		$this->db->where('skill_name', $skill_name);
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