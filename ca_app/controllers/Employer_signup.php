<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employer_signup extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = 'Create New Employer Account at '.SITE_URL;
		$data['msg']='';
		$data['result_cities'] = $this->cities_model->get_all_cities();
		$data['result_countries'] = $this->countries_model->get_all_countries();
		$data['result_industries'] = $this->industries_model->get_all_industries();
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_employers.email]|strip_all_tags');	
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|strip_all_tags');
		$this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|matches[pass]|strip_all_tags');
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
		
		
		if (empty($_FILES['company_logo']['name']))
			$this->form_validation->set_rules('company_logo', 'Company Logo', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$captcha_row = $this->cap_model->generate_captcha();
			$data['cpt_code'] = $captcha_row['image'];
			
			$this->load->view('employer_signup_view',$data);
			return;
			
		}
		
		$current_date_time = date("Y-m-d H:i:s");
		$company_slug = make_slug($this->input->post('company_name'));
		$is_slug = $this->companies_model->check_slug($company_slug);
		if($is_slug>0){
			$company_slug.='-'.time();
		}
		$employer_array = array(
								'first_name' => $this->input->post('full_name'),
								'email' => $this->input->post('email'),
								'pass_code' => $this->input->post('pass'),
								'mobile_phone' => $this->input->post('mobile_phone'),
								'home_phone' => $this->input->post('home_phone'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city'),
								'ip_address' => $this->input->ip_address(),
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
		if (!empty($_FILES['company_logo']['name'])){
			
			$company_name_for_file = strtolower($this->input->post('company_name'));
			$real_path = realpath(APPPATH . '../public/uploads/employer/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = true;
			$config['max_size'] = 6000;
			$config['file_name'] = 'JOBPORTAL-'.time();
			$this->upload->initialize($config);
			if ($this->upload->do_upload('company_logo')){
				/*if($obj_row->company_logo){
					@unlink($real_path.'/'.$obj_row->company_logo);	
					@unlink($real_path.'/thumb/'.$obj_row->company_logo);
				}*/
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$company_array['company_logo']=$image_name;
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 50;
			$thumb_config['width']	 = 70;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
		}
		$company_id = $this->companies_model->add_company($company_array);
		$employer_array['company_ID'] = $company_id;
		$employer_id = $this->employers_model->add_employer($employer_array);
		
		$user_data = array(
				'user_id' => $employer_id,
				 'user_email' => $this->input->post('email'),
				 'first_name' => $this->input->post('full_name'),
				 'slug' => $company_slug,
				 'last_name' => '',
				 'is_user_login' => TRUE,
				 'is_job_seeker' => FALSE,
				 'is_employer' => TRUE
				 );
		$this->session->set_userdata($user_data);
		
		//Sending email to the user
		$row_email = $this->email_model->get_records_by_id(3);
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($this->input->post('email'));
		$mail_message = $this->email_drafts_model->employer_signup($row_email->content, $employer_array);
		$this->email->subject($row_email->subject);
		$this->email->message($mail_message);     
		$this->email->send();
		
		redirect(base_url('employer/post_new_job'),'');
	}
	
}
