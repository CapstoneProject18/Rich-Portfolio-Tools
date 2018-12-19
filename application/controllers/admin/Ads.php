<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ads extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Ads';
		$data['msg'] = '';
		$row = $this->ads_model->get_ads();
		$data['row'] = $row;
		$this->load->view('admin/ads_view', $data);
		return;
	}
	
	public function update($id=''){
		
		if($id==''){
			redirect(base_url().'admin/ads','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Ads';
		$data['msg'] = '';
		
		/*$this->form_validation->set_rules('right_side_1', 'Home Page Main', 'trim');
		$this->form_validation->set_rules('right_side_2', 'Home Page Right Ride', 'trim');
		$this->form_validation->set_rules('bottom', 'Home Page Bottom', 'trim');
		$this->form_validation->set_rules('google_analytics', 'Google Analytics', 'trim');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');*/
		
		/*if ($this->form_validation->run() === FALSE) {
			
			$obj_row = $this->ads_model->get_ads_by_id($id);
			
			$data['row'] = $obj_row;
			$this->load->view('admin/ads_view', $data);
			return;
		}*/
		
		$ads_array = array(
								'right_side_1' => $this->input->post('right_side_1'),
								'right_side_2' => $this->input->post('right_side_2'),
								'bottom' => $this->input->post('bottom'),
								'google_analytics' => $this->input->post('google_analytics')
		);
		
		$this->ads_model->update_ads($id, $ads_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/ads'));
		return;
	}
	
}