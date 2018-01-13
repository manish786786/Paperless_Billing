<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill_db";

$name=$_POST['name'];
$email=$_POST['email'];
$num=$_POST['mob'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO customer (Name, Email, Phone)
VALUES ('".$name."', '".$email."', '".$num."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>