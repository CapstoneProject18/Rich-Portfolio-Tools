<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Controller {
	
	public function index(){
		$data['title'] = SITE_NAME.': Menu Management';
		$data['msg'] = '';
		
		//All active pages
		$obj_page_result = $this->cms_model->get_all_records_by_sts('Active');
		$data['result_pages'] = $obj_page_result;

		//All Menus
		$obj_menu_result = $this->Menu_Model->get_all_records();
		$data['result_menu'] = $obj_menu_result;
		$this->load->view('admin/menu/menu_view', $data);
		return;
	}
	
	public function load_menu_pages($menu_id=''){
		if($menu_id==''){
			echo json_encode(array('msg'=>'ID is missing. Please refresh and try again.'));
			exit;	
		}
		
		//Load menu pages
		$obj_result = $this->Menu_Pages_Model->get_record_by_menu_id($menu_id);
		$html='';
		if($obj_result){
			foreach($obj_result as $row){
				$html.='<tr id="row_'.$row->pageMenuPagesID.'">
                  <td>
            <a href="javascript:;" class="pt" id="pmtitle_'.$row->pageMenuPagesID.'" data-type="text" data-send="always" data-pk="'.$row->pageMenuPagesID.'" title="Edit Display Name" data-name="pmtitle" data-url="'.base_url("admin/menu/update_page_display_name").'" data-original-title="Edit Display Name">'.$row->pageHeading.'</a>
                
                  </td>
                  <td><a href="'.base_url($row->pageSlug).'" target="_blank">View Page</a></td>
                  <td>
                   	<a href="javascript:delete_menu_page('.$row->pageMenuPagesID.');" class="label label-danger">Remove</a>
                  </td>
                </tr>';
			}
		}
		$html.='<script> //$.fn.editable.defaults.mode = "inline";
$(".pt").editable();</script>';
		
		$delete_menu_button_html = '<a href="javascript:delete_menu('.$menu_id.');" class="btn btn-danger btn-sm">Delete This Menu</a>';
		echo json_encode(array('msg'=>'done','data'=>$html, 'd_m_p'=>$delete_menu_button_html));
		exit;
	}
	
	public function update_page_display_name(){
		
		$this->form_validation->set_rules('value', 'value', 'trim');
		$this->form_validation->set_rules('pk', 'pk', 'trim');
		$this->form_validation->set_rules('name', 'name', 'trim');
		//echo $this->input->post('name');
		//echo $this->input->post('value');
		//echo $this->input->post('pk');
		
		if($this->input->post('value')!='' && $this->input->post('pk')!=''){
			$this->Menu_Pages_Model->update($this->input->post('pk'), array('pageMenuPagesTitle'=>$this->input->post('value')));
		}
		else{
			$this->output->set_status_header('406', 'Please provide valid value.');	
		}
	}
	
	
	public function add(){
		$data['title'] = SITE_NAME.': Content Management';
		$data['msg'] = '';
		$data_array = array();
		$this->form_validation->set_rules('menuName', 'menu name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="err" style="padding-left:2px;">', '</span><br />');
		
		if ($this->form_validation->run() === FALSE) {
			$form_data =$this->load->view('admin/menu/menu_add_view',$data, true);
			echo json_encode(array('msg'=>validation_errors(), 'form_data'=>$form_data));
			exit;
		}
		$data_array = array('menuName' => $this->input->post('menuName'));
		$this->Menu_Model->add($data_array);
		echo json_encode(array('msg'=>'done'));
	}
		
	public function update($id=''){}
	
	public function status($id='', $current_staus=''){
		
		if($id==''){
			echo 'error';
			exit;
		}
		if($current_staus==''){
			echo 'invalid current status provided.';
			exit;
		}
		
		if($current_staus=='Active')
			$new_status= 'Inactive';
		else
			$new_status= 'Active';
		
		$data = array (
						'sts' => $new_status
		);
		
		$this->pages_model->update($id, $data);
		echo $new_status;
		exit;
	}	
	
	public function delete($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Oops! page ID is missing. Please refresh the page and try again.'));
			exit;
		}
		
		$this->Menu_Model->delete($id);
		$this->Menu_Pages_Model->delete_by_menu_id($id);
		echo 'done';
		exit;
	}
	
	
	//Menu Pages
	public function add_menu_pages(){
		$data['msg'] = '';
		$data_array = array();
		if(!$this->input->post('pselected')){
			echo json_encode(array('msg'=>'Please select pages first.'));
			exit;
		}
		if(!$this->input->post('menu_selected_id')){
			echo json_encode(array('msg'=>'Please select menu first.'));
			exit;
		}
		
		foreach($this->input->post('pselected') as $each_page){
			$data_array = array(
								'pageID'=>$each_page,
								'pageMenuID'=>$this->input->post('menu_selected_id')
			);
			$this->Menu_Pages_Model->add($data_array);
		}
		
		echo json_encode(array('msg'=>'done'));
	}
	
	//Menu Custom Pages
	public function add_menu_custom_pages(){
		
		$this->form_validation->set_rules('value', 'value', 'trim');
		$this->form_validation->set_rules('pk', 'pk', 'trim');

		
		if($this->input->post('value')!='' && $this->input->post('pk')!=''){
			//$this->Menu_Pages_Model->update($this->input->post('pk'), array('pageMenuPagesTitle'=>$this->input->post('value')));
			$data_array = array(
								'pageID'=>0,
								'customUrl'=>$this->input->post('value'),
								'pageMenuID'=>$this->input->post('pk')
			);
			$this->Menu_Pages_Model->add($data_array);
			echo json_encode(array('msg'=>'done'));
			
		}
		else{
			$this->output->set_status_header('406', 'Please provide valid value.');	
		}
		
	}
	
	
	public function delete_menu_page($id=''){
		
		if($id==''){
			echo json_encode(array('msg'=>'Oops! Menu page ID is missing. Please refresh the page and try again.'));
			exit;
		}
		
		$obj_row = $this->Menu_Pages_Model->delete($id);
		echo 'done';
		exit;
	}
}