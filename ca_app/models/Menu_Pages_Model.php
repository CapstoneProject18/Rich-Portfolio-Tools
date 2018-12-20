<?php
class Menu_Pages_Model extends CI_Model {
	
	private $table_name = 'tbl_page_menu_pages';
	private $primary_key = 'pageMenuPagesID';
	
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
		$this->db->where($this->primary_key, $id);
		$return=$this->db->update($this->table_name, $data);
		return $return;
	}
	
	public function delete($id){
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);
	}
	
	public function delete_by_menu_id($menu_id){
		$this->db->where('pageMenuID', $menu_id);
		$this->db->delete($this->table_name);
	}
	
	public function delete_by_page_id($page_id){
		$this->db->where('pageID', $page_id);
		$this->db->delete($this->table_name);
	}
	
	public function get_record_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where($this->primary_key, $id);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_menu_id($menu_id) {
		$query = "SELECT pmp.pageMenuPagesID, pmp.pageMenuID, pmp.pageID, p.pageSlug, IF((pmp.pageMenuPagesTitle='' OR pmp.pageMenuPagesTitle IS NULL), p.pageTitle, pmp.pageMenuPagesTitle) AS `pageHeading`
	FROM tbl_page_menu_pages pmp
	INNER JOIN tbl_page_menu pm ON pmp.pageMenuID=pm.menuID
	LEFT JOIN tbl_cms p ON p.pageID=pmp.pageID
	WHERE pm.menuID=$menu_id;";
	//echo $query; exit;
		$Q = $this->db->query($query);
        if ($Q->num_rows() > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_menu_id_front_end($menu_id) {
		$query = "SELECT pmp.pageMenuPagesID, pmp.pageMenuID, pmp.pageID, p.slug, p.title_en, p.title_ar
	FROM tbl_page_menu_pages pmp
	INNER JOIN tbl_page_menu pm ON pmp.pageMenuID=pm.menuID
	INNER JOIN usp_pages p ON p.ID=pmp.pageID
	WHERE pm.menuID=$menu_id;";
	//echo $query; exit;
		$Q = $this->db->query($query);
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
		$this->db->order_by($this->primary_key, "DESC");
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