<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_Template extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Email Template';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->email_model->record_count('tbl_email_content');
		$config = pagination_configuration(base_url("admin/email_template"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->email_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/email_template_view', $data);
		return;
	}
	
	public function get_email_template_by_id($id=''){
		if($id!=''){
			$row = $this->email_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	
	public function view($id=''){
		if($id!=''){
			$row = $this->email_model->get_record_by_id($id);
			echo $row['content'];
			exit;
		}
		return;
	}
	
	public function update(){
		
		$id = $this->input->post('eid');
		if($id==''){
			redirect(base_url().'admin/email_template','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Email Template';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('from_name', 'From Name', 'trim|required');
		$this->form_validation->set_rules('from_email', 'From Email', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');	
		$this->form_validation->set_rules('editor1', 'Email Content', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$data_array = array(
							'from_name' => $this->input->post('from_name'),
							'from_email' => $this->input->post('from_email'),
							'subject' => $this->input->post('subject'),
							'content' => $this->input->post('editor1')
		);
		$this->email_model->update($id, $data_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/email_template'));
		return;
	}
}