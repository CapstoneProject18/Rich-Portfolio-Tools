<?php
	
	include("session.php");
	
	header("Content-type: application/html");
	
	if($_POST && is_numeric($_POST['item'])) {
		
		if($_SESSION["resume"]->step==2) {
			
			$school = trim(strip_tags($_POST['school_upd']));
			$studies = trim(strip_tags($_POST['studies_upd']));
			$graduation = trim(strip_tags($_POST['graduation_upd']));
			
			if($school == '') {$school = 'The school name goes here';}
			if($studies == '') {$studies = 'The studies go here';}
			
			$_SESSION["resume"]->education->update_item($_POST['item'], $school, $studies, $graduation);
			
			$response = '<h3><b>LIST OF EDUCATION</b></h3>';
			
			for($i = 0;$i < $_SESSION["resume"]->education->counter;$i++) {
				
				$counter=1;
				
				if($_SESSION["resume"]->education->active[$i]) {
					
					$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->education->school[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->education->studies[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->education->graduation[$i]).'</div><div class="columnclear"></div></div>';
					
				}
				
			}
			
		}
		else {
			
			if($_SESSION["resume"]->step == 3) {
				
				$company = trim(strip_tags($_POST['company_upd']));
				$title = trim(strip_tags($_POST['title_upd']));
				$date = trim(strip_tags($_POST['date_upd']));
				$reason = trim(strip_tags($_POST['reason_upd']));
				$duties = trim(strip_tags($_POST['duties_upd']));
				
				if($company == '') {$company = 'The company name goes here';}
				if($title == '') {$title = 'The title goes here';}
				if($date == '') {$date = 'The date goes here';}
				if($duties == '') {$duties = 'The duties go here';}
				
				$_SESSION["resume"]->experience->update_item($_POST['item'], $company, $title, $date, $duties, $reason);
				
				$response = '<h3><b>LIST OF WORK EXPERIENCE</b></h3>';
				
				for($i = 0;$i < $_SESSION["resume"]->experience->counter;$i++) {
					
					$counter = 1;
					
					if($_SESSION["resume"]->experience->active[$i]) {
						
						$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->experience->company[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->title[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->date[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->reason[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->duties[$i]).'</div><div class="columnclear"></div></div>';
						
					}
					
				}
				
			}
			else {
				
				if($_SESSION["resume"]->step == 4) {
					
					$name = trim(strip_tags($_POST['name_upd']));
					$company = trim(strip_tags($_POST['company_upd']));
					$title = trim(strip_tags($_POST['title_upd']));
					$department = trim(strip_tags($_POST['department_upd']));
					$address = trim(strip_tags($_POST['address_upd']));
					$phone = trim(strip_tags($_POST['phone_upd']));
					
					if($name == '') {$name = 'The name goes here';}
					if($phone == '') {$phone = 'The phone goes here';}
					
					$_SESSION["resume"]->references->update_item($_POST['item'], $name, $company, $title, $department, $address, $phone);
					
					$response = '<h3><b>LIST OF REFERENCES</b></h3>';
					
					for($i = 0;$i < $_SESSION["resume"]->references->counter;$i++) {
						
						$counter=1;
						
						if($_SESSION["resume"]->references->active[$i]) {
							
							$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->references->name[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->company[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->title[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->department[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->address[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->phone[$i]).'</div><div class="columnclear"></div></div>';
							
						}
						
					}
					
				}
				else {
					
					$title = trim(strip_tags($_POST['title_upd']));
					$content = trim(strip_tags($_POST['content_upd']));
					
					if($title == '') {$title = 'The extra section title goes here';}
					if($content=='') {$content = 'The extra section content goes here';}
					
					$_SESSION["resume"]->extras->update_item($_POST['item'], $title, $content);
					
					$response = '<h3><b>LIST OF EXTRA SECTIONS</b></h3>';
					
					for($i = 0;$i < $_SESSION["resume"]->extras->counter;$i++) {
						
						$counter=1;
						
						if($_SESSION["resume"]->extras->active[$i]) {
							
							$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->extras->title[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->extras->content[$i]).'</div><div class="columnclear"></div></div>';
							
						}
						
					}
					
				}
				
			}
			
		}
		
		$response .= '<h3><div class="divisor5"></div></h3><div class="divisor50"></div><div class="divisor20"></div>';
		
		echo $response;
		
	}
	else{echo 'window.location="../../";';}
	
?>