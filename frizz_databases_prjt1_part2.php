<?php
    include 'connection.php';
	if (isset($_SESSION['loggedInUser'])) {
        $stmt1 = $conn->prepare("SELECT DISTINCT sender.myName AS SenderName, receiver.myName AS ReceiverName, m.timeSent, m.message
		FROM messages m
		JOIN users sender ON m.sendID = sender.ID
		JOIN users receiver ON m.receiveID = receiver.ID
		WHERE sender.userName = ? OR receiver.userName = ?
		ORDER BY m.timeSent");
		$stmt1->bind_param("ss",$_SESSION['loggedInUser'],$_SESSION['loggedInUser']);
		$stmt1->execute();
        $result = $stmt1->get_result();
        if ($result->num_rows > 0) 
		while($row = $result->fetch_assoc()) 
			echo "Sender: " . $row["SenderName"]."<br>Recipient: ".$row["ReceiverName"]."<br>Message: ".$row["message"]."<br>";
	    else 
		    echo "No results";

		
		$stmt = $conn->prepare("INSERT INTO messages (sendID, receiveID, message) VALUES((SELECT ID FROM users WHERE userName = ? ),(SELECT ID FROM users WHERE userName =?), ?);
		");
		$stmt->bind_param("sss", $_SESSION['loggedInUser'], $_POST["receiverUserName"], $_POST["message"]);
		$stmt->execute();
	}
	?>
    <html>
	<head>
		<title>This is a basic form</title>
	<head>
	<body>
		<form method="post" action="frizz_databases_prjt1_part2.php">
		<label for="message">Enter your message:</label><br>
        <input type="text" name="message"><br>
			Send to:
			<select name="receiverUserName">
				<?php
						
				$result = $conn->query("SELECT userName FROM users");
	
				if ($result->num_rows > 0) 
					while($row = $result->fetch_assoc()) {
						echo "<option";
						if (isset($_POST["userName"]) && $row["userName"] == $_POST["userName"])
							echo " selected ";						
						echo ">" . $row["userName"] . "</option>\n";  	 				
					}
				?>
			</select>
			<input type="submit">
			
		</form>

</body>
</html>
