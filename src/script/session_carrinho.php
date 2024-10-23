<?php
    // Inicializa a sessão carrinho
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    // Verifica se um produto foi adicionado
    if (isset($_GET['id']) && isset($_GET['nome_img']) && isset($_GET['nome_prod']) && isset($_GET['preco']) && isset($_GET['cor_prod'])) {
        $id_produto = (int) $_GET['id'];
        $nome_img = $_GET['nome_img'];
        $nome_prod = $_GET['nome_prod'];
        $preco = (float) $_GET['preco'];
        $cor_prod = $_GET['cor_prod'];

        // Verifica se o produto com a mesma cor já está no carrinho
        $produtoExiste = false;
        foreach ($_SESSION['carrinho'] as $key => $produto) {
            if ($produto['id'] == $id_produto && $produto['cor'] == $cor_prod) {
                $_SESSION['carrinho'][$key]['quantidade']++;
                $produtoExiste = true;
                break;
            }
        }

        // Se não estiver, adiciona!
        if (!$produtoExiste) {
            $_SESSION['carrinho'][] = array(
                'id' => $id_produto,
                'imagem' => $nome_img,
                'nome' => $nome_prod,
                'cor' => $cor_prod,
                'preco' => $preco,
                'quantidade' => 1
            );
        }

        // Evita o reenvio do formulário afim de evitar quantidade++ (1 => 3)
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Deletando o produto do carrinho
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id_produto = (int)$_GET['id'];
        $cor_prod = $_GET['cor'];

        // Procura o produto no carrinho e o remove
        foreach ($_SESSION['carrinho'] as $key => $produto) {
            if ($produto['id'] == $id_produto && $produto['cor'] == $cor_prod) {
                unset($_SESSION['carrinho'][$key]);
                // Reindexa o array para evitar buracos
                $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
                break;
            }
        }

        // Redireciona para a mesma página para evitar reenvio de formulários
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>