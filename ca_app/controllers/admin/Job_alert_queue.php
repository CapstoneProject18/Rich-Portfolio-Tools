<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_Alert_Queue extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Job Alert Queue';
		$data['msg'] = '';
		
		$obj_result = $this->job_alert_model->get_queue_list_grouped();
		$setting_row = $this->job_alert_model->get_settings();
		
		$data['result'] = $obj_result;
		$data['settings']  = $setting_row;
		$this->load->view('admin/job_alert_queue_view', $data);
		return;
	}
	
	public function delete_queue($job_id=''){
		
		if($job_id==''){
			redirect('admin/job_alert_queue');	
			exit;
		}
		
		$this->job_alert_model->delete_by_job_id($job_id);
		$this->session->set_flashdata('delete_action', true);
		redirect('admin/job_alert_queue');	
	}
	
	public function update_email_rate(){
		
		$this->form_validation->set_rules('per_hour', 'Email Rate', 'trim|required|numeric');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		$data_array = array('emails_per_hour' => $this->input->post('per_hour'));
		$this->job_alert_model->update_settings('1',$data_array);
		$this->session->set_flashdata('update_action', true);
		redirect('admin/job_alert_queue');	
	}
	
}