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
			<div>
				<h2>Kurzinformation</h2>
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
				
				
			
			
			
			</div>
		
		
		
		
		
		
		
		
		
		
		</div>
	</body>
</html>