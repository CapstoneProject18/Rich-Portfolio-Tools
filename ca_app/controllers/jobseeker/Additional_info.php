<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class additional_info extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		//Additional Info
		$row_additional = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		
		//Skills
		$keywords = $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		$is_keywords_provided = $keywords;
		
		if($is_keywords_provided<3){
			  redirect(base_url('jobseeker/add_skills'));
			  exit;
		}
		
		$data['ads_row'] = $this->ads;
		$row = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		$data['title'] = SITE_NAME.': Manage Additional Information';
		$data['row'] = $row;
		
		$this->form_validation->set_rules('description', 'career objective', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('awards', 'awards', 'trim|required|strip_all_tags');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('jobseeker/additional_info_view',$data);
			return;
		}
		$data_array = array(
							'seeker_ID'			=> $this->session->userdata('user_id'),
							'awards'			=> $this->input->post('awards'),
							'description'		=> $this->input->post('description')
		);
	
		if($row){
			$this->jobseeker_additional_info_model->update($row->ID, $data_array);
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Additional information has been updated successfully. </div>');
		}
		else{
			$this->jobseeker_additional_info_model->add($data_array);
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Additional information has been added successfully. </div>');
		}
		
		redirect(base_url('jobseeker/dashboard'));
	}
}
