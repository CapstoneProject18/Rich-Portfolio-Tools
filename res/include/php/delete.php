<?php
	
	include("session.php");
	
	header("Content-type: application/html");
	
	if($_POST && is_numeric($_POST['item'])) {
		
		$response = '';
		
		if($_SESSION["resume"]->step==2) {
			
			$_SESSION["resume"]->education->delete_item($_POST['item']);
			
			if($_SESSION["resume"]->count_items($_SESSION["resume"]->education->active, $_SESSION["resume"]->education->counter) > 0) {
				
				$response .= '<h3><b>LIST OF EDUCATION</b></h3>';
				
				for($i = 0;$i < $_SESSION["resume"]->education->counter;$i++) {
					
					$counter=1;
					
					if($_SESSION["resume"]->education->active[$i]) {
						
						$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->education->school[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->education->studies[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->education->graduation[$i]).'</div><div class="columnclear"></div></div>';
						
					}
					
				}
				
			}
			
		}
		else {
			
			if($_SESSION["resume"]->step == 3) {
				
				$_SESSION["resume"]->experience->delete_item($_POST['item']);
				
				if($_SESSION["resume"]->count_items($_SESSION["resume"]->experience->active, $_SESSION["resume"]->experience->counter) > 0) {
					
					$response .= '<h3><b>LIST OF WORK EXPERIENCE</b></h3>';
					
					for($i = 0;$i < $_SESSION["resume"]->experience->counter;$i++) {
						
						$counter = 1;
						
						if($_SESSION["resume"]->experience->active[$i]) {
							
							$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->experience->company[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->title[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->date[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->reason[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->experience->duties[$i]).'</div><div class="columnclear"></div></div>';
							
						}
						
					}
					
				}
				
			}
			else {
				
				if($_SESSION["resume"]->step == 4) {
					
					$_SESSION["resume"]->references->delete_item($_POST['item']);
					
					if($_SESSION["resume"]->count_items($_SESSION["resume"]->references->active, $_SESSION["resume"]->references->counter) > 0) {
						
						$response .= '<h3><b>LIST OF REFERENCES</b></h3>';
						
						for($i = 0;$i < $_SESSION["resume"]->references->counter;$i++) {
							
							$counter=1;
							
							if($_SESSION["resume"]->references->active[$i]) {
								
								$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->references->name[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->company[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->title[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->department[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->address[$i]).'</div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->references->phone[$i]).'</div><div class="columnclear"></div></div>';
								
							}
							
						}
						
					}
					
				}
				else {
					
					$_SESSION["resume"]->extras->delete_item($_POST['item']);
					
					if($_SESSION["resume"]->count_items($_SESSION["resume"]->extras->active, $_SESSION["resume"]->extras->counter) > 0) {
						
						$response .= '<h3><b>LIST OF EXTRA SECTIONS</b></h3>';
						
						for($i = 0;$i < $_SESSION["resume"]->extras->counter;$i++) {
							
							$counter=1;
							
							if($_SESSION["resume"]->extras->active[$i]) {
								
								$response .= '<div class="items"><div class="columnleft"><div class="divisor1"></div><div class="divisor1"></div><div id="val'.$i.'_'.$counter++.'">'.htmlentities($_SESSION["resume"]->extras->title[$i]).'</div></div><div id="edit" class="columnright"><img src="images/delete.gif" height="20" width="20" title="delete" lang="'.$i.'" class="columnright link" /><img src="images/edit.gif" height="20" width="20" title="edit" lang="'.$i.'" class="columnright link" /></div><div id="val'.$i.'_'.$counter++.'" class="hide">'.htmlentities($_SESSION["resume"]->extras->content[$i]).'</div><div class="columnclear"></div></div>';
								
							}
							
						}
						
					}
					
				}
				
			}
			
		}
		
		if($response != '') {$response .= '<h3><div class="divisor5"></div></h3><div class="divisor50"></div><div class="divisor20"></div>';}
		
		echo $response;
		
	}
	else{echo 'window.location="../../";';}
	
?>