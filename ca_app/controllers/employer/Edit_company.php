<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_Company extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['msg']='';
		$data['result_cities'] = $this->cities_model->get_all_cities();
		$data['result_countries'] = $this->countries_model->get_all_countries();
		$data['result_industries'] = $this->industries_model->get_all_industries();
		$row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		$data['row'] = $row;
		$data['title'] = $row->company_name.' - Edit Profile';
		
		$this->form_validation->set_rules('full_name', 'Your name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('mobile_phone', 'Mobile', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('industry_id', 'Industry', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_location', 'Company address', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_description', 'Company Description', 'trim|required|strip_all_tags|secure');
		$this->form_validation->set_rules('company_phone', 'Company Phone', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('no_of_employees', 'No of Employees', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('company_website', 'Company Website', 'trim|required|strip_all_tags');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		$data['full_name'] = (set_value('full_name'))?set_value('full_name'):$row->first_name;
		$data['industry_id'] = (set_value('industry_id'))?set_value('industry_id'):$row->industry_ID;
		$data['ownership_type'] = (set_value('ownership_type'))?set_value('ownership_type'):$row->ownership_type;
		$data['company_name'] = (set_value('company_name'))?set_value('company_name'):$row->company_name;
		$data['company_location'] = (set_value('company_location'))?set_value('company_location'):$row->company_location;
		$data['country'] = (set_value('country'))?set_value('country'):$row->country;
		$data['city'] = (set_value('city'))?set_value('city'):$row->city;
		$data['company_phone'] = (set_value('company_phone'))?set_value('company_phone'):$row->company_phone;
		
		$data['mobile_phone'] = (set_value('mobile_phone'))?set_value('mobile_phone'):$row->mobile_phone;
		$data['company_website'] = (set_value('company_website'))?set_value('company_website'):$row->company_website;
		$data['no_of_employees'] = (set_value('no_of_employees'))?set_value('no_of_employees'):$row->no_of_employees;
		$data['company_description'] = (set_value('company_description'))?set_value('company_description'):$row->company_description;
		
		$ip_address = ($row->ip_address=='')?$this->input->ip_address():$row->ip_address;
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('employer/edit_company_profile_view',$data);
			return;
		}
		$company_slug = make_slug($this->input->post('company_name'));
		$is_slug = $this->companies_model->check_slug_edit($row->company_ID, $company_slug);
		if($is_slug>0){
			$company_slug.='-'.time();
		}
		
		$employer_array = array(
								'first_name' => $this->input->post('full_name'),
								'mobile_phone' => $this->input->post('mobile_phone'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city'),
								'ip_address' => $ip_address,
								'dated' => $current_date_time
		);
		
		$company_array = array(
								'company_name' => $this->input->post('company_name'),
								'industry_ID' => $this->input->post('industry_id'),
								'company_phone' => $this->input->post('company_phone'),
								'company_location' => $this->input->post('company_location'),
								'company_website' => $this->input->post('company_website'),
								'no_of_employees' => $this->input->post('no_of_employees'),
								'company_description' => $this->input->post('company_description'),
								'company_slug' => $company_slug,
								'ownership_type' => $this->input->post('ownership_type')
		);
		
		$this->companies_model->update_company($row->company_ID, $company_array);
		$this->employers_model->update_employer($row->ID, $employer_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your company profile has been updated.</div>');
		$this->session->set_userdata('slug',$company_slug);
		redirect(base_url('employer/edit_company'));
	}
	
}
