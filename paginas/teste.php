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

        <form action="teste.php?min=&max=&preco-ordem=&material=&tamanho=&categoria=" method="post">
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

    // Pesquisa - Menu method post
    $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

    // Filtro method get
    $preco_ordem = $_GET['preco-ordem'];
    $precomin = $_GET['min'];
    $precomax = $_GET['max'];
    $mat = $_GET['material'];
    $tam = $_GET['tamanho'];
    $cat = $_GET['categoria'];
    // Adendo: cor não entra em filtro, apenas na pesquisa!

    //      ___
    //  _.-|   |          |\__/,|   (`\
    // {   |   |          |o o  |__ _) )
    //  "-.|___|        _.( T   )  `  /
    //   .--'-`-.     _((_ `^--' /_<  \
    // .+|______|__.-||__)`-'(((/  (((/ MIAU MIAU MIAU

    // Consulta inicial básica para o condicional funcionar
    $result_pesquisa = "select * from produto where 1=1";

    // Condicionais do filtro
        // Preço Min e Máx - Campos de Texto
    if (!empty($precomin)) {$result_pesquisa .= " and preco >= $precomin";}
    if (!empty($precomax)) {$result_pesquisa .= " and preco <= $precomax";}

    // Adição da pesquisa
    $result_pesquisa .= " and (
        descricao_prod like '%$pesquisa%' or
        nome_prod like '%$pesquisa%' or
        tipo_prod like '%$pesquisa%' or
        cor_prod like '%$pesquisa%' or
        material_prod like '%$pesquisa%' or
        tamanho_prod like '%$pesquisa%'
    )";
       
        // Material, Tamanho e Categoria
    if (!empty($mat)) {$result_pesquisa .= "and material_prod = '$mat'";}
    if (!empty($tam)) {$result_pesquisa .= "and tamanho_prod = '$tam'";}
    if (!empty($cat)) {$result_pesquisa .= " and tipo_prod = '$cat'";}

        // Preço Ordenado
    if (!empty($preco_ordem)) {
        if ($preco_ordem == 'asc') {
            $result_pesquisa .= " order by preco asc";
        } elseif ($preco_ordem == 'desc') {
            $result_pesquisa .= " order by preco desc";
        }
    }

    // Resultado Final
    $resultados = mysqli_query($conexao, $result_pesquisa);

    // Contagem de Resultados para exibição
    $quantia_results = mysqli_num_rows($resultados);

    echo "<div id='container-produtos'>";
    // pesquisa maior que 0
    if ($pesquisa != '' && mysqli_num_rows($resultados) > 0) {
        echo "<h1>EXIBINDO RESULTADOS PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
        echo "<p>Resultado: " . $quantia_results . " produtos</p>";
    // pesquisa igual a 0
    } else if ($pesquisa != '' && mysqli_num_rows($resultados) == 0) {
        echo "<h1>NENHUM RESULTADO ENCONTRADO PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
    // pesquisa relacionada ao filtro, pois não terá termo definido na $pesquisa
    } else {
        if (mysqli_num_rows($resultados) == 0) {
            echo "<h1>NENHUM RESULTADO ENCONTRADO :( </h1>";
        } else {
            echo "<h1>EXIBINDO RESULTADOS</h1>";
            echo "<p>Resultado: " . $quantia_results . " produtos</p>";
        }
    }
    
    // Div que agrupa filtros e produtos mostrados
    echo "<div id='pesquisa-prod'>";
    // FILTRO
    echo 
    "<div id='filtro'>    
        <form action='teste.php' method='get' name='pesquisa-filtro' id='pesquisa-filtro'>
        
        <!-- PREÇO -->
        <h1>Preço</h1>
            <span class='filtrar-preco'>
                <input type='text' class='txt-preco' name='min' id='min' placeholder='Min.'>
                <input type='text' class='txt-preco' name='max' id='max' placeholder='Máx.'>
            </span>
            <br>

        <label for='preco'>Ordenar por:</label>
        <select name='preco-ordem' id='preco-ordem'>
            <option value=''>A escolher</option>
            <option value='desc'>Maiores preços</option>
            <option value='asc'>Menores preços</option>
        </select>

        <!-- MATERIAL -->
        <h1>Material</h1>
        <select name='material' id='material'>
            <option value=''>A escolher</option>
            <option value='Couro'>Couro</option>
            <option value='Metal'>Metal</option>
            <option value='Prata'>Prata</option>
            <option value='Aço Inoxidável'>Aço inoxidável</option>
            <option value='Algodão'>Algodão</option>
            <option value='Pérolas>Pérolas</option>
            <option value='Zircônia'>Zircônia</option>
            <option value='Tungstênio'>Tungstênio</option>
            <option value='Ouro'>Ouro</option>
            <option value='Topázio'>Topázio</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select name='tamanho' id='tamanho'>
            <option value=''>A escolher</option>
            <option value='pequeno'>Pequeno</option>
            <option value='médio'>Médio</option>
            <option value='diversos'>Diversos</option>
            <option value='ajustavel'>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select name='categoria' id='categoria'>
            <option value=''>A escolher</option>
            <option value='pulseira'>Pulseiras</option>
            <option value='anel'>Anéis</option>
            <option value='colar'>Colares</option>
            <option value='brinco'>Brincos</option>
        </select>

        <!-- BOTÃO FILTRAR -->
        <input type='submit' value='Filtrar' class='btn-filtrar'>
        </form>
    </div>";

    // Div Produtos
    echo "<div id='produtos-resultado'>";

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