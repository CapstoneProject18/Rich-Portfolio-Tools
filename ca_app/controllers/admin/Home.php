<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function index(){
		
		$data['title'] = SITE_NAME.': Login';
		$data['msg'] = '';
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		
		

		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/home_view', $data);
			return;
		}
		
		$password = $this->input->post('password');
		

		$userRow = $this->Admin_model->authenticate_admin($this->input->post('username'), $password);
		
		if(!$userRow){
			$data['msg'] = 'Wrong username or password provided';
			$this->load->view('admin/home_view', $data);
			return;
		}
			
		$admin_data = array(
				'admin_id' => $userRow->id,
				 'name' => $userRow->admin_username,
				 'is_admin_login' => TRUE);
		$this->session->set_userdata($admin_data);
		
		redirect(base_url().'admin/dashboard','');		
	}	
		
	public function logout() {
						
		$admin_data = array(
		 'admin_id' => '',
		 'name' => '',
		 'is_admin_login' => FALSE);
		  
		$this->session->set_userdata($admin_data);
		$this->session->unset_userdata($admin_data);
		redirect(base_url(), 'refresh'); 
	}
	
	public function editpassword(){
		
		$data['title'] = SITE_NAME.': Edit Password';
		$data['msg'] = '';
		$this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required');
		$this->form_validation->set_rules('newpass', 'new password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('renewpass', 'confirm password', 'trim|required|matches[newpass]');
		$this->form_validation->set_error_delimiters('<div class="error" style="color:#F00">', '</div>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/admin_edit_view', $data);
			return;
		}
		$is_correct = $this->Admin_model->get_current_password($this->input->post('oldpass'));
		
		if(!$is_correct){
			$data['errmsg']='Old password is wrong.';
			$this->load->view('admin/admin_edit_view', $data);
			return;
		}
		
		$this->Admin_model->update(array('admin_password'=>do_hashing($this->input->post('newpass'))));
		$this->session->set_flashdata('update_action','true');	
		redirect(base_url('admin/home/editpassword'));
	}	
}
