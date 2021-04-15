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

$sql = "SELECT * FROM joined_massnahme";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["name"]. ", " . $row["ressource"]. $row["kategorieIndex"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
