<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array(
    'class' => 'Jobseeker_Login_Hook',
    'function' => 'validate_jobseeker_login',
    'filename' => 'jobseeker_login_hook.php',
    'filepath' => 'hooks'
);
$hook['post_controller_constructor'][] = array(
    'class' => 'Employer_Login_Hook',
    'function' => 'validate_employer_login',
    'filename' => 'employer_login_hook.php',
    'filepath' => 'hooks'
);
$hook['post_controller_constructor'][] = array(
    'class' => 'Admin_Login_Hook',
    'function' => 'validate_admin_login',
    'filename' => 'admin_login_hook.php',
    'filepath' => 'hooks'
);
/* End of file hooks.php */
/* Location: ./application/config/hooks.php */