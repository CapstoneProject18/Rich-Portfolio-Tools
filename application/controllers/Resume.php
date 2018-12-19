<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resume extends CI_Controller {
	
	public function index(){
		echo "you are not allow to access this page directly";
		exit;
	}
	
	public function download($file_name){
		if($file_name==''){
			redirect(base_url('login'));
			exit;	
		}
		
					if (!file_exists(realpath(APPPATH . '../public/uploads/candidate/resumes/'.$file_name))){
						echo 'Files does not exist on the server. <a href="javascript:;" onclick="window.history.back();">Back</a>';
						exit;
					}
					
		$data = file_get_contents(base_url("public/uploads/candidate/resumes/".$file_name));
		force_download($file_name, $data);
		exit;
	}
	
	public function add()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('job_title', 'job_title', 'trim|required');
		$this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
		$this->form_validation->set_rules('exp_country', 'exp_country', 'trim|required');
		$this->form_validation->set_rules('exp_city', 'exp_city', 'trim|required');
		$this->form_validation->set_rules('start_date', 'start_date', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
	}
	
	public function edit()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('job_title', 'job_title', 'trim|required');
		$this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
		$this->form_validation->set_rules('exp_country', 'exp_country', 'trim|required');
		$this->form_validation->set_rules('exp_city', 'exp_city', 'trim|required');
		$this->form_validation->set_rules('start_date', 'start_date', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		
		
	}
	
	public function delete()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
		$this->form_validation->set_rules('fl', 'file', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$this->resume_model->delete_by_id_seeker_id($this->input->post('id'), $this->session->userdata('user_id'));
		$real_path = realpath(APPPATH . '../public/uploads/candidate/resumes/');
		@unlink($real_path.'/'.$this->input->post('fl'));	
		echo "done";
	
	}
}
