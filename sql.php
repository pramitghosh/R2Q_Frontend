<?php

$servername = "185.149.214.79";
$username = "Flemming";
$password = "vo5Otei9";
$dbname = "r2q";
						
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
