<?php
use Dompdf\Dompdf;
require __DIR__ . '/../../vendor/autoload.php';
include 'processar_pedido.php';

// Gerando Boleto
$dompdf = new Dompdf();

$html = "<html>";
$html .= "<head>";
$html .= "</head>";
$html .= "<body>";
$html .= "<h1> Total a Pagar </h1>";
$html .= "<p>R$ " . number_format($valor_pedido, 2, '.', ',') . "</p>";
$html .= "</body>";
$html .= "</html>";

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("boleto.pdf", ["Attachment" => false]);

// Fim da geração
// header('Location: /TCC/paginas/confirmacao.php?pedido=' . $id_pedido);
?>