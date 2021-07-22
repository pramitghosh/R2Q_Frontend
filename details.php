<?php 
	// header('Content-Type: text/html; charset=utf-8');
	include 'parsedown-1.7.4/Parsedown.php';

	require 'sql.php';
	require 'outputValues.php';

	function textParsedown($textInput){
		$Parsedown = new Parsedown();
		echo $Parsedown->text($textInput);
	}

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
		<!-- <div class="Logo" id="logo"> 
			 
		<div>  -->
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
	 
	
	<?php include 'footer.php'; ?>

	</body>
	
</html>