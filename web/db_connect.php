<?php
$servername = "localhost";
$username = "root";      // change if needed
$password = "";          // add if your MySQL has a password
$dbname = "student_portal";  // make sure this database exists

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
