<?php
class Job_alert_model extends CI_Model {
	
	private $table_name = 'tbl_job_alert_queue';
	private $seeker_skill_table_name = 'tbl_seeker_skills';
	private $posted_jobs_table_name = 'tbl_post_jobs';
	private $settings_table_name = 'tbl_settings';
	
    public function __construct() {
	   $this->load->database();
    }
    
	public function add($data){
  
            $return = $this->db->insert($this->table_name, $data);
            if ((bool) $return === TRUE)
                return $this->db->insert_id();
            else
                return $return;
	}	
	
	public function add_batch($data){
  
            $return = $this->db->insert_batch($this->table_name, $data);
            if ((bool) $return === TRUE)
                return $this->db->insert_id();
            else
                return $return;
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
	
	public function update_settings($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update($this->settings_table_name, $data);
		return $return;
	}
	public function delete_by_job_id($job_id){
		$this->db->where('job_ID', $job_id);
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
	
	public function get_record_by_job_id($job_id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('job_ID', $job_id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_single_record() {
        $this->db->select('tbl_job_alert.*, tbl_post_jobs.job_title, tbl_post_jobs.job_slug, tbl_post_jobs.required_skills, tbl_post_jobs.sts');
        $this->db->from($this->table_name);
		$this->db->join('tbl_post_jobs', 'tbl_job_alert.job_ID = tbl_post_jobs.ID', 'inner');
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
	
	
	public function get_unqueued_active_jobs(){
		$this->db->select('ID, job_title, tbl_post_jobs.required_skills');
        $this->db->from($this->posted_jobs_table_name);
		$this->db->where('sts', 'active');
		$this->db->where('email_queued', '0');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
	}
	
	public function get_job_seeker_by_skill($skills){
	
		$Q = $this->db->query("SELECT seeker_ID
								FROM ".$this->seeker_skill_table_name." 
								INNER JOIN tbl_job_seekers ON seeker_ID=tbl_job_seekers.ID AND tbl_job_seekers.sts='active'
								WHERE MATCH(skill_name) AGAINST('".$skills."')
								GROUP BY seeker_ID;");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;
	}
	
	public function get_queue_list(){
		$Q = $this->db->query("SELECT jaq.ID, pj.job_title, pj.job_slug, js.first_name, js.email, ji.industry_name 
							  FROM `tbl_job_alert_queue` as jaq
							  INNER JOIN tbl_post_jobs as pj ON pj.ID=jaq.job_ID
							  INNER JOIN tbl_job_seekers as js ON js.ID=jaq.seeker_ID
							  INNER JOIN tbl_job_industries as ji ON ji.ID=pj.industry_ID;");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;	
	}
	
	public function get_queue_list_grouped(){
		$Q = $this->db->query("SELECT jaq.ID, jaq.job_ID, pj.job_title, pj.job_slug, jaq.dated, COUNT(jaq.ID) as in_queue
							  FROM `tbl_job_alert_queue` as jaq
							  INNER JOIN tbl_post_jobs as pj ON pj.ID=jaq.job_ID
							  GROUP BY jaq.job_ID");
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
		$Q->next_result();
        $Q->free_result();
        return $return;	
	}
	
	public function get_settings() {
		
		$Q = $this->db->get($this->settings_table_name, 1, 0);
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
}