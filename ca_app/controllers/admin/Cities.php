<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cities extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Cities Management';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->cities_model->record_count('tbl_cities');
		$config = pagination_configuration(base_url("admin/cities"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->cities_model->get_all_cities($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/cities_view', $data);
		return;
	}
	
	public function get_city_by_id($id=''){
		if($id!=''){
			$row = $this->cities_model->get_city_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	public function add(){
		$data['title'] = SITE_NAME.': Cities Management';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('city_name', 'City Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$cities_array = array(
							'city_name' => $this->input->post('city_name')
		);
		$this->cities_model->add_city($cities_array);
		$this->session->set_flashdata('added_action', true);
		redirect(base_url('admin/cities'));
	}
		
	public function update(){
		
		$id = $this->input->post('cities_id');
		if($id==''){
			redirect(base_url().'admin/cities','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Page';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('edit_city_name', 'City Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$cities_array = array(
							'city_name' => $this->input->post('edit_city_name')
		);
		$this->cities_model->update_cities($id, $cities_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/cities'));
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
		
		if($current_staus=='1')
			$new_status= '0';
		else
			$new_status= '1';
		
		$data = array (
						'show' => $new_status
		);
		
		$this->cities_model->update_cities($id, $data);
		
		echo $new_status;
		exit;
	}	
	
	public function status_popular($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid popular status provided.';
			exit;
		}
		
		if($current_staus=='yes')
			$new_status= 'no';
		else
			$new_status= 'yes';
		
		$data = array (
						'is_popular' => $new_status
		);
		
		$this->cities_model->update_cities($id, $data);
		
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->cities_model->delete_cities($id);
		echo 'done';
		exit;
	}
}