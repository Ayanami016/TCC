<?php

// Verifica se usuário está logado
session_start();
if (isset($_SESSION['nome_exibir'])) {
    // Divida o nome completo em partes
    $nomeCompleto = $_SESSION['nome_exibir'];
    $partesNome = explode(' ', $nomeCompleto);
    $primeiroNome = $partesNome[0];
} else {
    $primeiroNome = '';
}

include('../src/script/session_carrinho.php');
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
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu btnconta">
                        <?php if (!empty($primeiroNome)) : ?>
                        <!-- Logado -->
                        <a href="minha-conta.php" class="link-listamenu">Minha Conta</a>
                        <a href="historico.php" class="link-listamenu">Histórico</a>
                        <a href="../src/script/destroy_session.php" class="link-listamenu">Encessar Sessão</a>
                        <?php else: ?>
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <?php endif; ?>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu btnsuporte">
                        <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank" class="link-listamenu"><ion-icon name="logo-instagram"></ion-icon> @bellaacessoriosreal</a>

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
                            <a href="historico.php" class="link-listamenu">Histórico</a>
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
                        <?php if (!isset($_SESSION['id_usuario'])): ?>
                        <a href="login.php" class="link-listamenu">Checkout</a>
                        <?php else: ?>
                        <a href="checkout.php" class="link-listamenu">Checkout</a>
                        <?php endif; ?>
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

    <!-- HISTÓRICO -->
    <div id="historico">
        <h1><ion-icon name="wallet-outline"></ion-icon> &nbsp;Seu Histórico</h1>
        <!-- Pedidos -->
        <?php
            include('../src/script/conexao.php');
            $id_usuario = $_SESSION['id_usuario'];
            $consulta = "
                SELECT 
                    pedido.id_pedido, 
                    pedido.status_ped, 
                    produto.id_prod, 
                    produto.nome_prod, 
                    item_pedido.quantidade_prod, 
                    item_pedido.cor_selecionada,
                    pedido.datahora_ped
                FROM pedido
                JOIN item_pedido ON pedido.id_pedido = item_pedido.fk_pedido
                JOIN produto ON item_pedido.fk_produto = produto.id_prod
                WHERE pedido.fk_cliente = ?
                ORDER BY pedido.datahora_ped DESC
            ";

            $stmt = $conexao->prepare($consulta);
            $stmt->bind_param("i", $_SESSION['id_usuario']);
            $stmt->execute();
            $resultados = $stmt->get_result();

            if ($resultados->num_rows == 0) {
                echo "
                <ion-icon name='bag-handle-outline'></ion-icon>
                <p>Realize a sua primeira compra!</p>
                <a href='pesquisa.php?min=&max=&preco-ordem=&material=&tamanho=&categoria='>
                    <button class='btn-index' btn-placeholder='Ir para Loja'></button>
                </a>";
            } else {
                $pedido_atual = null; // Variável para acompanhar o pedido atual

                // Listando os pedidos do cliente
                while ($row_pedidos = mysqli_fetch_array($resultados)) {
                    $id_pedido = $row_pedidos['id_pedido'];
                    $id_prod = $row_pedidos['id_prod'];
                    $nome_img = "../src/img/produto" . $id_prod . ".png";
                    $nome_prod = $row_pedidos['nome_prod'];
                    $quantidade = $row_pedidos['quantidade_prod'];
                    $cor = $row_pedidos['cor_selecionada'];
                    $status_ped = $row_pedidos['status_ped'];

                    // Se o pedido mudou, fecha a div anterior
                    if ($pedido_atual !== $id_pedido) {
                        // Fecha a div anterior se existir
                        if ($pedido_atual !== null) {
                            // Botões que dependem do status do pedido
                            if ($status_ped == "Aguardando pagamento") {
                                $_SESSION['cancel-pedido'] = $pedido_atual;
                                echo "<span class='pedidos-botoes'>
                                        <a href='confirmacao.php?id_pedido=$pedido_atual'><button class='btn-pagar-ped'><ion-icon name='cash-outline'></ion-icon> Pagar</button></a>
                                        <a href='cancelar-pedido.php'><button class='btn-cancelar-ped'><ion-icon name='close-circle-outline'></ion-icon> Cancelar</button></a>
                                    </span>";
                            } elseif ($status_ped == "Preparando") {
                                $_SESSION['cancel-pedido'] = $pedido_atual;
                                echo "<span class='pedidos-botoes'>
                                        <a href='cancelar-pedido.php'><button class='btn-cancelar-ped'><ion-icon name='close-circle-outline'></ion-icon> Cancelar</button></a>
                                    </span>";
                            }
                            echo "</div>";
                        }

                        // Definindo cor do status
                        switch ($status_ped) {
                            case 'Preparando':
                                $cor_status = 'color: var(--preparando)';
                                break;
                            case 'Postado':
                                $cor_status = 'color: var(--postado)';
                                break;
                            case 'A caminho':
                                $cor_status = 'color: var(--acaminho)';
                                break;
                            case 'Entregue':
                                $cor_status = 'color: var(--entregue)';
                                break;
                            default:
                                $cor_status = 'color: var(--aguardando)';
                                break;
                        }

                        // Abre uma nova div para outro pedido
                        echo "
                        <div class='pedidos'>
                            <h3 style='$cor_status'>$status_ped</h3>
                            <p>ID do Pedido: #$id_pedido</p>";

                        $pedido_atual = $id_pedido;
                    }

                    echo "
                        <div class='pedido-produto'>
                            <div>
                                <a href='produto.php?id=$id_prod'>
                                    <img src='$nome_img' alt='Produto'>
                                </a>
                            </div>
                            <div class='info-produto'>
                                <p><strong>$nome_prod</strong></p>
                                <p><strong>Cor:</strong> $cor</p>
                                <p><strong>Quantidade:</strong> $quantidade</p>
                            </div>
                        </div>";
                }

                // Botões para o último pedido após o loop
                if ($status_ped == "Aguardando pagamento") {
                    $_SESSION['cancel-pedido'] = $pedido_atual;
                    echo "<span class='pedidos-botoes'>
                            <a href='confirmacao.php?id_pedido=$pedido_atual'><button class='btn-pagar-ped'><ion-icon name='cash-outline'></ion-icon> Pagar</button></a>
                            <a href='cancelar-pedido.php'><button class='btn-cancelar-ped'><ion-icon name='close-circle-outline'></ion-icon> Cancelar</button></a>
                        </span>";
                } elseif ($status_ped == "Preparando") {
                    $_SESSION['cancel-pedido'] = $pedido_atual;
                    echo "<span class='pedidos-botoes'>
                            <a href='cancelar-pedido.php'><button class='btn-cancelar-ped'><ion-icon name='close-circle-outline'></ion-icon> Cancelar</button></a>
                        </span>";
                }

                if ($pedido_atual !== null) {
                    echo "</div>"; // Fecha a div do último pedido
                }
            }
        ?>
    </div>
    

    <!-- RODAPÉ -->
    <footer id="rodape">
        <!-- Categorias -->
       <span>
            <h1>Categorias</h1>
            <ul>
                <li><a href="pulseira.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=pulseira">Pulseiras</a></li>
                <li><a href="colar.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=Colar%2C+Index">Colares</a></li>
                <li><a href="brinco.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=brinco">Brincos</a></li>
                <li class="ultimo"><a href="conjunto.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=conjunto">Conjuntos</a></li>
            </ul>
        </span>

        <!-- Minha Conta -->
        <span>
            <h1>Conta</h1>
            <ul>
                <?php if(!isset($_SESSION['id_usuario'])): ?>
                <li><a href="login.php">Iniciar Sessão</a></li>
                <li class="ultimo"><a href="cadastro.php">Criar Conta</a></li>
                <?php else: ?>
                <li><a href="minha-conta.php">Minha Conta</a></li>
                <li><a href="#">Histórico</a></li>
                <li class="ultimo"><a href="../src/script/destroy_session.php">Encerrar Sessão</a></li>
                <?php endif; ?>
            </ul>
        </span>

        <!-- Contato -->
        <span>
            <h1>Entre em Contato</h1>
            <ul>
                <li class="ultimo"><a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank"><ion-icon style="font-size: 1.25em;" name="logo-instagram"></ion-icon> @bellaacessoriosreal</a></li>
            </ul>
        </span>

        <!-- Brands -->
        <span>
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
            <a href="https://www.instagram.com/bellaacessoriosreal/profilecard/" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
        </span>
    </footer>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         
</body>
</html>