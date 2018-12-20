<?php
class Cap_model extends CI_Model {
    public function __construct() {
	   $this->load->database();
    }
    
	public function generate_captcha()
	{
		$random_number = generate_random_characters(5);
		
		$vals = array(
        'word'          => $random_number,
        'img_path'      => './public/images/captcha/',
        'img_url'       => base_url().'public/images/captcha/',
        'font_path'     => './public/fonts/dax_medium-webfont.ttf',
        'img_width'     => '120',
        'img_height'    => 40,
        'expiration'    => 2300,
        'word_length'   => 5,
        'font_size'     => 18,
        'img_id'        => rand(time(),5),
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(27, 166, 223),
                'border' => array(27, 166, 223),
                'text' => array(0, 0, 0),
                'grid' => array(255, 255, 255)
        )		
		);
		
		$cap = create_captcha($vals);
		$this->session->set_userdata('capWord',$cap['word']);
		return $cap;
	}
	
	
	
}
?>
