<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_Login_Hook {
    public function __construct() {
       
    }
    function validate_admin_login() {
        $CI 		= & get_instance();
        $folder 	= $CI->uri->segment(1);
        $controller = $CI->uri->segment(2);
        $method 	= $CI->uri->segment(3);
        if ($folder == "admin" && $controller != 'home') {
			 
				   $is_admin_login = $CI->session->userdata('is_admin_login');
				  
				   if ((bool)($is_admin_login) == FALSE) {
					
					   if($CI->uri->uri_string!='admin')
					   		$CI->session->set_userdata('back_from_admin_login', $CI->uri->uri_string);
					   redirect('admin/home', 'refresh');
				   }
		}
    }
}