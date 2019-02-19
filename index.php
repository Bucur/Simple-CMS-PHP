<?php
//session_start();
//session_regenerate_id(TRUE);
include_once 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Web </title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="icon" href="favicon.png">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
<?php include_once 'header.php' ?>
<?php 
include_once 'views/home.php'
?>
<?php include_once 'footer.php' ?>
</body>
</html>