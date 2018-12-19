<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Success_Stories extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Jobseekers';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->job_seekers_model->record_count('tbl_job_seekers');
		$config = pagination_configuration(base_url("admin/job_seekers"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->job_seekers_model->get_all_job_seekers($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/job_seekers_view', $data);
		return;
	}
	
	public function details($id=''){
		
		if($id==''){
			redirect(base_url().'admin/job_seekers','');
			exit;
		}
		$data['title'] = SITE_NAME.': Jobseeker Details';
		$data['msg'] = '';
		$obj_row = $this->job_seekers_model->get_job_seeker_by_id($id);
		$data['row'] = $obj_row;
		$this->load->view('admin/job_seeker_details_view', $data);
		return;
	}
	
	public function update($id=''){
		
		if($id==''){
			redirect(base_url().'admin/job_seekers','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Jobseeker Details';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');	
		$this->form_validation->set_rules('mobile', 'mobile number', 'trim|required|numeric');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('present_address', 'Present address', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required|alpha');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			
			$obj_row = $this->job_seekers_model->get_job_seeker_by_id($id);
			$obj_cities = $this->cities_model->get_all_cities();
			$obj_countries = $this->countries_model->get_all_countries();
			$obj_industries = $this->industries_model->get_all_industries();
			
			$data['row'] = $obj_row;
			$data['result_cities'] = $obj_cities;
			$data['result_countries'] = $obj_countries;
			$data['result_industries'] = $obj_industries;
			$this->load->view('admin/job_seeker_edit_view', $data);
			return;
		}
		
		$employer_array = array(
								'first_name' => $this->input->post('first_name'),
								'last_name' => $this->input->post('last_name'),
								'email' => $this->input->post('email'),
								'password' => $this->input->post('password'),
								'dob' => $this->input->post('dob'),
								'mobile' => $this->input->post('mobile'),
								'present_address' => $this->input->post('present_address'),
								'permanent_address' => $this->input->post('permanent_address'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city'),
								'gender' => $this->input->post('gender')
		);
		$this->job_seekers_model->update_job_seeker($id, $employer_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/job_seekers/update/'.$id));
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
		
		if($current_staus=='active')
			$new_status= 'blocked';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->job_seekers_model->update_job_seeker($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete_job_seeker($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->job_seekers_model->get_job_seeker_by_id($id);
		$this->job_seekers_model->delete_job_seeker($obj_row->ID);
		$this->applied_jobs_model->delete_applied_job_by_seeker_id($obj_row->ID);
		$real_path = realpath(APPPATH . '../public/uploads/candidate/');
		@unlink($real_path.'/'.$obj_row->photo);
		echo 'done';
		exit;
	}
}