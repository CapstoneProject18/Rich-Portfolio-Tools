<?php

class References
{
	
	public $counter;
	public $name;
	public $company;
	public $title;
	public $department;
	public $address;
	public $phone;
	public $active;
	
	public function __construct() {$this->counter = 0;}
	
	public function add_item($_name, $_company, $_title, $_department, $_address, $_phone) {
		
		$this->name[$this->counter] = $_name;
		$this->company[$this->counter] = $_company;
		$this->title[$this->counter] = $_title;
		$this->department[$this->counter] = $_department;
		$this->address[$this->counter] = $_address;
		$this->phone[$this->counter] = $_phone;
		$this->active[$this->counter] = 1;
		$this->counter++;
		
	}
	
	public function update_item($_id, $_name, $_company, $_title, $_department, $_address, $_phone) {
		
		$this->name[$_id] = $_name;
		$this->company[$_id] = $_company;
		$this->title[$_id] = $_title;
		$this->department[$_id] = $_department;
		$this->address[$_id] = $_address;
		$this->phone[$_id] = $_phone;
		
	}
	
	public function delete_item($_id) {$this->active[$_id] = 0;}
	
}