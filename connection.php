<?php
	session_start();
	$servername = "localhost"; 
	$username = "root"; 
	$password = "Annemarie@2009"; 
	$database = "messageSystem"; 
	//establish the connection, used by other php files
	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error){ 
		die("Connection failed: " . $conn->connect_error);
	}
