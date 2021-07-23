<?php 
	// header('Content-Type: text/html; charset=utf-8');
	include 'parsedown-1.7.4/Parsedown.php';

	// require 'sql.php';
	// require 'outputValues.php';

	function textParsedown($textInput){
		$Parsedown = new Parsedown();
		echo $Parsedown->text($textInput);
	}

	require 'sql.php';
	$m_id = $_GET["id"];

	
	function extract_wert($query_result)
	{
		$wert = "";
		foreach ($query_result as $qr)
			$wert = $qr["wert"];
		return $wert;
	}
	
	function get_wert_id($m_id, $e1, $e2=NULL, $e3=NULL){
		global $conn;
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

	function get_id($m_name){
		global $conn;
		
		$query_result = mysqli_query($conn, "SELECT id FROM joined_massnahme WHERE name = ". $m_name);
		$id = "";
		foreach ($query_result as $qr)
			$id = $qr["id"];
		return $id;
	}

	// function chooseCb($cbValue) {
	// 	if ($cbValue == 0) {echo "cb0";
	// 	} elseif ($cbValue == 1) {echo "cb1";
	// 	} elseif ($cbValue == 2) {echo "cb2";
	// 	} elseif ($cbValue == 3) {echo "cb3";
	// 	} elseif ($cbValue == 4) {echo "cb4";
	// 	}else {echo "cb0";};
										
	// }



	function get_wert($e1, $e2=NULL, $e3=NULL){
		global $conn;
		global $m_id;

		return get_wert_id($m_id, $e1, $e2, $e3);
	}

	if (!is_null($m_id))

	{
		$parsedown = new Parsedown();

		$q_template = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ";

		$r_Titel = get_wert("'Titel'");
		$r_Kurzbeschreibung = get_wert("'Kurzbeschreibung'");
		$r_Umsetzungsbeispiel_Beschriftung = get_wert("'Umsetzungsbeispiel'","'Beschriftung'");
		$r_Umsetzungsbeispiel_Bild = get_wert("'Umsetzungsbeispiel'","'Bild'");
		$r_ResNiederschlag = get_wert("'Ressource'","'Niederschlagswasser'");
		$r_ResSchmutzwasser = get_wert("'Ressource'","'Schmutzwasser'");
		$r_ResBaustoffe = get_wert("'Ressource'","'Baustoffe'");
		$r_ResEnergie = get_wert("'Ressource'","'Energie'");
		$r_ResFläche = get_wert("'Ressource'","'Fläche'");

		/* $r_funkNiederschlagGewässer = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Gewässerschutz'");
		$r_funkNiederschlagBodenschutz = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Bodenschutz'");
		$r_funkNiederschlagÜberflutungsschutz = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Überflutungsschutz'");
		$r_funkNiederschlagKlimaanpassung = get_wert("'Wirkung/Funktion'", "'Niederschlagswasser'", "'Klimaanpassung'"); */
		
		$r_funkWasserVerdunstung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Förderung Verdunstung'");
		if ($r_funkWasserVerdunstung > 4 Or !is_numeric($r_funkWasserVerdunstung)) {$r_funkWasserVerdunstung = 0;}
		$r_funkWasserGrundwasserneubildung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Förderung Grundwasserneubildung'");
		if ($r_funkWasserGrundwasserneubildung > 4 Or !is_numeric($r_funkWasserGrundwasserneubildung)) {$r_funkWasserGrundwasserneubildung = 0;}
		$r_funkWasserAbfluss = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Minderung Abfluss'");
		if ($r_funkWasserAbfluss > 4 Or !is_numeric($r_funkWasserAbfluss)) {$r_funkWasserAbfluss = 0;}
		$r_funkWasserSammlung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Sammlung und Ableitung'");
		if ($r_funkWasserSammlung > 4 Or !is_numeric($r_funkWasserSammlung)) {$r_funkWasserSammlung = 0;}
		$r_funkWasserBehandlung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Behandlung'");
		if ($r_funkWasserBehandlung > 4 Or !is_numeric($r_funkWasserBehandlung)) {$r_funkWasserBehandlung = 0;}
		$r_funkWasserTrinkwassereinsparung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Trinkwassereinsparung'");
		if ($r_funkWasserTrinkwassereinsparung > 4 Or !is_numeric($r_funkWasserTrinkwassereinsparung)) {$r_funkWasserTrinkwassereinsparung = 0;}
		$r_funkWasserNährstoffrückgewinnung = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Nährstoffrückgewinnung'");
		if ($r_funkWasserNährstoffrückgewinnung > 4 Or !is_numeric($r_funkWasserNährstoffrückgewinnung)) {$r_funkWasserNährstoffrückgewinnung = 0;}
		$r_funkWasserÜberflutungsvorsorge = get_wert("'Wirkung/Funktion'", "'Wasser'", "'Starkregen-, Überflutungsvorsorge'");
		if ($r_funkWasserÜberflutungsvorsorge > 4 Or !is_numeric($r_funkWasserÜberflutungsvorsorge)) {$r_funkWasserÜberflutungsvorsorge = 0;}
						

		$r_funkBaustoffeVermeidung = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Vermeidung'");
		if ($r_funkBaustoffeVermeidung > 4 Or !is_numeric($r_funkBaustoffeVermeidung)) {$r_funkBaustoffeVermeidung = 0;}
		$r_funkBaustoffeWiederverwendung = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Wiederverwendung'");
		if ($r_funkBaustoffeWiederverwendung > 4 Or !is_numeric($r_funkBaustoffeWiederverwendung)) {$r_funkBaustoffeWiederverwendung = 0;}
		$r_funkBaustoffeRecycling = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Recycling'");
		if ($r_funkBaustoffeRecycling > 4 Or !is_numeric($r_funkBaustoffeRecycling)) {$r_funkBaustoffeRecycling = 0;}
		$r_funkBaustoffeVerwertung = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Verwertung'");
		if ($r_funkBaustoffeVerwertung > 4 Or !is_numeric($r_funkBaustoffeVerwertung)) {$r_funkBaustoffeVerwertung = 0;}
		$r_funkBaustoffeBeseitigung = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Beseitigung'");
		if ($r_funkBaustoffeBeseitigung > 4 Or !is_numeric($r_funkBaustoffeBeseitigung)) {$r_funkBaustoffeBeseitigung = 0;}
/* 		$r_funkBaustoffeRohstoffverfügbarkeit = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Rohstoffverfügbarkeit'");
		$r_funkBaustoffeRohstoffaufwand = get_wert("'Wirkung/Funktion'", "'Baustoffe'", "'Rohstoffaufwand (gesamt)'"); */
		

		$r_funkFlächeKlimaanpassung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Klimaanpassung'");
		if ($r_funkFlächeKlimaanpassung > 4 Or !is_numeric($r_funkFlächeKlimaanpassung)) {$r_funkFlächeKlimaanpassung = 0;}
		$r_funkFlächeGesundheitsschutz = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Gesundheitsschutz'");
		if ($r_funkFlächeGesundheitsschutz > 4 Or !is_numeric($r_funkFlächeGesundheitsschutz)) {$r_funkFlächeGesundheitsschutz = 0;}
		$r_funkFlächeEinsparung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Erhalt d. Grunddaseinsfunktion'");
		if ($r_funkFlächeEinsparung > 4 Or !is_numeric($r_funkFlächeEinsparung)) {$r_funkFlächeEinsparung = 0;}
		$r_funkFlächeLuftreinhaltung = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Naturschutz'");
		if ($r_funkFlächeLuftreinhaltung > 4 Or !is_numeric($r_funkFlächeLuftreinhaltung)) {$r_funkFlächeLuftreinhaltung = 0;}
		$r_funkFlächeBiodiversität = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Klimaschutz'");
		if ($r_funkFlächeBiodiversität > 4 Or !is_numeric($r_funkFlächeBiodiversität)) {$r_funkFlächeBiodiversität = 0;}
		/* $r_funkFlächeAufenthaltsqualität = get_wert("'Wirkung/Funktion'", "'Fläche'", "'Aufenthalts-/ Freiraumqualität'"); */

/* 		$r_funkSchmutzwasserGesundheitsvorsorge = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Gesundheitsvorsorge'");
		$r_funkSchmutzwasserGewässerschutz = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Gewässerschutz'");
		$r_funkSchmutzwasserTrinwassereinsparung = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Trinwassereinsparung'");
		$r_funkSchmutzwasserNährstoffrückgewinnung = get_wert("'Wirkung/Funktion'", "'Schmutzwasser'", "'Nährstoffrückgewinnung'"); */

		$r_funkEnergieEnergiebereitstellung = get_wert("'Wirkung/Funktion'", "'Energie'", "'Energiebereitstellung'");
		if ($r_funkEnergieEnergiebereitstellung > 4 Or !is_numeric($r_funkEnergieEnergiebereitstellung)) {$r_funkEnergieEnergiebereitstellung = 0;}
		$r_funkEnergieEnergieverteilung = get_wert("'Wirkung/Funktion'", "'Energie'", "'Energieverteilung'");
		if ($r_funkEnergieEnergieverteilung > 4 Or !is_numeric($r_funkEnergieEnergieverteilung)) {$r_funkEnergieEnergieverteilung = 0;}
		$r_funkEnergieEnergieverbrauch = get_wert("'Wirkung/Funktion'", "'Energie'", "'Energieverbrauch'");
		if ($r_funkEnergieEnergieverbrauch > 4 Or !is_numeric($r_funkEnergieEnergieverbrauch)) {$r_funkEnergieEnergieverbrauch = 0;}
		$r_funkEnergieEnergiespeicherung = get_wert("'Wirkung/Funktion'", "'Energie'", "'Energiespeicherung'");
		if ($r_funkEnergieEnergiespeicherung > 4 Or !is_numeric($r_funkEnergieEnergiespeicherung)) {$r_funkEnergieEnergiespeicherung = 0;}
		$r_funkEnergieElektrizität = get_wert("'Wirkung/Funktion'", "'Energie'", "'Elektrizität'");
		if ($r_funkEnergieElektrizität > 4 Or !is_numeric($r_funkEnergieElektrizität)) {$r_funkEnergieElektrizität = 0;}
		$r_funkEnergieWärme = get_wert("'Wirkung/Funktion'", "'Energie'", "'Wärme'");
		if ($r_funkEnergieWärme > 4 Or !is_numeric($r_funkEnergieWärme)) {$r_funkEnergieWärme = 0;}
		$r_funkEnergieBrennstoffe = get_wert("'Wirkung/Funktion'", "'Energie'", "'Brennstoffe'");
		if ($r_funkEnergieBrennstoffe > 4 Or !is_numeric($r_funkEnergieBrennstoffe)) {$r_funkEnergieBrennstoffe = 0;}
		
		$r_anwendungsebeneGebäude = get_wert("'Anwendungsebene'", "'Gebäudeebene'");
		$r_anwendungsebeneGrundstück = get_wert("'Anwendungsebene'", "'Grundstücksebene'");
		$r_anwendungsebeneQuartier = get_wert("'Anwendungsebene'", "'Quartiersebene'");

		$r_FlaechenbedarfEW = get_wert("'Flächenbedarf'","'m²/EW'");
		$r_FlaechenbedarfXX = get_wert("'Flächenbedarf'","'XX'");
		$r_Flaechenbedarfm2XX = get_wert("'Flächenbedarf'","'m²/XX'");

		$r_Nutzungsdauer_min = get_wert("'Nutzungsdauer'","'min'");
		$r_Nutzungsdauer_max = get_wert("'Nutzungsdauer'","'max'");
		$r_Nutzungsdauer_ueblich = get_wert("'Nutzungsdauer'","'üblich'");

		$r_EntwicklungsstandWissenschaftTechnik = get_wert("'Entwicklungsstand'","'Stand der Wissenschaft und Technik'");
		$r_EntwicklungsstandTechnik = get_wert("'Entwicklungsstand'","'Stand der Technik'");
		$r_EntwicklungsstandAnerkanntTechnik = get_wert("'Entwicklungsstand'","'mAllgemein annerkannter Stand der Technikin'");
		$r_Sammelhinweis = get_wert("'Sammelhinweis'","'Hinweis'");

		$r_Funktionsbeschreibung = get_wert("'Funktionsbeschreibung und Aufbau'");
		$r_Systemskizze_Bild = get_wert("'Systemskizze'","'Bild'");
		$r_Systemskizze_Bild = substr($r_Systemskizze_Bild, 2);
		$r_Systemskizze_Beschriftung = get_wert("'Systemskizze'","'Beschriftung'");
		$r_Systemskizze_uptime = get_wert("'Systemskizze'","'uptime'");

		$r_Planung_freetext = get_wert("'Planung, Bemessung und rechtliche Aspekte'","'Fließtext'");
		$q_PlanungNormen = $q_template . "(ebene2 LIKE 'Normen/Regelwerke_' OR ebene2 LIKE 'Titel/Inhalt_') ORDER BY ebene2";
		$r_PlanungNormen = mysqli_query($conn, $q_PlanungNormen);
		$r_PlanungNormen = mysqli_fetch_all($r_PlanungNormen, MYSQLI_ASSOC);

		$r_Aufwand_freetext = get_wert("'Aufwand und Kosten'","'Fließtext'");
		// $q_Aufwand_Investitionskosten  = $q_template . "(ebene2 LIKE 'Betriebskosten_' OR ebene2 LIKE 'Investitionskosten_') ORDER BY ebene2";
		// $r_Aufwand_Investitionskosten  = mysqli_query($conn, $q_Aufwand_Investitionskosten );
		// $r_Aufwand_Investitionskosten  = mysqli_fetch_all($r_Aufwand_Investitionskosten , MYSQLI_ASSOC);
		$q_Aufwand_i1 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten1'";
		$q_Aufwand_i2 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten2'";
		$q_Aufwand_i3 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten3'";
		$q_Aufwand_i4 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten4'";
		$q_Aufwand_i5 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Investitionskosten5'";
		$q_Aufwand_b1 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten1'";
		$q_Aufwand_b2 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten2'";
		$q_Aufwand_b3 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten3'";
		$q_Aufwand_b4 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten4'";
		$q_Aufwand_b5 = $q_template . "ebene1 = 'Aufwand und Kosten' AND ebene2 = 'Betriebskosten5'";

		$r_Aufwand_i1 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i1), MYSQLI_NUM);
		$r_Aufwand_i2 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i2), MYSQLI_NUM);
		$r_Aufwand_i3 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i3), MYSQLI_NUM);
		$r_Aufwand_i4 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i4), MYSQLI_NUM);
		$r_Aufwand_i5 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_i5), MYSQLI_NUM);
		$r_Aufwand_b1 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b1), MYSQLI_NUM);
		$r_Aufwand_b2 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b2), MYSQLI_NUM);
		$r_Aufwand_b3 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b3), MYSQLI_NUM);
		$r_Aufwand_b4 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b4), MYSQLI_NUM);
		$r_Aufwand_b5 = mysqli_fetch_all(mysqli_query($conn, $q_Aufwand_b5), MYSQLI_NUM);

		$r_Aufwand_hinweis = get_wert("'Aufwand und Kosten'","'Hinweis'");


		$r_Weitergehende_freetext = get_wert("'Weitergehende Hinweise'","'Fließtext'");
		$q_Weitergehende_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Weitergehende Hinweise' AND (ebene2 = 'Parameter' OR ebene2 = 'Wert') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_Weitergehende_table = mysqli_fetch_all(mysqli_query($conn, $q_Weitergehende_table), MYSQLI_NUM);

		$r_AspekteSynNiederschlag = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Niederschlagswasser'");
		$r_AspekteSynSchmutzwasser = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Schmutzwasser'");
		$r_AspekteSynBaustoffe = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Baustoffe'");
		$r_AspekteSynEnergie = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Energie'");
		$r_AspekteSynFläche = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Fläche'");
		$r_AspekteSynÖkobilanz = get_wert("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Ökobilanz'");
		$r_AspekteKonfNiederschlag = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Niederschlagswasser'");
		$r_AspekteKonfSchmutzwasser = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Schmutzwasser'");
		$r_AspekteKonfBaustoffe = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Baustoffe'");
		$r_AspekteKonfEnergie = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Energie'");
		$r_AspekteKonfFläche = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Fläche'");
		$r_AspekteKonfÖkobilanz = get_wert("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Ökobilanz'");
		
		$q_VorNach_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Vor- und Nachteile' AND (ebene2 = 'Vorteile' OR ebene2 = 'Nachteile') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_VorNach_table = mysqli_fetch_all(mysqli_query($conn, $q_VorNach_table), MYSQLI_NUM);

		$q_Bewertung_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Ökobilanzielle Bewertung' AND (ebene2 = 'Literaturstelle' OR ebene2 = 'Bewertung') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_Bewertung_table = mysqli_fetch_all(mysqli_query($conn, $q_Bewertung_table), MYSQLI_NUM);

		$q_Fallbsp1 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '1'";
		$r_Fallbsp1 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp1), MYSQLI_NUM);
		$q_Fallbsp2 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '2'";
		$r_Fallbsp2 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp2), MYSQLI_NUM);
		$q_Fallbsp3 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '3'";
		$r_Fallbsp3 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp3), MYSQLI_NUM);

		$q_Kombi = "SELECT ebene2, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Kombinationsmöglichkeiten' ORDER BY CONVERT(ebene2, SIGNED INTEGER)";
		$r_Kombi = mysqli_fetch_all(mysqli_query($conn, $q_Kombi), MYSQLI_NUM);
		$r_Kombi_titel = $r_Kombi;
		
		for ($i=0; $i < 20 ; $i++) {
			$r_Kombi[$i][1] = substr($r_Kombi[$i][1], 6);
			$r_Kombi[$i][0] = get_id("'" . $r_Kombi[$i][1] . "'");
			$name_kombi = get_wert_id("'" . $r_Kombi[$i][0] . "'","'Titel'");
			if ($name_kombi!="") {
				$r_Kombi[$i][1] = $name_kombi;
			} else {if ($r_Kombi[$i][0]!="") {
				$r_Kombi[$i][1] = "!!Titel noch nicht vorhanden!!";
			}
			}
			
		}


	} else echo "Not a valid ID!"; 

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="styles.css">
		<!-- <link rel="stylesheet" href="footer-styles.css"> -->
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
		<div class = "results">
			<div class="tab">
			  <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'Kurzinformation')">Kurzinformation</button>
			  <button class="tablinks" onclick="openCity(event, 'Detailinformation')">Detailinformation</button>
			</div>
			<div>
			<!hr class="hline_top">
			<div id="Kurzinformation" class="tabcontent">




				<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
				<br>
				<br>
				<br>
				<br>
				<h3><?php echo $r_Titel; ?></h3>

				
				<h5>Kurzinformation</h5>
				<div id="kurzBox" class="greenBox"> 
					<p>
						<?php textParsedown($r_Kurzbeschreibung);?>
					</p>
				</div>
				<div id="imageBox" class="whiteBox">
					<h4>Umsetzungsbeispiel</h4>
						<p>
							<div id="imageCenter" class="img_center">
								<img class="figure_bsp" src=<?php echo "'" . $r_Umsetzungsbeispiel_Bild . "'"; ?>>
								<!-- <img class="figure_bsp" src="Umsetzungsbeispiele/N_004_Gruendachbsp.png"> -->
								<br>
								<br>
							
							<?php textParsedown("<figcaption><figcaptionPre>Abb. 1: </figcaptionPre>" . $r_Umsetzungsbeispiel_Beschriftung . "</figcaption>");?>
							</div>
						</p>
				</div>

				<div id="resBox" class="greenBox">
					<h6>Ressource</h6>
						<table class="resTable">
							<tbody>
								<tr class="hlineHead">
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
				<h4>Funktion</h4>
							<table class="resTable">
								<tbody>
									<tr class="hlineHead">
										<td class="gray"> Wasser </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserVerdunstung . "'>&nbsp;</div>"?> Förderung Verdunstung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserGrundwasserneubildung . "'>&nbsp;</div>"?> Förderung Grundwasserneubildung</td>
										</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserBehandlung . "'>&nbsp;</div>"?> Behandlung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserTrinkwassereinsparung . "'>&nbsp;</div>"?> Trinkwassereinsparung</td>
										</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserNährstoffrückgewinnung . "'>&nbsp;</div>"?> Nährstoffrückgewinnung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserÜberflutungsvorsorge . "'>&nbsp;</div>"?> Starkregen-, Überflutungsvorsorge</td>
																			
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserAbfluss . "'>&nbsp;</div>"?> Minderung Abfluss</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserSammlung . "'>&nbsp;</div>"?> Sammlung und Ableitung</td>
																			
									</tr>

									<tr class="hline">
										<td class="gray"> Baustoffe </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeVermeidung . "'>&nbsp;</div>"?> Vermeidung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeWiederverwendung . "'>&nbsp;</div>"?> Wiederverwendung</td>
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeVerwertung . "'>&nbsp;</div>"?> Verwertung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeBeseitigung . "'>&nbsp;</div>"?> Beseitigung</td>										
									</tr>
									<tr>
										<td> </td>	
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeRecycling . "'>&nbsp;</div>"?> Recycling</td>									
									</tr>
									<tr class="hline">
										<td class="gray"> Energie </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergiebereitstellung . "'>&nbsp;</div>"?> Energiebereitstellung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergieverteilung . "'>&nbsp;</div>"?> Energieverteilung</td>	
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergieverbrauch . "'>&nbsp;</div>"?> Energieverbrauch</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergiespeicherung . "'>&nbsp;</div>"?> Energiespeicherung</td>	
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieElektrizität . "'>&nbsp;</div>"?> Elektrizität</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieWärme . "'>&nbsp;</div>"?> Wärme</td>
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieBrennstoffe . "'>&nbsp;</div>"?> Brennstoffe</td>
									</tr>

									<tr class="hline">
										<td class="gray"> Fläche </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeKlimaanpassung . "'>&nbsp;</div>"?> Klimaanpassung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeGesundheitsschutz . "'>&nbsp;</div>"?> Gesundheitsschutz</td>
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeEinsparung . "'>&nbsp;</div>"?> Erhalt d. Grunddaseinsfunktion</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeLuftreinhaltung . "'>&nbsp;</div>"?> Naturschutz</td>
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeBiodiversität . "'>&nbsp;</div>"?> Klimaschutz</td>
									</tr>
								</tbody>
							</table>
							<br>
							<strong>Legende:&nbsp;</strong><br>
							<div class = cbDescr>
							<div id='checkbox' class='cb0'></div> kein Wirkpotential &nbsp;&nbsp;&nbsp; 
							<div id='checkbox' class='cb1'></div> Wirkpotential vorhanden &nbsp;&nbsp;&nbsp; 
							<div id='checkbox' class='cb2'></div> geringes Wirkpotential &nbsp;&nbsp;&nbsp; 
							<div id='checkbox' class='cb3'></div> mittlerer Wirkpotential &nbsp;&nbsp;&nbsp; 
							<div id='checkbox' class='cb4'></div> hohes Wirkpotential &nbsp;&nbsp;&nbsp; 
							</div></div>
						<br>
						<br>

						<div class="whiteBox">
						<table class="resTable">
							<thead class="header">
								<td>Anwendungsebene</td>
								<td>Flächenbedarf</td>
								<td>Nutzungsdauer (Jahre)</td>
								<td>Entwicklungsstand</td>
								
							</thead>
							<tbody>
								<tr class="hline">
									<td><input type="checkbox"  <?php echo ($r_anwendungsebeneGebäude==1)? "checked":""; ?> onclick="return false;"> Gebäude</td>
									<td><?php textParsedown($r_FlaechenbedarfEW . " m²/EW") ?> </td>
									<td><?php textParsedown("Min:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" . $r_Nutzungsdauer_min) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandWissenschaftTechnik==1)? "checked":""; ?> onclick="return false;"> Stand der Wissenschaft und Technik</td>
								</tr>
								<tr>
									<td><input type="checkbox"  <?php echo ($r_anwendungsebeneGrundstück==1)? "checked":""; ?> onclick="return false;"> Grundstück</td>
									<td><?php textParsedown($r_Flaechenbedarfm2XX . " m²/" . $r_FlaechenbedarfXX) ?></td>
									<td><?php textParsedown("Max: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" . $r_Nutzungsdauer_max) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandTechnik==1)? "checked":""; ?> onclick="return false;"> Stand der Technik</td>
								</tr>
								<tr>
									<td><input type="checkbox"  <?php echo ($r_anwendungsebeneQuartier==1)? "checked":""; ?> onclick="return false;"> Quartier</td>
									<td></td>
									<td><?php textParsedown("Üblich:&nbsp; &nbsp; &nbsp; &nbsp;" . $r_Nutzungsdauer_ueblich) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandAnerkanntTechnik==1)? "checked":""; ?> onclick="return false;"> Allgemein annerkanter Stand der Technik</td>
								</tr>
							</tbody>
						</table>

						<p>
							<Div class="boldGray">Hinweis:</Div>
							<?php textParsedown($r_Sammelhinweis);?>
						</p>
					</div>
					<br><br><br><br><br><br>
			</div>
			
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

			<div id="Detailinformation" class="tabcontent">
			
			<br><br><br><br>

			<h3><?php echo $r_Titel; ?></h3>
				<h5>Detailinformationen</h5>
				<div id="resBox" class="greenBox">
					<h6>Funktionsbeschreibung und Aufbau</h6>
					
					<p>
						<?php textParsedown($r_Funktionsbeschreibung);?>
					</p>
				</div>


				
				<div class="whiteBox">
				
					<h4>Systemskizze</h4>
					<p>
						<div class="img_center">
							<img class="figure_bsp" src=<?php echo "'" . $r_Systemskizze_Bild . "'"; ?>>
							<br>
							<br>
							<?php textParsedown("<figcaption><figcaptionPre>Abb. 2: </figcaptionPre>" . $r_Systemskizze_Beschriftung . "</figcaption>") ?>
						</div>
					</p>
				
					<h4>Planung, Bemessung und rechtliche Aspekte</h4>
				
					<p>
						<?php textParsedown($r_Planung_freetext);?>
					</p>
					
					<?php 
						if(!empty($r_PlanungNormen))
						{
							echo "
							<table class='resTable'>
								<colgroup>
									<col style='width:30%'>
									<col style='width:70%'>
								</colgroup>
									<thead class='headerBlack'>
										<td>Norm/Regelwerk</td>
										<td>Titel</td>
									</thead>";
									for ($i = 0; $i < 5; $i++)
									{
										if ($r_PlanungNormen[$i]['wert']!="" or $r_PlanungNormen[$i+5]['wert']!="" ) {
											textParsedown("<tr class='hline'><td>" .  $r_PlanungNormen[$i]['wert'] . "</td>");
											textParsedown("<td>" . $r_PlanungNormen[$i+5]['wert'] . "</td></tr>");
										}
										
									}							
							echo "</table>";
						}
					?>
				
					<h4>Aufwand und Kosten</h4>
					<p>
						<?php textParsedown($r_Aufwand_freetext);?>
					</p>

					<p>			
						<?php 
						echo "<table class='resTable'>
							<colgroup>
								<col style='width:10%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:10%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
								<col style='width:6.66666%'>
							</colgroup>
						<thead class='headerBlack'><td colspan='6'>Investitionskosten</td><td colspan='6'>Betriebskosten</td></thead>
							<tr><td>&nbsp</td>";
							for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_i" . $i}[0][0]!="")?"<td class='gray'>€/" . ${"r_Aufwand_i" . $i}[0][0] . "</td>":"<td>&nbsp</td>";
								}
								echo "<td class='gray'>&nbsp</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_b" . $i}[0][0]!="")?"<td class='gray'>€/" . ${"r_Aufwand_b" . $i}[0][0] . "</td>":"<td>&nbsp</td>";
								}
							echo "</tr>";
							echo "<tr class='hline'><td class='gray'>min</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_i" . $i}[1][0]!="")?"<td>" . ${"r_Aufwand_i" . $i}[1][0] . "</td>":"<td>&nbsp</td>";
								}
								echo "<td class='gray'>min</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_b" . $i}[1][0]!="")?"<td>" . ${"r_Aufwand_b" . $i}[1][0] . "</td>":"<td>&nbsp</td>";
								}
							echo "</tr>";
							echo "<tr class='hline'><td class='gray'>max</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_i" . $i}[2][0]!="")?"<td>" . ${"r_Aufwand_i" . $i}[2][0] . "</td>":"<td>&nbsp</td>";
								}
								echo "<td class='gray'>max</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_b" . $i}[2][0]!="")?"<td>" . ${"r_Aufwand_b" . $i}[2][0] . "</td>":"<td>&nbsp</td>";
								}
							echo "</tr>";
							echo "<tr class='hline'><td class='gray'>üblich</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_i" . $i}[3][0]!="")?"<td>" . ${"r_Aufwand_i" . $i}[3][0] . "</td>":"<td>&nbsp</td>";
								}
								echo "<td class='gray'>üblich</td>";
								for ($i = 1; $i < 6; $i++)
								{echo ( ${"r_Aufwand_b" . $i}[3][0]!="")?"<td>" . ${"r_Aufwand_b" . $i}[3][0] . "</td>":"<td>&nbsp</td>";
								}
							echo "</tr>";
						echo "</table>";					
						?>
					</p>
					
					<p>
					<Div class="boldGray">Hinweis:</Div>
						<?php textParsedown($r_Aufwand_hinweis);?>
					</p>
				
					<h4>Weitergehende Hinweise</h4>				
					<p>
						<?php textParsedown($r_Weitergehende_freetext);?>
					</p>
					<p>
						<?php 
							if(!empty($r_Weitergehende_table))
							{
								echo "
								<table class='resTable'>
									<colgroup>
										<col style='width:30%'>
										<col style='width:70%'>
									</colgroup>
									<thead class='headerBlack'>
										<td>Parameter</td>
										<td>Wert</td>
									</thead>";
									for ($i = 0; $i < 20; $i++)
									{
										if ($r_Weitergehende_table[$i][1]!="" or $r_Weitergehende_table[$i+20][1]!="") {
											textParsedown("<tr class='hline'><td>" . $r_Weitergehende_table[$i][1] . "</td>");
											echo "<td>" . $r_Weitergehende_table[$i+20][1] . "</td></tr>";
										} 
									}							
								echo "</table>";
							}
						?>
					</p>

					<p>
					<h4>Ressourcenübergreifende Aspekte</h4>	
						<?php 
							if(!empty($r_Weitergehende_table))
							{
								textParsedown(
									"<table class='resTable'>
									<colgroup>
										<col style='width:20%'>
										<col style='width:40%'>
										<col style='width:40%'>
									</colgroup>
									<thead class='headerBlack'>
										<td></td>
										<td>Synergien</td>
										<td>Zielkonflikte</td>
									</thead>
									
										<tr class='hline'>
										<td class='gray'>Niederschlagswasser</td>
										<td>" . $r_AspekteSynNiederschlag . "</td>
										<td>" . $r_AspekteKonfNiederschlag . "</td></tr>
										
										<tr class='hline'>
										<td class='gray'>Schmutzwasser</td>
										<td>" . $r_AspekteSynSchmutzwasser . "</td>
										<td>" . $r_AspekteKonfSchmutzwasser . "</td></tr>
										
										<tr class='hline'>
										<td class='gray'>Baustoffe</td>
										<td>" . $r_AspekteSynBaustoffe . "</td>
										<td>" . $r_AspekteKonfBaustoffe . "</td></tr>
										
										<tr class='hline'>
										<td class='gray'>Energie</td>
										<td>" . $r_AspekteSynEnergie . "</td>
										<td>" . $r_AspekteKonfEnergie . "</td></tr>
										
										<tr class='hline'>
										<td class='gray'>Fläche</td>
										<td>" . $r_AspekteSynFläche . "</td>
										<td>" . $r_AspekteKonfFläche . "</td></tr>
										</table>");
							}
						?>
					</p>

					<h4>Ökobilanzielle Bewertung</h4>
						<?php 
							if(!empty($r_Bewertung_table))
							{
								echo "
								<table class='resTable'>
									<colgroup>
										<col style='width:30%'>
										<col style='width:70%'>
									</colgroup>
									<thead class='headerBlack'>
										<td>Literaturstelle</td>
										<td>Bewertung</td>
									</thead>";
									for ($i = 0; $i < 10; $i++)
									{
										if ($r_Bewertung_table[$i][1]!="" or $r_Bewertung_table[$i+10][1]!="") {
											textParsedown("<tr class='hline'><td>" . $r_Bewertung_table[$i+10][1] . "</td>");
											textParsedown("<td>" . $r_Bewertung_table[$i][1] . "</td></tr>");
										} 
									}							
								echo "</table>";
							}
						?>
					</p>


					<h4>Kombinationsmöglichkeiten</h4>
					
					<?php 
					echo "<table>";
					
					for($i = 0; $i < 20; $i++){
						if ($r_Kombi[$i][1]!="") {						
						echo "<tr><td><a class='bold' href='http://r2q.fh-muenster.de:8081/R2Q_Frontend/details.php?id=" . $r_Kombi[$i][0] . "'>";
						echo $r_Kombi[$i][1];
						echo "</a></td></tr>";
						}
					}
					echo "</table>";
					?>
					<p>

					<h4>Vor- und Nachteile</h4>
						<?php 
							if(!empty($r_VorNach_table))
							{
								echo "
								<table class='resTable'>
									<colgroup>
										<col style='width:50%'>
										<col style='width:50%'>
									</colgroup>
									<thead class='headerBlack'>
										<td>Vorteile</td>
										<td>Nachteile</td>
									</thead>";
									for ($i = 0; $i < 10; $i++)
									{
										if ($r_VorNach_table[$i][1]!="" or $r_VorNach_table[$i+10][1]!="") {
											textParsedown("<tr class='hline'><td>" . $r_VorNach_table[$i+10][1] . "</td>");
											textParsedown("<td>" . $r_VorNach_table[$i][1] . "</td></tr>");
										}
									}
								echo "</table>";
							}
						?>
					</p>


					<p>	
					<h4>Fallbeispiele</h4>		
						<?php 
						echo "<table class='resTable'>
							<colgroup>
								<col style='width:20'>
								<col style='width:15%'>
								<col style='width:15%'>
								<col style='width:50%'>
							</colgroup>
							<thead class='headerBlack'><td>Projektname</td><td>Stadt</td><td>Land</td><td>Erläuterung</td></thead>
							<tr class='hline'>";
								if ($r_Fallbsp1[0][0]!="" or $r_Fallbsp1[1][0]!="" or $r_Fallbsp1[2][0]!="" or $r_Fallbsp1[3][0]!="") {
									textParsedown("<td>" . $r_Fallbsp1[2][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp1[3][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp1[1][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp1[0][0] . "</td>");
								}
							echo "</tr>
							<tr class='hline'>";
								if ($r_Fallbsp2[0][0]!="" or $r_Fallbsp2[1][0]!="" or $r_Fallbsp2[2][0]!="" or $r_Fallbsp2[3][0]!="") {
									textParsedown("<td>" . $r_Fallbsp2[2][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp2[3][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp2[1][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp2[0][0] . "</td>");
								}
							echo "</tr>
							<tr class='hline'>";
								if ($r_Fallbsp3[0][0]!="" or $r_Fallbsp3[1][0]!="" or $r_Fallbsp3[2][0]!="" or $r_Fallbsp3[3][0]!="") {
									textParsedown("<td>" . $r_Fallbsp3[2][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp3[3][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp3[1][0] . "</td>");
									textParsedown("<td>" . $r_Fallbsp3[0][0] . "</td>");
								}
							echo "</tr>";
								
						echo "</table>";					
						?>
					</p>


				</div>	
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				</div>
				<?php include 'comments.php'; ?>

				&nbsp;<br>
				&nbsp;<br>
				&nbsp;<br>
			</div>
		
			
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
				
		</div>
		<?php include 'footer.php'; ?>
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