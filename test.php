<!DOCTYPE html>
<html>
<head>
	<title>Basic SQL</title>
	<meta charset='utf-8' />
</head>
<body>

	<?php
// Assuming connection parameters are set
$servername = "localhost"; 
	$username = "root"; 
	$password = "Annemarie@2009"; 
	$database = "messageSystem"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if userName is set in POST request
if (isset($_POST["userName"])) {
    echo "Username Received: " . $_POST["userName"] . "<br>";
} else {
    echo "No username received";
}

    // Prepare the SQL statement
    $stmt = $conn->prepare("
        SELECT sender.myName AS SenderName, receiver.myName AS ReceiverName, m.timeSent, m.message
        FROM messages m
        JOIN users sender ON m.sendID = sender.ID
        JOIN users receiver ON m.receiveID = receiver.ID
        WHERE sender.userName = ? OR receiver.userName = ?
        ORDER BY m.timeSent
    ");

    // Bind parameters and execute
    $stmt->bind_param("ss", $userName, $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch and display the results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Time: " . $row["timeSent"] . "<br>";
            echo "From: " . $row["SenderName"] . "<br>";
            echo "To: " . $row["ReceiverName"] . "<br>";
            echo "Message: " . $row["message"] . "<br><br>";
        }
    } else {
        echo "No messages found for the specified user.";
    }

    $stmt->close();


$conn->close();
?>