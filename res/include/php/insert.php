<?php
	
	include("session.php");
	
	header("Content-type: application/html");
	
	if($_POST) {
		
		if($_SESSION["resume"]->step==2) {
			
			$school = trim(strip_tags($_POST['school']));
			$studies = trim(strip_tags($_POST['studies']));
			$graduation = trim(strip_tags($_POST['graduation']));
			
			if($school == '') {$school = 'The school name goes here';}
			if($studies == '') {$studies = 'The studies go here';}
			
			$_SESSION["resume"]->education->add_item($school, $studies, $graduation);
			
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
				
				$company = trim(strip_tags($_POST['company']));
				$title = trim(strip_tags($_POST['title']));
				$date = trim(strip_tags($_POST['date']));
				$reason = trim(strip_tags($_POST['reason']));
				$duties = trim(strip_tags($_POST['duties']));
				
				if($company == '') {$company = 'The company name goes here';}
				if($title == '') {$title = 'The title goes here';}
				if($date == '') {$date = 'The date goes here';}
				if($duties == '') {$duties = 'The duties go here';}
				
				$_SESSION["resume"]->experience->add_item($company, $title, $date, $duties, $reason);
				
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
					
					$name = trim(strip_tags($_POST['name']));
					$company = trim(strip_tags($_POST['company']));
					$title = trim(strip_tags($_POST['title']));
					$department = trim(strip_tags($_POST['department']));
					$address = trim(strip_tags($_POST['address']));
					$phone = trim(strip_tags($_POST['phone']));
					
					if($name == '') {$name = 'The name goes here';}
					if($phone == '') {$phone = 'The phone goes here';}
					
					$_SESSION["resume"]->references->add_item($name, $company, $title, $department, $address, $phone);
					
					$response = '<h3><b>LIST OF REFERENCES</b></h3>';
					
					for($i = 0;$i < $_SESSION["resume"]->references->counter;$i++) {
						
						$counter=1;
						
						if($_SESSION["resume"]->references->active[$i]) {
							
							$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->references->name[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->company[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->title[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->department[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->address[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->phone[$i]).'</div><div class="columnclear"></div></div>';
							
						}
						
					}
					
				}
				else {
					
					$title = trim(strip_tags($_POST['title']));
					$content = trim(strip_tags($_POST['content']));
					
					if($title == '') {$title = 'The extra section title goes here';}
					if($content=='') {$content = 'The extra section content goes here';}
					
					$_SESSION["resume"]->extras->add_item($title, $content);
					
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