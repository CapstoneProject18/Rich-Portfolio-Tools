<?php

class Resume
{
	
	public $step;
	public $name;
	public $phone;
	public $fax;
	public $email;
	public $address;
	public $objective;
	public $profile;
	public $qualifications;
	public $skills;
	public $education;
	public $experience;
	public $references;
	public $extras;
	
	public function __construct() {
		
		$this->education = new Education();
		$this->experience = new Experience();
		$this->references = new References();
		$this->extras = new Extras();
		$this->step = 1;
		
	}
	
	public function count_items($_items, $_limit) {
		
		$aux = 0;
		
		for($i = 0;$i < $_limit;$i++) {
			if($_items[$i]){$aux++;}
		}
		
		return $aux;
		
	}
	
}