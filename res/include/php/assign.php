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
	
	<div class = "header">
		<img src = "../../images/logo.png" height = "92" width = "186" class = "columnleft" />
		<h2 class = "columnright"><div class = "divisor50"></div><div class = "divisor5"></div>creating your <span class = "enphasis">own resume</span> has never been so easy</h2>
		<div class = "columnclear"></div>
	</div>
	
	<div class = "divisor15"></div>
	
	<p>
		<b>LOREM IPSUM</b> ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. 
		<br /><br />
		No mei ferri graeco dicunt, ad cum veri accommodare. Sed at malis omnesque delicata, usu et iusto zzril meliore. Dicunt maiorum eloquentiam cum cu, sit summo dolor essent te. Ne quodsi nusquam legendos has, ea dicit voluptua eloquentiam pro, ad sit quas qualisque. Eos vocibus deserunt quaestio ei. Blandit incorrupte quaerendum in quo, nibh impedit id vis, vel no nullam semper audiam. Ei populo graeci consulatu mei, has ea stet modus phaedrum. Inani oblique ne has, duo et veritus detraxit. Tota ludus oratio ea mel, offendit persequeris ei vim. <span class = "colored">Eos dicat oratio partem</span> ut, id cum ignota senserit intellegat.
	</p>
	
	<div class = "divisor25"></div>
	
	<div class = "columnright copyright">example copyright ® 2013</div>
	
	<div class = "columnclear divisor5"></div>
	
	<div class = "line"></div>
	
	<script>
	
		<?php
			
			if($_POST && $_SESSION["resume"]->step == 1) {
			
				$name = trim(strip_tags($_POST['name']));
				$phone = trim(strip_tags($_POST['phone']));
				$fax = trim(strip_tags($_POST['fax']));
				$address = trim(strip_tags($_POST['address']));
				$email = trim(strip_tags($_POST['email']));
				$objective = trim(strip_tags($_POST['objective']));
				$profile = trim(strip_tags($_POST['profile']));
				$qualifications = trim(strip_tags($_POST['qualifications']));
				$skills = trim(strip_tags($_POST['skills']));
				
				$_SESSION["resume"]->name = $name == '' ? 'Your name goes here' : $_POST['name'];
				$_SESSION["resume"]->phone = $phone == '' ? 'Your phone goes here' : $_POST['phone'];
				$_SESSION["resume"]->fax = $_POST['fax'];
				$_SESSION["resume"]->address = $_POST['address'];
				$_SESSION["resume"]->email = $email == '' ? 'Your email goes here' : $_POST['email'];
				$_SESSION["resume"]->objective = $_POST['objective'];
				$_SESSION["resume"]->profile = $_POST['profile'];
				$_SESSION["resume"]->qualifications = $_POST['qualifications'];
				$_SESSION["resume"]->skills = $_POST['skills'];
				$_SESSION["resume"]->step++;
				
				echo 'alert("Your information has been sucesfully storaged. Please, continue with the nex step");window.location = "../../";';
				
			}
			else {echo 'window.location = "../../";';}
			
		?>
	
	</script>

</body>
</html>