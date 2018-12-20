<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Prohibited_Keyword extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Prohibited Keywords';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->prohibited_keywords_model->record_count('tbl_prohibited_keywords');
		$config = pagination_configuration(base_url("admin/prohibited_keyword"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->prohibited_keywords_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/prohibited_keywords_view', $data);
		return;
	}
	
	public function get_prohibited_keyword_by_id($id=''){
		if($id!=''){
			$row = $this->prohibited_keywords_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	
	public function add(){
		$data['title'] = SITE_NAME.': Prohibited Keywords';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('keyword', 'keyword', 'trim|required|is_unique[tbl_prohibited_keywords.keyword]');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$data_array = array('keyword' => strtolower($this->input->post('keyword')));
		$this->prohibited_keywords_model->add($data_array);
		$this->write_data_into_file();
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/prohibited_keyword'));
	}
		
	public function update(){
		
		$id = $this->input->post('key_id');
		if($id==''){
			redirect(base_url().'admin/prohibited_keyword','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Prohibited Keyword';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_keyword', 'keyword', 'trim|required|unique[prohibited_keywords.keyword]');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$data_array = array('keyword' => strtolower($this->input->post('edit_keyword')));
		$this->prohibited_keywords_model->update($id, $data_array);
		$this->write_data_into_file();
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/prohibited_keyword'));
		return;
	}
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->prohibited_keywords_model->delete($id);
		echo 'done';
		exit;
	}
	
	public function write_data_into_file(){
		$result = $this->prohibited_keywords_model->get_all_records();
		$keywords = '';
		$content = 'var bad_words = ';
		if($result){
			foreach($result as $row){
				$keywords .= '"'.strtolower($row->keyword).'", ';
			}
			
			$keywords = rtrim($keywords,', ');
			$content.= '['.$keywords.'];';
			$real_path = realpath(APPPATH . '../public/js/bad_words.js');
			write_file($real_path, $content);
		}
	}
}