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

$mpdf->SetHTMLHeader("
<div class='header'>
Maßnahmenkatalog
<div class='hlineHeader'></div>
</div>");

$mpdf->SetHTMLFooter("
<div style='text-align: right; font-weight: bold;'>
    <img class='figure_bsp' src='LogofooterNT.png'; >
</div>");

$mpdf->WriteHTML("<h3 style = 'width: 1000px; text-align: justify;'>" . $r_Titel . "</h3>
    <h5>Kurzinformation</h5>
	<div id='kurzBox' class='greenBox'> 
		<p>"
			. $r_Kurzbeschreibung . 
		"</p>
	</div>");

$mpdf->WriteHTML("<img class='figure_bsp' src='" . $IMGpath . "'; >");



$mpdf->Output("mpdf.pdf", "I"); // für direkten Download der PDF -> "D" eingeben 