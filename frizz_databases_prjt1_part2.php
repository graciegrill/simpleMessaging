<?php
    //use the connection I made earlier
    include 'connection.php';
    //Always display messages
	if (isset($_SESSION['loggedInUser'])) {
        $stmt1 = $conn->prepare("SELECT DISTINCT sender.myName AS SenderName, sender.userName AS senderUserName, receiver.myName AS ReceiverName, receiver.userName as receiverUserName, m.message, m.timeSent, 
        CASE
            WHEN DATEDIFF(CURDATE(), m.timeSent) <1 THEN CONCAT(DATE_FORMAT(m.timeSent, '%h:%i %p'))
            WHEN DATEDIFF(CURDATE(), m.timeSent) <=365 AND DATEDIFF(CURDATE(), m.timeSent) >=1 THEN CONCAT(DATE_FORMAT(m.timeSent, '%M-%d'))
            ELSE CONCAT(DATE_FORMAT(m.timeSent, '%M %d %Y')) 
            END AS theTime
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
			echo "Sender: " . $row["SenderName"]."  (".$row["senderUserName"].")<br>Recipient: ".$row["ReceiverName"]."  (".$row["receiverUserName"].")<br>Message: ".$row["message"]."<br>Time sent: ".$row["theTime"]."<br>";
	    else 
		    echo "No results";
    }
    //if the method is post, I submit the information, otherwise redirect to same page --> prevents resubmission on refresh
	if(isset($_SESSION['loggedInUser']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
		$stmt = $conn->prepare("INSERT INTO messages (sendID, receiveID, message) VALUES((SELECT ID FROM users WHERE userName = ? ),(SELECT ID FROM users WHERE userName =?), ?);
		");
		$stmt->bind_param("sss", $_SESSION['loggedInUser'], $_POST["receiverUserName"], $_POST["message"]);
		$stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
