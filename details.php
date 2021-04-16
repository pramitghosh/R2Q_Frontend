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
		
		
		
		$r_Titel = extract_wert(mysqli_query($conn, $q_Titel));
		
		$r_Kurzbeschreibung = extract_wert(mysqli_query($conn, $q_Kurzbeschreibung));
		
		$r_Umsetzungsbeispiel_Beschriftung = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Beschriftung));
		$r_Umsetzungsbeispiel_Bild = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Bild));
		$r_Umsetzungsbeispiel_uptime = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_uptime));
		
		
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
			</div>
		
		
		
		
		
		
		
		
		
		
		</div>
	</body>
</html>