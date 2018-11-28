<?php
require_once("classes/Education.php");
require_once("classes/Experience.php");
require_once("classes/References.php");
require_once("classes/Extras.php");
require_once("classes/Resume.php");
session_start();
if(isset($_SESSION["resume"]) == 0) {$_SESSION["resume"] = new Resume();}
?>