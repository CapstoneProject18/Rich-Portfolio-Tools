<?php
class Countries_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function add_country($data){
  
            $return = $this->db->insert('tbl_countries', $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
			
	}	
	
	public function update_country($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_countries', $data);
		return $return;
	}
	
	public function delete_country($id){
		$this->db->where('ID', $id);
		$this->db->delete('tbl_countries');
	}
	public function get_all_countries() {
        $this->db->select('*');
        $this->db->from('tbl_countries');
		$this->db->order_by("country_name", "ASC");
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
	
	public function get_country_by_id($id) {
        $this->db->select('*');
        $this->db->from('tbl_countries');
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
