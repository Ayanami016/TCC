<?php
use Dompdf\Dompdf;
require __DIR__ . '/../../vendor/autoload.php';
include 'processar_pedido.php';

if (!isset($_SESSION['valor_pedido'])) {
    echo "Erro: Valor do pedido não encontrado.";
    exit;
}

// Codificação em base64 da logo do boleto
$img_path = __DIR__ . '/../favicon/android-chrome-192x192.png';
$type = pathinfo($img_path, PATHINFO_EXTENSION);
$data = file_get_contents($img_path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

// Gerando números aleatórios
    // Agência (apenas os dois últimos)
function num_agencia($n = '00') {
    for ($i = 0; $i <= 2; $i++) {
        $n .= random_int(1, 9);
    }
    return $n;
}
    // Conta
function num_conta ($p1 = '', $p2 = '') {
    for ($i = 0; $i < 8; $i++) {$p1 .= random_int(0, 9);} // primeira parte
    $p2 .= random_int(0, 9); // segunda parte

    return $p1 . "-" . $p2;
}

// Gerando Boleto
$dompdf = new Dompdf();
$html = '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modelo do Boleto</title>
            <link rel="stylesheet" href="boleto.css">
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    font-family: sans-serif;
                    box-sizing: border-box;
                }

                #topo {
                    border: 2px solid purple;
                    padding: 20px;
                }

                #topo img {width: 100px;}
            </style>
        </head>
        <body>
            <span id="topo">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; width: 50%;">
                            <img src="' . $base64 . '" alt="Logo">
                        </td>
                        <td style="text-align: right; width: 70%;">
                            <p>Boleto para pagamento do pedido de <strong>"NOME USUÁRIO"</strong></p>
                            <p>Agência <strong>"NUMERO ALEATORIO x4"</strong> Conta <strong>"NUMERO ALEATORIO x8 - x1"</strong></p>
                        </td>
                    </tr>
                </table>
            </span>
        </body>
        </html>';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("boleto.pdf", ["Attachment" => false]);

// Fim da geração
// header('Location: /TCC/paginas/confirmacao.php?pedido=' . $id_pedido);
?>