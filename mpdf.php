<?php
include 'parsedown-1.7.4/Parsedown.php';
require 'outputValues.php';
require_once __DIR__ . '/vendor/autoload.php';
$IMGpath = "startBackground2.jpg";

$mpdf = new \Mpdf\Mpdf([
	'default_font' => 'Helevetica'
]);
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
// $stylesheet = '<style>'.file_get_contents('pdf_style.css').'</style>';
$stylesheet = file_get_contents('pdf_style.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->Image('startBackground.png', 0, 0, 210, 297, 'png', '', true, false);

// Header for every Page
$mpdf->SetHTMLHeader("
<table class='header'>
    <colgroup>
        <col style='width:95%'>
        <col style='width:5%'>
    </colgroup>
    <tr><td>Maßnahmensteckbrief " . $r_Titel . "</td>
    <td style='text-align: right'>{PAGENO}</td></tr>
</table>
<div class='hlineHeader'></div><br>");


// Footer for every page
$mpdf->SetHTMLFooter("
<div style='text-align: right; font-weight: bold;'>
    <br>
    <img src='FooterResize.jpg'; >
</div>");


//Kurzinformation///////////////////////////////////////////////////////////////////////////////////
// Titel + Kurzbeschreibung

$mpdf->WriteHTML("<h3 style = 'width: 1000px; text-align: justify;'>" . $r_Titel . "</h3>
    <h5>Kurzinformation</h5>
	<div id='kurzBox' class='greenBox'>" . $r_Kurzbeschreibung . "</div>");

// Umsetzungsbeispiel Bild + Beschriftung 

if (strlen($r_Umsetzungsbeispiel_Bild) != 0 or strlen($r_Umsetzungsbeispiel_Beschriftung) != 0) {
    $parsedown = new Parsedown(); $html = $parsedown->text("<figcaption><strong>Abb. 1:</strong> " . $r_Umsetzungsbeispiel_Beschriftung . "</figcaption>");
    $mpdf->WriteHTML("<div style='page-break-inside: avoid;'>
        <h4>Umsetzungsbeispiel</h4>
        <div id='imageCenter' class='img_center'>
            <img class='figure_bsp' src='" . $r_Umsetzungsbeispiel_Bild . "'; >
            <br>
            <br>
            <div style='text-align: center; margin-bottom: 10px;'>" . $html . "</div></div>
    </div>");
    } else {$mpdf->WriteHTML("<br>");
}

// Ressourcen Checkboxen

$mpdf->WriteHTML('<div style="page-break-inside: avoid;"><div style="margin-bottom: 10px" class="greenBox">
<h6>Ressource</h6>
    <table style="border-top: 2px solid black;" class="resTable">
        <tbody>
            <tr>
                <td><img class="cbIMG" src="checkboxes/check' . $r_ResNiederschlag . '.jpeg"> Niederschlagswasser&nbsp;</td>
                <td><img class="cbIMG" src="checkboxes/check' . $r_ResSchmutzwasser . '.jpeg"> Schmutzwasser&nbsp;</td>
				<td><img class="cbIMG" src="checkboxes/check' . $r_ResBaustoffe . '.jpeg"> Baustoffe&nbsp;</td>
				<td><img class="cbIMG" src="checkboxes/check' . $r_ResEnergie . '.jpeg"> Energie&nbsp;</td>
				<td><img class="cbIMG" src="checkboxes/check' . $r_ResFläche . '.jpeg"> Fläche</td>
            </tr>
        </tbody>
    </table>
    </div></div>'
);

// Funktion

$mpdf->WriteHTML('<h4>Funktion</h4>
<div class="funkTableHead">
    <div class="col1"> Wasser </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserVerdunstung . '.jpeg">&nbsp; Förderung Verdunstung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserGrundwasserneubildung . '.jpeg">&nbsp; Förderung Grundwasserneubildung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserBehandlung . '.jpeg">&nbsp; Förderung Behandlung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserTrinkwassereinsparung . '.jpeg">&nbsp; Trinkwassereinsparung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserNährstoffrückgewinnung . '.jpeg">&nbsp; Nährstoffrückgewinnung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserÜberflutungsvorsorge . '.jpeg">&nbsp; Überflutungsvorsorge</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserAbfluss . '.jpeg">&nbsp; Minderung Abfluss</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkWasserSammlung . '.jpeg">&nbsp; Sammlung und Ableitung</div>
    </div>
    <div class="funkTableHline">
        <div class="col1"> Baustoffe </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkBaustoffeVermeidung . '.jpeg">&nbsp; Vermeidung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkBaustoffeWiederverwendung . '.jpeg">&nbsp; Wiederverwendung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkBaustoffeVerwertung . '.jpeg">&nbsp; Verwertung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkBaustoffeBeseitigung . '.jpeg">&nbsp; Beseitigung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkBaustoffeRecycling . '.jpeg">&nbsp; Recycling</div>
        <div class="col3">&nbsp;</div>
    </div>
    <div class="funkTableHline">
        <div class="col1"> Energie </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieEnergiebereitstellung . '.jpeg">&nbsp; Energiebereitstellung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieEnergieverteilung . '.jpeg">&nbsp; Energieverteilung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieEnergieverbrauch . '.jpeg">&nbsp; Energieverbrauch</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieEnergiespeicherung . '.jpeg">&nbsp; Energiespeicherung</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieElektrizität . '.jpeg">&nbsp; Elektrizität</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieWärme . '.jpeg">&nbsp; Wärme</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkEnergieBrennstoffe . '.jpeg">&nbsp; Brennstoffe</div>
        <div class="col3">&nbsp;</div>
    </div>
    <div class="funkTableHline">
        <div class="col1"> Fläche </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkFlächeKlimaanpassung . '.jpeg">&nbsp; Klimaanpassung</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkFlächeGesundheitsschutz . '.jpeg">&nbsp; Gesundheitsschutz</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkFlächeEinsparung . '.jpeg">&nbsp; Erhalt d. Grunddaseinsfunktion</div>
        <div class="col3"><img class="cbIMG" src="checkboxes/cb' . $r_funkFlächeLuftreinhaltung . '.jpeg">&nbsp; Naturschutz</div>
    </div>
    <div class="funkTableRow">
        <div class="col1"> &nbsp; </div>
        <div class="col2"><img class="cbIMG" src="checkboxes/cb' . $r_funkFlächeBiodiversität . '.jpeg">&nbsp; Klimaschutz</div>
        <div class="col3">&nbsp;</div>
    </div>
</div>
<div style="page-break-inside: avoid;">
<strong style="maring-top: 10px;">Legende:&nbsp;</strong><br>
<div class="cbDescr">
    <div style="margin-bottom: 5px">
        <img class="cbIMG" src="checkboxes/cb0.jpeg"> kein Wirkpotential &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
        <img class="cbIMG" src="checkboxes/cb1.jpeg"> Wirkpotential vorhanden &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; 
        <img class="cbIMG" src="checkboxes/cb2.jpeg"> geringes Wirkpotential &nbsp;&nbsp;&nbsp;<br>
    </div>
    <img class="cbIMG" src="checkboxes/cb3.jpeg"> mittleres Wirkpotential &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <img class="cbIMG" src="checkboxes/cb4.jpeg"> hohes Wirkpotential &nbsp;&nbsp;&nbsp;
</div></div>');

$mpdf->WriteHTML('<div style="page-break-inside: avoid;"><div style="margin-bottom: 10px; margin-top: 10px;">
<h6>Anwendungsebene</h6>
    <table style="border-top: 2px solid black;" class="resTable">
        <tbody>
            <tr>
                <td><img class="cbIMG" src="checkboxes/checkW' . $r_anwendungsebeneGebäude . '.jpeg"> Gebäude&nbsp;</td>
                <td><img class="cbIMG" src="checkboxes/checkW' . $r_anwendungsebeneGrundstück . '.jpeg"> Grundstück&nbsp;</td>
				<td><img class="cbIMG" src="checkboxes/checkW' . $r_anwendungsebeneQuartier . '.jpeg"> Quartier&nbsp;</td>
            </tr>
        </tbody>
    </table>
    </div></div>'
);



// <div class="AnwC1">' . $r_FlaechenbedarfEW . 'm²/EW </div>

// Anwendungsebene + Flächenbedarf + Nutzungsdauer + Entwicklungsstand
$mpdf->WriteHTML('<div style="margin-top: 20px; page-break-inside: avoid;">
    <table class="resTable">
            <tr>
                <td style="width:25%" class="AnwC1H">Flächenbedarf</td>
                <td style="width:31%" class="AnwC2H">Nutzungsdauer (Jahre)</td>
                <td style="width:44%" class="AnwC3H">Entwicklungsstand</td>
            </tr>
    </table>

    <table style="border-top: 2px solid black;" class="resTable">
        <tbody>
            <tr>
                <td style="width:25%;">' . $r_FlaechenbedarfEW . 'm²/EW</td>
                <td style="width:31%;"><img class="cbIMG" src="checkboxes/checkW' . $r_anwendungsebeneGrundstück . '.jpeg"> Grundstück&nbsp;</td>
                <td style="width:44%;"><img class="cbIMG" src="checkboxes/checkW' . $r_anwendungsebeneQuartier . '.jpeg"> Quartier&nbsp;</td>
            </tr>
        </tbody>
    </table>
</div>');


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