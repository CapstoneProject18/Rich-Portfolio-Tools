<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobseeker_signup extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		if($this->session->userdata('is_job_seeker')==TRUE){
				redirect(base_url('jobseeker/dashboard'),'');
				exit;
		}
		$data['title'] = 'Create New Jobseeker Account at '.SITE_URL;
		$data['msg']='';
		$data['result_cities'] = $this->cities_model->get_all_cities();
		$data['result_countries'] = $this->countries_model->get_all_countries();
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_job_seekers.email]|strip_all_tags');	
		$this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[6]|strip_all_tags');
		$this->form_validation->set_rules('confirm_pass', 'Confirm password', 'trim|required|matches[pass]');
		$this->form_validation->set_rules('full_name', 'Full name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_day', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_month', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('dob_year', 'DOB', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('current_address', 'Current address', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('mobile_number', 'Mobile', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|strip_all_tags');

		
		$this->form_validation->set_message('is_unique', 'The %s is already taken');
		
		if (empty($_FILES['cv_file']['name']))
			$this->form_validation->set_rules('cv_file', 'Resume', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$captcha_row = $this->cap_model->generate_captcha();
			$data['cpt_code'] = $captcha_row['image'];
			$this->load->view('jobseeker_signup_view',$data);
			return;
			
		}
		$current_date = date("Y-m-d H:i:s");
		$job_seeker_array = array(
								'first_name' => $this->input->post('full_name'),
								'email' => $this->input->post('email'),
								'password' => $this->input->post('pass'),
								'dob' => $this->input->post('dob_year').'-'.$this->input->post('dob_month').'-'.$this->input->post('dob_day'),
								'mobile' => $this->input->post('mobile_number'),
								'home_phone' => $this->input->post('phone'),
								'present_address' => $this->input->post('current_address'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city'),
								'nationality' => $this->input->post('nationality'),
								'gender' => $this->input->post('gender'),
								'ip_address' => $this->input->ip_address(),
								'dated' => $current_date
		);
		
		
		if (!empty($_FILES['cv_file']['name'])){
			
			//$verification_code = md5(time());
			
			$extention = get_file_extension($_FILES['cv_file']['name']);
			$allowed_types = array('doc','docx','pdf','rtf','jpg','txt');
			
			if(!in_array($extention,$allowed_types)){
				$captcha_row = $this->cap_model->generate_captcha();
				$data['cpt_code'] = $captcha_row['image'];
				$data['msg'] = 'This file type is not allowed.';
				$this->load->view('jobseeker_signup_view',$data);
				return;	
			}
			
			$seeker_id = $this->job_seekers_model->add_job_seekers($job_seeker_array);
			$resume_array = array();
			$real_path = realpath(APPPATH . '../public/uploads/candidate/resumes/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'doc|docx|pdf|rtf|jpg|txt';
			$config['overwrite'] = true;
			$config['max_size'] = 6000;
			$config['file_name'] = replace_string(' ','-',strtolower($this->input->post('full_name'))).'-'.$seeker_id;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('cv_file')){
				$this->job_seekers_model->delete_job_seeker($seeker_id);
				$captcha_row = $this->cap_model->generate_captcha();
				$data['cpt_code'] = $captcha_row['image'];
				$data['msg'] = $this->upload->display_errors();
				$this->load->view('jobseeker_signup_view',$data);
				return;
			}
			
			$resume = array('upload_data' => $this->upload->data());	
			$resume_file_name = $resume['upload_data']['file_name'];
			$resume_array = array(
									'seeker_ID' => $seeker_id,
									'file_name' => $resume_file_name,
									'dated' => $current_date,
									'is_uploaded_resume' => 'yes'
									
			);
		}
		
		$this->resume_model->add($resume_array);
		$this->jobseeker_additional_info_model->add(array('seeker_ID'=>$seeker_id));
		$user_data = array(
				'user_id' => $seeker_id,
				 'user_email' => $this->input->post('email'),
				 'first_name' => $this->input->post('full_name'),
				 'slug' => '',
				 'last_name' => '',
				 'is_user_login' => TRUE,
				 'is_job_seeker' => TRUE,
				 'is_employer' => FALSE
				 );
		$this->session->set_userdata($user_data);
		
		//Sending email to the user
		$row_email = $this->email_model->get_records_by_id(2);
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($this->input->post('email'));
		$mail_message = $this->email_drafts_model->jobseeker_signup($row_email->content, $job_seeker_array);
		$this->email->subject($row_email->subject);
		$this->email->message($mail_message);     
		$this->email->send();
		
		redirect(base_url('jobseeker/add_skills'),'');
	}
	
	/*public function check_captcha($str)
	{
	  $word = $this->session->userdata('capWord');
	  if(strcmp(strtoupper($str),strtoupper($word)) == 0){
		return true;
	  }
	  else{
		$this->form_validation->set_message('check_captcha', 'Please enter correct characters.');
		return false;
	  }
    } */
}
