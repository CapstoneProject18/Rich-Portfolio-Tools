<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Indeed_jobs extends CI_Controller {
	var $client ='';
	public function __construct(){
        parent::__construct();
		$this->ads = '';
		$this->ads = $this->ads_model->get_ads();
		$indeed_key = array(INDEED_KEY);
	    $this->load->library('indeed', $indeed_key);
    }
	
	public function index()
	{
		$q = $this->input->get('q');
		$l= $this->input->get('l');
		$co=$this->input->get('co');
		$data['ads_row'] = $this->ads;
		$result_set='';
		$param = $q;
		if($q!='' && $l!='')
		{
			$result_set = $this->get_jobs($q,$l,$co);
		}
		
		$data['title'] = $param.' Jobs';
		$data['result']=@$result_set['results'];
		$data['param']=$param;
		$this->load->view('indeed_jobs_view',$data);
	}
	
	private function get_jobs($q='',$l='', $co='US')
	{
		$params = array(
    		"q" => $q,
    		"l" => $l,
			"limit"=>'20',
			"highlight"=>1,
			"co" => $co,
    		"userip" => $this->input->ip_address(),
    		"useragent" => $this->agent->agent_string()
		);
	
	//print_array($params);
	//exit;
		$results = $this->indeed->search($params);
		return $results;	
	}
}
