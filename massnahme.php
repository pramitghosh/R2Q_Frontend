<?php 
	require_once 'sql.php';
	
	$post_set = $_POST?1:0;
	
	$search_query = $_POST["massnahme_search"];
	
	$resources = $_POST["resourceform"];
	$funcs = $_POST["functionsform"];
	$anwendungs = $_POST["anwendungsform"];
	
	$resources_count = count($resources);
	$funcs_count = count($funcs);
	$anwendungs_count = count($anwendungs);
	
	if(!is_null($search_query))
	{
		$search_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme WHERE name LIKE '%" . $search_query . "%' ORDER BY ressource, name";
		//echo $search_sql;
	}
	
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
		
		$resource_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme WHERE ebene1 = 'Ressource' AND wert = '1' AND (" . $ebene2 . ")";
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
		
		$func_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme WHERE ebene1 = 'Wirkung/Funktion' AND wert = 1 AND (" . $ebene3 . ")";
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
		
		$anwendungs_sql = "SELECT DISTINCT id, name, ressource, kategorieIndex FROM r2q.joined_massnahme WHERE ebene1 = 'Anwendungsebene' AND wert = 1 AND (" . $anwendungs_ebene2 . ")"; 
	}
	
	$filter_query = $resource_sql . " AND (id , name, ressource, kategorieIndex) IN (" . $func_sql . " AND (id , name, ressource, kategorieIndex) IN (" . $anwendungs_sql . ")) ORDER BY ressource, name";
	//echo $filter_query;
	$result2 = mysqli_query($conn, is_null($search_sql)?$filter_query:$search_sql);
	
?>

<html>
	<head>
		
		<link rel="stylesheet" href="styles.css">
		<title>
			Massnahmenkatalog Frontend
		</title>		
				<script type="text/javascript" src = "selectdeselect.js"></script>		
	</head>
	<body>
		<div class="page-container">
			<div class = "filters">
				<?php
					include 'filters.php';
				?>
			</div>
			<div class = "resultsMas">
				
				<div class="resultsTab">

					<?php
						if($post_set)
						{
							echo "<p class='filterHeader'>
								Suchergebnisse
								<br>
								<br>
								</p>
								<table class='resultsTable'>
								<colgroup>
										<col style='width:90%'>
										<col style='width:10%;'>
								</colgroup>
								<thead class='resultsTableHeader'>
									<td style='font-size: 22px;' >Name</td>
									<td style='font-size: 22px;' >Ressource</td>
					
								</thead>
								";
									/* $Parsedown = new Parsedown();
									echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
									
									require 'sql.php';
							
									if(mysqli_num_rows($result2) > 0)
									{
										//while($row = mysqli_fetch_assoc($result))
										foreach ($result2 as $row2)
										{
											$titel_query = "SELECT wert FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel'";
											
											$titel_result = mysqli_query($conn, $titel_query);
											$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
											if ($titel[0][0]=="") {
												$titel[0][0] = "!!Titel noch nicht vorhanden!!";
											}

											//echo "<tr><td>" . $row2["id"] . "</td>";
											echo "<tr>";
											echo "<td>" . "<a href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
											echo "<td>" . $row2["ressource"] . "</td>";
											echo "</tr>";
											//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
										}
									}                   
									mysqli_close($conn);
								
							echo "</table>";
						}
					?>
				</div>
				<div class="directSearch">
					<form action="details.php" method="GET">
						<label for="id">Für Direktsuche MaßnahmenID eingeben: <br><br> </label>
						<input type="text" name="id">
						<input class="buttonFilter" type="submit" value="Bestätigen">				
					</form>
				</div>

			</div>
			<?php include 'footer.php'; ?>
		</div>
		
	</body>
</html>
