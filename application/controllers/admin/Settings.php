<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Controller {
	
	public function index(){
		$data['title'] = SITE_NAME.': Manage Settings';
		$data['msg'] = '';
		$row = $this->settings_model->get_record_by_id(1);
		$data['row'] = $row;
		$this->load->view('admin/settings_view', $data);
		return;
	}
	
	public function update($id=''){
		
		if($id==''){
			redirect(base_url().'admin/Settings','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Settings';
		$data['msg'] = '';
		
		
		$ads_array = array(
								'emails_per_hour' => $this->input->post('emails_per_hour'),
								'payment_plan' => $this->input->post('payment_plan'),
								'currency' => $this->input->post('currency')
		);
		
		$this->settings_model->update($id, $ads_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/Settings'));
		return;
	}
	
}