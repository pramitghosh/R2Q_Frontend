<?php

require_once __DIR__ . '/vendor/autoload.php';
ini_set('memory_limit', '640M');
$mpdf = new \Mpdf\Mpdf();
// $stylesheet = file_get_contents('style.css');

// $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->Image('R2Q_Logo.png', 0, 0, 210, 297, 'png', '', true, false);
$mpdf->SetHTMLHeader("
<div style='text-align: right; font-weight: bold;'>
    My document
</div>");
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output("mpdf.pdf", "d");