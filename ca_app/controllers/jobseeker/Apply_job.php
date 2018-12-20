<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apply_Job extends CI_Controller {
	
	public function index()
	{
		$data['title'] = SITE_NAME.' : Apply for the Job';
		$data['msg']='';
		
		if(!$this->session->userdata('user_id')){
			echo 'All fields are mandatory.';
			exit;	
		}
		
		/*$this->form_validation->set_rules('cv', 'CV', 'trim|required|strip_all_tags');*/
		$this->form_validation->set_rules('expected_salary', 'Expected Salary', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('cover_letter', 'Cover letter', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('jid', 'ID', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo validation_errors();
			exit;
			
		}
		$row = $this->posted_jobs_model->get_active_posted_job_by_id($this->input->post('jid'));
		
		if(!$row){
			echo 'Something went wrong.';
			exit;	
		}
		
		if($this->session->userdata('is_job_seeker')!=TRUE){
			echo 'You are not logged in with a jobseeker account. Please re-login with a jobseeker account to apply for this job.';
			exit;
		}
		$is_already_applied = $this->applied_jobs_model->get_applied_job_by_seeker_and_job_id($this->session->userdata('user_id'), $this->input->post('jid'));
		
		if($is_already_applied>0){
			echo 'You have already applied for this job job has been closed.';
			exit;	
		}
		
		/*$can_apply = ($row->last_date > date("Y-m-d")?'yes':'no');
		
		if($can_apply=='no'){
			echo 'This job has been closed.';
			exit;	
		}*/
		
		$current_date_time = date("Y-m-d H:i:s");
		
		$job_array = array(
							'seeker_ID' 		=> $this->session->userdata('user_id'),
							'job_ID' 			=> $this->input->post('jid'),
							'employer_ID' 		=> $row->employer_ID,
							'cover_letter' 		=> $this->input->post('cover_letter'),
							'expected_salary' 	=> $this->input->post('expected_salary'),
							'dated' 			=> $current_date_time
		);
		$this->applied_jobs_model->add_applied_job($job_array);
		
		//Sending email
		$row_email = $this->email_model->get_records_by_id(5);
		$config = array();
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		
		$data_array = $this->posted_jobs_model->get_active_posted_job_by_id($this->input->post('jid'));
		$seeker_id = $this->custom_encryption->encrypt_data($this->session->userdata('user_id'));
		
		$subject = str_replace('{JOB_TITLE}', $data_array->job_title, $row_email->subject);
		
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($data_array->employer_email);
		$mail_message = $this->email_drafts_model->apply_job($seeker_id, $row_email->content, $data_array);
		$this->email->subject($subject);
		$this->email->message($mail_message);     
		$this->email->send();
		
		echo 'done';
	}
}
