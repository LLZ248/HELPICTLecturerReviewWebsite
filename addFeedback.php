<?php
include 'config.php';
// Create connection
$conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
$msg = $_GET['studentFeedback'];
$lid = $_GET['lid'];
echo $lid;
$sql = "INSERT INTO feedback VALUES (NULL,'$msg', '$lid' )";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
	
?>