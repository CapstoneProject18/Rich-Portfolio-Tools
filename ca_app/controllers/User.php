<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index(){
		
		redirect(base_url().'user/login');
		
	}
	
	public function login(){
		
		if($this->session->userdata('is_user_login')==TRUE){
			if($this->session->userdata('is_employer')==TRUE)
				redirect(base_url('employer/dashboard'),'');
			else
				redirect(base_url('jobseeker/dashboard'),'');
			exit;
		}
		$data['ads_row'] = $this->ads;
		$data['title'] = 'Apply for jobs';
		$data['msg'] = '';
		$signup_link = base_url('jobseeker-signup');
		
		if(stristr($this->session->userdata('back_from_user_login'), 'employer/')){
			$signup_link = base_url('employer-signup');
		}
		else
		{
			$signup_link = base_url('jobseeker-signup');
		}
		
		$data['signup_link'] = $signup_link;
		
		$this->form_validation->set_rules('email', 'Email address', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ($this->form_validation->run() === FALSE) {
			$data['msg'] = $this->session->flashdata('msg');
			$this->load->view('login_view', $data);
			return;
		}
		
		$is_job_seeker = TRUE;
		$folder = 'jobseeker';
		$is_employer = FALSE;
		$userRow = $this->job_seekers_model->authenticate_job_seeker($this->input->post('email'), $this->input->post('pass'));
		$slug = '';
		if(!$userRow){
			$is_job_seeker = FALSE;
			$is_employer = TRUE;
			$folder = 'employer';
			$userRow = $this->employers_model->authenticate_employer($this->input->post('email'), $this->input->post('pass'));
			if(!$userRow){
				$data['msg'] = 'Wrong email or password provided';
				$this->load->view('login_view', $data);
				return;
			}
		}
		
		if($userRow->sts=='pending'){
			$data['msg'] = 'You have not yet verified your email address.';
			$this->load->view('login_view', $data);
			return;
		}
		
		if($userRow->sts=='blocked'){
			$data['msg'] = 'Your account was suspended. Please contact site admin for further information.';
			$this->load->view('login_view', $data);
			return;
		}
		
		$slug = @$userRow->company_slug;
		$user_data = array(
				'user_id' => $userRow->ID,
				 'user_email' => $userRow->email,
				 'first_name' => $userRow->first_name,
				 'slug' => $slug,
				 'first_name' => $userRow->first_name,
				 'is_user_login' => TRUE,
				 'is_job_seeker' => $is_job_seeker,
				 'is_employer' => $is_employer
				 );
		$this->session->set_userdata($user_data);
		
		$this_model_name = ($is_employer==TRUE)?'employers_model':'job_seekers_model';
		
		if($userRow->first_login_date==''){
			$this->$this_model_name->update($userRow->ID, array('first_login_date' => date("Y-m-d H:i:s"), 'last_login_date' => date("Y-m-d H:i:s"), 'sts' => 'active'));
		} else {
			$this->$this_model_name->update($userRow->ID, array('last_login_date' => date("Y-m-d H:i:s")));
		}
		
		$redirect = ($this->session->userdata('back_from_user_login')) ? $this->session->userdata('back_from_user_login') : $folder.'/dashboard';
		$this->session->set_userdata('back_from_user_login','');
		redirect(base_url($redirect), '');
	}	
		
	public function forgot(){
		
		$data['ads_row'] = $this->ads;
		$data['title'] = 'Recover Your Password';
		$data['msg'] = '';
		$signup_link = base_url('jobseeker-signup');
		
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha', 'Verification code', 'trim|required|callback_check_captcha');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		if ($this->form_validation->run() === FALSE) {
			$captcha_row = $this->cap_model->generate_captcha();
			$data['cpt_code'] = $captcha_row['image'];
			$this->load->view('forgot_view', $data);
			return;
		}
		
		if(stristr($this->session->userdata('back_from_user_login'), 'employer/')){
			$signup_link = base_url('employer-signup');
		}
		else
		{
			$signup_link = base_url('jobseeker-signup');
		}
		
		$data['signup_link'] = $signup_link;
		
		
		$row = $this->job_seekers_model->authenticate_job_seeker_email_address($this->input->post('email'));
		$email = @$row->email;
		$password = @$row->password;
		if(!$row){
			$row = $this->employers_model->authenticate_employer_by_email($this->input->post('email'));	
			if(!$row){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger">Provided email address does not exist.</div>');
				redirect(base_url('forgot'));
				exit;
			}
			$email = $row->email;
			$password = $row->pass_code;
		}
		
		$row_email = $this->email_model->get_records_by_id(1);
	
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($email);
		$mail_message = $this->email_drafts_model->get_forgot_password_draft($email, $password, $row_email->content);
		$this->email->subject(SITE_NAME.' | Password Recovery');
		$this->email->message($mail_message);     
		$this->email->send();
		
		
		
			
		$this->session->set_flashdata('success_msg', '<div class="alert alert-success">Your account information has been sent to your email address.</div>');
		redirect(base_url('login'));		
	}
	
	public function logout() {
		  
		  $user_data = array(
				'user_id' => '',
				 'useremail' => '',
				 'is_user_login' => FALSE,
				 'slug' => '',
				 'is_job_seeker' => FALSE,
				 'is_employer' => FALSE
				 );
		$this->session->set_userdata($user_data);
		$this->session->unset_userdata($user_data);
		redirect(base_url(), 'refresh'); 
	}
	
	public function check_captcha($str)
	{
	  $word = $this->session->userdata('capWord');
	  if(strcmp(strtoupper($str),strtoupper($word)) == 0){
		return true;
	  }
	  else{
		$this->form_validation->set_message('check_captcha', 'Please enter correct characters.');
		return false;
	  }
    } 
}
