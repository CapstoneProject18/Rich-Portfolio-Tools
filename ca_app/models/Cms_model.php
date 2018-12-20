<?php
class Cms_model extends CI_Model {
	
	private $table_name = 'tbl_cms';
	
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
		$this->db->where('pageID', $id);
		$return=$this->db->update($this->table_name, $data);
		return $return;
	}
	
	public function delete($id){
		$this->db->where('pageID', $id);
		$this->db->delete($this->table_name);
	}
	
	public function get_record_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('pageID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_slug($page_slug) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->like('pageSlug', $page_slug);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
    	
    	public function get_active_record_by_slug($page_slug) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('pageStatus', 'Published');
	$this->db->like('pageSlug', $page_slug);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	public function get_all_records() {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->order_by("pageID", "DESC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_records_by_sts($sts) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->order_by("pageStatus", $sts);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	public function get_cms_by_slug($page_slug) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->like('pageSlug', $page_slug);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_active_records_by_menu($menu_field) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where($menu_field, '1');
		$this->db->where('pageStatus', 'Published');
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