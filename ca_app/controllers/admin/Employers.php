<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employers extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Employers';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->employers_model->record_count('tbl_employers');
		$config = pagination_configuration(base_url("admin/employers"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->employers_model->get_all_employers($config["per_page"], $page);
		$data['result'] = $obj_result;
		$data["total_rows"] = $total_rows;
		$this->load->view('admin/employers_view', $data);
		return;
	}
	
	public function details($id=''){
		
		if($id==''){
			redirect(base_url().'admin/employers','');
			exit;
		}
		$data['title'] = SITE_NAME.': Employer Details';
		$data['msg'] = '';
		$obj_row = $this->employers_model->get_employer_by_id($id);
		if($obj_row){
			$data['row'] = $obj_row;
			$this->load->view('admin/employers_details_view', $data);
			return;
		}
		redirect(base_url().'admin/employers','');
		exit;
		
	}
	
	public function update($id=''){
		
		if($id==''){
			redirect(base_url().'admin/employers','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Employer Details';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('full_name', 'full name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');	
		$this->form_validation->set_rules('mobile_phone', 'mobile number', 'trim|required');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			
			$obj_row = $this->employers_model->get_employer_by_id($id);
			$obj_cities = $this->cities_model->get_all_cities();
			$obj_countries = $this->countries_model->get_all_countries();
			$obj_industries = $this->industries_model->get_all_industries();
			
			$data['row'] = $obj_row;
			$data['result_cities'] = $obj_cities;
			$data['result_countries'] = $obj_countries;
			$data['result_industries'] = $obj_industries;
			$this->load->view('admin/employers_edit_view', $data);
			return;
		}
		
		$employer_array = array(
								'first_name' => $this->input->post('full_name'),
								'email' => $this->input->post('email'),
								'pass_code' => $this->input->post('password'),
								'mobile_phone' => $this->input->post('mobile_phone'),
								'country' => $this->input->post('country'),
								'city' => $this->input->post('city')
		);
		$this->employers_model->update_employer($id, $employer_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/employers/update/'.$id));
		return;
	}
	
	public function status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid status value provided.';
			exit;
		}
		
		if($current_staus=='active')
			$new_status= 'blocked';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$row = $this->employers_model->get_employer_by_id_simple($id);
		$this->employers_model->update_employer($id, $data);
		$this->companies_model->update_company($row->company_ID, $data);
		echo $new_status;
		exit;
	}	
	
	public function top_employer_status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid status value provided.';
			exit;
		}
		
		if($current_staus=='yes')
			$new_status= 'no';
		else
			$new_status= 'yes';
		
		$data = array (
						'top_employer' => $new_status
		);
		
		$this->employers_model->update_employer($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete_employer($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		$obj_row = $this->employers_model->get_employer_by_id($id);
		$this->employers_model->delete_employer($obj_row->ID);
		$this->companies_model->delete_company($obj_row->company_ID);
		//$this->posted_jobs_model->delete_post_jobs($employer_id);
		$real_path = realpath(APPPATH . '../public/uploads/employer/');
		@unlink($real_path.'/'.$obj_row->company_logo);	
		@unlink($real_path.'/thumb/'.$obj_row->company_logo);		
		echo 'done';
		exit;
	}
	
	public function search(){
		$data['title'] = SITE_NAME.': Manage Employers';
		$data['msg'] = '';
		$search_name ='';
		$search_email ='';
		$search_company ='';
		$search_city ='';
		$top_employer ='';
		
		$this->form_validation->set_rules('first_name', 'first_name', 'trim');
		$this->form_validation->set_rules('email', 'email', 'trim');	
		$this->form_validation->set_rules('company_name', 'company_name', 'trim');
		$this->form_validation->set_rules('city', 'city', 'trim');
		$this->form_validation->set_rules('industry_ID', 'industry', 'trim');
		$this->form_validation->run();
		
		if ($_GET){
			$search_name 	= 	$this->input->get('first_name');
			$search_email 	= 	$this->input->get('email');
			$search_company = 	$this->input->get('company_name');
			$search_city 	= 	$this->input->get('city');
			$top_employer 	= 	$this->input->get('top_employer');
			$industry_ID 	= 	$this->input->get('industry_ID');
			
		}
		if($search_name=='' && $search_email=='' && $search_company=='' && $search_city=='' && $top_employer=='' && $industry_ID==''){
			redirect(base_url('admin/employers'));
			return;
		}
		$new_array = array();
		$search_data = array();
		if(isset($search_name) && $search_name!=''){
			$search_data['first_name']=$search_name;	
			
		}
		if(isset($search_email) && $search_email!=''){
			$search_data['email']=$search_email;	
		}
		if(isset($search_company) && $search_company!=''){
			$search_data['company_name']=$search_company;	
		}
		if(isset($search_city) && $search_city!=''){
			$search_data['city']=$search_city;	
		}
		if(isset($top_employer) && $top_employer!=''){
			$search_data['top_employer']=$top_employer;	
		}
		if(isset($industry_ID) && $industry_ID!=''){
			$search_data['industry_ID']=$industry_ID;	
		}
		
		$wild_card = ($industry_ID!='')?'yes':'';
		$url_params = implode('&amp;', array_map(function($key, $val) {
			return urlencode($key).'=' . urlencode($val);
		  },
		  array_keys($search_data), $search_data)
		);
		//Pagination starts
		$total_rows = $this->employers_model->search_record_count('tbl_employers',$search_data);
		$config = pagination_configuration_search(base_url("admin/employers/search/?".$url_params), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = $this->input->get('per_page');
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		$data["total_rows"] = $total_rows;
		//Pagination ends
		$obj_result = $this->employers_model->search_all_employers($config["per_page"], $page, $search_data, $wild_card);
		$data['result'] = $obj_result;
		$data['search_data'] = $search_data;
		
		$this->load->view('admin/employers_view', $data);
		return;
	}
	
	public function check_email_address(){
		$email = $this->input->post('email');
		$id = $this->input->post('id');
		$rcd = $this->employers_model->is_email_already_exists($id, $email);
		echo $rcd;
		exit;	
	}
	
	public function login($id){
			if($id==''){
				redirect(base_url('admin/employers'),'');
				exit;
			}
			
			$userRow = $this->employers_model->get_employer_by_id($id);
			if(!$userRow){
				redirect(base_url('admin/employers'),'');
				exit;
			}
			
			$user_data = array(
				'user_id' => $userRow->ID,
				 'user_email' => $userRow->email,
				 'first_name' => $userRow->first_name,
				 'slug' => $userRow->company_slug,
				 'is_user_login' => TRUE,
				 'is_user_login' => TRUE,
				 'is_job_seeker' => FALSE,
				 'is_employer' => TRUE
				 );
			$this->session->set_userdata($user_data);
			redirect(base_url('employer/dashboard'));
	}
}