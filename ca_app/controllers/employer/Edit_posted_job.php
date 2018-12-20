<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_Posted_Job extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index($id='')
	{
		
		if($id==''){
			redirect(base_url().'employer/dashboard','');
			exit;
		}
		
		$data['ads_row'] = $this->ads;
		$data['id'] = $id;
		$data['title'] = SITE_NAME.' : Edit Posted Job';
		$data['msg']='';
		$data['result_cities'] = $this->cities_model->get_all_cities();
		$data['result_countries'] = $this->countries_model->get_all_countries();
		$data['result_industries'] = $this->industries_model->get_all_industries();
		$data['result_salaries'] = $this->salaries_model->get_all_records();
		$data['result_qualification'] = $this->qualification_model->get_all_records();
		$available_skills='';
		foreach($this->skill_model->get_all_skills() as $skill_row){
			$available_skills.='"'.$skill_row->skill_name.'", ';
		}
		$available_skills = '['.rtrim($available_skills,', ').']';
		$data['available_skills'] = $available_skills;
		$row = $this->posted_jobs_model->get_posted_job_by_id_employer_id($id, $this->session->userdata('user_id'));
		if(!$row){
			redirect(base_url().'employer/dashboard','');
			exit;	
		}
		$data['row'] = $row;
	
		$this->form_validation->set_rules('industry_id', 'Job category', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('job_title', 'Job title', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('vacancies', 'Vacancies', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('job_mode', 'Job mode', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('pay', 'Pay', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('last_date', 'Apply date', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'City', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');
		$this->form_validation->set_rules('editor1', 'Job description', 'trim|required');
		$this->form_validation->set_rules('contact_person', 'Contact person', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('contact_email', 'Contact rmail', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('contact_phone', 'Contact phone', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('experience', 'Experience', 'trim|required|strip_all_tags');
	
		$this->form_validation->set_error_delimiters('<div class="errowbox"><div class="erormsg">', '</div></div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('employer/edit_posted_job_view',$data);
			return;
		}
		
		$required_skills = ltrim($this->input->post('s_val'),', ');
		$job_desc = strip_tags($this->input->post('editor1'),'<b><p><br><ul><li>');
		$last_date = date_formats($this->input->post('last_date'),'Y-m-d');
		$job_slug = $this->make_job_slug($row->company_slug, $this->input->post('job_title'), $this->input->post('city'), $id);
		$job_array = array(
								'industry_id' => $this->input->post('industry_id'),
								'job_title' => $this->input->post('job_title'),
								'vacancies' => $this->input->post('vacancies'),
								'job_mode' => $this->input->post('job_mode'),
								'pay' => $this->input->post('pay'),
								'experience' => $this->input->post('experience'),
								'last_date' => $last_date,
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city'),
								'qualification' => $this->input->post('qualification'),
								'job_description' => $job_desc,
								'contact_person' => $this->input->post('contact_person'),
								'contact_email' => $this->input->post('contact_email'),
								'contact_phone' => $this->input->post('contact_phone'),
								'required_skills' => $required_skills,
								'job_slug' => $job_slug
		);
		$this->posted_jobs_model->update_posted_job($id, $job_array);
		$this->add_skill($required_skills);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Job has been updated successfully.</div>');
		redirect(base_url('employer/edit_posted_job/'.$id),'');		
	}
	
	public function make_job_slug($company_slug, $job_title, $city, $id){
		
		$job_url_prefix = $company_slug.'-jobs-in-';
		$final_job_url ='';
		$job_title = trim($job_title);
		$string1 = preg_replace('/[^a-zA-Z0-9 ]/s', '', $job_title);
		$job_title_slug = strtolower(preg_replace('/\s+/', '-', $string1));
		$job_url_postfix = strtolower($city).'-'.$job_title_slug.'-'.$id;
		$final_job_url = $job_url_prefix.$job_url_postfix;
		return $final_job_url;
		
	}
	
	public function delete_posted_job($id=''){
		
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		if($this->session->userdata('is_employer')!=TRUE){
			echo 'Illegal Request. Details are sent to administrator.';
			exit;	
		}
		
		if($id==''){
			echo 'Valid ID is missing.';
			exit;	
		}
		
		$this->posted_jobs_model->delete_posted_job_by_id_emp_id($id, $this->session->userdata('user_id'));
		$this->applied_jobs_model->delete_applied_job_by_posted_job_id($id);
		echo "done";
		
	}
	
	public function status($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		if($this->session->userdata('is_employer')!=TRUE){
			echo 'Illegal Request. Details are sent to administrator.';
			exit;	
		}
		
		$obj_row = $this->posted_jobs_model->get_posted_job_by_id_employer_id($id, $this->session->userdata('user_id'));
		
		if($obj_row){
			$current_status = $obj_row->sts;
			if($current_status=='active')
				$new_status= 'inactive';
			else
				$new_status= 'active';
			
			$data = array ('sts' => $new_status);
			
			$this->posted_jobs_model->update_posted_job($id, $data);
			echo $new_status;
		}else{
			echo 'It seems an illegal Request. Details are sent to administrator.';
		}
		exit;
	}	
	
	public function add_skill($skills)
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		$skills_array = explode(', ',$skills);
		
		foreach($skills_array as $skill){
			if(!$this->skill_model->get_skills_by_skill_name($skill)){
				$this->skill_model->add(array('skill_name'=>$skill));
			}
		}
	}
}
