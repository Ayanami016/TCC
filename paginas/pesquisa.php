<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
    <header>
        <span>
            <a href="index.html"><img src="../src/img/Bella Logo com Fundo.png" alt="Logo" class="logo"></a>
        </span>

        <form action="pesquisa.php" method="post">
            <input type="search" name="pesquisa" id="pesquisa" class="menu-pesquisa" placeholder="Buscar">
        </form>

        <nav>
            <!--Menu Mobile-->
            <span class="alterna-menu" id="menu-mobile">
                <ion-icon name="menu" class="iconmenu" color="light"></ion-icon>
            </span>

            <!--Menu PC-->
            <span id="menu-pc">
                <a href="#" class="link-menupc">Pulseiras</a>
                <a href="#" class="link-menupc">Anéis</a>
                <a href="#" class="link-menupc">Colares</a>
                <a href="#" class="link-menupc">Brincos</a>
            </span>

            <!--Menu Mobile-->
            <span class="alterna-botoes">
                <!-- Conta -->
                <button class="btnmenu-mobile">
                    <ion-icon name="person-circle-outline" class="iconconta" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <a href="minha-conta.html" class="link-listamenu">Minha Conta</a>
                    </div>
                </button>

                <!-- Suporte -->
                <button class="btnmenu-mobile">
                    <ion-icon name="chatbubbles-outline" class="iconsuporte" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="#" class="link-listamenu">Contato</a>
                        <a href="faq.html" class="link-listamenu">FAQ</a>
                    </div>
                </button>

                <!-- Carrinho -->
                <button class="btnmenu-mobile">
                    <ion-icon name="cart-outline" class="iconcarrinho" color="light"></ion-icon>
                    <div class="listamenu">
                        <a href="#" class="link-listamenu mostrarcarrinho">Ver Carrinho</a>
                        <a href="#" class="link-listamenu">Checkout</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                    </div>
                </button>
            </span>

            <!--Menu PC-->
            <span id="botoes-pc">
                <!-- Conta -->
                <button class="btnmenu-pc">
                    <ion-icon name="person-outline" class="iconbtn"></ion-icon><br>Conta
                    <div class="listamenu btnconta">
                        <a href="login.php" class="link-listamenu">Iniciar Sessão</a>
                        <a href="cadastro.php" class="link-listamenu">Criar Conta</a>
                        <a href="minha-conta.html" class="link-listamenu">Minha Conta</a>
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
                    <ion-icon name="cart-outline" class="iconbtn"></ion-icon><br>Carrinho
                    <div class="listamenu btncarrinho">
                        <a href="#" class="link-listamenu mostrarcarrinho">Ver Carrinho</a>
                        <a href="#" class="link-listamenu">Checkout</a>
                        <a href="#" class="link-listamenu">Histórico</a>
                    </div>
                </button>
            </span>
        </nav>
    </header>

    <span class="menu-pesquisa-mobile">
        <input type="search" name="pesquisa" id="pesquisa" placeholder="Buscar">
    </span>
    <span class="menu-pc-mobile">
        <a href="#">Pulseiras</a>
        <a href="#">Anéis</a>
        <a href="#">Colares</a>
        <a href="#">Brincos</a>
    </span>

    <!-- BARRA LATERAL - HISTÓRICO -->
    <aside id="carrinho" style="display: none;">
        <ion-icon name="cart-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!-- Link âncora para voltar ao topo da página -->
    <a name="topo"></a>

<?php
    include("../src/script/conexao.php");

    if ($conexao->connect_error) {
        die("Há uma falha no banco de dados!" . $conexao->connect_error);
    }

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

    // Contagem de Resultados para exibição
    //Início div que contém quantia de resultados e produtos
    $quantia_results = mysqli_num_rows($resultados);
    echo "<div id='container-produtos'>
        <h1>EXIBINDO RESULTADOS PARA &#34;" . strtoupper($pesquisa) . "&#34;</h1>";
        
    if (mysqli_num_rows($resultados) == 0) {
        echo "<p>Não encontramos resultados para sua pesquisa :(</p>";
    } else {
        echo "<p>Resultado: " . $quantia_results . " produtos</p>";
    }

    // Div que agrupa filtros e produtos mostrados
    echo "<div id='pesquisa-prod'>";

    echo 
    "<div id='filtro'>
        <!-- PREÇO -->
        <h1>Preço</h1>
        <label for='preco'>Ordenar por:</label>
        <select name='preco'>
            <option>A escolher</option>
            <option>Maiores preços</option>
            <option>Menores preços</option>
        </select>

        <!-- MATERIAL -->
        <h1>Material</h1>
        <select>
            <option>A escolher</option>
            <option>Couro</option>
            <option>Metal</option>
            <option>Prata</option>
            <option>Aço inoxidável</option>
            <option>Algodão</option>
            <option>Pérolas</option>
            <option>Zircônia</option>
            <option>Tungstênio</option>
            <option>Ouro</option>
            <option>Topázio</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select>
            <option>A escolher</option>
            <option>P</option>
            <option>M</option>
            <option>G</option>
            <option>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select>
            <option>A escolher</option>
            <option>Pulseiras</option>
            <option>Anéis</option>
            <option>Colares</option>
            <option>Brincos</option>
        </select>
    </div>";

    // Div Produtos
    echo "<div class='produtos-resultado'>";

    // Listando Resultados
    while ($row_produtos = mysqli_fetch_array($resultados)) {
        echo
        "<div class='produto' style='margin-top: 0px;'>
            <img src='../src/img/ph-produto-anel.jpg' alt='Produto'>
            <p>" . $row_produtos['nome_prod'] . "</p>" .
            "<p class='preco'> R$" . $row_produtos['preco'] . "</p>" .
            "<div class='botoes-produto'>
                <button class='btn-compra' btn-placeholder='Comprar'></button>
                <ion-icon name='add-outline'></ion-icon>
            </div>
        </div>";
    }

    //Fim DIVs
    echo "</div></div></div>";

    mysqli_close($conexao);
?>

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
                <li><a href="#">Pulseiras</a></li>
                <li><a href="#">Anéis</a></li>
                <li><a href="#">Colares</a></li>
                <li class="ultimo"><a href="#">Brincos</a></li>
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