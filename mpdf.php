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
$mpdf->shrink_tables_to_fit = 0;
$mpdf->use_kwt = true;
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
<div class='footer'>
    <br>
    <img style='margin-left: 20px; margin-right: -60px; margin-bottom: -20px' src='FooterResize.jpg'; >
</div>");


//Kurzinformation///////////////////////////////////////////////////////////////////////////////////
// Titel + Kurzbeschreibung

$mpdf->WriteHTML("<h3 style = 'width: 1000px;'>" . $r_Titel . "</h3>
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
            <div style='text-align: center; margin-bottom: 14px;'>" . $html . "</div></div>
    </div>");
    } else {$mpdf->WriteHTML("<br>");
}

// Ressourcen Checkboxen

$mpdf->WriteHTML('<div style="page-break-inside: avoid;"><div style="margin-bottom: 14px" class="greenBox">
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
<strong style="maring-top: 14px;">Legende:&nbsp;</strong><br>
<div class="cbDescr">
    <div style="margin-bottom: 5px">
        <img class="cbIMG" src="checkboxes/cb0.jpeg"> kein Wirkpotential &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
        <img class="cbIMG" src="checkboxes/cb1.jpeg"> Wirkpotential vorhanden &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; 
        <img class="cbIMG" src="checkboxes/cb2.jpeg"> geringes Wirkpotential &nbsp;&nbsp;&nbsp;<br>
    </div>
    <img class="cbIMG" src="checkboxes/cb3.jpeg"> mittleres Wirkpotential &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <img class="cbIMG" src="checkboxes/cb4.jpeg"> hohes Wirkpotential &nbsp;&nbsp;&nbsp;
</div></div>');

// Anwendungsebene

$mpdf->WriteHTML('<div style="page-break-inside: avoid;"><div style="margin-top: 14px;">
    <div><h4>Anwendungsebene</h4></div>
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

// Flächenbedarf + Nutzungsdauer + Entwicklungsstand

if (strlen($r_Sammelhinweis) != 0) {
    $hinw = '<table class="resTable">
        <tbody>
            <tr>
                <td><Div class="boldGray">Hinweis:</Div>' . $r_Sammelhinweis . '</td>
            </tr>
        </tbody>
    </table>';
}

$mpdf->WriteHTML('<div style="margin-top: 20px; page-break-inside: avoid;">
        <div><h4>Flächenbedarf |
        Nutzungsdauer(Jahre) | 
        Entwicklungsstand</h4></div>

    <table style="border-top: 2px solid black;" class="resTable">
        <tbody>
            <tr>
                <td style="width:22%;">' . $r_FlaechenbedarfEW . '</td>
                <td style="width:31%;">Min:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;' . $r_Nutzungsdauer_min . '</td>
                <td style="width:4%;"><img class="cbIMG" src="checkboxes/checkW' . $r_EntwicklungsstandWissenschaftTechnik . '.jpeg"></td>
                <td style="width:43%;">Stand der Wissenschaft und Technik</td>
            </tr>
        </tbody>
    </table>

    <table class="resTable">
        <tbody>
            <tr>
                <td style="width:22%;">' . $r_Flaechenbedarfm2XX . '</td>
                <td style="width:31%;">Max: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;' . $r_Nutzungsdauer_max . '</td>
                <td style="width:4%;"><img class="cbIMG" src="checkboxes/checkW' . $r_EntwicklungsstandTechnik . '.jpeg"></td>
                <td style="width:43%;">Stand der Technik</td>
            </tr>
        </tbody>
    </table>

    <table class="resTable">
        <tbody>
            <tr>
                <td style="width:22%;"></td>
                <td style="width:31%;">Üblich:&nbsp; &nbsp; &nbsp; &nbsp;' . $r_Nutzungsdauer_ueblich . '</td>
                <td style="width:4%;"><img class="cbIMG" src="checkboxes/checkW' . $r_EntwicklungsstandAnerkanntTechnik . '.jpeg"></td>
                <td style="width:43%;">Allgemein anerkannte Regeln der Technik</td>
            </tr>
        </tbody>
    </table>' . $hinw . '</div><br><br>'
);


//Detailinformationen//////////////////////////////////////////////////////////////////////////////////////

$mpdf->WriteHTML('<h5>Detailinformationen</h5>');

// Funktionsbeschreibung

$mpdf->WriteHTML('<div id="resBox" class="greenBox">
        <h6>Funktionsbeschreibung und Aufbau</h6>
        ' . $r_Funktionsbeschreibung . '
    </div>'
);

// Systemskizze

if (strlen($r_Systemskizze_Bild) != 0 or strlen($r_Systemskizze_Beschriftung) != 0) {
    $parsedown = new Parsedown(); $html = $parsedown->text("<figcaption><strong>Abb. 2:</strong> " . $r_Systemskizze_Beschriftung . "</figcaption>");
    $mpdf->WriteHTML("<div style='page-break-inside: avoid;'>
        <h4>Systemskizze</h4>
        <div id='imageCenter' class='img_center'>
            <img class='figure_bsp' src='" . $r_Systemskizze_Bild . "'; >
            <br>
            <br>
            <div style='text-align: center; margin-bottom: 14px;'>" . $html . "</div></div>
    </div>");
    } else {$mpdf->WriteHTML("<br>");
}

// Planung + Bemessung + rechtliche Aspekte

$mpdf->WriteHTML("<div style='text-align: justify';><h4>Planung, Bemessung und rechtliche Aspekte</h4>"
 . $r_Planung_freetext . "</div>"
);

$sumLength = 0;
for ($i=0; $i < sizeof($r_PlanungNormen); $i++) {
    $sumLength = $sumLength + strlen($r_PlanungNormen[$i]['wert']);
}

if($sumLength != 0)
{
    $Parsedown_Norm = new Parsedown();
    $Parsedown_Titel = new Parsedown();

    $html = "<div style='page-break-inside: avoid;'><table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:32%;' class='PlanC1H'>Norm/Regelwerk</td>
                <td style='width:68%;' class='PlanC2H'>Titel</td>
            </tr>
        </tbody>
    </table>";

    $first = 0;

    for ($i = 0; $i < sizeof($r_PlanungNormen)/2; $i++)
    {            
        if ($r_PlanungNormen[$i]['wert']!="" or $r_PlanungNormen[$i+sizeof($r_PlanungNormen)/2]['wert']!="" ) {
            if ($i == $first) {
                $html = $html . "<table class='resTable'  style='border-top: 2px solid black; overflow: wrap;'>
                <tr><td style='width:32%; vertical-align:top'>" .  $Parsedown_Norm->text($r_PlanungNormen[$i]['wert']) . "</td>";
                $html = $html . "<td  style='width:68%; vertical-align:top'>" . $Parsedown_Titel->text($r_PlanungNormen[$i+sizeof($r_PlanungNormen)/2]['wert']) . "</td></tr></table></div>";
            } else {
                $html = $html . "<table class='resTable'  style='border-top: 1px solid gray; overflow: wrap;'>
                <tr><td style='width:32%; vertical-align:top'>" .  $Parsedown_Norm->text($r_PlanungNormen[$i]['wert']) . "</td>";
                $html = $html . "<td  style='width:68%; vertical-align:top'>" . $Parsedown_Titel->text($r_PlanungNormen[$i+sizeof($r_PlanungNormen)/2]['wert']) . "</td></tr></table>";
            }
        } else {
            $first = $first + 1;
        }
    }
    $mpdf->WriteHTML($html);
}

// Aufwand + Kosten

$mpdf->WriteHTML("<h4>Aufwand und Kosten</h4><div style='text-align: justify; margin-top: -15px;'>"
. $r_Aufwand_freetext . "</div>"
);

 if (strlen($r_Aufwand_i5[0][0])>0) {
    $VBorder = " border-left: 1px solid gray";
 } else {
     $VBorder = "";
 }

$head = "<div>";

$row1 = "<div style='page-break-inside: avoid; float: left; width: 50%; margin-right: -4px'><table class='resTable' style='overflow: wrap;'>
<tr>
    <td style='width:100%; border-bottom: 2px solid black'><div class='headerBlack'>Investitionskosten</div></td>
</tr>
</table>
<table class='resTable'  style='overflow: wrap;'>
<tr><td style='color: gray; font-weight: bold; width: 10%'>&nbsp;</td>";
for ($i = 1; $i < 6; $i++) {
    ( ${"r_Aufwand_i" . $i}[0][0]!="")? $row1 = $row1 . "<td style='color: gray; font-weight: bold; width: auto; text-align: center'>€/" . ${"r_Aufwand_i" . $i}[0][0] . "</td>": $row1 = $row1;
    }
$row1 = $row1 .  "</tr>";


$row2 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>min</td>";
for ($i = 1; $i < 6; $i++) {
    ( ${"r_Aufwand_i" . $i}[2][0]!="")? $row2 = $row2 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_i" . $i}[2][0] . "</td>": $row2 = $row2;
}
$row2 = $row2 .  "</tr>";


$row3 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>max</td>";
for ($i = 1; $i < 6; $i++) {
    ( ${"r_Aufwand_i" . $i}[1][0]!="")? $row3 = $row3 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_i" . $i}[1][0] . "</td>": $row3 = $row3;
}
$row3 = $row3 .  "</tr>";


$row4 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>üblich</td>";
for ($i = 1; $i < 6; $i++) {
    ( ${"r_Aufwand_i" . $i}[3][0]!="")? $row4 = $row4 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_i" . $i}[3][0] . "</td>": $row4 = $row4;
}
$row4 = $row4 .  "</tr></table></div>";




$row5 = "<div style='page-break-inside: avoid; float: left; width: 50%; margin-left: -4px'><table class='resTable' style='overflow: wrap;'>
<tr>
    <td style='width:100%; border-bottom: 2px solid black'><div class='headerBlack'>Betriebskosten</div></td>
</tr>
</table>
<table class='resTable' style='overflow: wrap;" . $VBorder . "'>
<tr><td style='color: gray; font-weight: bold; width: 10%'>&nbsp;</td>";
for ($i = 1; $i < 6; $i++) {
( ${"r_Aufwand_b" . $i}[0][0]!="")? $row5 = $row5 . "<td style='color: gray; font-weight: bold; width: auto; text-align: center'>€/" . ${"r_Aufwand_b" . $i}[0][0] . "</td>": $row5 = $row5;
}
$row5 = $row5 .  "</tr>";


$row6 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>min</td>";
for ($i = 1; $i < 6; $i++) {
( ${"r_Aufwand_b" . $i}[2][0]!="")? $row6 = $row6 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_b" . $i}[2][0] . "</td>": $row6 = $row6;
}
$row6 = $row6 .  "</tr>";


$row7 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>max</td>";
for ($i = 1; $i < 6; $i++) {
( ${"r_Aufwand_b" . $i}[1][0]!="")? $row7 = $row7 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_b" . $i}[1][0] . "</td>": $row7 = $row7;
}
$row7 = $row7 .  "</tr>";


$row8 = "
<tr><td style='color: gray; font-weight: bold; width: 10%'>üblich</td>";
for ($i = 1; $i < 6; $i++) {
( ${"r_Aufwand_b" . $i}[3][0]!="")? $row8 = $row8 . "<td style='width: auto; text-align: center'>" . ${"r_Aufwand_b" . $i}[3][0] . "</td>": $row8 = $row8;
}
$row8 = $row8 .  "</tr></table></div></div>";


$mpdf->WriteHTML($head . $row1 . $row2 . $row3 . $row4 . $row5 . $row6 . $row7 . $row8);

if (strlen($r_Aufwand_hinweis) != 0) {
    $mpdf->WriteHTML('<Div class="boldGray" style="margin-top: 5px">Hinweis:</Div>' . $r_Aufwand_hinweis . '</td>');
}

// Weitergehende Hinweise

$mpdf->WriteHTML("<h4>Weitergehende Hinweise</h4><div style='text-align: justify;'>"
. $r_Weitergehende_freetext . "</div>"
);

$sumLength = 0;
for ($i=0; $i < sizeof($r_Weitergehende_table); $i++) {
    $sumLength = $sumLength + strlen($r_Weitergehende_table[$i][1]);
}

$html2 = "";

if($sumLength != 0)
{
    $Parsedown_Param = new Parsedown();
    $Parsedown_Wert = new Parsedown();

    $html2 = "<div style='page-break-inside: avoid;'><table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:40%;' class='PlanC1H'>Parameter</td>
                <td style='width:60%;' class='PlanC2H'>Wert</td>
            </tr>
        </tbody>
    </table>";

    $first = 0;

    for ($i = 0; $i < sizeof($r_Weitergehende_table)/2; $i++)
    {
        if ($r_Weitergehende_table[$i][1]!="" or $r_Weitergehende_table[$i+sizeof($r_Weitergehende_table)/2][1]!="" ) {
            if ($i == $first) {
                $html2 = $html2 . "<table class='resTable'  style='border-top: 2px solid black;'>
                <tr><td style='width:40%; vertical-align:top'>" .  $Parsedown_Param->text($r_Weitergehende_table[$i][1]) . "</td>";
                $html2 = $html2 . "<td  style='width:60%; vertical-align:top'>" . $Parsedown_Wert->text($r_Weitergehende_table[$i+sizeof($r_Weitergehende_table)/2][1]) . "</td></tr></table></div>";
            } else {
                $html2 = $html2 . "<table class='resTable'  style='border-top: 1px solid gray;'>
                <tr><td style='width:40%; vertical-align:top'>" .  $Parsedown_Param->text($r_Weitergehende_table[$i][1]) . "</td>";
                $html2 = $html2 . "<td  style='width:60%; vertical-align:top'>" . $Parsedown_Wert->text($r_Weitergehende_table[$i+sizeof($r_Weitergehende_table)/2][1]) . "</td></tr></table>";
            }
        } else {
            $first = $first + 1;
        }
    }
}

$mpdf->WriteHTML($html2);

// Ressourcenübergreifende Aspekte



$html3 = "";
$first = 1;

$Parsedown_Syn = new Parsedown();
$Parsedown_Konf = new Parsedown();

$html3 = "<div style='page-break-inside: avoid;'>
    <div><h4>Ressourcenübergreifende Aspekte</h4></div>
    <table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:25%;' class='PlanC1H'>&nbsp;</td>
                <td style='width:37.5%;' class='PlanC1H'>Synergien</td>
                <td style='width:37.5%;' class='PlanC2H'>Zielkonflikte</td>
            </tr>
        </tbody>
    </table>";

if ($r_AspekteSynNiederschlag != "" or $r_AspekteKonfNiederschlag != "" ) {
    if (1 == $first) {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 2px solid black; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Niederschlagswasser</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynNiederschlag) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfNiederschlag) . "</td></tr></table></div>";
    } else {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 1px solid gray; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Niederschlagswasser</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynNiederschlag) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfNiederschlag) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_AspekteSynSchmutzwasser != "" or $r_AspekteKonfSchmutzwasser != "" ) {
    if (2 == $first) {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 2px solid black; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Schmutzwasser</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynSchmutzwasser) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfSchmutzwasser) . "</td></tr></table></div>";
    } else {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 1px solid gray; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Schmutzwasser</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynSchmutzwasser) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfSchmutzwasser) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_AspekteSynBaustoffe != "" or $r_AspekteKonfBaustoffe != "" ) {
    if (3 == $first) {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 2px solid black; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Baustoffe</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynBaustoffe) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfBaustoffe) . "</td></tr></table></div>";
    } else {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 1px solid gray; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%;'>Baustoffe</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynBaustoffe) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfBaustoffe) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_AspekteSynEnergie != "" or $r_AspekteKonfEnergie != "" ) {
    if (4 == $first) {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 2px solid black; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Energie</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynEnergie) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfEnergie) . "</td></tr></table></div>";
    } else {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 1px solid gray; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Energie</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynEnergie) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfEnergie) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_AspekteSynFläche != "" or $r_AspekteKonfFläche != "" ) {
    if (5 == $first) {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 2px solid black; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Fläche</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynFläche) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfFläche) . "</td></tr></table></div>";
    } else {
        $html3 = $html3 . "<table class='resTable'  style='border-top: 1px solid gray; font-size: 14px'>
        <tr><td style='color: gray; font-weight: bold; width:25%; vertical-align:top'>Fläche</td>
        <td style='width:37.5%; vertical-align:top'>" .  $Parsedown_Syn->text($r_AspekteSynFläche) . "</td>";
        $html3 = $html3 . "<td  style='width:37.5%; vertical-align:top'>" . $Parsedown_Konf->text($r_AspekteKonfFläche) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

$mpdf->WriteHTML($html3);

// Ökobilanzielle Bewertung 


$sumLength = 0;
for ($i=0; $i < sizeof($r_Bewertung_table); $i++) {
    $sumLength = $sumLength + strlen($r_Bewertung_table[$i][1]);
}

if ($sumLength != 0 or  strlen($r_Bewertung_freetext) != 0) {
    $mpdf->WriteHTML("<h4>Ökobilanzielle  Bewertung</h4><div style='text-align: justify;'>"
    . $r_Bewertung_freetext . "</div>"
    );
}



$html4 = "";

if($sumLength != 0)
{
    $Parsedown_Lit = new Parsedown();
    $Parsedown_Bew = new Parsedown();

    $html4 = "<div style='page-break-inside: avoid;'><table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:40%;' class='PlanC1H'>Literaturstelle</td>
                <td style='width:60%;' class='PlanC2H'>Bewertung</td>
            </tr>
        </tbody>
    </table>";

    $first = 0;

    for ($i = 0; $i < sizeof($r_Bewertung_table)/2; $i++)
    {
        if ($r_Bewertung_table[$i][1]!="" or $r_Bewertung_table[$i+sizeof($r_Bewertung_table)/2][1]!="" ) {
            if ($i == $first) {
                $html4 = $html4 . "<table class='resTable'  style='border-top: 2px solid black;'>
                <tr><td style='width:40%; vertical-align:top'>" .  $Parsedown_Lit->text($r_Bewertung_table[$i][1]) . "</td>";
                $html4 = $html4 . "<td  style='width:60%; vertical-align:top'>" . $Parsedown_Bew->text($r_Bewertung_table[$i+sizeof($r_Bewertung_table)/2][1]) . "</td></tr></table></div>";
            } else {
                $html4 = $html4 . "<table class='resTable'  style='border-top: 1px solid gray;'>
                <tr><td style='width:40%; vertical-align:top'>" .  $Parsedown_Lit->text($r_Bewertung_table[$i][1]) . "</td>";
                $html4 = $html4 . "<td  style='width:60%; vertical-align:top'>" . $Parsedown_Bew->text($r_Bewertung_table[$i+sizeof($r_Bewertung_table)/2][1]) . "</td></tr></table>";
            }
        } else {
            $first = $first + 1;
        }
    }
}

$mpdf->WriteHTML($html4);

//Kombinationsmöglichkeiten

if (count($r_Kombi) != 0) {
    $mpdf->WriteHTML("<h4>Kombinationsmöglichkeiten</h4>"
    );
}
				
$html5 = "<table>";

for($i = 0; $i < count($r_Kombi); $i++){
    if ($r_Kombi[$i][1]!="") {						
        $html5 = $html5 . "<tr><td><a class='bold' target='_blank' href='http://r2q.fh-muenster.de:8081/R2Q_Frontend/details.php?id=" . $r_Kombi[$i][0] . "'>";
        $html5 = $html5 . $r_Kombi[$i][1];
        $html5 = $html5 .  "</a></td></tr>";
    }
}
$html5 = $html5 . "</table>";
$mpdf->WriteHTML($html5);

// Vor- und Nachteile 

$sumLength = 0;
for ($i=0; $i < sizeof($r_VorNach_table); $i++) {
    $sumLength = $sumLength + strlen($r_VorNach_table[$i][1]);
}

$html6 = "";

if($sumLength != 0)
{
    $Parsedown_Vor = new Parsedown();
    $Parsedown_Nach = new Parsedown();

    $html6 = "<div style='page-break-inside: avoid;'>
    <div><h4>Vor- und Nachteile</h4></div>
    <table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:50%;' class='PlanC1H'>Vorteile</td>
                <td style='width:50%;' class='PlanC2H'>Nachteile</td>
            </tr>
        </tbody>
    </table>";

    $first = 0;

    for ($i = 0; $i < sizeof($r_VorNach_table)/2; $i++)
    {
        if ($r_VorNach_table[$i][1]!="" or $r_VorNach_table[$i+sizeof($r_VorNach_table)/2][1]!="" ) {
            if ($i == $first) {
                $html6 = $html6 . "<table class='resTable'  style='border-top: 2px solid black;'>
                <tr><td style='width:50%; vertical-align:top'>" .  $Parsedown_Vor->text($r_VorNach_table[$i][1]) . "</td>";
                $html6 = $html6 . "<td  style='width:50%; vertical-align:top'>" . $Parsedown_Nach->text($r_VorNach_table[$i+sizeof($r_VorNach_table)/2][1]) . "</td></tr></table></div>";
            } else {
                $html6 = $html6 . "<table class='resTable'  style='border-top: 1px solid gray;'>
                <tr><td style='width:50%; vertical-align:top'>" .  $Parsedown_Vor->text($r_VorNach_table[$i][1]) . "</td>";
                $html6 = $html6 . "<td  style='width:50%; vertical-align:top'>" . $Parsedown_Nach->text($r_VorNach_table[$i+sizeof($r_VorNach_table)/2][1]) . "</td></tr></table>";
            }
        } else {
            $first = $first + 1;
        }
    }
}

$mpdf->WriteHTML($html6);


// Fallbeispiele 

$mpdf->WriteHTML("");

$html7 = "";

$first = 1;
$parsedown= new Parsedown();

$html7 = "<div style='page-break-inside: avoid;'>
    <div><h4>Fallbeispiele</h4></div>
    <table style='page-break-inside: avoid;' class='resTable'>
        <tbody>
            <tr>
                <td style='width:20%;' class='PlanC1H'>Projektname</td>
                <td style='width:15%;' class='PlanC2H'>Stadt</td>
                <td style='width:15%;' class='PlanC1H'>Land</td>
                <td style='width:50%;' class='PlanC2H'>Erläuterung</td>
            </tr>
        </tbody>
    </table>";

if ($r_Fallbsp1[0][0]!="" or $r_Fallbsp1[1][0]!="" or $r_Fallbsp1[2][0]!="" or $r_Fallbsp1[3][0]!="") {
    if (1 == $first) {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 2px solid black; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp1[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[0][0]) . "</td></tr></table></div>";
    } else {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 1px solid gray; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp1[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp1[0][0]) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_Fallbsp2[0][0]!="" or $r_Fallbsp2[1][0]!="" or $r_Fallbsp2[2][0]!="" or $r_Fallbsp2[3][0]!="") {
    if (2 == $first) {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 2px solid black; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp2[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[0][0]) . "</td></tr></table></div>";
    } else {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 1px solid gray; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp2[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp2[0][0]) . "</td></tr></table>";
    }
} else {
    $first = $first + 1;
}

if ($r_Fallbsp3[0][0]!="" or $r_Fallbsp3[1][0]!="" or $r_Fallbsp3[2][0]!="" or $r_Fallbsp3[3][0]!="") {
    if (3 == $first) {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 2px solid black; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp3[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[0][0]) . "</td></tr></table></div>";
    } else {
        $html7 = $html7 . "<table class='resTable'  style='border-top: 1px solid gray; overflow: wrap;'>
        <tr><td style='width:20%; vertical-align:top'>" .  $parsedown->text($r_Fallbsp3[2][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[3][0]) . "</td>
        <td  style='width:15%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[1][0]) . "</td>
        <td  style='width:50%; vertical-align:top'>" . $parsedown->text($r_Fallbsp3[0][0]) . "</td></tr></table>";
    }
}

$mpdf->WriteHTML($html7);


$mpdf->Output("mpdf.pdf", "I"); // für direkten Download der PDF -> für "I" ein "D" einsetzten 