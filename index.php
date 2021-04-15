<?php 
	require_once 'sql.php';
	$resources = $_POST["resourceform"];
	$resources_count = count($resources);
	
	if ($resources_count > 0) {
		$ebene2_prefix = "ebene2 = ";
		$ebene2 = "";
		for ($i = 0; $i < $resources_count; $i++) {
			//echo $resources[$i] . "<br>";
			$ebene2 = $ebene2 . $ebene2_prefix . "'" . $resources[$i] . "'";
			if ($i != $resources_count - 1) {
				$ebene2 = $ebene2 . " OR ";
			}
		}
		
		$sql2 = "SELECT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme WHERE ebene1 = 'Ressource' AND wert = '1' AND (" . $ebene2 . ")";
		//echo $sql2 . "\n";
		$result2 = mysqli_query($conn, $sql2);
		//print_r($result);
	}
?>

<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<title>
			Massnahmenkatalog Frontend
		</title>
	</head>
	<body>
		<div class = "filters">
			<?php
				include 'filters.php';
			?>
		</div>
		<div class = "results">
			<table>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Resource</th>
					<th>Category Index</th>
				</tr>
				<?php
					
					if(mysqli_num_rows($result2) > 0)
					{
						//while($row = mysqli_fetch_assoc($result))
						foreach ($result2 as $row2)
						{
							echo "<tr><td>" . $row2["id"] . "</td>";
							echo "<td>" . $row2["name"] . "</td>";
							echo "<td>" . $row2["ressource"] . "</td>";
							echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
						}
					}
					
					else echo "No results to show!";
					mysqli_close($conn);
				?>
			</table>
		</div>
	</body>
</html>