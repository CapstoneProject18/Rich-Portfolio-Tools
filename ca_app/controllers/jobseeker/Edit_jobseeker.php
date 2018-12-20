<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_Jobseeker extends CI_Controller {
	public function index(){
		echo "you are not allow to access this page directly";
		exit;
	}
	
	public function profile()
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
		
		$this->form_validation->set_rules('full_name', 'full name', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('country', 'country', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('city', 'city', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$profile_array = array(
							'first_name'		=> $this->input->post('full_name'),
							'last_name'			=> '',
							'mobile'			=> $this->input->post('mobile'),
							'country' 			=> $this->input->post('country'),
							'city' 				=> $this->input->post('city'),
		);
		$this->job_seekers_model->update($this->session->userdata('user_id'), $profile_array);
		$this->session->set_userdata('first_name',$this->input->post('full_name'));
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Profile has been updated successfully. </div>');
		echo "done";
	}
	
	public function summary()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('content', 'summary', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$summary_array = array(
							'summary'		=> $this->input->post('content')
		);
		
		$row = $this->jobseeker_additional_info_model->get_record_by_userid($this->session->userdata('user_id'));
		//$this->jobseeker_additional_info_model->update($row->ID, $data_array);
		
		if($row){
			$this->jobseeker_additional_info_model->update($row->ID, $summary_array);
		}else{
			$this->jobseeker_additional_info_model->add($summary_array);
		}
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Professional summary has been updated successfully. </div>');
		echo "done";
	}
	
	public function delete_applied_job(){
		
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|strip_all_tags|numeric');
		
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		
		$this->applied_jobs_model->delete_applied_job_by_id_seeker_id($this->input->post('id'), $this->session->userdata('user_id'));
		echo "done";
		
	}
	
	public function upload_photo(){
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		if (!empty($_FILES['upload_pic']['name'])){
			$obj_row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
			$company_name_for_file = strtolower($this->input->post('company_name'));
			$real_path = realpath(APPPATH . '../public/uploads/candidate/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = true;
			$config['max_size'] = 6000;
			$config['file_name'] = make_slug($obj_row->first_name).'-JOBPORTAL-'.$obj_row->ID;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('upload_pic')){
				if($obj_row->photo){
					@unlink($real_path.'/'.$obj_row->photo);	
					@unlink($real_path.'/thumb/'.$obj_row->photo);
				}
			} else{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Error!</strong> '.strip_tags($error['error']).' </div>');
				redirect(base_url('jobseeker/dashboard'));
				exit;
			}
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 200;
			$thumb_config['width']	 = 200;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
			
			$photo_array = array('photo' => $image_name);
			$this->job_seekers_model->update($this->session->userdata('user_id'), $photo_array);
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Photo uploaded successfully. </div>');
		}
		redirect(base_url('jobseeker/dashboard'));
	}
	
	public function delete_photo(){
		
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		$obj_row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
		$this->job_seekers_model->update($this->session->userdata('user_id'), array('photo'=>''));
		$real_path = realpath(APPPATH . '../public/uploads/candidate/');
		@unlink($real_path.'/'.$obj_row->photo);	
		@unlink($real_path.'/thumb/'.$obj_row->photo);
		echo "done";
	}
	
	public function is_image($path){
		$a = getimagesize($path);
		$image_type = $a[2];
		 
		if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
		{
			return true;
		}
		return false;
	}
	
	
	public function upload_cv(){
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		if (!empty($_FILES['upload_resume']['name'])){
			$obj_row = $this->job_seekers_model->get_job_seeker_by_id($this->session->userdata('user_id'));
			$real_path = realpath(APPPATH . '../public/uploads/candidate/resumes/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'doc|docx|pdf|rtf|jpg|png|jpeg';
			$config['overwrite'] = true;
			$config['max_size'] = 6000;
			$config['file_name'] = make_slug($obj_row->first_name).'-JOBPORTAL-'.$obj_row->ID.time();
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('upload_resume')){
				
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Error!</strong> '.strip_tags($error['error']).' </div>');
				redirect(base_url('jobseeker/cv_manager'));
				exit;
			}
			
			$resume = array('upload_data' => $this->upload->data());	
			$resume_file_name = $resume['upload_data']['file_name'];
			$resume_array = array(
									'seeker_ID' => $obj_row->ID,
									'file_name' => $resume_file_name,
									'dated' => date("Y-m-d H:i:s"),
									'is_uploaded_resume' => 'yes'
									
			);
			$this->resume_model->add($resume_array);			
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> CV uploaded successfully. </div>');
		}
		redirect(base_url('jobseeker/cv_manager'));
	}
	
}
