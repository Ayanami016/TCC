<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Endereço
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];

    // Entrega e Produto
    $frete = $_POST['frete'];
    $valor_pedido = $_POST['valor-pedido'];

    $id_cliente = $_SESSION['id_cliente']; // Necessário login

    $insertEndereco = "INSERT INTO endereco (rua_end, numero_end, bairro_end, cidade_end, estado_end, cep_end, fk_cliente) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertEndereco);
    $stmt->bind_param("ssssssi", $rua, $numero, $bairro, $cidade, $estado, $cep, $id_cliente);
    $stmt->execute();
    $id_endereco = $stmt->insert_id; // Obtém o ID do endereço inserido

    // 2. Criar um novo pedido
    $valor_total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $valor_total += $item['preco'] * $item['quantidade'];
    }
    
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $status_ped = "Aguardando Pagamento"; // Defina o status inicial do pedido

    $insertPedido = "INSERT INTO pedido (datahora_ped, valor_ped, pagamento_metodo_ped, status_ped, fk_cliente) 
                     VALUES (NOW(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertPedido);
    $stmt->bind_param("dssi", $valor_total, $metodo_pagamento, $status_ped, $id_cliente);
    $stmt->execute();
    $id_pedido = $stmt->insert_id; // Obtém o ID do pedido

    // 3. Salvar os itens do carrinho na tabela 'item'
    foreach ($_SESSION['carrinho'] as $item) {
        $insertItem = "INSERT INTO item (fk_pedido, fk_produto, quantidade_prod) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertItem);
        $stmt->bind_param("iii", $id_pedido, $item['id'], $item['quantidade']);
        $stmt->execute();
    }

    // 4. Criar o registro de entrega
    $insertEntrega = "INSERT INTO entrega (status_ent, metodo_envio, fk_cliente, fk_ped, fk_endereco) 
                      VALUES ('Processando', 'Correios', ?, ?, ?)";
    $stmt = $conn->prepare($insertEntrega);
    $stmt->bind_param("iii", $id_cliente, $id_pedido, $id_endereco);
    $stmt->execute();

    // 5. Limpar o carrinho e redirecionar para uma página de confirmação
    unset($_SESSION['carrinho']);
    header('Location: confirmacao.php?pedido=' . $id_pedido);
}
?>
