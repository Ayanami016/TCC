<?php
include('conexao.php');
session_start();

$id_produto = $_POST['id'];

if (isset($_POST['id'])) {
    $id_produto = intval($_GET['id']);
    echo "ID do Produto: " . $id_produto;
} else {
    echo "ID do produto não fornecido.";
    exit;
}

if (isset($_POST['id_produto'], $_POST['cor_selecionada'])) {
    $id_produto = $_POST['id_produto'];
    $cor_selecionada = $_POST['cor_selecionada'];

    // Inicializar o carrinho se não estiver criado
    if (!isset($_SESSION['sacola'])) {
        $_SESSION['sacola'] = [];
    }

    // Adicionar o produto ao carrinho (você pode armazenar mais informações se necessário)
    if (isset($_SESSION['sacola'][$id_produto])) {
        $_SESSION['sacola'][$id_produto]['quantidade'] += 1;
    } else {
        $_SESSION['sacola'][$id_produto] = [
            'quantidade' => 1,
            'cor' => $cor_selecionada,
        ];
    }

    // Redirecionar para a página de checkout ou mostrar sucesso
    header("Location: /TCC/paginas/produto.php?id=$id_produto");
    exit;
} else {
    // Se algo der errado, redirecionar de volta
    header("Location: /TCC/paginas/produto.php?id=$id_produto");
    exit;
}