<!DOCTYPE html>
<html>
<head>
	<title>Basic SQL</title>
	<meta charset='utf-8' />
</head>
<body>

	<?php
	//use that connection
	include 'connection.php';
	if ($conn->connect_error){ 
		die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST["loginUser"])) {
		//make this a session variable so I can keep using it
		$_SESSION['loggedInUser'] = $_POST['loginUser'];
		//direct to next page
		header("location: frizz_databases_prjt1_part2.php");
		exit();
	}
	?>
	