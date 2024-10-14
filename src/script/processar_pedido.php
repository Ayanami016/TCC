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
    $stmt->bind_param("sssisssi", $cep, $rua, $numero, $complemento, $bairro, $cidade, $uf, $id_usuario);
    $stmt->execute();
    $id_endereco = $stmt->insert_id;

    // Insere o pedido
    $status_ped = "Pedido realizado";
    $insert_ped = "INSERT INTO pedido (datahora_ped, valor_ped, pagamento_metodo_ped, status_ped, frete_ped, fk_cliente) 
                     VALUES (NOW(), ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($insert_ped);
    $stmt->bind_param("dssdi", $valor_pedido, $metodo_pagamento, $status_ped, $frete, $id_usuario);
    $stmt->execute();
    $id_pedido = $stmt->insert_id;

    // Insere itens na tabela item
    foreach ($_SESSION['carrinho'] as $item) {
        $insert_item = "INSERT INTO item (fk_produto, quantidade_prod) VALUES (?, ?)";
        $stmt = $conexao->prepare($insert_item);
        $stmt->bind_param("ii", $item['id'], $item['quantidade']);
        $stmt->execute();
        $id_item = $stmt->insert_id;

        // Atualiza o pedido com a referência ao item
        $updatePedidoItem = "UPDATE pedido SET fk_item = ? WHERE id_pedido = ?";
        $stmt = $conexao->prepare($updatePedidoItem);
        $stmt->bind_param("ii", $id_item, $id_pedido);
        $stmt->execute();
    }

    // Cria o registro de entrega com base no pedido e endereço
    $insertEntrega = "UPDATE entrega SET fk_ped = ? WHERE id_ent = ?";
    $stmt = $conexao->prepare($insertEntrega);
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
