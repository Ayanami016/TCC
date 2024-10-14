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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosso FAQ</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
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


            <span class="alterna-botoes">
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

                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu btnsuporte">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="faq.html" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-mobile">
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

                    <div class="listamenu btnconta">
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

                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu btnsuporte">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="#" class="link-listamenu">FAQ</a>
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

    <!-- Conteudo Placeholder -->
     <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure ea ducimus consequatur saepe, voluptatum natus quam delectus iusto, laboriosam ex incidunt, nemo possimus qui placeat blanditiis animi nisi eos? Culpa! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit earum, animi maiores id hic autem sequi maxime error. Iure sunt ducimus voluptatum laudantium quas! Ipsa eveniet sint dolorum distinctio voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat eius officia dolorem dolor quam sed corporis ducimus voluptatum ipsum? Fuga sunt eligendi molestiae incidunt ex dolorem distinctio accusantium ut nobis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi quod quisquam temporibus natus ullam porro eaque consequatur laboriosam enim, rem ipsam, deleniti recusandae inventore nam velit? Quia, nobis quam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet repellendus deserunt dolores aliquid! Placeat cumque esse adipisci, maxime expedita quaerat, minus enim amet repellat illum aspernatur rem repudiandae incidunt animi. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure ea ducimus consequatur saepe, voluptatum natus quam delectus iusto, laboriosam ex incidunt, nemo possimus qui placeat blanditiis animi nisi eos? Culpa! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit earum, animi maiores id hic autem sequi maxime error. Iure sunt ducimus voluptatum laudantium quas! Ipsa eveniet sint dolorum distinctio voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat eius officia dolorem dolor quam sed corporis ducimus voluptatum ipsum? Fuga sunt eligendi molestiae incidunt ex dolorem distinctio accusantium ut nobis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi quod quisquam temporibus natus ullam porro eaque consequatur laboriosam enim, rem ipsam, deleniti recusandae inventore nam velit? Quia, nobis quam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet repellendus deserunt dolores aliquid! Placeat cumque esse adipisci, maxime expedita quaerat, minus enim amet repellat illum aspernatur rem repudiandae incidunt animi. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure ea ducimus consequatur saepe, voluptatum natus quam delectus iusto, laboriosam ex incidunt, nemo possimus qui placeat blanditiis animi nisi eos? Culpa! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit earum, animi maiores id hic autem sequi maxime error. Iure sunt ducimus voluptatum laudantium quas! Ipsa eveniet sint dolorum distinctio voluptatibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat eius officia dolorem dolor quam sed corporis ducimus voluptatum ipsum? Fuga sunt eligendi molestiae incidunt ex dolorem distinctio accusantium ut nobis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque eligendi quod quisquam temporibus natus ullam porro eaque consequatur laboriosam enim, rem ipsam, deleniti recusandae inventore nam velit? Quia, nobis quam. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet repellendus deserunt dolores aliquid! Placeat cumque esse adipisci, maxime expedita quaerat, minus enim amet repellat illum aspernatur rem repudiandae incidunt animi.</p>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

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
                <li><a href="login.php">Iniciar Sessão</a></li>
                <li class="ultimo"><a href="cadastro.php">Criar Conta</a></li>
            </ul>
        </span>

        <!-- Contato -->
        <span>
            <h1>Entre em Contato</h1>
            <ul>
                <li><a href="#">Número de Telefone</a></li>
                <li class="ultimo"><a href="#">E-mail</a></li>
            </ul>
        </span>

        <!-- Brands -->
        <span>
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><ion-icon name="logo-github"></ion-icon></a>
            <a href="#" target="_blank"><ion-icon name="logo-instagram"></ion-icon></a>
        </span>
     </footer>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!--Ícones-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
         
</body>
</html>