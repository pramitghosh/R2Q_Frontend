<?php
include 'parsedown-1.7.4/Parsedown.php';
require 'outputValues.php';
require_once __DIR__ . '/vendor/autoload.php';
$IMGpath = "startBackground2.jpg";

$mpdf = new \Mpdf\Mpdf();
$mpdf->setAutoTopMargin = 'stretch';
// $stylesheet = '<style>'.file_get_contents('pdf_style.css').'</style>';
$stylesheet = file_get_contents('pdf_style.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->Image('startBackground.png', 0, 0, 210, 297, 'png', '', true, false);

// Header for every Page
$mpdf->SetHTMLHeader("
<div class='header'>
Maßnahmenkatalog
<div class='hlineHeader'></div>
</div>");


// Footer for every page
$mpdf->SetHTMLFooter("
<div style='text-align: right; font-weight: bold;'>
    <img class='figure_bsp' src='LogofooterNT.png'; >
</div>");


//Kurzinformation///////////////////////////////////////////////////////////////////////////////////
// Titel + Kurzbeschreibung

$mpdf->WriteHTML("<h3 style = 'width: 1000px; text-align: justify;'>" . $r_Titel . "</h3>
    <h5>Kurzinformation</h5>
	<div id='kurzBox' class='greenBox'> 
		<p>"
			. $r_Kurzbeschreibung . 
		"</p>
	</div>");

// Umsetzungsbeispiel Bild + Beschriftung 

if (strlen($r_Umsetzungsbeispiel_Bild) != 0 or strlen($r_Umsetzungsbeispiel_Beschriftung) != 0) {
    $mpdf->WriteHTML("<div id='imageBox' class='whiteBox'>
        <h4>Umsetzungsbeispiel</h4>
        <div id='imageCenter' class='img_center'>
            <img class='figure_bsp' src='" . $r_Umsetzungsbeispiel_Bild . "'; >
            <br>
            <br>");
            $parsedown = new Parsedown(); $html = $parsedown->text("<figcaption><figcaptionPre>Abb. 1: </figcaptionPre>" . $r_Umsetzungsbeispiel_Beschriftung . "</figcaption>");
            $mpdf->WriteHTML($html . "</div>
    </div>");
    }


// Ressourcen Checkboxen
    ($r_ResNiederschlag==1)? $cb1='"checked"':$cb1="";
    ($r_ResSchmutzwasser==1)? $cb2='"checked"':$cb2="";
    ($r_ResBaustoffe==1)? $cb3='"checked"':$cb3="";
    ($r_ResEnergie==1)? $cb4='"checked"':$cb4="";
    ($r_ResFläche==1)? $cb5='"checked"':$cb5="";

$mpdf->WriteHTML('<div id="resBox" class="greenBox">
<h6>Ressource</h6>
    <table class="resTable">
        <tbody>
            <tr class="hlineHead">
                <td><input type="checkbox" checked='. $cb1 . '>Niederschlagswasser</td>
                <td><input type="checkbox"  checked='. $cb2 . '> Schmutzwasser</td>
				<td><input type="checkbox"  checked='. $cb3 . '>  Baustoffe</td>
				<td><input type="checkbox"  checked='. $cb4 . '> Energie</td>
				<td><input type="checkbox"  checked='. $cb5 . '> Fläche</td>
            </tr>
        </tbody>
    </table>
</div>'
);

// Funktion

$mpdf->WriteHTML('<h4>Funktion</h4>
<table class="resTable">
    <tbody>
        <tr class="hlineHead">
            <td class="gray"> Wasser </td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserVerdunstung . '.jpeg">&nbsp;</div> Förderung Verdunstung</td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserGrundwasserneubildung . '.jpeg">&nbsp;</div> Förderung Grundwasserneubildung</td>
            </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserBehandlung . '.jpeg">&nbsp;</div> Behandlung</td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserTrinkwassereinsparung . '.jpeg">&nbsp;</div> Trinkwassereinsparung</td>
            </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserNährstoffrückgewinnung . '.jpeg">&nbsp;</div> Nährstoffrückgewinnung</td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserÜberflutungsvorsorge . '.jpeg">&nbsp;</div> Überflutungsvorsorge</td>                                                
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserAbfluss . '.jpeg">&nbsp;</div> Minderung Abfluss</td>
            <td><img class="cbIMG" src="cb' . $r_funkWasserSammlung . '.jpeg">&nbsp;</div> Sammlung und Ableitung</td>                                                      
        </tr>

        <tr class="hline">
            <td class="gray"> Baustoffe </td>
            <td><img class="cbIMG" src="cb' . $r_funkBaustoffeVermeidung . '.jpeg">&nbsp;</div> Vermeidung</td>
            <td><img class="cbIMG" src="cb' . $r_funkBaustoffeWiederverwendung . '.jpeg">&nbsp;</div> Wiederverwendung</td>
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkBaustoffeVerwertung . '.jpeg">&nbsp;</div> Verwertung</td>
            <td><img class="cbIMG" src="cb' . $r_funkBaustoffeBeseitigung . '.jpeg">&nbsp;</div> Beseitigung</td>									
        </tr>
        <tr>
            <td> </td>	
            <td><img class="cbIMG" src="cb' . $r_funkBaustoffeRecycling . '.jpeg">&nbsp;</div> Recycling</td>								
        </tr>
        <tr class="hline">
            <td class="gray"> Energie </td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieEnergiebereitstellung . '.jpeg">&nbsp;</div> Energiebereitstellung</td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieEnergieverteilung . '.jpeg">&nbsp;</div> Energieverteilung</td>		
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieEnergieverbrauch . '.jpeg">&nbsp;</div> Energieverbrauch</td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieEnergiespeicherung . '.jpeg">&nbsp;</div> Energiespeicherung</td>	
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieElektrizität . '.jpeg">&nbsp;</div> Elektrizität</td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieWärme . '.jpeg">&nbsp;</div> Wärme</td>
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkEnergieBrennstoffe . '.jpeg">&nbsp;</div> Brennstoffe</td>
        </tr>

        <tr class="hline">
            <td class="gray"> Fläche </td>
            <td><img class="cbIMG" src="cb' . $r_funkFlächeKlimaanpassung . '.jpeg">&nbsp;</div> Klimaanpassung</td>
            <td><img class="cbIMG" src="cb' . $r_funkFlächeGesundheitsschutz . '.jpeg">&nbsp;</div> Gesundheitsschutz</td>
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkFlächeEinsparung . '.jpeg">&nbsp;</div> Erhalt d. Grunddaseinsfunktion</td>
            <td><img class="cbIMG" src="cb' . $r_funkFlächeLuftreinhaltung . '.jpeg">&nbsp;</div> Naturschutz</td>
        </tr>
        <tr>
            <td> </td>
            <td><img class="cbIMG" src="cb' . $r_funkFlächeBiodiversität . '.jpeg">&nbsp;</div> Klimaschutz</td>
        </tr>
    </tbody>
</table>
<br>');



// Anwendungsebene + Flächenbedarf + Nutzungsdauer + Entwicklungsstand



//Detailinformationen//////////////////////////////////////////////////////////////////////////////////////



// Funktionsbeschreibung



// Systemskizze


// Planung + Bemessung + rechtliche Aspekte


// Aufwand + Kosen


// Weitergehende Hinweise


// Ressourcenübergreifende Aspekte


// Ökobilanzielle Bewertung 



//Kombinationsmöglichkeiten



// Fallbeispiele 



$mpdf->Output("mpdf.pdf", "I"); // für direkten Download der PDF -> "D" eingeben 