<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_Applications extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		$data['ads_row'] = $this->ads;
		$data['title'] = SITE_NAME.': List of Received Job Applications';
		
		//Pagination starts
		$total_rows = $this->applied_jobs_model->count_applied_job_by_employer_id($this->session->userdata('user_id'));
		$config = pagination_configuration(base_url("employer/job_applications"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		//Applied Jobs by Employer ID
		$result_applied_jobs = $this->applied_jobs_model->get_applied_job_by_employer_id($this->session->userdata('user_id'), $config["per_page"], $page);
		$data['result_applied_jobs']= $result_applied_jobs;
		$this->load->view('employer/job_applications_view',$data);
	}
	
	public function send_message_to_candidate(){
		if(!$this->session->userdata('user_id')){
			echo 'All fields are mandatory.';
			exit;	
		}
		$this->form_validation->set_rules('message', 'message', 'trim|required|strip_all_tags|time_diff');
		$this->form_validation->set_rules('jsid', 'ID', 'trim|required|strip_all_tags');
		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() === FALSE) {
			echo validation_errors();
			exit;
		}
		
		if($this->session->userdata('is_employer')!=TRUE){
			echo 'You are not logged in with a employer account. Please login with a employer account to send message to the candidate.';
			exit;
		}
		
		$decrypted_id = $this->custom_encryption->decrypt_data($this->input->post('jsid'));
		
		$row_jobseeker 	= $this->job_seekers_model->get_job_seeker_by_id($decrypted_id);
		$row_employer 	= $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		if(!$row_jobseeker){
			echo 'Something went wrong.';
			exit;	
		}
		
		if(!$row_employer){
			echo 'Something went wrong.';
			exit;	
		}
		
		//Sending email to Jobseeker
		$row_email = $this->email_model->get_records_by_id(7);
		
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($this->input->post('email'));
		$mail_message = $this->email_drafts_model->send_message_to_candidate($row_email->content, $this->input->post('message'), $row_jobseeker, $row_employer);
		$this->email->subject($row_email->subject);
		$this->email->message($mail_message);     
		@$this->email->send();
		$this->session->set_userdata('timestm', date("H:i:s"));
		echo "done";
		exit;
		
	}
}
