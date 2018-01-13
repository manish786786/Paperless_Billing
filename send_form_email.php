<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill_db";




if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = $_POST['email'];
    $email_subject = "INVOICE GENERATED";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, "http://localhost/bill/viewbill.php?id=".$_POST["iid"], $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$sql = "INSERT INTO invoice (cust, date ,total,invoiceid,invoice)
VALUES ('".$_POST["name"]."','".$_POST["date"]."','".$_POST["tot"]."','".$_POST["iid"]."','".base64_encode($_POST['msg'])."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}
?>