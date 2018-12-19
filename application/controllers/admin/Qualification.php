<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qualification extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Qualification Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->qualification_model->record_count('tbl_qualifications');
		$config = pagination_configuration(base_url("admin/qualification_view"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->qualification_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/qualification_view', $data);
		return;
	}
	
	public function get_qualification_by_id($id=''){
		if($id!=''){
			$row = $this->qualification_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	public function add(){
		$data['title'] = SITE_NAME.': Qualification Management';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');
		$this->form_validation->set_rules('text', 'Text', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$qualification_array = array(
							'val' => $this->input->post('qualification'),
							'text' => $this->input->post('text')
		);
		$this->qualification_model->add($qualification_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/qualification'));
	}
		
	public function update(){
		
		$id = $this->input->post('qualification_id');
		if($id==''){
			redirect(base_url().'admin/qualification','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Page';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_qualification', 'Qualification', 'trim|required');
		$this->form_validation->set_rules('edit_text', 'Text', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$qualification_array = array(
							'val' => $this->input->post('edit_qualification'),
							'text' => $this->input->post('edit_text')
		);
		$this->qualification_model->update($id, $qualification_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/qualification'));
		return;
	}
	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->qualification_model->delete($id);
		echo 'done';
		exit;
	}
}