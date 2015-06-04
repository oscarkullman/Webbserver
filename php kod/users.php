<?php
$servername = "localhost";
$username = "root";
$password = "eber";
$dbname = "Diary";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "CREATE TABLE users (

id INT( 50 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,

username VARCHAR( 15 ) NOT NULL ,

password VARCHAR( 15 ) NOT NULL ,

email VARCHAR( 50 ) NOT NULL

)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?> 
