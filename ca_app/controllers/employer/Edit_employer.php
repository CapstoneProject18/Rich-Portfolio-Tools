<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_Employer extends CI_Controller {
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
	}
	
	public function summary()
	{
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		
		$this->form_validation->set_rules('content', 'summary', 'trim|required|strip_all_tags');
		$this->form_validation->set_rules('cid', 'ID', 'trim|required|strip_all_tags');
		if ($this->form_validation->run() === FALSE) {
			echo strip_tags(validation_errors());
			exit;
		}
		$summary_array = array(
							'company_description'	=> $this->input->post('content')
		);
		$this->companies_model->update_company($this->input->post('cid'), $summary_array);
		$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Summary has been updated successfully. </div>');
		echo "done";
	}
	public function upload_logo(){
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		if (!empty($_FILES['upload_logo']['name'])){
			
			$obj_row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
			$real_path = realpath(APPPATH . '../public/uploads/employer/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = true;
			$config['max_size'] = 6000;
			$config['file_name'] = 'JOBPORTAL-'.time();
			$this->upload->initialize($config);
			if ($this->upload->do_upload('upload_logo')){
				if($obj_row->company_logo){
					@unlink($real_path.'/'.$obj_row->company_logo);	
					@unlink($real_path.'/thumb/'.$obj_row->company_logo);
				}
			} else{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Error!</strong> '.strip_tags($error['error']).' </div>');
				redirect(base_url('employer/dashboard'));
				exit;
			}
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 50;
			$thumb_config['width']	 = 70;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
			
			$thumb_config2['image_library'] = 'gd2';
			$thumb_config2['source_image']	= $real_path.'/'.$image_name;
			$thumb_config2['new_image']	= $real_path.'/'.$image_name;
			$thumb_config2['maintain_ratio'] = TRUE;
			$thumb_config2['height']	= 250;
			$thumb_config2['width']	 = 250;
			$this->image_lib->initialize($thumb_config2);
			$this->image_lib->resize();
			
			$photo_array = array('company_logo' => $image_name);
			$this->companies_model->update_company($obj_row->company_ID, $photo_array);
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Success!</strong> Company logo uploaded successfully. </div>');
		}
		$redirect = base_url('jobseeker/dashboard');
		if ($this->agent->is_referral()){
			$redirect = $this->agent->referrer();	
		}
		redirect($redirect);
	}
	
	public function delete_logo(){
		
		if(!$this->session->userdata('user_id')){
			echo 'Your session has been expired, please re-login first.';
			exit;	
		}
		$obj_row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		$this->companies_model->update_company($obj_row->company_ID, array('company_logo'=>''));
		$real_path = realpath(APPPATH . '../public/uploads/employer/');
		@unlink($real_path.'/'.$obj_row->company_logo);	
		@unlink($real_path.'/thumb/'.$obj_row->company_logo);
		echo "done";
	}
	
	public function delete_company_logo(){
		
		if(!$this->session->userdata('user_id')){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong>Error!</strong> Your session has been expired, please re-login first.. </div>');
			$redirect = base_url('jobseeker/dashboard');
			if ($this->agent->is_referral()){
				$redirect = $this->agent->referrer();	
			}
			redirect($redirect);
			exit;	
		}
		$obj_row = $this->employers_model->get_employer_by_id($this->session->userdata('user_id'));
		$this->companies_model->update_company($obj_row->company_ID, array('company_logo'=>''));
		$real_path = realpath(APPPATH . '../public/uploads/employer/');
		@unlink($real_path.'/'.$obj_row->company_logo);	
		@unlink($real_path.'/thumb/'.$obj_row->company_logo);
		
		$redirect = base_url('jobseeker/dashboard');
			if ($this->agent->is_referral()){
				$redirect = $this->agent->referrer();	
			}
			redirect($redirect);
			exit;
	}
}
