<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invite_Employer extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Invite Employer';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('employer_name', 'Employer Name', 'trim|required');
		$this->form_validation->set_rules('employer_email', 'Employer Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/invite_employer_view',$data);
		}
		
		else {
  		$employer_name=$this->input->post('employer_name');
		$employer_email=$this->input->post('employer_email');
		$message=$this->input->post('message');
  		$mail_message = '<p>Dear '.$employer_name.',</p>
		<p>'.$message.'</p>
		<p>Thank you</p>';
	  
	  
	$config = $this->email_drafts_model->email_configuration();
	$this->email->initialize($config);
	$this->email->clear(TRUE);
	$this->email->from(ADMIN_EMAIL, SITE_NAME);
	$this->email->to($employer_email);
	
	$this->email->subject(SITE_NAME.' | Invitation Request');
	$this->email->message($mail_message);     
	$this->email->send() or die('Error while sending email.');
	$this->session->set_flashdata('done', true);
	redirect(base_url('admin/invite_employer'));
 }     
	}
}