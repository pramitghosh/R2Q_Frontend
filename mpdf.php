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
<div style='text-align: left; font-weight: bold;'>

    <img class='Logo' src='R2Q_LogoNT.jpg'; >
</div>");
$mpdf->WriteHTML("<h1>Hello world!". $r_Umsetzungsbeispiel_Beschriftung ." </h1>
<img class='figure_bsp' src='" . $IMGpath . "'; >");

$mpdf->SetHTMLFooter("
<div style='text-align: right; font-weight: bold;'>
    <img class='figure_bsp' src='Logofooter.png'; >
</div>");

$mpdf->Output("mpdf.pdf", "I"); // für direkten Download der PDF -> "D" eingeben 