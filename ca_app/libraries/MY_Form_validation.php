<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {
	/*public function __construct() {
        $ci = & get_instance();
        parent::__construct();
        log_message('debug', 'MY_Form_validation loaded');
    }*/
	
    public function valid_url($str){
            if(filter_var($str, FILTER_VALIDATE_URL)){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
	
	public function validate_ml_spam($captcha) {
        $CI = & get_instance();
        $CI->form_validation->set_message('validate_ml_spam', 'Invalid Verification Code Entered.');
        $spam_validation = true;
        $post_captcha_value = $captcha;
        $original_captcha_value = $CI->session->userdata('cptcode');
        if (strtolower($post_captcha_value) != strtolower($original_captcha_value)) {
            $CI->session->userdata['cptcode'] = 'ans951753qwerttyhdehb15hdtyhjk95412ytfvyhbhsqwertty1485';
            $spam_validation = false;
        }
        return $spam_validation;
    }
    public function time_diff($str) {
        $CI = & get_instance();
        $CI->form_validation->set_message('time_diff', 'Cant send mail too frequently.');
        $spam_validation = true;
        $timestm = $CI->session->userdata('timestm');
        if (isset($timestm) && !empty($timestm)) {
            $mailtime = eventtime($CI->session->userdata('timestm'), 5);
            //echo $mailtime ;exit;
            if ($mailtime == 'false') {
                $spam_validation = false;
            }
        }
        return $spam_validation;
    }
    public function file_required($str) {
        if (!is_array($str)) {
            return (trim($_FILE[$str]) == '') ? FALSE : TRUE;
        } else {
            return (!empty($_FILE[$str]));
        }
    }
	
	public function secure($str) {
        $CI = & get_instance();
		$prohibited_keywords = $CI->prohibited_keywords_model->get_all_records();
        $validation = true;
        foreach ($prohibited_keywords as $prohibited_keyword) {
			$kw = $prohibited_keyword->keyword;
            $kw1 = "/" . $kw . "/i";
            if (preg_match($kw1, $str)) {
				$validation = false;
				break;
            }
        }		
		$CI->form_validation->set_message('secure', '"'.$kw.'" can\'t be used');
        return $validation;				
    }
	
	public function strip_all_tags($str) {
        $newstr = strip_tags($str);
        return $newstr;				
    }
	
	public function secure_banned($str) {
        $CI = & get_instance();
        $CI->form_validation->set_message('secure_banned', 'Invalid data');
		$banned_keywords = $CI->banned_keywords_model->get_keywords();
        $validation = true;
        foreach ($banned_keywords as $banned_keyword) {
			$kw = $banned_keyword->keyword;
            $kw1 = "/" . $kw . "/i";
            if (preg_match($kw1, $str)) {
				
				$replace_with = '<span style="text-decoration:underline; font-weight:bold;">'.$kw.'</span>';
				$str = str_replace($kw, $replace_with, $str);
				
				$user_name = $CI->session->userdata('member_user_name');
				$full_name = $CI->session->userdata('member_first_name');
				
				if($user_name != ''){
					$config = array();
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
		
					$CI->email->initialize($config);
		
					$CI->email->from('pr@pkmotors.com', 'Banned Keyword');
					$CI->email->reply_to('pr@pkmotors.com', 'Banned Keyword');
					$CI->email->to('pr@pkmotors.com');
					$CI->email->subject('Banned keyword ("'.$kw.'") used at pkmotors.com');
		
					$mail_message = $CI->email_drafts_model->get_banned_keyword_draft($full_name, $user_name, $str);
					$CI->email->message($mail_message);
					$CI->email->send();
					
					$member_id = $CI->member_model->get_member_id_by_user_name($user_name);
					$CI->member_model->block_registered_user($member_id, 1, 2);
				}
                $validation = false;
				break;
            }
        }
        return $validation;
    }
	
	public function phone($str) {
        $CI = & get_instance();
        if ($str == '( XXX )XXX XXXX' or $str == '') {
            $CI->form_validation->set_message('phone', '%s is required');
            return FALSE;
        } else {
            return TRUE;
        }
    }
} 