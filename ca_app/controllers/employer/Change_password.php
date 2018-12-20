<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Change_Password extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.': Change Password';
		$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|strip_all_tags');
		$this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|matches[new_password]|strip_all_tags');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('employer/change_password_view', $data);
			return;
		}
		else
		{
			
			$old_password=$this->input->post('old_password');
			
			$rs = $this->employers_model->authenticate_employer_by_password($this->session->userdata('user_id'), $old_password);
			if($rs){
				$employer_array = array(
							'pass_code' => $this->input->post('new_password')
				);
				
				$this->employers_model->update($rs->ID, $employer_array);
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Password has been changed successfully.</div>');
				redirect(base_url('employer/change_password'));
				return;	
			}
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Old password is wrong.</div>');
			redirect(base_url('employer/change_password'));
			return;
			
		}
		}
}
