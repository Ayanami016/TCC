<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Endereço para entrega
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $numero = $_POST['num'];
    $complemento = $_POST['complemento'];

    // Cliente - Requer Login
    $id_usuario = $_SESSION['id_usuario'];

    // Frete, Valor e Método de Pagamento
    $frete = $_POST['frete'];
    $valor_pedido = $_POST['valor-pedido'];
    $metodo_pagamento = $_POST['pagamento'];

    // Inserindo endereço na tabela entrega
    $insert_ent = "INSERT INTO entrega (cep_ent, rua_ent, numero_ent, complemento_ent, bairro_ent, cidade_ent, estado_ent, fk_cliente) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($insert_ent);
    $stmt->bind_param("ssissssi", $cep, $rua, $numero, $complemento, $bairro, $cidade, $uf, $id_usuario);
    $stmt->execute();
    $id_endereco = $stmt->insert_id;

    // Insere o pedido
    $status_ped = "Pedido realizado";
    $insert_ped = "INSERT INTO pedido (datahora_ped, frete_ped, valortotal_ped, pagamento_metodo_ped, status_ped, fk_cliente) 
                     VALUES (NOW(), ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($insert_ped);
    $stmt->bind_param("ddssi", $frete, $valor_pedido, $metodo_pagamento, $status_ped, $id_usuario);
    $stmt->execute();
    $id_pedido = $stmt->insert_id;

    // Comprovante
    $datahora = date('YmdHis');
    $comprovante = $datahora . '-' . $id_usuario . '-' . $id_pedido;

    //Insere comprovante na tabela pedido
    $insere_compr = "UPDATE pedido SET comprovante_ped = ? WHERE id_pedido = ?";
    $stmt = $conexao->prepare($insere_compr);
    $stmt->bind_param("si", $comprovante, $id_pedido);
    $stmt->execute();

    // Insere o(s) produto(s) do carrinho na tabela item, vinculando ao pedido
    foreach ($_SESSION['carrinho'] as $item) {
        $insert_item = "INSERT INTO item_pedido (fk_pedido, fk_produto, quantidade_prod) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($insert_item);
        $stmt->bind_param("iii", $id_pedido, $item['id'], $item['quantidade']);
        $stmt->execute();
    }

    // Atualiza a entrega com a referência ao pedido
    $update_ent = "UPDATE entrega SET fk_pedido = ? WHERE id_ent = ?";
    $stmt = $conexao->prepare($update_ent);
    $stmt->bind_param("ii", $id_pedido, $id_endereco);
    $stmt->execute();

    // Limpa o carrinho
    unset($_SESSION['carrinho']);

    // Página de conclusão do pedido
    // A página aparecerá que o pedido foi confirmado e as informações seguintes de pagamento.
    // Útil para aparecer código pix e boleto.
    header('Location: /TCC/paginas/confirmacao.php?pedido=' . $id_pedido);
}
?>
