<?php

class Education
{
	
	public $counter;
	public $school;
	public $studies;
	public $graduation;
	public $active;
	
	public function __construct() {$this->counter = 0;}
	
	public function add_item($_school, $_studies, $_graduation) {
		
		$this->school[$this->counter] = $_school;
		$this->studies[$this->counter] = $_studies;
		$this->graduation[$this->counter] = $_graduation;
		$this->active[$this->counter] = 1;
		$this->counter++;
		
	}
	
	public function update_item($_id, $_school, $_studies, $_graduation) {
		
		$this->school[$_id] = $_school;
		$this->studies[$_id] = $_studies;
		$this->graduation[$_id] = $_graduation;
		
	}
	
	public function delete_item($_id) {$this->active[$_id] = 0;}
	
}