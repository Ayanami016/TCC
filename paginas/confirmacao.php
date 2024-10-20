<?php

// Verifica se usuário está logado
include("../src/script/processar_pedido.php");
include("../src/script/conexao.php");
if (isset($_SESSION['nome_exibir'])) {
    // Divida o nome completo em partes
    $nomeCompleto = $_SESSION['nome_exibir'];
    $partesNome = explode(' ', $nomeCompleto);
    $primeiroNome = $partesNome[0];
} else {
    $primeiroNome = '';
}

// Número do Boleto
    // Total de 48 números
    // eu me recuso a programar conforme o que cada número representa
    // (exceto os dois primeiros)
function num_boleto($tres = '0', $random = '') {
    // três primeiros dígitos - banco emissor
    for ($i = 0; $i < 3; $i++) {$tres .= random_int(0, 9);}
    // Random
    for ($i = 0; $i < 43; $i++) {$random .= random_int(0, 9);}

    return  $tres . 9 . $random;
    // número 9 indica a moeda do Brasil
}

// Código PIX
    // Total de 35 caracteres
function codigoPIX($codigo = '') {
    $lower = implode('', range('a', 'z'));
    $n = implode('', range(0, 9));
    $alfanumerico = $lower . $n . $n;

    for ($i = 0; $i < 35; $i++) {$codigo .= $alfanumerico[rand(0, strlen($alfanumerico) - 1)];}

    return $codigo;
}

// Consulta SQL do status, pegando o id do pedido
$id_pedido = $_SESSION['pedido'];
$valor_pedido = $_SESSION['valor'];

$query = "SELECT status_ped FROM pedido WHERE id_pedido = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id_pedido);
$stmt->execute();
$stmt->bind_result($status_pedido);
$stmt->fetch();
$stmt->close();

// Data de Vencimento
$datahora = $_SESSION['datahora'];

$data = new DateTime($datahora);
    // adiciona 3 dias
$data->modify('+3 days');
$vencimento = $data->format('d/m/Y');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Acessórios - Página Inicial</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
    <style>
        <?php if (!empty($primeiroNome)): ?>
        nav a.link-menupc {padding: 5vh 19px 4.4vh 19px;}

        nav .ajusteconta {width: 105px;}
        <?php endif; ?>
    </style>
</head>
<body>
    <!-- MENU -->
    <header>
        <span>
            <a href="index.php"><img src="../src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
        </span>

        <form action="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
            <input type="search" name="pesquisa" id="pesquisa" class="menu-pesquisa" placeholder="Buscar">
        </form>

        <nav>
            <!--Menu Mobile-->
            <span class="alterna-menu" id="menu-mobile">
                <ion-icon name="menu" class="iconmenu" color="light"></ion-icon>
            </span>

            <!--Menu PC-->
            <span id="menu-pc">
                <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25" class="link-menupc">Pulseiras</a>
                <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index" class="link-menupc">Colares</a>
                <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25" class="link-menupc">Brincos</a>
                <a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25conjunto%25" class="link-menupc">Conjuntos</a>
            </span>


            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu btnsuporte">
                        <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank" class="link-listamenu"><ion-icon name="logo-instagram"></ion-icon> @bellaacessoriosreal</a>
                        
                    </div>
                </button>
                
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu btnconta">
                        <?php if (!empty($primeiroNome)) : ?>
                        <!-- Logado -->
                        <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                        <a href="../src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <?php if (!isset($_SESSION['id_usuario'])): ?>
                        <a href="login.php" class="link-listamenu">Checkout</a>
                        <?php else: ?>
                        <a href="checkout.php" class="link-listamenu">Checkout</a>
                        <?php endif; ?>
                    </div>
                </button>
            </span>

            <!--Menu PC-->
            <span id="botoes-pc">
                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu">
                        <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank" class="link-listamenu"><ion-icon name="logo-instagram"></ion-icon> @bellaacessoriosreal</a>
                        
                    </div>
                </button>
                
                <!-- Conta -->
                <button class="btnmenu-pc ajusteconta">
                    <ion-icon name="person-outline" class="iconbtn"></ion-icon><br>
                    <?php if (!empty($primeiroNome)): ?>
                        <!-- Se logado, exibe o primeiro nome do usuário -->
                        Olá, <?php echo htmlspecialchars($primeiroNome); ?>!
                    <?php else: ?>
                        <!-- Se não estiver logado, exibe "Conta" -->
                        Conta
                    <?php endif; ?>

                    <div class="listamenu">
                        <?php if (!empty($primeiroNome)): ?>
                            <!-- Itens do menu para usuários logados -->
                            <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                            <a href="#" class="link-listamenu">Histórico</a>
                            <a href="../src/script/destroy_session.php" class="link-listamenu">Encerrar Sessão</a>
                        <?php else: ?>
                            <!-- Itens do menu para usuários não logados -->
                            <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                            <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <a href="checkout.php" class="link-listamenu">Checkout</a>
                    </div>
                </button>
            </span>
        </nav>
    </header>

    <span class="menu-pesquisa-mobile">
        <form action="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
            <input type="search" name="pesquisa" id="pesquisa" placeholder="Buscar">
        </form>
    </span>
    <span class="menu-pc-mobile">
        <a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25pulseira%25">Pulseiras</a>
        <a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index">Colares</a>
        <a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25brinco%25">Brincos</a>
        <a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=%25onjunto%25">Conjuntos</a>
    </span>

    <!-- BARRA LATERAL - SACOLA -->
    <aside id="carrinho" style="display: none;">
        <?php
            if (!isset($_SESSION['id_usuario'])) {
               echo "<div>
                    <ion-icon name='person-circle-outline'></ion-icon>
                    <p>É necessário fazer login para acessar sua sacola!</p> <br>
                    <a style='color: var(--cor4);' href='login.php'>Entrar em sua Conta</a> <br><br>
                    <a id='fecharcarrinho'>Voltar</a>
               </div>";
            } else {
                if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                    $preco_total = 0;
                    echo "<div>"; // Para conter todos os produtos para o space-around do #carrinho aplicar corretamente
                    foreach ($_SESSION['carrinho'] as $id_produto => $item) {
                        // Calcula o preço total
                        $subtotal = $item['preco'] * $item['quantidade'];
                        $preco_total += $subtotal;
    
                        echo "
                        <div class='prod-carrinho'>
                            <a href='?action=delete&id={$item['id']}&cor={$item['cor']}'>
                                <ion-icon name='close-outline' style='color: var(--cor3); font-size: 1.5em;'></ion-icon>
                            </a>
                            <img src='{$item['imagem']}' alt='{$item['nome']}'>
                            <div class='txt-prod-carrinho'>
                                <p>{$item['nome']}</p>
                                <p class='preco-prod-carrinho'>R&#36;{$item['preco']}.00</p>
                                <p>{$item['cor']}</p>
                                <p>Quantidade: {$item['quantidade']}</p>
                            </div>
                        </div>";
                    }
                    // Preço Total
                    echo "<h1 style='margin-top: 5px; font-size: 2em; color: var(--cor2);'>Total: R$" . number_format($preco_total, 2, '.', '.') . "</h1>";
                    echo "</div>";
                    echo "
                    <div>
                        <a id='fecharcarrinho'>Voltar</a> <br>
                        <a href='checkout.php'><button>Finalizar Compra</button></a>
                    </div>";
                } else {
                    echo " 
                    <div>
                        <ion-icon name='bag-handle-outline'></ion-icon>
                            <h1>Sua sacola está vazia!</h1> <br>
                            <p>Escolha algum produto e adicione à sacola para realizar sua compra!</p> <br>
                            <a id='fecharcarrinho'>Voltar</a>
                    </div>";
                }
            }
        ?>
    </aside>

    <!-- CONFIRMAÇÃO DA COMPRA -->
    <div id="confirmacao">
        <h1><ion-icon name="sparkles-outline"></ion-icon>&nbsp;Agradecemos pelo pedido!&nbsp;<ion-icon name="sparkles-outline"></ion-icon></h1>
        <h2>Status: <?php echo $status_pedido; ?></h2>
        <?php
            if (isset($_SESSION['metodo_pagamento'])) {
                $metodo_pagamento = $_SESSION['metodo_pagamento'];
                
                if ($metodo_pagamento == 'BOLETO') {
                    echo '<div id="boleto">
                        <div class="infos-boleto">
                            <img class="logo" src="../src/favicon/android-chrome-192x192.png" alt="Logo Bella Acessórios">
                            <div style="text-align: right;">
                                <p>Valor: <strong>R$' . number_format($valor_pedido, 2, '.', ',') . '</strong></p>
                                <p>Data de vencimento: <strong>' . $vencimento . '</strong></p>
                            </div>
                        </div>
                        <div style="text-align: center;">
                            <img style="margin-bottom: 10px;" src="../src/img/codigo-barras-colorido.png" alt="Código de barras do boleto">
                            <p>' . num_boleto() . '</p>
                            <p>ID do pedido: #' . $id_pedido . '</p>
                        </div>
                    </div>';
                } elseif ($metodo_pagamento == 'PIX') {
                    echo '<div id="pix">
                        <img class="qrcode" src="../src/img/qrcode-colorido.png" alt="QR Code">
                        <div style="text-align: center;">
                            <p>Valor: <strong>R$' . number_format($valor_pedido, 2, '.', ',') . '</strong></p>
                            <p>Data de vencimento: <strong>' . $vencimento . '</strong></p>
                            <p>Código PIX: <strong>' . codigoPIX() . '</strong></p>
                            <p>ID do pedido: #' . $id_pedido . '</p>
                        </div>
                    </div>';
                } else {
                    // Atualiza o status de pagamento ao pagar no cartão
                    $novo_status = "Preparando";
                    $atualizar_status = "UPDATE pedido SET status_ped = ? WHERE id_pedido = ?";
                    $stmt = $conexao->prepare($atualizar_status);
                    $stmt->bind_param('si', $novo_status, $id_pedido);
                    $stmt->execute();

                    echo '<div style="text-align: center;">
                            <p>Valor: <strong>R$' . number_format($valor_pedido, 2, '.', ',') . '</strong></p>
                            <p>ID do pedido: #' . $id_pedido . '</p>
                    </div>';
                }
            } else {
                echo 'Método de pagamento não definido.';
            }
        ?>
        <span>
            <a href="pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria="><button class="voltar-loja">Voltar à Loja</button></a>
            <button class="acompanhar-pedido"><a href="#">Acompanhar Pedido</a></button>
        </span>
    </div>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         
</body>
</html>