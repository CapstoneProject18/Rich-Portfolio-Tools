<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Industries extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Industry Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->industries_model->record_count('tbl_job_industries');
		$config = pagination_configuration(base_url("admin/industries"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->industries_model->get_all_records($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/industries_view', $data);
		return;
	}
	
	public function get_industries_by_id($id=''){
		if($id!=''){
			$row = $this->industries_model->get_industries_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	public function add(){
		$data['title'] = SITE_NAME.': Industry Management';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('industries', 'Industries', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$slug = make_slug($this->input->post('industries'));
		$industries_array = array(
							'industry_name' => $this->input->post('industries'),
							'slug' => $slug
		);
		$this->industries_model->add($industries_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/industries'));
	}
		
	public function update(){
		
		$id = $this->input->post('industries_id');
		if($id==''){
			redirect(base_url().'admin/industries','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Page';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_industries', 'Industries', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		$slug = make_slug($this->input->post('edit_industries'));
		$industries_array = array(
							'industry_name' => $this->input->post('edit_industries'),
							'slug' => $slug
		);
		$this->industries_model->update($id, $industries_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/industries'));
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
		
		$this->industries_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->industries_model->delete($id);
		echo 'done';
		exit;
	}
	
	public function top_industry_status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid status value provided.';
			exit;
		}
		
		if($current_staus=='yes')
			$new_status= 'no';
		else
			$new_status= 'yes';
		
		$data = array (
						'top_category' => $new_status
		);
		
		$this->industries_model->update($id, $data);
		echo $new_status;
		exit;
	}	
}