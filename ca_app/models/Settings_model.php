<?php
class Settings_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }

	public function update($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_settings', $data);
		return $return;
	}

	public function get_all_records() {
        $this->db->select('tbl_settings.*');
        $this->db->from('tbl_settings');
		$this->db->where('ID', '1');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_id($id) {
        $this->db->select('tbl_settings.*');
        $this->db->from('tbl_settings');
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
