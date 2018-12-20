<?php
class Email_drafts_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
	 public function email_configuration()
	 {
			$config = array();
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			if(SMTP==true){
				//SMTP Settings
				$config['protocol'] = 'mail';
				$config['newline'] = '\r\n';
				$config['smtp_host'] = SMTP_host;
				$config['smtp_user'] = SMTP_user;
				$config['smtp_pass'] = SMTP_pass;
				$config['smtp_port'] = SMTP_port;
			}
			return $config;
	 }
	 
	public function jobseeker_signup($email_body,$row){
		
		$email_body=replace_string('{JOBSEEKER_NAME}',$row['first_name'],$email_body);
		$email_body=replace_string('{USERNAME}',$row['email'],$email_body);
		$email_body=replace_string('{PASSWORD}',$row['password'],$email_body);
		$email_body=replace_string('{SITE_URL}',base_url(),$email_body);
		return $email_body;
	}
	
	public function employer_signup($email_body,$row){
		
		$email_body=replace_string('{EMPLOYER_NAME}',$row['first_name'],$email_body);
		$email_body=replace_string('{USERNAME}',$row['email'],$email_body);
		$email_body=replace_string('{PASSWORD}',$row['pass_code'],$email_body);
		$email_body=replace_string('{SITE_URL}',base_url(),$email_body);
		return $email_body;
	}
	public function new_job_posted($email_body,$row){
		
		$email_body=replace_string('{JOBSEEKER_NAME}',$row['first_name'],$email_body);
		$email_body=replace_string('{JOB_LINK}',$row['job_link'],$email_body);
		$email_body=replace_string('{SITE_URL}',base_url(),$email_body);
		return $email_body;
	}
	
	public function apply_job($seeker_id,$email_body,$row){
		
		$email_body=replace_string('{EMPLOYER_NAME}',$row->first_name,$email_body);
		$email_body=replace_string('{JOB_TITLE}',$row->job_title,$email_body);
		$email_body=replace_string('{CANDIDATE_PROFILE_LINK}',base_url('candidate/'.$seeker_id),$email_body);
		return $email_body;
	}
	
	public function job_activation_email($email_body,$row){
		
		$email_body=replace_string('{EMPLOYER_NAME}',$row->first_name,$email_body);
		$email_body=replace_string('{JOB_TITLE}',$row->job_title,$email_body);
		return $email_body;
	}
	
	public function send_message_to_candidate($email_body,$message,$row_jobseeker,$row_employer){
		
		$email_body=replace_string('{JOBSEEKER_NAME}',$row_jobseeker->first_name,$email_body);
		$email_body=replace_string('{COMPANY_NAME}',$row_employer->company_name,$email_body);
		$email_body=replace_string('{MESSAGE}',$message,$email_body);
		$email_body=replace_string('{COMPANY_PROFILE_LINK}',base_url('company/'.$row_employer->company_slug),$email_body);
		return $email_body;
	}
	
	public function get_forgot_password_draft($username,$password,$email_body){
		
		$email_body=replace_string('{USERNAME}',$username,$email_body);
		$email_body=replace_string('{PASSWORD}',$password,$email_body);
		$email_body=replace_string('{SITE_URL}',base_url(),$email_body);
		return $email_body;
	}
	
	
	public function contact_us_draft($data){
		$email_body = '<style type="text/css">
				.txt {
						font-family: Arial, Helvetica, sans-serif;
						font-size: 13px; color:#000000;
					}
				</style>
<p class="txt">A contact us form has been submitted at JOBPORTAL.Com. Details are given below:</p>
<table border="0" cellspacing="0" cellpadding="0" width="99%" class="txt">
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right"><strong>Submitted Date:&nbsp;</strong></td>
    <td align="left">'.$data['dated'].'</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right"><strong>IP Address:&nbsp;</strong></td>
    <td align="left">'.$data['ip_address'].'</td>
  </tr>
  <tr>
    <td width="17" height="19"><p>&nbsp;</p></td>
    <td height="25" align="right"><strong>Name:&nbsp;&nbsp;</strong></td>
    <td align="left">'.$data['full_name'].'</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right"><strong>Email Address:&nbsp;&nbsp;</strong></td>
    <td align="left">'.$data['email'].'</td>
  </tr>
  <tr>
    <td height="19"><p>&nbsp;</p></td>
    <td height="25" align="right"><strong>Phone:&nbsp;&nbsp;</strong></td>
    <td align="left">'.$data['phone'].'</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right"><strong>City:&nbsp;</strong></td>
    <td align="left">'.$data['city'].'</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right"><strong>Comment:&nbsp; </strong></td>
    <td align="left">'.$data['message'].'</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td height="25" align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>
<p class="txt">&nbsp;</p>';
		return $email_body;
	}
	
	public function send_message_job_alerts($email_body,$job_seeker_name,$job_url){
		
		$email_body=replace_string('{JOBSEEKER_NAME}',$job_seeker_name,$email_body);
		$email_body=replace_string('{JOB_LINK}',$job_url,$email_body);
		return $email_body;
	}
	
	public function force_send_newsletter_draft($email_body){
		return $email_body;
	}
	
	public function scam_alert($email_body, $data, $reason){
		
		$job_url = base_url('jobs/'.$data->job_slug);
		$email_body=replace_string('{JOBSEEKER_NAME}',$this->session->userdata('first_name'),$email_body);
		$email_body=replace_string('{JOBSEEKER_EMAIL}',$this->session->userdata('user_email'),$email_body);
		$email_body=replace_string('{IP_ADDRESS}',$this->input->ip_address(),$email_body);
		$email_body=replace_string('{REASON}',$reason,$email_body);
		
		$email_body=replace_string('{COMPANY_NAME}',$data->company_name,$email_body);
		$email_body=replace_string('{JOB_LINK}',$job_url,$email_body);
		$email_body=replace_string('{COMPANY_EMAIL}',$data->employer_email,$email_body);
		$email_body=replace_string('{COMPANY_WEBSITE}',$data->company_website,$email_body);
		return $email_body;
	}
	
	public function scam_alert_db($email_body, $data, $data_emp){
		
		$job_url = base_url('jobs/'.$data_emp->job_slug);
		$email_body=replace_string('{JOBSEEKER_NAME}',$data->first_name,$email_body);
		$email_body=replace_string('{JOBSEEKER_EMAIL}',$data->email,$email_body);
		$email_body=replace_string('{IP_ADDRESS}',$this->input->ip_address(),$email_body);
		$email_body=replace_string('{REASON}',$data->reason,$email_body);
		
		$email_body=replace_string('{COMPANY_NAME}',$data_emp->company_name,$email_body);
		$email_body=replace_string('{JOB_LINK}',$job_url,$email_body);
		$email_body=replace_string('{COMPANY_EMAIL}',$data_emp->employer_email,$email_body);
		$email_body=replace_string('{COMPANY_WEBSITE}',$data_emp->company_website,$email_body);
		return $email_body;
	}
	
}