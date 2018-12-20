<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_Personal_Profile extends CI_Controller {
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.' : Edit Personal Information';
		$data['msg']='';
		$data['result_cities'] = $this->cities_model->get_all_cities();
		$data['result_countries'] = $this->countries_model->get_all_countries();
		$data['result_industries'] = $this->industries_model->get_all_industries();
		$row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		$data['row'] = $row;
		$this->form_validation->set_rules('full_name', 'Full name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_day', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_month', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_year', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('mobile_phone', 'Mobile', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('employer/edit_personal_profile_view',$data);
			return;
		}
		$employer_array = array(
								'first_name' => $this->input->post('full_name'),							
								'dob' => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
								'mobile_phone' => $this->input->post('mobile_phone'),
								'home_phone' => $this->input->post('home_phone'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city')
		);
		$this->employers_model->update_employer($row->ID, $employer_array);
		$this->session->set_userdata('first_name',$this->input->post('full_name'));
		$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your personal information has been updated.</div>');
		redirect(base_url('employer/edit_personal_profile'));
	}
	
}
