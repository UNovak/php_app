<?php
$host = 'db';  // Use the container name
$username = 'root';
$password = 'password';
$database = 'php_todo';

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
