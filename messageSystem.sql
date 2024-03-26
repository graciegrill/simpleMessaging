CREATE TABLE users(
	ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    myName VARCHAR(100) NOT NULL,
    userName VARCHAR(100) NOT NULL
    );
CREATE TABLE messages(
	sendID INTEGER,
    receiveID INTEGER,
    timeSent DATETIME DEFAULT NOW(),
    message VARCHAR(500)
    );
INSERT INTO users (myName, userName) VALUES ("Jon David Frizzell", "jdfrizz");
INSERT INTO users (myName, userName) VALUES ("William Frizzell", "superguy");
INSERT INTO users (myName, userName) VALUES ("Annie Frizzell", "thefunnyone");
INSERT INTO users (myName, userName) VALUES ("Ava Bunch", "bunchOTrouble");
INSERT INTO users (myName, userName) VALUES ("Emily Ryan", "eryan");
INSERT INTO users (myName, userName) VALUES ("Mary Caroline Hoverkamp", "MChammer");
INSERT INTO users (myName, userName) VALUES ("Emily Hall", "collegeEmily");
INSERT INTO users (myName, userName) VALUES ("Emily Kiger", "bandEmily");
INSERT INTO users (myName, userName) VALUES ("Hadlee Sanders", "lovesSharkWeek");
INSERT INTO users (myName, userName) VALUES ("Jon David Frizzell Sr.", "theOldOne");
INSERT INTO users (myName, userName) VALUES ("Christina Frizzell", "mater");

INSERT INTO messages (sendID, receiveID, timeSent, message) VALUES 
(1, 2, '2023-03-20 08:30:00', 'Hey, how are you doing?'),
(2, 1, '2023-03-20 08:45:00', 'Doing well, thanks! And you?'),
(1, 2, '2023-03-20 09:00:00', 'I’m great, thanks for asking!'),

(3, 4, '2023-03-21 10:15:00', 'Did you finish the project?'),
(4, 3, '2023-03-21 10:45:00', 'Yes, I sent it to your email.'),

(5, 6, '2023-03-22 12:00:00', 'Wanna grab lunch tomorrow?'),
(6, 5, '2023-03-22 12:05:00', 'Sure, what time works for you?'),

(7, 8, '2023-03-23 14:30:00', 'Happy Birthday, Emily!'),
(8, 7, '2023-03-23 14:35:00', 'Thank you so much!'),

(9, 10, '2023-03-24 16:00:00', 'Are you watching Shark Week?'),
(10, 9, '2023-03-24 16:30:00', 'Of course, I never miss it!'),

(1, 11, '2023-03-25 18:00:00', 'Do we need anything from the store?'),
(11, 1, '2023-03-25 18:15:00', 'Yes, please pick up some milk.');

SELECT * FROM users;
SELECT * FROM messages;
SELECT DISTINCT sender.myName AS SenderName, receiver.myName AS ReceiverName, m.timeSent, m.message
		FROM messages m
		JOIN users sender ON m.sendID = sender.ID
		JOIN users receiver ON m.receiveID = receiver.ID
		WHERE sender.userName = 'jdfrizz' OR receiver.userName = 'jdfrizz'
		ORDER BY m.timeSent;

SELECT 
    m.*,
    u1.userName AS SenderUserName,
    u1.myName AS SenderName,
    u2.userName AS ReceiverUserName,
    u2.myName AS ReceiverName
FROM messages m
INNER JOIN users u1 ON u1.ID = m.sendID
INNER JOIN users u2 ON u2.ID = m.receiveID;






    