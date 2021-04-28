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
	
	// function get_wertParsedown($e1, $e2=NULL, $e3=NULL)
	// { 	global $conn;
	// 	global $m_id;
	// 	if (is_null($e2))  {
	// 		$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = ".$e1);
	// 	} elseif (is_null($e3)) {
	// 		$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = " . $e1 . " AND ebene2 = " . $e2);
	// 	} else {
	// 		$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = " . $e1 . " AND ebene2 = " . $e2 . " AND ebene3 = " . $e3);
	// 	}
	// 	$wert = "";
	// 	foreach ($query_result as $qr)
	// 		$wert = $qr["wert"];
	// 		$wert = text($wert); 
	// 	return $wert;
	// }

	function get_wert($e1, $e2=NULL, $e3=NULL)
	{ 	global $conn;
		global $m_id;
		if (is_null($e2))  {
			$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = ".$e1);
		} elseif (is_null($e3)) {
			$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = " . $e1 . " AND ebene2 = " . $e2);
		} else {
			$query_result = mysqli_query($conn, "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = " . $e1 . " AND ebene2 = " . $e2 . " AND ebene3 = " . $e3);
		}
		$wert = "";
		foreach ($query_result as $qr)
			$wert = $qr["wert"];
		return $wert;
	}
 
	if (!is_null($m_id))
	{	
		// $q_template = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ";
		
		// $q_Titel = $q_template . "ebene1 = 'Titel'";
		
		// $q_Kurzbeschreibung = $q_template . "ebene1 = 'Kurzbeschreibung'";
		
		// $q_Umsetzungsbeispiel_Beschriftung = $q_template . "ebene1 = 'Umsetzungsbeispiel' AND ebene2 = 'Beschriftung'";
		// $q_Umsetzungsbeispiel_Bild = $q_template . "ebene1 = 'Umsetzungsbeispiel' AND ebene2 = 'Bild'";
		
		// $q_Ressource = "SELECT ebene2 FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Ressource' AND wert = 1";
		
		// $q_wirkungfunktion = "SELECT ebene2, ebene3 FROM joined_massnahme WHERE ebene1 = 'Wirkung/Funktion' AND wert = 1 AND id = " . $m_id;
		
		// $q_Anwendungsebene = "SELECT ebene2 FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Anwendungsebene' AND wert = 1";
		
		// $q_Flaechenbedarf = $q_template . "ebene1 = 'Flächenbedarf'";
		
		// $q_Nutzungsdauer_min = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'min'";
		// $q_Nutzungsdauer_max = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'max'";
		// $q_Nutzungsdauer_ueblich = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Nutzungsdauer' AND ebene2 = 'üblich'";
		
		// $q_Entwicklungsstand = "SELECT ebene2 FROM joined_massnahme WHERE ebene1 = 'Entwicklungsstand' AND id = " . $m_id . " AND wert = 1";
		
		// $q_Sammelhinweis = $q_template . "ebene1 = 'Sammelhinweis'";
		
		// $q_Funktionsbeschreibung = $q_template . "ebene1 = 'Funktionsbeschreibung und Aufbau'";
		
		// $q_Systemskizze_Beschriftung = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'Beschriftung'";
		// $q_Systemskizze_Bild = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'Bild'";
		// $q_Systemskizze_uptime = $q_template . "ebene1 = 'Systemskizze' AND ebene2 = 'uptime'";
		
		// $q_Planung_freetext = $q_template . "ebene1 = 'Planung, Bemessung und rechtliche Aspekte' AND ebene2 = 'Fließtext'";
		// $q_Planung_table = $q_template . "wert != '' AND (ebene2 LIKE 'Normen/Regelwerke_' OR ebene2 LIKE 'Titel/Inhalt_') ORDER BY ebene2";
		
		// $q_Aufwand_freetext = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Fließtext'";
		// $q_Aufwand_i1 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten1'";
		// $q_Aufwand_i2 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten2'";
		// $q_Aufwand_i3 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten3'";
		// $q_Aufwand_i4 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten4'";
		// $q_Aufwand_i5 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten5'";
		// $q_Aufwand_b1 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten1'";
		// $q_Aufwand_b2 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten2'";
		// $q_Aufwand_b3 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten3'";
		// $q_Aufwand_b4 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten4'";
		// $q_Aufwand_b5 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten5'";
		// $q_Aufwand_hinweis = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Hinweis'";
		
		// $q_Weitergehende_freetext = $q_template . "ebene1 = 'Weitergehende Hinweise' AND ebene2 = 'Fließtext'";
		// $q_Weitergehende_table = $q_template . "wert != '' AND ebene1 = 'Weitergehende Hinweise' AND (ebene2 = 'Parameter' OR ebene2 = 'Wert') ORDER BY ebene2, ebene3";
		
		
		// $r_Titel = extract_wert(mysqli_query($conn, $q_Titel));
		
		// $r_Kurzbeschreibung = extract_wert(mysqli_query($conn, $q_Kurzbeschreibung));
		// $r_Umsetzungsbeispiel_Beschriftung = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Beschriftung));
		// $r_Umsetzungsbeispiel_Bild = extract_wert(mysqli_query($conn, $q_Umsetzungsbeispiel_Bild));
		
		// $r_Ressource = mysqli_query($conn, $q_Ressource);		
		// $r_Ressource = mysqli_fetch_all($r_Ressource, MYSQLI_NUM);
		
		// $r_wirkungfunktion = mysqli_query($conn, $q_wirkungfunktion);
		// $r_wirkungfunktion = mysqli_fetch_all($r_wirkungfunktion, MYSQLI_NUM);

		// $r_Anwendungsebene = mysqli_query($conn, $q_Anwendungsebene);
		// $r_Anwendungsebene = mysqli_fetch_all($r_Anwendungsebene, MYSQLI_NUM);
		
		// $r_Flaechenbedarf = mysqli_query($conn, $q_Flaechenbedarf);
		// $r_Flaechenbedarf = mysqli_fetch_all($r_Flaechenbedarf, MYSQLI_ASSOC);
		
		// $r_Nutzungsdauer_min = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_min));
		// $r_Nutzungsdauer_max = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_max));
		// $r_Nutzungsdauer_ueblich = extract_wert(mysqli_query($conn, $q_Nutzungsdauer_ueblich));
		
		// $r_Entwicklungsstand = mysqli_query($conn, $q_Entwicklungsstand);
		// $r_Entwicklungsstand = mysqli_fetch_all($r_Entwicklungsstand, MYSQLI_NUM);
		
		// $r_Sammelhinweis = extract_wert(mysqli_query($conn, $q_Sammelhinweis));
		
		// $r_Funktionsbeschreibung = extract_wert(mysqli_query($conn, $q_Funktionsbeschreibung));
		
		// $r_Systemskizze_Beschriftung = extract_wert(mysqli_query($conn, $q_Systemskizze_Beschriftung));
		// $r_Systemskizze_Bild = extract_wert(mysqli_query($conn, $q_Systemskizze_Bild));
		// $r_Systemskizze_uptime = extract_wert(mysqli_query($conn, $q_Systemskizze_uptime));
		
		// $r_Planung_freetext = extract_wert(mysqli_query($conn, $q_Planung_freetext));
		// $r_Planung_table = mysqli_query($conn, $q_Planung_table);
		// $r_Planung_table = mysqli_fetch_all($r_Planung_table, MYSQLI_NUM);
		
		// $r_Aufwand_freetext = extract_wert(mysqli_query($conn, $q_Aufwand_freetext));
		// $r_Aufwand_i1 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i1), MYSQLI_NUM);
		// $r_Aufwand_i2 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i2), MYSQLI_NUM);
		// $r_Aufwand_i3 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i3), MYSQLI_NUM);
		// $r_Aufwand_i4 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i4), MYSQLI_NUM);
		// $r_Aufwand_i5 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i5), MYSQLI_NUM);
		// $r_Aufwand_b1 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b1), MYSQLI_NUM);
		// $r_Aufwand_b2 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b2), MYSQLI_NUM);
		// $r_Aufwand_b3 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b3), MYSQLI_NUM);
		// $r_Aufwand_b4 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b4), MYSQLI_NUM);
		// $r_Aufwand_b5 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b5), MYSQLI_NUM);
		// $r_Aufwand_hinweis = extract_wert(mysqli_query($conn, $q_Aufwand_hinweis));
		
		// $r_Weitergehende_freetext = extract_wert(mysqli_query($conn, $q_Weitergehende_freetext));
		// $r_Weitergehende_table = mysqli_fetch_all(mysqli_query($conn, $q_Weitergehende_table), MYSQLI_NUM);
		
		$r_Titel = get_wert("'Titel'");
		$r_Kurzbeschreibung = get_wert("'Kurzbeschreibung'");
		$r_Umsetzungsbeispiel_Beschriftung = get_wert("'Umsetzungsbeispiel'","'Beschriftung'");
		$r_Umsetzungsbeispiel_Bild = get_wert("'Umsetzungsbeispiel'","'Bild'");
		$r_ResNiederschlag = get_wert("'Ressource'","'Niederschlagswasser'");
		$r_ResSchmutzwasser = get_wert("'Ressource'","'Schmutzwasser'");
		$r_ResBaustoffe = get_wert("'Ressource'","'Baustoffe'");
		$r_ResEnergie = get_wert("'Ressource'","'Energie'");
		$r_ResFläche = get_wert("'Ressource'","'Fläche'");



		$r_funkNiederschlagGewässer = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Gewässerschutz'");
		$r_funkNiederschlagBodenschutz = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Bodenschutz'");
		$r_funkNiederschlagÜberflutungsschutz = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Überflutungsschutz'");
		$r_funkNiederschlagKlimaanpassung = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Klimaanpassung'");

		$r_funkBaustoffeBOM = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'BOM Bill of Material'");
		$r_funkBaustoffeMonomaterial = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Monomaterial'");
		$r_funkBaustoffeEinsparung = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Einsparung von Primärmaterialien'");
		$r_funkBaustoffeNachwachsend = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Nachwachsender Rohstoff'");
		$r_funkBaustoffeRohstofferhalt = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Rohstofferhalt'");
		$r_funkBaustoffeRohstoffverfügbarkeit = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Rohstoffverfügbarkeit'");
		$r_funkBaustoffeRohstoffaufwand = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Rohstoffaufwand (gesamt)'");

		$r_funkFlächeInfrastrukturversorgung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Infrastrukturversorgung'");
		$r_funkFlächeNutzungsvielfalt = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Nutzungsvielfalt'");
		$r_funkFlächeEinsparung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Einsparung natürlicher Ressourcen'");
		$r_funkFlächeLuftreinhaltung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Luftreinhaltung'");
		$r_funkFlächeBiodiversität = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Biodiversität'");
		$r_funkFlächeAufenthaltsqualität = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Aufenthalts-/ Freiraumqualität'");

		$r_funkSchmutzwasserGesundheitsvorsorge = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Gesundheitsvorsorge'");
		$r_funkSchmutzwasserGewässerschutz = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Gewässerschutz'");
		$r_funkSchmutzwasserTrinwassereinsparung = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Trinwassereinsparung'");
		$r_funkSchmutzwasserNährstoffrückgewinnung = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Nährstoffrückgewinnung'");

		$r_funkEnergieElektrizität = get_wert("'Wirkung/Funktion'", "'Energie'", "'Elektrizität'");
		$r_funkEnergieWärme = get_wert("'Wirkung/Funktion'", "'Energie'", "'Wärme'");
		$r_funkEnergieBrennstoffe = get_wert("'Wirkung/Funktion'", "'Energie'", "'Brennstoffe'");
		$r_funkEnergieErzeugung = get_wert("'Wirkung/Funktion'", "'Energie'", "'Erzeugung'");
		$r_funkEnergieVerteilung = get_wert("'Wirkung/Funktion'", "'Energie'", "'Verteilung'");
		$r_funkEnergieVerbrauch = get_wert("'Wirkung/Funktion'", "'Energie'", "'Verbrauch'");

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

			<!hr class="hline_top">
			<div id="Kurzinformation" class="tabcontent">




				<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
				<h3><?php echo $r_Titel; ?></h3>

				
					<h5>Kurzinformation</h5>
					<div id="kurzBox" class="greenBox"> 
						<p>
							<?php 
								$Parsedown = new Parsedown();
								echo $Parsedown->text($r_Kurzbeschreibung);
							?>
						</p>
						</div>
				<h4>Umsetzungsbeispiel</h4>
					<p>
						<figure_bsp>
							<img src=<?php echo "'" . $r_Umsetzungsbeispiel_Bild . "'"; ?> class = "img_center">
							
							<figcaption><figcaptionPre>Abb.1: </figcaptionPre> <?php echo $r_Umsetzungsbeispiel_Beschriftung ?></figcaption>
						</figure_bsp>	
					</p>
				<div id="resBox" class="greenBox">
					<h6>Ressource</h6>
						<table class="resTable">
							<tbody>
								<tr>
									<td><input type="checkbox"  <?php echo ($r_ResNiederschlag==1)? "checked":""; ?> onclick="return false;"> Niederschlagswasser</td>
									<td><input type="checkbox"  <?php echo ($r_ResSchmutzwasser==1)? "checked":""; ?> onclick="return false;"> Schmutzwasser</td>
									<td><input type="checkbox"  <?php echo ($r_ResBaustoffe==1)? "checked":""; ?> onclick="return false;">  Baustoffe</td>
									<td><input type="checkbox"  <?php echo ($r_ResEnergie==1)? "checked":""; ?> onclick="return false;"> Energie</td>
									<td><input type="checkbox"  <?php echo ($r_ResFläche==1)? "checked":""; ?> onclick="return false;"> Fläche</td>
								</tr>
							</tbody>
						</table>
				</div>

				<div id="funktionBox" class="whiteBox">
				<h4>Wirkung und Funktion</h4>
							<table class="resTable">
								<tbody>
									<tr>
										<td class="gray"> Niederschlagswasser </td>
										<td><input type="checkbox"  <?php echo ($r_funkNiederschlagGewässer==1)? "checked":""; ?> onclick="return false;"> Gewässerschutz</td>
										<td><input type="checkbox"  <?php echo ($r_funkNiederschlagBodenschutz==1)? "checked":""; ?> onclick="return false;">  Bodenschutz</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkNiederschlagÜberflutungsschutz==1)? "checked":""; ?> onclick="return false;"> Überflutungsschutz</td>
										<td><input type="checkbox"  <?php echo ($r_funkNiederschlagKlimaanpassung==1)? "checked":""; ?> onclick="return false;">  Klimaanpassung</td>
									</tr>
									<tr class="hline">
										<td class="gray"> Schmutzwasser </td>
										<td><input type="checkbox"  <?php echo ($r_funkSchmutzwasserGesundheitsvorsorge==1)? "checked":""; ?> onclick="return false;"> Gesundheitsvorsorge</td>
										<td><input type="checkbox"  <?php echo ($r_funkSchmutzwasserGewässerschutz==1)? "checked":""; ?> onclick="return false;"> Gewässerschutz</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkSchmutzwasserTrinwassereinsparung==1)? "checked":""; ?> onclick="return false;"> Trinkwassereinsparung</td>
										<td><input type="checkbox"  <?php echo ($r_funkSchmutzwasserNährstoffrückgewinnung==1)? "checked":""; ?> onclick="return false;">  Nährstoffrückgewinnung</td>
									</tr>
									<tr class="hline">
										<td class="gray"> Baustoffe </td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeBOM==1)? "checked":""; ?> onclick="return false;"> BOM Bill of Material</td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeMonomaterial==1)? "checked":""; ?> onclick="return false;">  Monomaterial</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeEinsparung==1)? "checked":""; ?> onclick="return false;"> Einsparung von Primärmaterialien</td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeNachwachsend==1)? "checked":""; ?> onclick="return false;">  Nachwachsender Rohstoff</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeRohstofferhalt==1)? "checked":""; ?> onclick="return false;"> Rohstofferhalt</td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeRohstoffverfügbarkeit==1)? "checked":""; ?> onclick="return false;">  Rohstoffverfügbarkeit</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeRohstoffaufwand==1)? "checked":""; ?> onclick="return false;"> Rohstoffaufwand (gesamt)</td>
										<td></td>
									</tr>
									<tr class="hline">
										<td class="gray"> Energie </td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieElektrizität==1)? "checked":""; ?> onclick="return false;"> Elektrizität</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieErzeugung==1)? "checked":""; ?> onclick="return false;">  Erzeugung</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieWärme==1)? "checked":""; ?> onclick="return false;"> Wärme</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieVerteilung==1)? "checked":""; ?> onclick="return false;">  Verteilung</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieBrennstoffe==1)? "checked":""; ?> onclick="return false;"> Brennstoffe</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieVerbrauch==1)? "checked":""; ?> onclick="return false;">  Verbrauch</td>
									</tr>
									<tr class="hline">
										<td class="gray"> Fläche </td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeInfrastrukturversorgung==1)? "checked":""; ?> onclick="return false;"> Infrastrukturversorgung</td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeNutzungsvielfalt==1)? "checked":""; ?> onclick="return false;">  Nutzungsvielfalt</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeEinsparung==1)? "checked":""; ?> onclick="return false;"> Einsparung natürlicher Ressourcen</td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeLuftreinhaltung==1)? "checked":""; ?> onclick="return false;">  Luftreinhaltung</td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeBiodiversität==1)? "checked":""; ?> onclick="return false;"> Biodiversität</td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeAufenthaltsqualität==1)? "checked":""; ?> onclick="return false;">  Aufenthalts-/ Freiraumqualität</td>
									</tr>
								</tbody>
							</table>
							</div>
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
						<figure_bsp>
							<img src=<?php echo "'" . $r_Systemskizze_Bild . "'"; ?> class = "img_center">
							<figcaption><?php echo $r_Systemskizze_Beschriftung ?></figcaption>
						</figure_bsp>	
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
					<p>
						<h5>Investitionskosten</h5>						
						<?php 
							for ($i = 1; $i < 6; $i++)
							{
								
								echo "<ul>";
								
								if(!empty(${"r_Aufwand_i$i"}[0][0]))
								{
									echo "<li>Investitionskosten $i:</li>";
									echo "<ul><li>Minimum: " . ${"r_Aufwand_i" . $i}[1][0] . " €/" . ${"r_Aufwand_i" . $i}[0][0] . "</li>";
									echo "<li>Maximum: " . ${"r_Aufwand_i" . $i}[2][0] . " €/" . ${"r_Aufwand_i" . $i}[0][0] . "</li>";
									echo "<li>Üblich: " . ${"r_Aufwand_i" . $i}[3][0] . " €/" . ${"r_Aufwand_i" . $i}[0][0] . "</li></ul>";									
								}
								
								echo "</ul>";
								//echo ${"r_Aufwand_i$i`[1][0]`"};
							}							
						?>
					</p>
					<p>						
						<h5>Betriebskosten</h5>
						<?php 
							for ($i = 1; $i < 6; $i++)
							{
								
								echo "<ul>";
								
								if(!empty(${"r_Aufwand_b$i"}[0][0]))
								{
									echo "<li>Betriebskosten $i:</li>";
									echo "<ul><li>Minimum: " . ${"r_Aufwand_b" . $i}[1][0] . " €/" . ${"r_Aufwand_b" . $i}[0][0] . "</li>";
									echo "<li>Maximum: " . ${"r_Aufwand_b" . $i}[2][0] . " €/" . ${"r_Aufwand_b" . $i}[0][0] . "</li>";
									echo "<li>Üblich: " . ${"r_Aufwand_b" . $i}[3][0] . " €/" . ${"r_Aufwand_b" . $i}[0][0] . "</li></ul>";									
								}
								
								echo "</ul>";
							}							
						?>
					</p>
					<p>
						<h5>Hinweis</h5>
						<?php 
							$parsedown_Aufwand_hinweis = new Parsedown();
							echo $parsedown_Aufwand_hinweis->text($r_Aufwand_hinweis);
						?>
					</p>
				
				<h4>Weitergehende Hinweise</h4>				
					<p>
						<?php 
							$parsedown_Weitergehende_freetext = new Parsedown();
							echo $parsedown_Weitergehende_freetext->text($r_Weitergehende_freetext);
						?>
					</p>
					<p>
						<?php 
							if(!empty($r_Weitergehende_table))
							{
								echo "
								<table>
										<tr>
											<th>Parameter</th>
											<th>Wert</th>
										</tr>";
										for ($i = 0; $i < 5; $i++)
										{
											echo "<tr><td>" . $r_Weitergehende_table[$i][0] . "</td>";
											echo "<td>" . $r_Weitergehende_table[$i+5][0] . "</td></tr>";
										}							
								echo "</table>";
							}
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