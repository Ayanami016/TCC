<?php
    include('../src/script/conexao.php');
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

    echo "
    <head>
        <link rel='shortcut icon' href='../src/favicon/android-chrome-512x512.png' type='image/x-icon'>
    </head>";

    if (isset($_GET['id'])) {
        $id_produto = $_GET['id'];
    
        // Consulta dos detalhes do produto
        $query = "SELECT * FROM produto WHERE id_prod = $id_produto";
        $resultado = mysqli_query($conexao, $query);

        // Lista de cores disponiveis
        $cor_disponivel = [
            'Azul Escuro' => '#0f37a6',
            'Azul Claro' => '#2cc0de',
            'Preto' => '#000000',
            'Rosa' => '#ed558d',
            'Rosa Claro' => '#f797ba',
            'Rosa Choque' => '#f7075f',
            'Prata' => 'background-color: #e0e0e0; background: var(--prateado)',
            'Transparente' => 'background-color: #ffffff; background: var(--transparente)',
        ];
        // $cor_disponivel = [
        //     ['Azul Escuro' => '#0f37a6', 'borda' => '#040e66'],
        //     ['Azul Claro' => '#2cc0de', 'borda' => '#0b5d9c'],
        //     ['Preto' => '#000000', 'borda' => '##808080'],
        //     ['Rosa' => '#ed558d', 'borda' => '#d11755'],
        //     ['Rosa Claro' => '#f797ba', 'borda' => '#db608d'],
        //     ['Rosa Choque' => '#f7075f', 'borda' => '#ab0537'],
        //     ['Prata' => 'background-color: #e0e0e0; background: var(--prateado)', 'borda' => '#a3a3a3'],
        //     ['Transparente' => 'background-color: #ffffff; background: var(--transparente)', 'borda' => '#8a8787'],
        // ];


        // Se o produto foi encontrado
        if (mysqli_num_rows($resultado) > 0) {
            $nome_img = "../src/img/produto" . $id_produto . ".png";
            $produto = mysqli_fetch_assoc($resultado);

            // Cores
            $cores = explode(', ', $produto['cor_prod']);

            echo "<a name='topo'></a>"; // Link âncora para voltar ao topo
            // Início DIV #pag-produto
            echo "<div id='pag-produto'>";
            echo // DIV responsável por agrupar as imagens
            "<div class='img-pag-produto'>
                <div class='mais-img-produto'>";
                    $contagem = 0;

                    while (true) {
                        $caminho = $contagem == 0 ? $nome_img : "../src/img/produto" . $id_produto . "_" . $contagem . ".png";

                        if (file_exists($caminho)) {
                            echo "<img src='$caminho'>";
                        } else {
                            break;
                        }
                        $contagem++;
                    }
            echo "</div>

                <img src='$nome_img' alt='Produto'>
            </div>";
            echo // DIV responsável pelo texto
            "<div class='txt-pag-produto'>
                <form action='' method='post'>
                    <h1>" . $produto['nome_prod'] . "</h1>
                    <p class='preco-pag-produto'>R$" . $produto['preco'] . "</p>
                        <div class='checkbox-cor'>";

                    foreach ($cores as $cor_prod) {
                        $hex = isset($cor_disponivel[$cor_prod]) ? $cor_disponivel[$cor_prod] : '#000000';

                        echo "
                                <input type='radio' name='cores[]' id='cor_$cor_prod' value='$cor_prod'>
                                <label for='cor_$cor_prod' class='quadrado-cor' style='background-color: $hex;' title='$cor_prod'></label>";
                    }

                    echo "</div>"; // Fim da DIV checkbox-cor
                    
                    echo "<a href='linkdescricao'>Ver mais detalhes</a> <br>
                    <input type='submit' value='Comprar'>
                </form>
            </div>";

            //Fim DIV #pag-produto
            echo "</div>";
        } else {
            echo "<p>Produto não encontrado.</p>";
        }
    } else {
        echo "<p>Nenhum produto selecionado.</p>";
    }
    
    // Fechar a conexão com o banco de dados
    mysqli_close($conexao);
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
            <a href="../index.php"><img src="../src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
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
                    <ion-icon name="bag-handle-outline" class="iconsacola" color="light"></ion-icon>
                    <div class="listamenu btnsacola">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <a href="#" class="link-listamenu">Checkout</a>
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

                <!-- Suporte -->
                <button class="btnmenu-pc">
                    <ion-icon name="chatbubbles-outline" class="iconbtn"></ion-icon><br>Suporte
                    <div class="listamenu">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="#" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-pc">
                    <ion-icon name="bag-handle-outline" class="iconbtn"></ion-icon><br>Sacola
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarsacola">Ver Sacola</a>
                        <a href="#" class="link-listamenu">Checkout</a>
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

    <!-- BARRA LATERAL - HISTÓRICO -->
    <aside id="carrinho" style="display: none;">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!-- Escuro -->
    <div id="escuro" style="display: none;"></div>

    <!-- VOLTAR AO TOPO -->
    <div class="voltar-topo">
        <a href="#topo">Voltar ao Topo <ion-icon name="chevron-up-outline"></ion-icon></a>
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
            <a href="https://github.com/Ayanami016/TCC" target="_blank"><i class="fab fa-github fa-lg"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
        </span>
    </footer>

    <!--JAVASCRIPT-->
    <script src="../src/script/javascript.js" type="text/javascript"></script>
        <!-- Ícones -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <!-- Font Awesome - usado para o rodapé -->
    <script src="https://kit.fontawesome.com/750ae9b6a4.js" crossorigin="anonymous"></script>
</body>
</html>