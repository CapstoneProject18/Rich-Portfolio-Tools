<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Experience extends CI_Controller {
	public function index(){
		echo "you are not allow to access this page directly";
		exit;
	}
	
	public function add()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('job_title', 'job_title', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_name', 'company_name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('exp_country', 'exp_country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('exp_city', 'exp_city', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('start_date', 'start_date', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$start_date = date_formats($this->input->post('start_date'),'Y-m-d');
		$end_date = ($this->input->post('end_date')!='Present' && $this->input->post('end_date')!='')?date_formats($this->input->post('end_date'),'Y-m-d'):NULL;
		$exp_array = array(
							'seeker_ID'		=> $this->session->userdata('user_id'),
							'job_title'		=> $this->input->post('job_title'),
							'company_name'	=> $this->input->post('company_name'),
							'country'		=> $this->input->post('exp_country'),
							'city' 			=> $this->input->post('exp_city'),
							'start_date' 	=> $start_date,
							'end_date' 		=> $end_date,
							'dated'			=> date("Y-m-d H:i:s")
		);
		$this->jobseeker_experience_model->add($exp_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Your experience has been added successfully. </div>');
		echo "done";
	}
	
	public function edit()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('job_title', 'job_title', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_name', 'company_name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('exp_country', 'exp_country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('exp_city', 'exp_city', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('start_date', 'start_date', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		
		$start_date = date_formats($this->input->post('start_date'),'Y-m-d');
		$end_date = ($this->input->post('end_date')!='Present' && $this->input->post('end_date')!='')?date_formats($this->input->post('end_date'),'Y-m-d'):NULL;
		$exp_array = array(
							'job_title'		=> $this->input->post('job_title'),
							'company_name'	=> $this->input->post('company_name'),
							'country'		=> $this->input->post('exp_country'),
							'city' 			=> $this->input->post('exp_city'),
							'start_date' 	=> $start_date,
							'end_date' 		=> $end_date
		);
		$this->jobseeker_experience_model->update($this->input->post('id'), $exp_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Your experience has been updated successfully. </div>');
		echo "done";
	}
	
	public function delete()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|strip_all_tags|numeric');
		
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$this->jobseeker_experience_model->delete($this->input->post('id'));
		echo "done";
	}
	
	public function experience_by_id()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
		
		$row = $this->jobseeker_experience_model->get_record_by_id($this->input->post('id'));
		echo json_encode($row);
	}
}
