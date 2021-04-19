<?php 
	include 'parsedown-1.7.4/Parsedown.php';

	require 'sql.php';
	$m_id = $_GET["id"];
	//echo mysqli_ping($conn) ? 'true' : 'false';
	
/* 	function m_values($id, $e1, $e2, $e3):mysqli_result
	{
		$q = "SELECT wert FROM joined_massnahme WHERE id = " . $id . " AND ebene1 = '" . $e1 . "'";
		if (!isset($e2)) {
			$q = $q . " AND ebene2 = '" . $e2 . "'";
			if(!isset($e3))
			{
				$q = $q . " AND ebene3 = '" . $e3 . "'";
			}
		}
		echo $q;
		$r = mysqli_query($conn, $q);
		return $r;
	}
	$details_r = m_values(1, 'Titel'); */
	
	function extract_wert($query_result)
	{
		$wert = "";
		foreach ($query_result as $qr)
			$wert = $qr["wert"];
		return $wert;
	}
	
	if (!is_null($m_id))
	{	
		$q_template = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ";
		
		
		$q_Titel = $q_template . "ebene1 = 'Titel'";
		
		$q_Kurzbeschreibung = $q_template . "ebene1 = 'Kurzbeschreibung'";
		
		$q_Umsetzungsbeispiel_Beschriftung = $q_template . "ebene1 = 'Umsetzungsbeispiel' AND ebene2 = 'Beschriftung'";
		$q_Umsetzungsbeispiel_Bild = $q_template . "ebene1 = 'Umsetzungsbeispiel' AND ebene2 = 'Bild'";
		$q_Umsetzungsbeispiel_uptime = $q_template . "ebene1 = 'Umsetzungsbeispiel' AND ebene2 = 'uptime'";
		
		$q_Ressource = "SELECT ebene2 FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Ressource' AND wert = 1";
		
		$q_wirkungfunktion = "SELECT ebene2, ebene3 FROM joined_massnahme WHERE ebene1 = 'Wirkung/Funktion' AND wert = 1 AND id = " . $m_id;
		
		$q_Anwendungsebene = "SELECT ebene2 FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Anwendungsebene' AND wert = 1";
		
		$q_Flaechenbedarf = $q_template . "ebene1 = 'Flächenbedarf'";
		
		$q_Nutzungsdauer_min = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'min'";
		$q_Nutzungsdauer_max = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'max'";
		$q_Nutzungsdauer_ueblich = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'üblich'";
		
		$q_Entwicklungsstand = "SELECT ebene2 FROM joined_massnahme WHERE ebene1 = 'Entwicklungsstand' AND id = " . $m_id . " AND wert = 1";
		
		$q_Sammelhinweis = $q_template . "ebene1 = 'Sammelhinweis'";
		
		$q_Funktionsbeschreibung = $q_template . "ebene1 = 'Funktionsbeschreibung und Aufbau'";
		
		$q_Systemskizze_Beschriftung = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'Beschriftung'";
		$q_Systemskizze_Bild = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'Bild'";
		$q_Systemskizze_uptime = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'uptime'";
		
		$q_Planung_freetext = $q_template . "ebene1 = 'Planung, Bemessung und rechtliche Aspekte' AND ebene2 = 'Fließtext'";
		$q_Planung_table = $q_template . "wert != '' AND (ebene2 LIKE 'Normen/Regelwerke_' OR ebene2 LIKE 'Titel/Inhalt_') ORDER BY ebene2";
		
		$q_Aufwand_freetext = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Fließtext'";
		
		
		
		
		$r_Titel = extract_wert(mysqli_query($conn, $q_Titel));
		
		$r_Kurzbeschreibung = extract_wert(mysqli_query($conn, $q_Kurzbeschreibung));
		
		$r_Umsetzungsbeispiel_Beschriftung = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Beschriftung));
		$r_Umsetzungsbeispiel_Bild = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Bild));
		$r_Umsetzungsbeispiel_uptime = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_uptime));
		
		$r_Ressource = mysqli_query($conn, $q_Ressource);		
		$r_Ressource = mysqli_fetch_all($r_Ressource, MYSQLI_NUM);
		
		$r_wirkungfunktion = mysqli_query($conn, $q_wirkungfunktion);
		$r_wirkungfunktion = mysqli_fetch_all($r_wirkungfunktion, MYSQLI_NUM);

		$r_Anwendungsebene = mysqli_query($conn, $q_Anwendungsebene);
		$r_Anwendungsebene = mysqli_fetch_all($r_Anwendungsebene, MYSQLI_NUM);
		
		$r_Flaechenbedarf = mysqli_query($conn, $q_Flaechenbedarf);
		$r_Flaechenbedarf = mysqli_fetch_all($r_Flaechenbedarf, MYSQLI_ASSOC);
		
		$r_Nutzungsdauer_min = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_min));
		$r_Nutzungsdauer_max = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_max));
		$r_Nutzungsdauer_ueblich = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_ueblich));
		
		$r_Entwicklungsstand = mysqli_query($conn, $q_Entwicklungsstand);
		$r_Entwicklungsstand = mysqli_fetch_all($r_Entwicklungsstand, MYSQLI_NUM);
		
		$r_Sammelhinweis = extract_wert(mysqli_query($conn, $q_Sammelhinweis));
		
		$r_Funktionsbeschreibung = extract_wert(mysqli_query($conn, $q_Funktionsbeschreibung));
		
		$r_Systemskizze_Beschriftung = extract_wert(mysqli_query($conn, $q_Systemskizze_Beschriftung));
		$r_Systemskizze_Bild = extract_wert(mysqli_query($conn, $q_Systemskizze_Bild));
		$r_Systemskizze_uptime = extract_wert(mysqli_query($conn, $q_Systemskizze_uptime));
		
		$r_Planung_freetext = extract_wert(mysqli_query($conn, $q_Planung_freetext));
		$r_Planung_table = mysqli_query($conn, $q_Planung_table);
		$r_Planung_table = mysqli_fetch_all($r_Planung_table, MYSQLI_NUM);
		
		$r_Aufwand_freetext = extract_wert(mysqli_query($conn, $q_Aufwand_freetext));
		
	} else echo "Not a valid ID!";








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
			<div class="tab">
			  <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'Kurzinformation')">Kurzinformation</button>
			  <button class="tablinks" onclick="openCity(event, 'Detailinformation')">Detailinformation</button>
			</div>
			
			<div id="Kurzinformation" class="tabcontent">
				<!-- <h2>Kurzinformation</h2> -->
				<h3><?php echo $r_Titel; ?></h3>
				
				<h4>Kurzbeschreibung</h4>
					<p>
						<?php 
							$Parsedown = new Parsedown();
							echo $Parsedown->text($r_Kurzbeschreibung); 
						?>
					</p>
				
				<h4>Umsetzungsbeispiel</h4>
					<p>
						<figure>
							<img src=<?php echo "'" . $r_Umsetzungsbeispiel_Bild . "'"; ?> class = "img_center">
							<figcaption><?php echo $r_Umsetzungsbeispiel_Beschriftung ?></figcaption>
						</figure>	
					</p>
					<p>
						<small>
							Updated on: <?php echo date('d/M/Y H:i:s', strtotime($r_Umsetzungsbeispiel_uptime)); ?>
						</small>
					</p>
				
				<h4>Ressource</h4>
					<p>
						<ul>
							<?php 
								$ress_count = count($r_Ressource);
								for ($i = 0; $i < $ress_count; $i++)								
								{
									echo "<li>" . $r_Ressource[$i][0] . "</li>";
								}
							?>
						</ul>
					</p>
				
				<h4>Wirkung und Funktion</h4>
					<?php 
						$rg_wirkungfunktion = array();
						foreach ($r_wirkungfunktion as $wf)
						{
	    					$rg_wirkungfunktion[$wf[0]][] = $wf;
						}
						$rgwf_keys = array_keys($rg_wirkungfunktion);
						$rgwf_keys_count = count($rgwf_keys);
	    			?>
					<p>
						<ul>
							<?php 								
								for ($i = 0; $i < $rgwf_keys_count; $i++)
								{
									echo "<li>" . $rgwf_keys[$i] . "</li>";
									
									echo "<ul>";
									
										$rgwf_subarr = $rg_wirkungfunktion[$rgwf_keys[$i]];
										$rgwf_subarr_count = count($rgwf_subarr);
										for ($j = 0; $j < $rgwf_subarr_count; $j++)
										{
											echo "<li>" . $rgwf_subarr[$j][1] . "</li>";
										}
										
									echo "</ul>";
								}
							?>
						</ul>
					</p>
				
				<h4>Anwendungsebene</h4>
					<p>
						<ul>
							<?php 
								$anwendugsebene_count = count($r_Anwendungsebene);
								for ($i = 0; $i < $anwendugsebene_count; $i++)								
								{
									echo "<li>" . $r_Anwendungsebene[$i][0] . "</li>";
								}
							?>
						</ul>
					</p>
					
				<h4>Flächenbedarf</h4>
					<p>
						<ul>
							<li>spezifische Fläche: <?php echo $r_Flaechenbedarf[0]['wert']; ?> m²/EW</li>
							<li>Einheit für den spezifischen Flächenbedarf: <?php echo $r_Flaechenbedarf[1]['wert']; ?> m²/XX</li>
							<li>spezifische Fläche: <?php echo $r_Flaechenbedarf[2]['wert'] ?> m²/XX</li>
						</ul>
					</p>
				
				<h4>Nutzungsdauer</h4>
					<p>
						<ul>
							<li>minimum: <?php echo $r_Nutzungsdauer_min . " Jahre"; ?> </li>
							<li>maximum: <?php echo $r_Nutzungsdauer_ueblich . " Jahre"; ?> </li>
							<li>üblich: <?php echo $r_Nutzungsdauer_ueblich . " Jahre" ?> </li>							
						</ul>
					</p>
					
				<h4>Entwicklungsstand</h4>
					<p>
						<ul>
							<?php 
								$ent_count = count($r_Entwicklungsstand);
								for ($i = 0; $i < $ent_count; $i++)
								{
									echo "<li>" . $r_Entwicklungsstand[$i][0] . "</li>";									
								}
							?>
						</ul>
					</p>
					
				<h4>Sammelhinweis</h4>
					<p>
						<?php 
							echo $r_Sammelhinweis;
						?>
					</p>			
			</div>
			
			<div id="Detailinformation" class="tabcontent">
				
				<h4>Funktionsbeschreibung und Aufbau</h4>
					<p>
						<?php
							$parsedown_Funktionsbeschreibung = new Parsedown();
							echo $parsedown_Funktionsbeschreibung->text($r_Funktionsbeschreibung);
						?>
					</p>
				
				<h4>Systemskizze</h4>
					<p>
						<figure>
							<img src=<?php echo "'" . $r_Systemskizze_Bild . "'"; ?> class = "img_center">
							<figcaption><?php echo $r_Systemskizze_Beschriftung ?></figcaption>
						</figure>	
					</p>
					<p>
						<small>
							Updated on: <?php echo date('d/M/Y H:i:s', strtotime($r_Systemskizze_uptime)); ?>
						</small>
					</p>
				
				<h4>Planung, Bemessung und rechtliche Aspekte</h4>
					<p>
						<?php
							$parsedown_Planung = new Parsedown();
							echo $parsedown_Planung->text($r_Planung_freetext);
						?>
					</p>
					<?php 
						if(!empty($r_Planung_table))
						{
							echo "
							<table>
									<tr>
										<th>Norm</th>
										<th>Titel</th>
									</tr>";
									for ($i = 0; $i < 5; $i++)
									{
										echo "<tr><td>" . $r_Planung_table[$i][0] . "</td>";
										echo "<td>" . $r_Planung_table[$i+5][0] . "</td></tr>";
									}							
							echo "</table>";
						}
					?>
				
				<h4>Aufwand und Kosten</h4>
					<p>
						<?php 
							$parsedown_Aufwand = new Parsedown();
							echo $parsedown_Aufwand->text($r_Aufwand_freetext);
						?>
					</p>
				
				
				
						
			
			</div>
		
		
		
		
		
		
		
		
		
		
		</div>
	 <script>			
		function openCity(evt, cityName)
		{
		  var i, tabcontent, tablinks;
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
		    tabcontent[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {
		    tablinks[i].className = tablinks[i].className.replace(" active", "");
		  }
		  document.getElementById(cityName).style.display = "block";
		  evt.currentTarget.className += " active";
		}
		
		document.getElementById("defaultOpen").click();
		
	 </script>
	</body>
</html>