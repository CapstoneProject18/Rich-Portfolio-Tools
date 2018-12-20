<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Success_Story extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index()
	{
		if(!$this->session->userdata('user_id')){
			echo 'All fields are mandatory.';
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
		$data['title'] = SITE_NAME.': Post Success Story';
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('story', 'Story', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('jobseeker/my_success_story_view', $data);
			return;
		}
				$new_array = array(
							'seeker_ID' => $this->session->userdata('user_id'),
							'title' => $this->input->post('title'),
							'story' => $this->input->post('story'),
							'dated' => date("Y-m-d H:i:s")
				);
				
				$this->stories_model->add($new_array);
				$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your story has been posted successfully.</div>');
				redirect(base_url('jobseeker/my_success_story'));
				return;				
		}
}
