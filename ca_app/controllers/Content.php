<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
    }
	
	public function index($page_slug=''){
		$data['ads_row'] = $this->ads;
		if($page_slug!=''){
			$row = $this->cms_model->get_cms_by_slug($page_slug);
			
			if(!$row){
				$this->load->view('404_view', $data);
				return;	
			}
			
			$data['title'] = $row->seoMetaTitle;
			$data['meta_keyword'] = $row->seoMetaKeyword;
			$data['meta_description'] = $row->seoMetaDescription;
			//$data['title'] = $row->heading;
			$data['row'] = $row;
			$this->load->view('content_view', $data);
			return;
		}
		redirect(base_url());
	}
}