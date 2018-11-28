<?php
include("include/php/session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Your Resume</title>
<link rel="stylesheet" href="include/css/_reset.css" />
<link rel="stylesheet" href="include/css/resume.css" />
</head>
<body>
	
	<h1 class="title"><?php echo $_SESSION["resume"]->name; ?></h1>
	
	<p>
		
		<?php
			
				if($_SESSION["resume"]->address != '') {echo '&nbsp'.$_SESSION["resume"]->address.'<br />';}
				
				echo '&nbsp<b>Phone:</b>&nbsp&nbsp'.$_SESSION["resume"]->phone;
				
				if($_SESSION["resume"]->fax != '') {echo '&nbsp&nbsp&nbsp<b>/</b>&nbsp&nbsp&nbsp<b>Fax:</b>&nbsp&nbsp'.$_SESSION["resume"]->fax;}
				
				echo '<br />&nbsp<b>Email:</b>&nbsp&nbsp'.$_SESSION["resume"]->email;
			
		?>
		
	</p>
	
	<div class="divider"></div>
	
	<?php
		
		if($_SESSION["resume"]->objective != '') {
			echo '<br />
					<h2>OBJECTIVE</h2>
					'.nl2br($_SESSION["resume"]->objective).'
					<br />';
		}
		
		if($_SESSION["resume"]->profile != '') {
			echo '<br />
					<h2>PROFILE</h2>
					'.nl2br($_SESSION["resume"]->profile).'
					<br />';
		}
		
		if($_SESSION["resume"]->qualifications != '') {
			
			$items=explode(chr(13), $_SESSION["resume"]->qualifications);
			
			echo '<br />
					<h2>QUALIFICATIONS</h2>
					<ul>';
			
			for($i = 0;$i < count($items);$i++) {
				$checker = trim($items[$i]);
				if($checker != '') {echo '<li>'.$checker.'</li>';}
			}
			
			echo '</ul>';
			
		}
		
		if($_SESSION["resume"]->skills != '') {
			
			$items=explode(chr(13),$_SESSION["resume"]->skills);
			
			echo '<br />
					<h2>SKILLS</h2>
					<ul>';
			
			for($i = 0;$i < count($items);$i++){
				$checker = trim($items[$i]);
				if($checker != '') {echo '<li>'.$checker.'</li>';}
			}
			
			echo '</ul>';
			
		}
		
		if($_SESSION["resume"]->objective != '' || $_SESSION["resume"]->profile != '' || $_SESSION["resume"]->qualifications != '' || $_SESSION["resume"]->skills != '') {
			echo '<br />
					<div class="divider"></div>';
		}
		
	?>
	
	<br />
	
	<h2>EDUCATION</h2>
	
	<?php
		
		if($_SESSION["resume"]->education->counter > 0 && $_SESSION["resume"]->count_items($_SESSION["resume"]->education->active, $_SESSION["resume"]->education->counter) > 0) {
			
			for($i = 0;$i < $_SESSION["resume"]->education->counter;$i++) {
				
				if($_SESSION["resume"]->education->active[$i]) {
					
					echo '<br />'
							.$_SESSION["resume"]->education->school[$i].
							'<ul>
								<li>'.$_SESSION["resume"]->education->studies[$i];
								
					if($_SESSION["resume"]->education->graduation[$i] !== '') {echo ', <b>'.$_SESSION["resume"]->education->graduation[$i].'</b></li>';}
					else {echo '</li>';}
					
					echo '</ul>';
					
				}
				
			}
			
		}
		
	?>
	
	<br />
	
	<div class="divider"></div>
	
	<br />
	
	<h2>WORK EXPERIENCE</h2>
	
	<?php
		
		if($_SESSION["resume"]->experience->counter > 0 && $_SESSION["resume"]->count_items($_SESSION["resume"]->experience->active, $_SESSION["resume"]->experience->counter) > 0) {
			
			for($i = 0;$i < $_SESSION["resume"]->experience->counter;$i++) {
				
				if($_SESSION["resume"]->experience->active[$i]) {
					
					echo '<br />'
							.$_SESSION["resume"]->experience->company[$i].', '.$_SESSION["resume"]->experience->date[$i].
							'<br />
							<b>'.strtoupper($_SESSION["resume"]->experience->title[$i]).'</b>
							<ul>';
					
					$items = explode(chr(13), $_SESSION["resume"]->experience->duties[$i]);
					
					for($j = 0;$j < count($items);$j++) {
						$checker = trim($items[$j]);
						if($checker != '') {echo '<li>'.$checker.'</li>';}
					}
					
					echo '</ul>';
					
					if($_SESSION["resume"]->experience->reason[$i] != '') {
						echo '<br />
								<b>Reason for living:</b> '
								.$_SESSION["resume"]->experience->reason[$i].
								'<br /><br />';
					}
					
				}
				
			}
			
		}
		
	?>
	
	<br />
	
	<div class="divider"></div>
	
	<br />
	
	<h2>REFERENCES</h2>
	
	<?php
		
		if($_SESSION["resume"]->references->counter > 0 && $_SESSION["resume"]->count_items($_SESSION["resume"]->references->active, $_SESSION["resume"]->references->counter) > 0) {
			
			echo '<br />
					
					<ul>';
			
			for($i = 0;$i < $_SESSION["resume"]->references->counter;$i++) {
				
				if($_SESSION["resume"]->references->active[$i]) {
					
					echo '<li>'
								.$_SESSION["resume"]->references->name[$i].', <b><u>'.$_SESSION["resume"]->references->phone[$i].'</u></b>';
					
					if($_SESSION["resume"]->references->company[$i] != '') {echo '<br />'.$_SESSION["resume"]->references->company[$i];}
					
					if($_SESSION["resume"]->references->department[$i] != '') {
						$previous = $_SESSION["resume"]->references->company[$i] == '' ? '<br />' : ', ';
						$label = strstr($_SESSION["resume"]->references->department[$i], 'department') ? '' : ' department';
						echo $previous.$_SESSION["resume"]->references->department[$i].$label;
					}
					
					if($_SESSION["resume"]->references->title[$i] != '') {
						$previous = ($_SESSION["resume"]->references->company[$i] != '' || $_SESSION["resume"]->references->department[$i] != '') ? ', ' : '<br />';
						echo '<b>'.$previous.$_SESSION["resume"]->references->title[$i].'</b>';
					}
					
					if($_SESSION["resume"]->references->address[$i] != '') {echo '<br />'.$_SESSION["resume"]->references->address[$i];}
					
					echo '</li>
							
							<br />';
					
				}
				
			}
			
			echo '</ul>';
			
		}
		
		if($_SESSION["resume"]->extras->counter > 0 && $_SESSION["resume"]->count_items($_SESSION["resume"]->extras->active, $_SESSION["resume"]->extras->counter) > 0) {
			
			echo '<br />
					
					<div class="divider"></div>
					
					<br />';
			
			for($i = 0;$i < $_SESSION["resume"]->extras->counter;$i++) {
				
				if($_SESSION["resume"]->extras->active[$i]) {
					
					echo '<h2 class="title">'.$_SESSION["resume"]->extras->title[$i].'</h2>
							<br />';
					
					$items = explode(chr(13), $_SESSION["resume"]->extras->content[$i]);
					
					if(count($items) > 1){
						
						echo '<ul>';
						
						for($j = 0;$j < count($items);$j++){
							$checker = trim($items[$j]);
							if($checker != '') {echo '<li>'.$checker.'</li>';}
						}
						
						echo '</ul>
								
								<br />';
						
					}
					else {echo nl2br($_SESSION["resume"]->extras->content[$i]).'<br /><br />';}
					
					echo '<br />';
					
				}
				
			}
			
		}
		
	?>
	
</body>
</html>