<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class add_skills extends CI_Controller {
	
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
		
		$available_skills = '';
		$data['ads_row'] = $this->ads;
		$result = $this->jobseeker_skills_model->get_records_by_seeker_id($this->session->userdata('user_id'));
		$data['title'] = $this->session->userdata('first_name').' - Add Skills';
		$data['result'] = $result;
		$data['count_skills'] = count($result);
		
		foreach($this->skill_model->get_all_skills() as $skill_row){
			$available_skills.='"'.$skill_row->skill_name.'", ';
		}
		$available_skills = '['.rtrim($available_skills,', ').']';
		$data['available_skills'] = $available_skills;
		
		$this->load->view('jobseeker/add_skills_view',$data);
		return;
	}
	
	public function add()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$skill = trim(strtolower($this->input->post('skill')));
		$skill = strip_tags($skill);
		
		$row = $this->jobseeker_skills_model->get_records_by_seeker_id_skill_name($this->session->userdata('user_id'),$skill);
		if($row){
			echo "This skill is already added.";
			exit;
		}
		
		$data_array = array('seeker_ID' => $this->session->userdata('user_id'), 'skill_name' => $skill);
		$this->jobseeker_skills_model->add($data_array);
		echo $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		exit;
	}
	
	public function remove()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->jobseeker_skills_model->delete($this->input->post('skill'));
		echo $this->jobseeker_skills_model->count_jobseeker_skills_by_seeker_id($this->session->userdata('user_id'));
		exit;
		
		
	}
}
