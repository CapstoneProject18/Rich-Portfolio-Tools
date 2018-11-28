<?php

class Experience
{
	
	public $counter;
	public $company;
	public $title;
	public $date;
	public $duties;
	public $reason;
	public $active;
	
	public function __construct() {$this->counter = 0;}
	
	public function add_item($_company,$_title,$_date,$_duties,$_reason) {
		
		$this->company[$this->counter] = $_company;
		$this->title[$this->counter] = $_title;
		$this->date[$this->counter] = $_date;
		$this->duties[$this->counter] = $_duties;
		$this->reason[$this->counter] = $_reason;
		$this->active[$this->counter] = 1;
		$this->counter++;
		
	}
	
	public function update_item($_id, $_company, $_title, $_date, $_duties, $_reason) {
		
		$this->company[$_id] = $_company;
		$this->title[$_id] = $_title;
		$this->date[$_id] = $_date;
		$this->duties[$_id] = $_duties;
		$this->reason[$_id] = $_reason;
		
	}
	
	public function delete_item($_id) {$this->active[$_id] = 0;}
	
}