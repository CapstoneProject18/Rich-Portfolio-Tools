<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salary extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Sallary Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->salaries_model->record_count('tbl_salaries');
		$config = pagination_configuration(base_url("admin/salary_view"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->salaries_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/salary_view', $data);
		return;
	}
	
	public function get_salary_by_id($id=''){
		if($id!=''){
			$row = $this->salaries_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	public function add(){
		$data['title'] = SITE_NAME.': Sallary Management';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('salary_val', 'salary Value', 'trim|required');
		$this->form_validation->set_rules('salary_text', 'salary Text', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$salary_array = array(
							'val' => $this->input->post('salary_val'),
							'text' => $this->input->post('salary_text')
		);
		$this->salaries_model->add($salary_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/salary'));
	}
		
	public function update(){
		
		$id = $this->input->post('salary_id');
		if($id==''){
			redirect(base_url().'admin/salary','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Page';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_salary_value', 'Sallar Value', 'trim|required');
		$this->form_validation->set_rules('edit_salary_text', 'Salary Text', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$salary_array = array(
							'val' => $this->input->post('edit_salary_value'),
							'text' => $this->input->post('edit_salary_text')
		);
		$this->salaries_model->update($id, $salary_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/salary'));
		return;
	}
	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->salaries_model->delete($id);
		echo 'done';
		exit;
	}
}