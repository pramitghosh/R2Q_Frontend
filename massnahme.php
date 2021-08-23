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
		
		$search_sql = "SELECT DISTINCT
			id, name, ressource, kategorieIndex, wert
		FROM
			r2q.joined_massnahme
		WHERE
			ebene1 = 'Titel' AND wert LIKE '%" . $search_query . "%' ORDER BY ressource, wert";
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
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>	
	</head>
	<body>
		<div class="page-container">
			
			<?php
				include 'NavBar.php';
			?>
			
			<div class="mainContent">
				<div class = "filters">
					<?php
						include 'filters.php';
					?>
				</div>
				<div class = "results">
					
					<div class="resultsTab">

						<?php
							if($post_set)
							{
								echo "<p class='filterHeader'>
								<br>
								Suchergebnisse
								<br>
								<br>
								</p>
									
								";
									/* $Parsedown = new Parsedown();
									echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
									
									require 'sql.php';
							
									if(mysqli_num_rows($result2) > 0)
									{
										$resCounter = 0;
										foreach ($result2 as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'B'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Baustoffe &nbsp; <i class='fa fa-cubes'></i></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($result2 as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'B'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="B") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($result2 as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'E'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Energie &nbsp; <i class='fas fa-battery-three-quarters'></i></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($result2 as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'E'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="E") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($result2 as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'N'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Niederschlagswasser &nbsp; <i class='fas fa-cloud-rain'></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($result2 as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'N'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="N") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
														
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($result2 as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'S'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Schmutzwasser &nbsp; <i class='fas fa-toilet'></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($result2 as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'S'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="S") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
														
													}
																										
												}
											echo "</table>";
										}
										
									}                   
								mysqli_close($conn);
							} else {
								require 'sql.php';
								$default_query = "SELECT DISTINCT id, name, ressource FROM r2q.joined_massnahme ORDER BY ressource, name";
								$default_result = mysqli_query($conn, $default_query);

								// echo "<p class='filterHeader'>
								// 	<br>
								// 	Maßnahmenkatalog
								// 	<br>
								// 	<br>
								// 	</p>
								// 	<table class='searchTable'>
								// 	<colgroup>
								// 			<col style='width:90%'>
								// 			<col style='width:10%;'>
								// 	</colgroup>
								// 	<thead class='search'>
								// 		<td style='font-size: 30px;' >Name</td>
								// 		<td style='font-size: 30px;' >Ressource</td>
						
								// 	</thead>
								// 	";
								// 		/* $Parsedown = new Parsedown();
								// 		echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
										
								// 		require 'sql.php';
								
								// 		if(mysqli_num_rows($default_result) > 0)
								// 		{
								// 			//while($row = mysqli_fetch_assoc($result))
								// 			foreach ($default_result as $row2)
								// 			{
								// 				$titel_query = "SELECT wert FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel'";
												
								// 				$titel_result = mysqli_query($conn, $titel_query);
								// 				$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
								// 				if ($titel[0][0]=="") {
								// 					$titel[0][0] = "!!Titel noch nicht vorhanden!!";
								// 				}

								// 				//echo "<tr><td>" . $row2["id"] . "</td>";
								// 				echo "<tr class='searchRow'>";
								// 				echo "<td>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
								// 				echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
								// 				echo "</tr>";
								// 				//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
								// 			}
								// 		}                   
								// 		mysqli_close($conn);
									
								// echo "</table>";


								echo "<p class='filterHeader'>
								<br>
								Maßnahmenkatalog
								<br>
								<br>
								</p>
									
								";
									/* $Parsedown = new Parsedown();
									echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p> */
									
									require 'sql.php';
							
									if(mysqli_num_rows($default_result) > 0)
									{
										$resCounter = 0;
										foreach ($default_result as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'B'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Baustoffe &nbsp;<i class='fa fa-cubes'></i></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($default_result as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'B'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="B") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($default_result as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'E'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Energie</td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($default_result as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'E'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="E") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($default_result as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'N'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Niederschlagswasser &nbsp; <i class='fas fa-cloud-rain'></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($default_result as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'N'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="N") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
														
													}
																										
												}
											echo "</table>";
										}


										$resCounter = 0;
										foreach ($default_result as $row2) {
											$q_ressource = "SELECT ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ressource = 'S'";
											$r_ressource = mysqli_query($conn, $q_ressource);
											$ressource = mysqli_fetch_all($r_ressource, MYSQLI_NUM);
											if (sizeof($ressource)>0) {
												$resCounter = $resCounter + 1;
											}
										}

										if ($resCounter > 0) {
											echo "<br><table class='searchTable'>
												
												<thead class='search'>
													<td style='font-size: 30px;' >Maßnahmen für Schmutzwasser &nbsp; <i class='fas fa-toilet'></td>
												</thead>";
												//while($row = mysqli_fetch_assoc($result))
												foreach ($default_result as $row2) {
													$titel_query = "SELECT wert, ressource FROM joined_massnahme WHERE id = " . $row2["id"] . " AND ebene1 = 'Titel' AND ressource = 'S'";
													
													$titel_result = mysqli_query($conn, $titel_query);
													$titel = mysqli_fetch_all($titel_result, MYSQLI_NUM);
													if (sizeof($titel)>0 and $titel[0][1]="S") {
														if ($titel[0][0]=="") {
															$titel[0][0] = "!!Titel noch nicht vorhanden!!";
														}
														//echo "<tr><td>" . $row2["id"] . "</td>";
														echo "<tr class='searchRow'>";
														echo "<td class='searchCell'>" . "<a class='resultRef' href='details.php?id=" . $row2["id"] . "'>" . $titel[0][0] . "</a>" . "</td>";
														// echo "<td style='text-align:center'>" . $row2["ressource"] . "</td>";
														echo "</tr>";
														//echo "<td>" . $row2["kategorieIndex"] . "</td></tr>";
														
													}
																										
												}
											echo "</table>";
										}
										
									}                   
								mysqli_close($conn);









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
			</div>
			<?php include 'footer.php'; ?>
			
		</div>
		
	</body>
</html>
