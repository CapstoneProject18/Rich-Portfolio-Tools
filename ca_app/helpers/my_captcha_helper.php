<?php
if (!function_exists('create_ml_captcha')) {
    function create_ml_captcha() {
        $CI = & get_instance();
        $img = NULL;
        $strng = NULL;
        $imgs = array("_Ml__c--ImG__e_.jpg", "_Ml__c--ImG__g_.jpg", "_Ml__c--ImG__i_.jpg", "_Ml__c--ImG__k_.jpg", "_Ml__c--ImG__m_.jpg");
        $strngs = array("G7K5", "T9L4", "X3FD", "N2W5", "B4W8");
        $rand_key = rand(0, 4);
        $img = $imgs[$rand_key];
        $CI->session->set_userdata('cptcode', $strngs[$rand_key]);
        $path = base_url() . 'public/captcha/cpt___m_L_images---u____/';
        $img_path = $path . '/' . $img;
        return '<img src="' . $img_path . '" />';
    }
}
if (!function_exists('eventtime')) {
    function eventtime($etime, $elength) {
        $curr_time = date('H:i:s');
        $event_time = $etime;
        $event_length = $elength;
        $timestamp = strtotime("$event_time");
        $etime = strtotime("+$event_length minutes", $timestamp);
        $next_time = date('H:i:s', $etime);
        $next_time;
        if ($curr_time > $next_time)
            return "true";
        else
            return "false";
    }
}
?>