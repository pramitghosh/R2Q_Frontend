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
}# else echo "Connected!";

if (!mysqli_set_charset($conn, "utf8mb4")) {
	printf("Error loading character set utf8mb4: %s\n", mysqli_error($conn));
} else {
	//printf("Current character set: %s\n", mysqli_character_set_name($conn));
}

?>
