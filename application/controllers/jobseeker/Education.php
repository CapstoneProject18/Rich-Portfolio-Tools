<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Education extends CI_Controller {
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
		
		$this->form_validation->set_rules('degree_title', 'degree_title', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('major_subject', 'major_subject', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('institute', 'institute', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('edu_country', 'edu_country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('edu_city', 'edu_city', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('completion_year', 'completion_year', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$edu_array = array(
							'seeker_ID'			=> $this->session->userdata('user_id'),
							'degree_title'		=> $this->input->post('degree_title'),
							'major'				=> $this->input->post('major_subject'),
							'institude'			=> $this->input->post('institute'),
							'country' 			=> $this->input->post('edu_country'),
							'city' 				=> $this->input->post('edu_city'),
							'completion_year' 	=> $this->input->post('completion_year'),
							'dated'				=> date("Y-m-d H:i:s")
		);
		$this->jobseeker_academic_model->add($edu_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Your eduction has been added successfully. </div>');
		echo "done";
	}
	
	public function edit()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'ID', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('degree_title', 'degree_title', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('major_subject', 'major_subject', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('institute', 'institute', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('edu_country', 'edu_country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('edu_city', 'edu_city', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('completion_year', 'completion_year', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$edu_array = array(
							'degree_title'		=> $this->input->post('degree_title'),
							'major'				=> $this->input->post('major_subject'),
							'institude'			=> $this->input->post('institute'),
							'country' 			=> $this->input->post('edu_country'),
							'city' 				=> $this->input->post('edu_city'),
							'completion_year' 	=> $this->input->post('completion_year')
		);
		$this->jobseeker_academic_model->update($this->input->post('id'), $edu_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Your eduction has been updated successfully. </div>');
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
		$this->jobseeker_academic_model->delete($this->input->post('id'));
		echo "done";
	}
	
	public function education_by_id()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|strip_all_tags|numeric');
		
		$row = $this->jobseeker_academic_model->get_record_by_id($this->input->post('id'));
		echo json_encode($row);
	}
}
