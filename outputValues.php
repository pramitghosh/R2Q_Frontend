<?php 
	require 'sql.php';
	$m_id = $_GET["id"];

	function textparsedown($textInput){
		$Parsedown = new Parsedown();
		return $Parsedown->text($textInput);
	}


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

	function get_wert_NA($e1, $e2=NULL, $e3=NULL){
		global $conn;
		global $m_id;
		$value = get_wert_id($m_id, $e1, $e2, $e3);
		if (strlen($value) == 0) {
			$value = "N/A";
		}

		return $value;
	}

	function get_wert_pd($e1, $e2=NULL, $e3=NULL){
		global $conn;
		global $m_id;

		return textparsedown(get_wert_id($m_id, $e1, $e2, $e3));
	}

	function get_wert_pd_NA($e1, $e2=NULL, $e3=NULL){
		global $conn;
		global $m_id;
		$value = get_wert_id($m_id, $e1, $e2, $e3);
		if (strlen($value) == 0) {
			$value = "N/A";
		}
		return textparsedown($value);
	}

	if (!is_null($m_id))

	{
		$parsedown = new Parsedown();

		$q_template = "SELECT wert FROM joined_massnahme WHERE id = " . $m_id . " AND ";

		$r_Titel = get_wert("'Titel'");
		$r_Kurzbeschreibung =  get_wert_pd("'Kurzbeschreibung'");
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

		$r_FlaechenbedarfEW = get_wert_NA("'Flächenbedarf'","'m²/EW'");
		$r_FlaechenbedarfEW = textparsedown($r_FlaechenbedarfEW . " m²/EW");
		$r_FlaechenbedarfXX = get_wert("'Flächenbedarf'","'XX'");
		$r_Flaechenbedarfm2XX = get_wert("'Flächenbedarf'","'m²/XX'");
		if (strlen($r_Flaechenbedarfm2XX) != 0 or strlen($r_FlaechenbedarfXX) != 0) {
			$r_Flaechenbedarfm2XX = textparsedown($r_Flaechenbedarfm2XX . " m²/" . $r_FlaechenbedarfXX);
		} else {
			$r_Flaechenbedarfm2XX = "";
		}
		
		$r_Nutzungsdauer_min = get_wert_NA("'Nutzungsdauer'","'min'");
		$r_Nutzungsdauer_max = get_wert_NA("'Nutzungsdauer'","'max'");
		$r_Nutzungsdauer_ueblich = get_wert_NA("'Nutzungsdauer'","'üblich'");

		$r_EntwicklungsstandWissenschaftTechnik = get_wert("'Entwicklungsstand'","'Stand der Wissenschaft und Technik'");
		$r_EntwicklungsstandTechnik = get_wert("'Entwicklungsstand'","'Stand der Technik'");
		$r_EntwicklungsstandAnerkanntTechnik = get_wert("'Entwicklungsstand'","'Allgemein annerkannter Stand der Technik'");
		$r_Sammelhinweis = get_wert_pd("'Sammelhinweis'","'Hinweis'");

		$r_Funktionsbeschreibung = get_wert_pd("'Funktionsbeschreibung und Aufbau'");
		$r_Systemskizze_Bild = get_wert("'Systemskizze'","'Bild'");
		$r_Systemskizze_Bild = substr($r_Systemskizze_Bild, 2);
		$r_Systemskizze_Beschriftung = get_wert("'Systemskizze'","'Beschriftung'");
		$r_Systemskizze_uptime = get_wert("'Systemskizze'","'uptime'");

		$r_Planung_freetext = get_wert_pd("'Planung, Bemessung und rechtliche Aspekte'","'Fließtext'");
		$q_PlanungNormen = $q_template . "(ebene2 LIKE 'Normen/Regelwerke_' OR ebene2 LIKE 'Titel/Inhalt_') ORDER BY ebene2";
		$r_PlanungNormen = mysqli_query($conn, $q_PlanungNormen);
		$r_PlanungNormen = mysqli_fetch_all($r_PlanungNormen, MYSQLI_ASSOC);

		$r_Aufwand_freetext = get_wert_pd("'Aufwand und Kosten'","'Fließtext'");
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

		$r_Aufwand_hinweis = get_wert_pd("'Aufwand und Kosten'","'Hinweis'");


		$r_Weitergehende_freetext = get_wert_pd("'Weitergehende Hinweise'","'Fließtext'");
		$q_Weitergehende_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Weitergehende Hinweise' AND (ebene2 = 'Parameter' OR ebene2 = 'Wert') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_Weitergehende_table = mysqli_fetch_all(mysqli_query($conn, $q_Weitergehende_table), MYSQLI_NUM);

		$r_AspekteSynNiederschlag = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Niederschlagswasser'");
		$r_AspekteSynSchmutzwasser = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Schmutzwasser'");
		$r_AspekteSynBaustoffe = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Baustoffe'");
		$r_AspekteSynEnergie = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Energie'");
		$r_AspekteSynFläche = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Synergien'" ,"'Fläche'");
		$r_AspekteKonfNiederschlag = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Niederschlagswasser'");
		$r_AspekteKonfSchmutzwasser = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Schmutzwasser'");
		$r_AspekteKonfBaustoffe = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Baustoffe'");
		$r_AspekteKonfEnergie = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Energie'");
		$r_AspekteKonfFläche = get_wert_pd("'Ressourcenübergreifende Aspekte'","'Zielkonflikte'" ,"'Fläche'");
		
		$r_Bewertung_freetext = get_wert_pd("'Ökobilanzielle Bewertung'","'Fließtext'");
		$q_Bewertung_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Ökobilanzielle Bewertung' AND (ebene2 = 'Literaturstelle' OR ebene2 = 'Bewertung') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_Bewertung_table = mysqli_fetch_all(mysqli_query($conn, $q_Bewertung_table), MYSQLI_NUM);
		
		$q_Kombi = "SELECT ebene2, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Kombinationsmöglichkeiten' ORDER BY CONVERT(ebene2, SIGNED INTEGER)";
		$r_Kombi = mysqli_fetch_all(mysqli_query($conn, $q_Kombi), MYSQLI_NUM);
		$r_Kombi_titel = $r_Kombi;
		
		for ($i=0; $i < count($r_Kombi); $i++) {
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

		$q_VorNach_table = "SELECT ebene3, wert FROM joined_massnahme WHERE id = " . $m_id . " AND ebene1 = 'Vor- und Nachteile' AND (ebene2 = 'Vorteile' OR ebene2 = 'Nachteile') ORDER BY ebene2, CONVERT(ebene3, SIGNED INTEGER)";
		$r_VorNach_table = mysqli_fetch_all(mysqli_query($conn, $q_VorNach_table), MYSQLI_NUM);

		$q_Fallbsp1 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '1'";
		$r_Fallbsp1 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp1), MYSQLI_NUM);
		$q_Fallbsp2 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '2'";
		$r_Fallbsp2 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp2), MYSQLI_NUM);
		$q_Fallbsp3 = $q_template . "ebene1 = 'Fallbeispiele' AND ebene2 = '3'";
		$r_Fallbsp3 = mysqli_fetch_all(mysqli_query($conn, $q_Fallbsp3), MYSQLI_NUM);

		


	} else echo "Not a valid ID!"; 

?>
