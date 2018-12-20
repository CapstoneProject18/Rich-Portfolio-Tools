<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scam_Report extends CI_Controller {
	
	public function index()
	{
		$data = array();
		
		if(!$this->session->userdata('is_job_seeker')){
			echo 'You are not logged in with a jobseeker account. Please re-login with a jobseeker account to submit a scam report.';
			exit;	
		}
		$this->form_validation->set_rules('reason', 'Reason', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|strip_all_tags|validate_ml_spam');
		$this->form_validation->set_rules('scjid', 'ID', 'trim|required|strip_all_tags');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			//$data['cpt_code'] = create_ml_captcha();
			$data['msg'] = validation_errors();
			$data['cap'] = create_ml_captcha();
			echo json_encode($data);
			exit;
			
		}
		$row = $this->posted_jobs_model->get_active_posted_job_by_id($this->input->post('scjid'));
		
		if(!$row){
			$data['msg'] = 'Something went wrong: No job found!';
			$data['cap'] = create_ml_captcha();
			echo json_encode($data);
			exit;	
		}
		
		if($this->session->userdata('is_job_seeker')!=TRUE){
			$data['msg'] = 'You are not logged in with a jobseeker account. Please re-login with a jobseeker account submit this form.';
			$data['cap'] = create_ml_captcha();
			echo json_encode($data);
			exit;
		}
		
		$current_date_time = date("Y-m-d H:i:s");
		
		$d_array = array(
					'reason' => $this->input->post('reason'),
					'job_ID' => $this->input->post('scjid'),
					'user_ID' => $this->session->userdata('user_id'),
					'dated' => $current_date_time,
					'ip_address' => $this->input->ip_address()
		);
		
		
		$this->scam_model->add($d_array);
		
		//Sending email
		$row_email = $this->email_model->get_records_by_id(8);
		
		$seeker_id = $this->session->userdata('user_id');
		$from_name = replace_string('{JOBSEEKER_NAME}',$this->session->userdata('first_name'),$row_email->from_name);
		$from_email = replace_string('{JOBSEEKER_EMAIL}',$this->session->userdata('user_email'),$row_email->from_email);
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($from_email, $from_name);
		$this->email->to(ADMIN_EMAIL);
		$mail_message = $this->email_drafts_model->scam_alert($row_email->content, $row, $this->input->post('reason'));
		$this->email->subject($row_email->subject);
		$this->email->message($mail_message);     
		$this->email->send();
		
		
		$this->session->set_userdata('timestm', date("H:i:s"));
		
		$data['msg'] = 'done';
		$data['cap'] = create_ml_captcha();
		echo json_encode($data);
	}
	
}
