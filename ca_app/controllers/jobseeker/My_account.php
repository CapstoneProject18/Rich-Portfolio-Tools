<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Account extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		//Additional Info
		$row_additional = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		
		//Skills
		$keywords = $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		$is_keywords_provided = $keywords;
		
		if($is_keywords_provided<3){
			  redirect(base_url('jobseeker/add_skills'));
			  exit;
		}
		
		$data['ads_row'] = $this->ads;
		$row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
		$data['title'] = SITE_NAME.': Manage Account';
		$data['row'] = $row;
		$data['result_cities'] 			= $this->cities_model->get_all_cities();
		$data['result_countries'] 		= $this->countries_model->get_all_countries();
		
		$this->form_validation->set_rules('full_name', 'full name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_day', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_month', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_year', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('gender', 'gender', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('present_address', 'present_address', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'city', 'trim|required|strip_all_tags');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('jobseeker/my_account_view',$data);
			return;
		}
		$profile_array = array(
							'first_name'		=> $this->input->post('full_name'),
							'last_name'			=> '',
							'mobile'			=> $this->input->post('mobile'),
							'dob'				=> $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
							'present_address' 	=> $this->input->post('present_address'),
							'country' 			=> $this->input->post('country'),
							'city' 				=> $this->input->post('city'),
		);
		$this->job_seekers_model->update($this->session->userdata('user_id'), $profile_array);
		$this->session->set_userdata('first_name',$this->input->post('full_name'));
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Profile has been updated successfully. </div>');
		redirect(base_url('jobseeker/my_account'));
	}
}
