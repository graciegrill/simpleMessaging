<!DOCTYPE html>
<html>
<head>
	<title>Basic SQL</title>
	<meta charset='utf-8' />
</head>
<body>

	<?php
	include 'connection.php';
	if ($conn->connect_error){ 
		die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST["loginUser"])) {
		$_SESSION['loggedInUser'] = $_POST['loginUser'];
		header("location: frizz_databases_prjt1_part2.php");
		exit();
	}
	?>
	