<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Skills extends CI_Controller {
	public function index(){
		$data['title'] = SITE_NAME.': Manage Skills';
		$data['msg'] = '';
		$obj_seeker_keywords =  $this->jobseeker_skills_model->get_all_grouped_skills();
		$obj_result = $this->skill_model->get_all_records();
		$already_array=array();
		$array_with_counter=array();
		foreach($obj_result as $key => $row_already){
			$total_skill_counter = $this->jobseeker_skills_model->count_jobseeker_skills_by_skill_name($row_already->skill_name);
			$array_with_counter[$key] = array('ID' => $row_already->ID,'skill_name' => $row_already->skill_name,'industry_ID' => $row_already->industry_ID,'counter' => $total_skill_counter);
			array_push($already_array,$row_already->skill_name);
		}
		$skills_array = array();
		foreach($obj_seeker_keywords as $row_key){
				if($row_key){
						$single_skill  = strip_tags(trim($row_key->skill_name));
						if($single_skill!=''){
							if(!in_array($single_skill, $already_array)){							
								//array_push($skills_array,trim($single_skill));
								$skills_array[$single_skill] = $row_key->total_times;
							}
						}
				}
		}
	
		//$skills_array = array_count_values(array_map('strtolower', $skills_array));
		arsort($skills_array);
		
		$data['result'] = array_to_object($array_with_counter);
		$data['keywords_result'] = $skills_array;
		$data['total_skills'] = count($skills_array);
		$this->load->view('admin/skills_view', $data);
		return;
	}
	
	public function get_skill_by_id($id=''){
		if($id!=''){
			$row = $this->skill_model->get_record_by_id($id);
			$json_data = json_encode($row);
			echo $json_data;
			exit;
		}
		return;
	}
	
	public function view($id=''){
		if($id!=''){
			$row = $this->skill_model->get_record_by_id($id);
			echo '<title>Email Template Preview</title>
			';
			echo $row['content'];
			exit;
		}
		return;
	}
	
	public function update(){
		
		$id = $this->input->post('sid');
		if($id==''){
			redirect(base_url().'admin/skills','');
			exit;
		}
		
		$data['title'] = SITE_NAME.': Edit Skill';
		$data['msg'] = '';
		
		$this->form_validation->set_rules('skill_name', 'Skill', 'trim|required');
		$this->form_validation->set_rules('blend_to', 'blend_to', 'trim');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span>');
		
		if ($this->form_validation->run() === FALSE) {
			$this->index();
			return;
		}
		
		$row_actual = $this->skill_model->get_record_by_id($id);
		if($this->input->post('blend_to')!=''){
			$this->jobseeker_skills_model->update_skill_frequency($row_actual['skill_name'], $this->input->post('blend_to'));
			$this->skill_model->delete($id);
			$this->session->set_flashdata('update_action', true);
			redirect(base_url('admin/skills'));
			return;
		}
		
		$data_array = array(
							'skill_name' => $this->input->post('skill_name')
		);
		$this->skill_model->update($id, $data_array);
		$this->jobseeker_skills_model->update_skill_frequency($row_actual['skill_name'], $this->input->post('skill_name'));
		$this->session->set_flashdata('update_action', true);
		redirect(base_url('admin/skills'));
		return;
	}
	
	public function delete($id=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		
		$this->skill_model->delete($id);
		echo 'done';
		exit;
	}
	
	public function update_skill_frequency(){
		$this->form_validation->set_rules('original_skill', 'actuall skill', 'trim|required');
		$this->form_validation->set_rules('new_skill', 'new skill', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo "actuall or new skill value is missing.";
			exit;
		}
		$original_skill = $this->input->post('original_skill');
		$new_skill = $this->input->post('new_skill');
		$this->jobseeker_skills_model->update_skill_frequency($original_skill, $new_skill);
		echo 'done';
		
	}
	
	public function add_skill_frequency(){
		$this->form_validation->set_rules('new_skill', 'new skill', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo "new skill value is missing.";
			exit;
		}
		$this->skill_model->add(array('skill_name'=>$this->input->post('new_skill')));
		
	}
	
	public function add(){
		$this->form_validation->set_rules('add_skill_name', 'new skill', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			echo "new skill value is missing.";
			exit;
		}
		$this->skill_model->add(array('skill_name'=>$this->input->post('add_skill_name')));
		redirect(base_url('admin/skills'));
		return;
	}
	
	public function load_ajax(){
		$data['title'] = SITE_NAME.': Manage Skills';
		$data['msg'] = '';
		$obj_seeker_keywords =  $this->jobseeker_skills_model->get_all_grouped_skills_by_limit($this->input->post('end'),$this->input->post('start'));
		$obj_result = $this->skill_model->get_all_records();
		$already_array=array();
		$array_with_counter=array();
		foreach($obj_result as $key => $row_already){
			$total_skill_counter = $this->jobseeker_skills_model->count_jobseeker_skills_by_skill_name($row_already->skill_name);
			$array_with_counter[$key] = array('ID' => $row_already->ID,'skill_name' => $row_already->skill_name,'industry_ID' => $row_already->industry_ID,'counter' => $total_skill_counter);
			array_push($already_array,$row_already->skill_name);
		}
		$skills_array = array();
		$skills_array2 = array();
		$itt='';
		$i=0;
		foreach($obj_seeker_keywords as $row_key){
				if($row_key){
						$single_skill  = strip_tags(trim($row_key->skill_name));
						if($single_skill!=''){
							if(!in_array($single_skill, $already_array)){		
							   $i++;	
							   $skill_with_quotes = "'".$single_skill."'";
							   $itt.= '<tr id="r_'.$i.'">
								<td width="200">
								'.$this->get_skills_dropdown($i).'
								</td>
								<td width="200">
								'.$single_skill.' ( '.$row_key->total_times.' )
								 </td>
								 <td width="100">
								  <a href="javascript:;" onClick="update_skill_frequency('.$i.','.$skill_with_quotes.');" class="btn btn-primary btn-xs">Update</a>&nbsp;<a href="javascript:;" onClick="add_skill_frequency('.$i.','.$skill_with_quotes.');" class="btn btn-primary btn-xs">Add</a>
								 </td>
							  </tr>';	
							}
						}
				}
		}
		echo $itt;
	}
	
	public function get_skills_dropdown($i){
		$obj_result = $this->skill_model->get_all_records();
		$options = '';
		$pre = '<select name="main_skills_'.$i.'" id="main_skills_'.$i.'">
                  <option value="" selected>-  - Skills - -</option>';
				  
				  foreach($obj_result as $row){
                  	$options.= '<option value="'.$row->skill_name.'">'.$row->skill_name.'</option>';
				  }
               $post ='</select>';
	    return $pre.$options.$post;
	}
}