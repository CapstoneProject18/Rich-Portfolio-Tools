<?php

class Extras
{
	
	public $counter;
	public $title;
	public $content;
	public $active;
	
	public function __construct() {$this->counter = 0;}
	
	public function add_item($_title, $_content) {
		
		$this->title[$this->counter] = $_title;
		$this->content[$this->counter] = $_content;
		$this->active[$this->counter] = 1;
		$this->counter++;
		
	}
	
	public function update_item($_id, $_title, $_content) {
		
		$this->title[$_id] = $_title;
		$this->content[$_id] = $_content;
		
	}
	
	public function delete_item($_id) {$this->active[$_id] = 0;}
	
}