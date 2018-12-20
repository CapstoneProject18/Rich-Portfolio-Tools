<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Verification extends CI_Controller {
	public function index()
	{
		$data['title'] = 'Thank you for the registration';
	
		$this->load->view('thanks_view',$data);
	}
}
