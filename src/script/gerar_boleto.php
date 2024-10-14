<?php
use Dompdf\Dompdf;
require '../TCC/vendor/autoload.php';
include 'processar_pedido.php';

// Fim da geração
header('Location: /TCC/paginas/confirmacao.php?pedido=' . $id_pedido);
?>