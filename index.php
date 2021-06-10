<?php 
	require_once 'sql.php';
	
	$post_set = $_POST?1:0;
	
	$resources = $_POST["resourceform"];
	$funcs = $_POST["functionsform"];
	$anwendungs = $_POST["anwendungsform"];
	
	$resources_count = count($resources);
	$funcs_count = count($funcs);
	$anwendungs_count = count($anwendungs);
	
	if ($resources_count > 0)
	{
		$ebene2_prefix = "ebene2 = ";
		$ebene2 = "";
		for ($i = 0; $i < $resources_count; $i++)
		{
			//echo $resources[$i] . "<br>";
			$ebene2 = $ebene2 . $ebene2_prefix . "'" . $resources[$i] . "'";
			if ($i != $resources_count - 1)
			{
				$ebene2 = $ebene2 . " OR ";
			}
		}
		
		$resource_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme2 WHERE ebene1 = 'Ressource' AND wert = '1' AND (" . $ebene2 . ")";
		//echo $sql2 . "\n";
		//$result2 = mysqli_query($conn, $resource_sql);
		//print_r($result);
	}
	
	if ($funcs_count > 0)
	{
		$func_prefix = "ebene3 = ";
		$ebene3 = "";
		for($i = 0; $i < $funcs_count; $i++)
		{
			$ebene3 = $ebene3 . $func_prefix . "'" . $funcs[$i] . "'";
			if($i != $funcs_count - 1)
			{
				$ebene3 = $ebene3 . " OR ";
			}
		}
		
		$func_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme2 WHERE ebene1 = 'Wirkung/Funktion' AND wert = 1 AND (" . $ebene3 . ")";
		//echo $func_sql;
	}
	
	if($anwendungs_count > 0)
	{
		$anwendungs_prefix = "ebene2 = ";
		$anwendungs_ebene2 = "";
		for ($i = 0; $i < $anwendungs_count; $i++)
		{
			$anwendungs_ebene2 = $anwendungs_ebene2 . $anwendungs_prefix . "'" . $anwendungs[$i] . "'";
			if($i != $anwendungs_count - 1)
			{
				$anwendungs_ebene2 = $anwendungs_ebene2 . " OR ";
			}
		}
		
		$anwendungs_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme2 WHERE ebene1 = 'Anwendungsebene' AND wert = 1 AND (" . $anwendungs_ebene2 . ")"; 
	}
	
	$filter_query = $resource_sql . " AND (id , name, ressource, kategorieIndex) IN (" . $func_sql . " AND (id , name, ressource, kategorieIndex) IN (" . $anwendungs_sql . "))";
	//echo $filter_query;
	$result2 = mysqli_query($conn, $filter_query);
	
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
			<form action="details.php" method="GET">
				<label for="id">Bitte geben Sie Massnahmen ID ein, für die Direktsuche: </label>
				<input type="text" name="id">
				<input type="submit" value="Submit">				
			</form>
			<?php
				if($post_set)
				{
					echo "
						<table>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Resource</th>
								<th>Category Index</th>
							</tr>
						";
							/* $Parsedown = new Parsedown();
							echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
						
							if(mysqli_num_rows($result2) > 0)
							{
								//while($row = mysqli_fetch_assoc($result))
								foreach ($result2 as $row2)
								{
									echo "<tr><td>" . $row2["id"] . "</td>";
									echo "<td>" . "<a href='details.php?id=" . $row2["id"] . "'>" . $row2["name"] . "</a>" . "</td>";
									echo "<td>" . $row2["ressource"] . "</td>";
									echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
								}
							}					
							mysqli_close($conn);
						
					echo "</table>";
				}
			?>
		</div>
	</body>
</html>
