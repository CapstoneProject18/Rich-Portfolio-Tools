<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stories extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Stories Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->stories_model->record_count('tbl_stories');
		$config = pagination_configuration(base_url("admin/stories"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->stories_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/stories_view', $data);
		return;
	}
	
	public function get_stories_by_id($id=''){
		if($id!=''){
			$row = $this->stories_model->get_stories_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	public function add(){
		$data['title'] = SITE_NAME.': Stories Management';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_title', 'Title', 'trim|required');
		$this->form_validation->set_rules('edit_story', 'Story', 'trim|required');	
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$stories_array = array(
							'title' => $this->input->post('edit_title'),
							'story' => $this->input->post('edit_story'),
							'dated' => date("Y-m-d H:i:s")
		);
		$this->stories_model->add($stories_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/stories'));
	}
		
	public function update(){
		
		$id = $this->input->post('stories_id');
		if($id==''){
			redirect(base_url().'admin/stories','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Page';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_title', 'Title', 'trim|required');
		$this->form_validation->set_rules('edit_story', 'Story', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$stories_array = array(
							'title' => $this->input->post('edit_title'),
							'story' => $this->input->post('edit_story')
		);
		$this->stories_model->update($id, $stories_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/stories'));
		return;
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
			$new_status= 'blocked';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->stories_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->stories_model->delete($id);
		echo 'done';
		exit;
	}
}