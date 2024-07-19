<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsivo.css">
    <link rel="shortcut icon" href="../favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
<?php
    header("Content-type=text/html,charset=utf-8");
    include("conexao.php");

    if ($conexao->connect_error) {
        die("Há uma falha no banco de dados!" . $conexao->connect_error);
    }

    // Início Tabela
    echo
    "<table style='border: 2px solid black; border-collapse: collapse; text-align: right;'>
        <tr style='border: 2px solid black;'>
        <th>Código</th>
        <th>Descrição</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Cor</th>
        <th>Material</th>
        <th>Tamanho</th>
        <th>Estoque</th>
        <th>Preço</th>
        </tr>"; // Não fechar table aqui!

    // Pesquisa
    $pesquisa = $_POST['pesquisa'];
    $result_pesquisa = "select * from produto where 
        descricao_prod like '%$pesquisa%' or
        nome_prod like '%$pesquisa%' or
        tipo_prod like '%$pesquisa%' or
        cor_prod like '%$pesquisa%' or
        material_prod like '%$pesquisa%' or
        tamanho_prod like '%$pesquisa%'";

    $resultados = mysqli_query($conexao, $result_pesquisa);

    // Listando Resultados
    while ($row_produtos = mysqli_fetch_array($resultados)) {
        echo
        "<tr>
            <td>" . $row_produtos['id_prod'] . "</td>" . 
            "<td>" . $row_produtos['descricao_prod'] . "</td>" . 
            "<td>" . $row_produtos['nome_prod'] . "</td>" . 
            "<td>" . $row_produtos['tipo_prod'] . "</td>" . 
            "<td>" . $row_produtos['cor_prod'] . "</td>" . 
            "<td>" . $row_produtos['material_prod'] . "</td>" . 
            "<td>" . $row_produtos['tamanho_prod'] . "</td>" . 
            "<td>" . $row_produtos['estoque'] . "</td>" . 
            "<td>" . $row_produtos['preco'] . "</td>
        </tr>";
    }

    //Fim da Tabela
    echo "</table>";

    mysqli_close($conexao);
?>
</body>
</html>