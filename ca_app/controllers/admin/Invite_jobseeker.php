<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invite_Jobseeker extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.':Invite Jobseeker';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('jobseeker_name', 'Jobseeker Name', 'trim|required');
		$this->form_validation->set_rules('jobseeker_email', 'Jobseeker Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/invite_jobseeker_view',$data);
		}
		
		else {
  		$jobseeker_name=$this->input->post('jobseeker_name');
		$jobseeker_email=$this->input->post('jobseeker_email');
		$message=$this->input->post('message');
 		$mail_message = '<p>Dear '.$jobseeker_name.',</p>
<p>'.$message.'</p>
<p>Thank you</p>';
	  
	  
	$config = $this->email_drafts_model->email_configuration();
	$this->email->initialize($config);
	$this->email->clear(TRUE);
	$this->email->from(ADMIN_EMAIL, SITE_NAME);
	$this->email->to($jobseeker_email);
	
	$this->email->subject(SITE_NAME.' | Invitation Request');
	$this->email->message($mail_message);     
	$this->email->send() or die('Error while sending email.');
	$this->session->set_flashdata('done', true);
	redirect(base_url('admin/invite_jobseeker'));
 }     
	}
}