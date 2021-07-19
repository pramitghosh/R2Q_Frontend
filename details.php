<?php 
	include 'parsedown-1.7.4/Parsedown.php';

	require 'sql.php';
	require 'outputValues.php';

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

		<!-- <div class="Logo" id="logo"> 
			 
		</div>  -->
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
				<br>
				<br>
				<br>
				<br>
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
				<div id="imageBox" class="whiteBox">
					<h4>Umsetzungsbeispiel</h4>
						<p>
							<div id="imageCenter" class="img_center">
								<img class="figure_bsp" src=<?php echo "'" . $r_Umsetzungsbeispiel_Bild . "'"; ?>>
								<!-- <img class="figure_bsp" src="Umsetzungsbeispiele/N_004_Gruendachbsp.png"> -->
								<br>
								<br>
							<?php $Parsedown = new Parsedown();
							echo "<figcaption><figcaptionPre>Abb. 1: </figcaptionPre>" . $Parsedown->text($r_Umsetzungsbeispiel_Beschriftung) . "</figcaption>"?>
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
										<!-- <td><input type="checkbox"  <?php echo ($r_funkWasserVerdunstung==1)? "checked":""; ?> onclick="return false;"> Förderung Verdunstung</td>
										<td><input type="checkbox"  <?php echo ($r_funkWasserGrundwasserneubildung==1)? "checked":""; ?> onclick="return false;">  Förderung Grundwasserneubildung</td> -->
										<!-- <td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserVerdunstung . "'>"?> Förderung Verdunstung</div></td>
										<td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserGrundwasserneubildung . "'>"?> Förderung Grundwasserneubildung</td> -->
										
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserVerdunstung . "'>&nbsp;</div>"?> Förderung Verdunstung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserGrundwasserneubildung . "'>&nbsp;</div>"?> Förderung Grundwasserneubildung</td>
										</tr>
									<tr>
										<td> </td>
										<!-- <td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserBehandlung . "'>"?> Behandlung</td>
										<td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserTrinkwassereinsparung . "'>"?> Trinkwassereinsparung</td> -->
										
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserBehandlung . "'>&nbsp;</div>"?> Behandlung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserTrinkwassereinsparung . "'>&nbsp;</div>"?> Trinkwassereinsparung</td>
										</tr>
									<tr>
										<td> </td>
										<!-- <td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserNährstoffrückgewinnung . "'>"?> Nährstoffrückgewinnung</td>
										<td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserÜberflutungsvorsorge . "'>"?> Starkregen-, Überflutungsvorsorge</td> -->
										
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserNährstoffrückgewinnung . "'>&nbsp;</div>"?> Nährstoffrückgewinnung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserÜberflutungsvorsorge . "'>&nbsp;</div>"?> Starkregen-, Überflutungsvorsorge</td>
																			
									</tr>
									<tr>
										<td> </td>
										<!-- <td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserAbfluss . "'>"?> Minderung Abfluss</td>
										<td><?php echo "<img class='cbSize' src='cb" . $r_funkWasserSammlung . "'>"?> Sammlung und Ableitung</td> -->
										
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserAbfluss . "'>&nbsp;</div>"?> Minderung Abfluss</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkWasserSammlung . "'>&nbsp;</div>"?> Sammlung und Ableitung</td>
																			
									</tr>
<!--  									<tr class="hline">
										<td class="gray"> Schmutzwasser </td> 
										<td><input type="checkbox"  <?php /* echo ($r_funkSchmutzwasserGesundheitsvorsorge==1)? "checked":""; */ ?> onclick="return false;"> Gesundheitsvorsorge</td>
										<td><input type="checkbox"  <?php /* echo ($r_funkSchmutzwasserGewässerschutz==1)? "checked":""; */ ?> onclick="return false;"> Gewässerschutz</td>
									</tr>
								<tr>
 										<td> </td>
										<td><input type="checkbox"  <?php /* echo ($r_funkSchmutzwasserTrinwassereinsparung==1)? "checked":""; */ ?> onclick="return false;"> Trinkwassereinsparung</td>
										<td><input type="checkbox"  <?php /* echo ($r_funkSchmutzwasserNährstoffrückgewinnung==1)? "checked":""; */ ?> onclick="return false;">  Nährstoffrückgewinnung</td>
 									</tr> 
--> 				
									<tr class="hline">
										<td class="gray"> Baustoffe </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeVermeidung . "'>&nbsp;</div>"?> Vermeidung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeWiederverwendung . "'>&nbsp;</div>"?> Wiederverwendung</td>

										<!-- <td><input type="checkbox"  <?php echo ($r_funkBaustoffeVermeidung==1)? "checked":""; ?> onclick="return false;"> Vermeidung</td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeWiederverwendung==1)? "checked":""; ?> onclick="return false;">  Wiederverwendung</td>																				 -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeVerwertung . "'>&nbsp;</div>"?> Verwertung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeBeseitigung . "'>&nbsp;</div>"?> Beseitigung</td>										
										
										<!-- <td><input type="checkbox"  <?php echo ($r_funkBaustoffeVerwertung==1)? "checked":""; ?> onclick="return false;">  Verwertung</td>
										<td><input type="checkbox"  <?php echo ($r_funkBaustoffeBeseitigung==1)? "checked":""; ?> onclick="return false;">  Beseitigung</td>								 -->
									</tr>
									<tr>
										<td> </td>	
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkBaustoffeRecycling . "'>&nbsp;</div>"?> Recycling</td>									
										
										<!-- <td><input type="checkbox"  <?php echo ($r_funkBaustoffeRecycling==1)? "checked":""; ?> onclick="return false;"> Recycling</td> -->
									</tr>
									
									<tr class="hline">
										<td class="gray"> Energie </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergiebereitstellung . "'>&nbsp;</div>"?> Energiebereitstellung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergieverteilung . "'>&nbsp;</div>"?> Energieverteilung</td>	

										<!-- <td><input type="checkbox"  <?php echo ($r_funkEnergieEnergiebereitstellung==1)? "checked":""; ?> onclick="return false;"> Energiebereitstellung</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieEnergieverteilung==1)? "checked":""; ?> onclick="return false;">  Energieverteilung</td> -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergieverbrauch . "'>&nbsp;</div>"?> Energieverbrauch</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieEnergiespeicherung . "'>&nbsp;</div>"?> Energiespeicherung</td>	

										<!-- <td><input type="checkbox"  <?php echo ($r_funkEnergieEnergieverbrauch==1)? "checked":""; ?> onclick="return false;"> Energieverbrauch</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieEnergiespeicherung==1)? "checked":""; ?> onclick="return false;">  Energiespeicherung</td> -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieElektrizität . "'>&nbsp;</div>"?> Elektrizität</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieWärme . "'>&nbsp;</div>"?> Wärme</td>

										<!-- <td><input type="checkbox"  <?php echo ($r_funkEnergieElektrizität==1)? "checked":""; ?> onclick="return false;"> Elektrizität</td>
										<td><input type="checkbox"  <?php echo ($r_funkEnergieWärme==1)? "checked":""; ?> onclick="return false;">  Wärme</td> -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkEnergieBrennstoffe . "'>&nbsp;</div>"?> Brennstoffe</td>

										<!-- <td><input type="checkbox"  <?php echo ($r_funkEnergieBrennstoffe==1)? "checked":""; ?> onclick="return false;"> Brennstoffe</td>										 -->
									</tr>
									
									<tr class="hline">
										<td class="gray"> Fläche </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeKlimaanpassung . "'>&nbsp;</div>"?> Klimaanpassung</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeGesundheitsschutz . "'>&nbsp;</div>"?> Gesundheitsschutz</td>

										<!-- <td><input type="checkbox"  <?php echo ($r_funkFlächeKlimaanpassung==1)? "checked":""; ?> onclick="return false;"> Klimaanpassung</td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeGesundheitsschutz==1)? "checked":""; ?> onclick="return false;">  Gesundheitsschutz</td> -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeEinsparung . "'>&nbsp;</div>"?> Erhalt d. Grunddaseinsfunktion</td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeLuftreinhaltung . "'>&nbsp;</div>"?> Naturschutz</td>

										<!-- <td><input type="checkbox"  <?php echo ($r_funkFlächeEinsparung==1)? "checked":""; ?> onclick="return false;"> Erhalt d. Grunddaseinsfunktion</td>
										<td><input type="checkbox"  <?php echo ($r_funkFlächeLuftreinhaltung==1)? "checked":""; ?> onclick="return false;">  Naturschutz</td> -->
									</tr>
									<tr>
										<td> </td>
										<td><?php echo "<div id='checkbox' class='cb" . $r_funkFlächeBiodiversität . "'>&nbsp;</div>"?> Klimaschutz</td>
										
										<!-- <td><input type="checkbox"  <?php echo ($r_funkFlächeBiodiversität==1)? "checked":""; ?> onclick="return false;"> Klimaschutz</td> -->
										
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
									<td><?php $Parsedown = new Parsedown(); echo $Parsedown->text($r_FlaechenbedarfEW . " m²/EW") ?> </td>
									<td><?php $Parsedown = new Parsedown(); echo $Parsedown->text("Mindestens: " . $r_Nutzungsdauer_min) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandWissenschaftTechnik==1)? "checked":""; ?> onclick="return false;"> Stand der Wissenschaft und Technik</td>
								</tr>
								<tr>
									<td><input type="checkbox"  <?php echo ($r_anwendungsebeneGrundstück==1)? "checked":""; ?> onclick="return false;"> Grundstück</td>
									<td><?php echo $r_Flaechenbedarfm2XX ?> m²/<?php echo $r_FlaechenbedarfXX ?></td>
									<td><?php $Parsedown = new Parsedown(); echo $Parsedown->text("Maximal: &nbsp; &nbsp; &nbsp;" . $r_Nutzungsdauer_max) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandTechnik==1)? "checked":""; ?> onclick="return false;"> Stand der Technik</td>
								</tr>
								<tr>
									<td><input type="checkbox"  <?php echo ($r_anwendungsebeneQuartier==1)? "checked":""; ?> onclick="return false;"> Quartier</td>
									<td></td>
									<td><?php $Parsedown = new Parsedown(); echo $Parsedown->text("Üblich:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" . $r_Nutzungsdauer_ueblich) ?></td>
									<td><input type="checkbox"  <?php echo ($r_EntwicklungsstandAnerkanntTechnik==1)? "checked":""; ?> onclick="return false;"> Allgemein annerkanter Stand der Technik</td>
								</tr>
							</tbody>
						</table>

						<p>
							<Div class="boldGray">Hinweis:</Div>
							<?php 
								
								echo $parsedown->text($r_Sammelhinweis);
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
			
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

			<div id="Detailinformation" class="tabcontent">
			
			<br>
			<br>
			<br>
			<br>

			<h3><?php echo $r_Titel; ?></h3>
				<h5>Detailinformationen</h5>
				<div id="resBox" class="greenBox">
					<h6>Funktionsbeschreibung und Aufbau</h6>
					
					<p>
						<?php 
							$Parsedown = new Parsedown();
							echo $Parsedown->text($r_Funktionsbeschreibung);
						?>
					</p>
				</div>



				<div class="whiteBox">
				
					<h4>Systemskizze</h4>
					<p>
						<div class="img_center">
							<img class="figure_bsp" src=<?php echo "'" . $r_Systemskizze_Bild . "'"; ?>>
							<!-- <img class="figure_bsp" src="Umsetzungsbeispiele/N_004_Gruendachbsp.png"> -->
							<br>
							<br>
							<figcaption><?php $Parsedown = new Parsedown(); echo "<figcaptionPre>Abb. 2: </figcaptionPre>" . $Parsedown->text($r_Systemskizze_Beschriftung) ?></figcaption>
						</div>
					</p>
				
					<h4>Planung, Bemessung und rechtliche Aspekte</h4>
				
					<p>
						<?php
							$parsedown_Planung = new Parsedown();
							echo $parsedown_Planung->text($r_Planung_freetext);
						?>
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
										$Parsedown_Norm = new Parsedown();
										$Parsedown_Titel = new Parsedown();
										if ($r_PlanungNormen[$i]['wert']!="" or $r_PlanungNormen[$i+5]['wert']!="" ) {
											echo "<tr class='hline'><td>" .  $Parsedown_Norm->text($r_PlanungNormen[$i]['wert']) . "</td>";
											echo "<td>" . $Parsedown_Titel->text($r_PlanungNormen[$i+5]['wert']) . "</td></tr>";
										}
										
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
																		<!-- <p>
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
																		</p> -->
					<p>
					<Div class="boldGray">Hinweis:</Div>
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
											$parsedown_Weitergehende_table0 = new Parsedown();
											$parsedown_Weitergehende_table1 = new Parsedown();

											echo "<tr class='hline'><td>" . $parsedown_Weitergehende_table0->text($r_Weitergehende_table[$i][1]) . "</td>";
											echo "<td>" . $parsedown_Weitergehende_table1->text($r_Weitergehende_table[$i+20][1]) . "</td></tr>";
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
								echo "
								<table class='resTable'>
									<colgroup>
										<col style='width:20%'>
										<col style='width:40%'>
										<col style='width:40%'>
									</colgroup>
									<thead class='headerBlack'>
										<td></td>
										<td>Synergien</td>
										<td>Zielkonflikte</td>
									</thead>";
											$parsedown_table_syn = new Parsedown();
											$parsedown_table_konf = new Parsedown();
											echo "<tr class='hline'>
											<td class='gray'>Niederschlagswasser</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynNiederschlag) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfNiederschlag) . "</td></tr>";

											echo "<tr class='hline'>
											<td class='gray'>Schmutzwasser</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynSchmutzwasser) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfSchmutzwasser) . "</td></tr>";
											
											echo "<tr class='hline'>
											<td class='gray'>Baustoffe</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynBaustoffe) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfBaustoffe) . "</td></tr>";

											echo "<tr class='hline'>
											<td class='gray'>Energie</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynEnergie) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfEnergie) . "</td></tr>";

											echo "<tr class='hline'>
											<td class='gray'>Fläche</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynFläche) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfFläche) . "</td></tr>";

											echo "<tr class='hline'>
											<td class='gray'>Ökobilanz</td>
											<td>" . $parsedown_table_syn->text($r_AspekteSynÖkobilanz) . "</td>";
											echo "<td>" . $parsedown_table_konf->text($r_AspekteKonfÖkobilanz) . "</td></tr>";
								echo "</table>";
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
											$parsedown_Literaturstelle = new Parsedown();
											$parsedown_Bewertung = new Parsedown();

											echo "<tr class='hline'><td>" . $parsedown_Literaturstelle->text($r_Bewertung_table[$i+10][1]) . "</td>";
											echo "<td>" . $parsedown_Bewertung->text($r_Bewertung_table[$i][1]) . "</td></tr>";
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
											$parsedown_Vorteile = new Parsedown();
											$parsedown_Nachteile = new Parsedown();

											echo "<tr class='hline'><td>" . $parsedown_Vorteile->text($r_VorNach_table[$i+10][1]) . "</td>";
											echo "<td>" . $parsedown_Nachteile->text($r_VorNach_table[$i][1]) . "</td></tr>";
										} 
									}							
								echo "</table>";
							}
						?>
					</p>


					<p>			
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
									$parsedown_Fallbeispiele = new Parsedown();
								if ($r_Fallbsp1[0][0]!="" or $r_Fallbsp1[1][0]!="" or $r_Fallbsp1[2][0]!="" or $r_Fallbsp1[3][0]!="") {
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp1[2][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp1[3][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp1[1][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp1[0][0]) . "</td>";
								}
							echo "</tr>
							<tr class='hline'>";
								if ($r_Fallbsp2[0][0]!="" or $r_Fallbsp2[1][0]!="" or $r_Fallbsp2[2][0]!="" or $r_Fallbsp2[3][0]!="") {
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp2[2][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp2[3][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp2[1][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp2[0][0]) . "</td>";
								}
							echo "</tr>
							<tr class='hline'>";
								if ($r_Fallbsp3[0][0]!="" or $r_Fallbsp3[1][0]!="" or $r_Fallbsp3[2][0]!="" or $r_Fallbsp3[3][0]!="") {
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp3[2][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp3[3][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp3[1][0]) . "</td>";
									echo "<td>" . $parsedown_Fallbeispiele->text($r_Fallbsp3[0][0]) . "</td>";
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
		
			
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			
			<?php include 'comments.php'; ?>
		
		
		
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