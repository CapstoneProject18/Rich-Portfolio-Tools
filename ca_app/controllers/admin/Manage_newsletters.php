<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_Newsletters extends CI_Controller {
	public function index(){
		
		$data=array();
		$data['title'] = SITE_NAME.': Newsletter Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->newsletter_model->record_count('tbl_newsletter');
		$config = pagination_configuration(base_url("admin/manage_newsletters"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->newsletter_model->get_all_records($config["per_page"], $page);
		$data['result']=$obj_result;
		$this->load->view('admin/manage_newsletters_view',$data);
		
	}
	
	public function get_record_by_id($id=''){
		if($id!=''){
			$row = $this->newsletter_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	
	public function add(){
		
		$data=array();
		$data['msg']='';
		
		$this->form_validation->set_rules('from_name', 'From Name', 'trim|required');
		$this->form_validation->set_rules('from_email', 'From Email', 'trim|required|secure|valid_email');
		$this->form_validation->set_rules('email_subject', 'Email Subject', 'trim|required');
		$this->form_validation->set_rules('email_interval', 'email interval', 'trim|required|numeric');
		$this->form_validation->set_rules('editor1', 'email content', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$data_array = array(
							'from_name' => $this->input->post('from_name'),
							'from_email' => $this->input->post('from_email'),
							'email_subject' => $this->input->post('email_subject'),
							'email_interval' => $this->input->post('email_interval'),
							'email_body' => $this->input->post('editor1'),
							'dated' => date("Y-m-d H:i:s")
		);
		$this->newsletter_model->add($data_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/manage_newsletters'));
	}
	
	public function update(){
		
		$id = $this->input->post('n_id');
		if($id==''){
			redirect(base_url().'admin/manage_newsletters','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Newsletter';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_from_name', 'From Name', 'trim|required');
		$this->form_validation->set_rules('edit_from_email', 'From Email', 'trim|required|secure|valid_email');
		$this->form_validation->set_rules('edit_email_subject', 'Email Subject', 'trim|required');
		$this->form_validation->set_rules('edit_email_interval', 'email interval', 'trim|required|numeric');
		$this->form_validation->set_rules('edit_editor1', 'email content', 'trim|required');
	    $this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$data_array = array(
							'from_name' => $this->input->post('edit_from_name'),
							'from_email' => $this->input->post('edit_from_email'),
							'email_subject' => $this->input->post('edit_email_subject'),
							'email_interval' => $this->input->post('edit_email_interval'),
							'email_body' => $this->input->post('edit_editor1')
		);
		$this->newsletter_model->update($id, $data_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/manage_newsletters'));
	}
	public function status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid current status provided.';
			exit;
		}
		
		if($current_staus=='active')
			$new_status= 'inactive';
		else
			$new_status= 'active';
		
		$data = array (
						'status' => $new_status
		);
		
		$this->newsletter_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->newsletter_model->delete($id);
		echo 'done';
		exit;
	}
	
	public function preview($id=''){
		
		
		if($id==''){
			redirect('admin/manage_newsletters');
			return;
		}
		
		$obj_row = $this->newsletter_model->get_record_by_id($id);
		echo $obj_row['email_body'];
		exit;
		
	}
	
	public function download_newsletter($id=''){
		if($id==''){
			redirect('admin/manage_newsletters');
			return;
		}
		$obj_row = $this->newsletter_model->get_record_by_id($id);
		$data = $obj_row['email_body'];
		$name = underscore($obj_row['email_subject']).'_template.html';
		force_download($name, $data);
	}
	public function force_send_newsletter(){
		
		$data=array();
		$data['msg']='';
		$id = $this->input->post('n_force_id');
		if(!$id){
			redirect(base_url('admin/manage_newsletters'));
			exit;	
		}
		
		$obj_row = $this->newsletter_model->get_record_by_id($id);
		$this->form_validation->set_rules('n_force_id', 'ID', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Eamil Address', 'trim|required|valid_email');
	
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$email = $this->input->post('email_address');
		
		$email_draft	=	$obj_row['email_body'];
		$from_name		=	$obj_row['from_name'];
		$from_email		=	$obj_row['from_email'];
		$email_subject	=	$obj_row['email_subject'];
		
		//sending an email to support team
		$config = array();
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
	
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($from_email, $from_name);
		$this->email->to($email);
		
		$this->email->subject($email_subject);
		$mail_message = $this->email_drafts_model->force_send_newsletter_draft($email_draft);
		$this->email->message($mail_message);				
		$this->email->send();
		$this->session->set_flashdata('force_send_action', true);
		redirect(base_url('admin/manage_newsletters'));
	}	
	
}
