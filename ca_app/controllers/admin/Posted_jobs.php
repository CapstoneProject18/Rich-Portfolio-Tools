<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posted_Jobs extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Posted Jobs';
		$data['msg'] = '';
		
		//Pagination starts
		$total_rows = $this->posted_jobs_model->record_count('tbl_post_jobs');
		$config = pagination_configuration(base_url("admin/posted_jobs"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->posted_jobs_model->get_all_posted_jobs($config["per_page"], $page);
		
		//$this->output->enable_profiler(TRUE);
		//$sections = array( 'config'  => false, 'queries' => TRUE);
		//$this->output->set_profiler_sections($sections);
		
		$data['result'] = $obj_result;
		$this->load->view('admin/posted_jobs_view', $data);
		return;
	}
	
	public function details($id=''){
		
		if($id==''){
			redirect(base_url().'admin/posted_jobs','');
			exit;
		}
		$data['title'] = SITE_NAME.': Posted Job Details';
		$data['msg'] = '';
		$obj_row = $this->posted_jobs_model->get_posted_job_by_id($id);
		$data['row'] = $obj_row;
		$this->load->view('admin/posted_job_details_view', $data);
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
		if($current_staus=='pending'){
			$this->job_activation_email_to_employer($id);
		}
		
		if($current_staus=='active')
			$new_status= 'blocked';
		else
			$new_status= 'active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->posted_jobs_model->update_posted_job($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function featured_status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid current status provided.';
			exit;
		}
		
		if($current_staus=='yes')
			$new_status= 'no';
		else
			$new_status= 'yes';
		
		$data = array (
						'is_featured' => $new_status
		);
		
		$this->posted_jobs_model->update_posted_job($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete_posted_job($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$obj_row = $this->posted_jobs_model->get_posted_job_by_id($id);
		$this->posted_jobs_model->delete_posted_job($obj_row->ID);
		$this->applied_jobs_model->delete_applied_job_by_posted_job_id($obj_row->ID);
		echo 'done';
		exit;
	}
	
	public function search($search_title='te_', $search_company='co_', $search_city='ct_', $search_featured='fe_', $search_sts='st_'){
		$data['title'] = SITE_NAME.': Manage Posted Jobs';
		$data['msg'] = '';
		$this->form_validation->set_rules('search_title', 'search_title', 'trim');
		$this->form_validation->set_rules('search_company', 'search_company', 'trim');	
		$this->form_validation->set_rules('search_city', 'search_city', 'trim');
		$this->form_validation->set_rules('search_featured', 'search_featured', 'trim');
		$this->form_validation->set_rules('search_sts', 'search_sts', 'trim');
		$this->form_validation->run();
		
		if ($_POST){
			$search_title 		= 	'te_'.$this->input->post('search_title');
			$search_company 	= 	'co_'.$this->input->post('search_company');
			$search_city 		= 	'ct_'.$this->input->post('search_city');
			$search_featured 	= 	'fe_'.$this->input->post('search_featured');
			$search_sts 		= 	'st_'.$this->input->post('search_sts');
		}
		if($search_title=='te_' && $search_company=='co_' && $search_city=='ct_' && $search_featured=='fe_' && $search_sts=='st_'){
			redirect(base_url('admin/posted_jobs'));
			return;
		}
		$new_array = array();
		
		$new_array = params_to_array_posted_jobs($search_title, $search_company, $search_city, $search_featured, $search_sts);
		
		
		$search_data = array_key_changer_posted_jobs($new_array);
		
		$making_url = '';
		$segment = 4;
		if($search_title!='te_'){
			$making_url = $search_title.'/';
		}
		if($search_company!='co_'){
			$making_url .= $search_company.'/';
			$segment++;
		}
		if($search_city!='ct_'){
			$making_url .= $search_city.'/';
			$segment++;
		}
		if($search_featured!='fe_'){
			$making_url .= $search_featured.'/';
			$segment++;
		}
		if($search_sts!='st_'){
			$making_url .= $search_sts.'/';
			$segment++;
		}
		//Pagination starts
		$total_rows = $this->posted_jobs_model->search_record_count($search_data);
		$config = pagination_configuration_search(base_url("admin/posted_jobs/search/".$making_url.'/?'), $total_rows, 50, $segment, 5, true);
		
		$this->pagination->initialize($config);
        $page = $this->input->get('per_page');
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		$obj_result = $this->posted_jobs_model->search_all_posted_jobs($config["per_page"], $page, $search_data);
		$data['result'] = $obj_result;
		$data['search_data'] = $search_data;
		
		if ($_POST)
			redirect(base_url('admin/posted_jobs/search/'.$making_url));
		else
			$this->load->view('admin/posted_jobs_view', $data);
		return;
	}
	
	public function jobs_by_company($employer_id=''){
		
		$data['title'] = SITE_NAME.': Manage Posted Jobs';
		$data['msg'] = '';
		
		if($employer_id==''){
			redirect(base_url().'admin/posted_jobs','');
			exit;
		}
		
		//Pagination starts
		$total_rows = $this->posted_jobs_model->count_records('tbl_post_jobs','employer_ID',$employer_id);
		$config = pagination_configuration(base_url("admin/posted_jobs/jobs_by_company/"), $total_rows, 50, 3, 5, true);
		
		$this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$page_num = $page-1;
		$page_num = ($page_num<0)?'0':$page_num;
		$page = $page_num*$config["per_page"];
		$data["links"] = $this->pagination->create_links();
		//Pagination ends
		
		$obj_result = $this->posted_jobs_model->get_posted_job_by_employer_ID($employer_id, $config["per_page"], $page);
		
		//$this->output->enable_profiler(TRUE);
		//$sections = array( 'config'  => false, 'queries' => TRUE);
		//$this->output->set_profiler_sections($sections);
		
		$data['result'] = $obj_result;
		$this->load->view('admin/posted_jobs_by_company_view', $data);
		return;
	}
	
	public function latest_job_by_company($employer_id=''){
		if($employer_id==''){
			echo "Wrong company ID provided.";
			exit;
		}
		$obj_result = $this->posted_jobs_model->get_posted_job_by_employer_ID($employer_id, 1, 0);
		$row= $obj_result[0];
		if($row)
			echo json_encode($row);
		else{
			echo json_encode(array("err" => "No job posted yet!"));
		}
		exit;
	}
	
	public function job_by_id($job_id=''){
		if($job_id==''){
			echo "Wrong job ID provided.";
			exit;
		}
		$obj_row = $this->posted_jobs_model->get_posted_job_by_id($job_id);
		if($obj_row)
			echo json_encode($obj_row);
		else{
			echo json_encode(array("err" => "No job found!"));
		}
		exit;
	}
	
	public function job_activation_email_to_employer($job_id){
		
		$row = $this->posted_jobs_model->get_posted_job_by_job_id($job_id);
		//$this->job_alert_model->add(array('job_ID' => $job_id, 'dated' => $current_date_time));
		
		//Sending job activation email to the employer
		$row_email = $this->email_model->get_records_by_id(6);
		$email_subject = replace_string('{JOB_TITLE}',$row->job_title,$row_email->subject);
		
		$config = $this->email_drafts_model->email_configuration();
		$this->email->initialize($config);
		$this->email->clear(TRUE);
		$this->email->from($row_email->from_email, $row_email->from_name);
		$this->email->to($row->email);
		$mail_message = $this->email_drafts_model->job_activation_email($row_email->content, $row);
		$this->email->subject($email_subject);
		$this->email->message($mail_message);
		$this->email->send();
	}
}