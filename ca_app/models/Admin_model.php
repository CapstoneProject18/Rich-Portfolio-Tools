<?php
class Admin_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function update($data){
		$return=$this->db->update('tbl_admin', $data);
		return $return;
	}
	
	public function authenticate_admin($email_address,$password) 
	{
		//echo $email_address.' - '.$password; exit;
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('admin_username', $email_address);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
       		
			if (verify_hashing($password,$Q->row('admin_password'))) {
				
				if (needs_rehashing($Q->row('admin_password'))) {
        			$newHash = do_hashing($password);
					$this->update($Q->row('id'),array('admin_password'=>$newHash));
    			}
				$user_data = $Q->row();
				$return = $user_data;
			}
			else {
    			$return = 0;
			}
            
        } else {
            $return = 0;
        }

		
        $Q->free_result();
        return $return;
    }
	

	
	public function get_current_password($pass){
		 $this->db->select('admin_password');
         $this->db->from('tbl_admin');
         $this->db->where('id', $this->session->userdata('admin_id'));
		 $Q = $this->db->get();
         if ($Q->num_rows() > 0) {
			 if (verify_hashing($pass,$Q->row('admin_password'))) {
					//Checking if password needs rehashing
					if (needs_rehashing($Q->row('admin_password'))) {
						$newHash = do_hashing($password);
						//Updating password in database
						$this->update($Q->row('id'),array('admin_password'=>$newHash));
					}
					$user_data = $Q->row();
					$return = $user_data;
			}
			else {
            	$return = 0;
        	 }
		 }
		 else {
            $return = 0;
         }
         $Q->free_result();
         return $return;
	}
	
}
?>
