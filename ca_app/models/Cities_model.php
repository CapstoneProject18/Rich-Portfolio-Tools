<?php
class Cities_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function add_city($data){
  
            $return = $this->db->insert('tbl_cities', $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
			
	}	
	
	public function update_cities($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_cities', $data);
		return $return;
	}
	
	public function delete_cities($id){
		$this->db->where('ID', $id);
		$this->db->delete('tbl_cities');
	}
	public function get_all_cities() {
        $this->db->select('*');
        $this->db->from('tbl_cities');
		$this->db->order_by("sort_order", "ASC");
		$this->db->order_by("city_name", "ASC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_active_cities() {
        $this->db->select('*');
        $this->db->from('tbl_cities');
		$this->db->where('show','1');
		$this->db->order_by("sort_order", "ASC");
		$this->db->order_by("city_name", "ASC");
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_popular_cities() {
        $this->db->select('*');
        $this->db->from('tbl_cities');
		$this->db->where("is_popular", "yes");
		$this->db->order_by("sort_order", "ASC");
		$this->db->order_by("city_name", "ASC");
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
	
	public function get_city_by_id($id) {
        $this->db->select('*');
        $this->db->from('tbl_cities');
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
	
}
?>
