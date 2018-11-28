<?php
include("session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset = iso-8859-1" />
<title>Resume Builder</title>
<link rel = "stylesheet" href = "../css/_reset.css" />
<link rel = "stylesheet" href = "../css/_setup.css" />
<link rel = "stylesheet" href = "../css/_global.css" />
</head>
<body>

	
	<div class = "divisor15"></div>

	
	<div class = "divisor25"></div>
	
	<div class = "columnright copyright"></div>
	
	<div class = "columnclear divisor5"></div>
	
	<div class = "line"></div>
	
	<script>
	
		<?php
			
			$next = 1;
			$next += $_SESSION["resume"]->step;
			
			if($next < 7) {$_SESSION["resume"]->step = $next;}
			
			echo 'window.location="../../";';
			
		?>
	
	</script>

</body>
</html>