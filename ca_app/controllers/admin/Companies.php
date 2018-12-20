<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Companies extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Companies';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->companies_model->record_count('tbl_companies');
		$config = pagination_configuration(base_url("admin/companies"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->companies_model->get_all_companies($config["per_page"], $page);
		$data['result'] = $obj_result;
		$this->load->view('admin/companies_view', $data);
		return;
	}
		
	public function update($emp_id, $comp_id=''){
			
		if($emp_id=='' || $comp_id==''){
			redirect(base_url().'admin/employers','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Employer Details';
		$data['msg'] = '';
			
		$this->form_validation->set_rules('company_name', 'Company name', 'trim|required');
		$this->form_validation->set_rules('industry_ID', 'Industry ID', 'trim|required');
		$this->form_validation->set_rules('company_phone', 'Company phone', 'trim|required');
		$this->form_validation->set_rules('company_location', 'Company location', 'trim|required');
		$this->form_validation->set_rules('company_website', 'Company website URL', 'trim|required|valid_url');
		
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		$this->form_validation->set_message('required', '%s field is required.');
		
		$obj_row = $this->employers_model->get_employer_by_id($emp_id);
		
		if ($this->form_validation->run() === FALSE) {		
			
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
		
		
		$company_array = array(
								'company_name' => $this->input->post('company_name'),
								'industry_ID' => $this->input->post('industry_ID'),
								'company_phone' => $this->input->post('company_phone'),
								'company_location' => $this->input->post('company_location'),
								'company_website' => $this->input->post('company_website'),
								'no_of_employees' => $this->input->post('no_of_employees')
		);
		
		if (!empty($_FILES['company_logo']['name'])){
			$real_path = realpath(APPPATH . '../public/uploads/employer/');
			$config['upload_path'] = $real_path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = true;
			$config['max_size'] = 12000;
			$config['file_name'] = $comp_id.time();
			$this->upload->initialize($config);
			if ($this->upload->do_upload('company_logo')){
				if($obj_row->company_logo){
					@unlink($real_path.'/'.$obj_row->company_logo);	
					@unlink($real_path.'/thumb/'.$obj_row->company_logo);
				}
			}
			
			$image = array('upload_data' => $this->upload->data());	
			$image_name = $image['upload_data']['file_name'];
			$company_array['company_logo']=$image_name;
			$thumb_config['image_library'] = 'gd2';
			$thumb_config['source_image']	= $real_path.'/'.$image_name;
			$thumb_config['new_image']	= $real_path.'/thumb/'.$image_name;
			$thumb_config['maintain_ratio'] = TRUE;
			$thumb_config['height']	= 50;
			$thumb_config['width']	 = 70;
			
			$this->image_lib->initialize($thumb_config);
			$this->image_lib->resize();
		}
		$this->companies_model->update_company($comp_id, $company_array);
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/employers/update/'.$emp_id));
		return;
	}
	
}