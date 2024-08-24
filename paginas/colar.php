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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colares</title>
    <link rel="stylesheet" href="../src/script/style.css">
    <link rel="stylesheet" href="../src/script/responsivo.css">
    <link rel="shortcut icon" href="../src/favicon/android-chrome-512x512.png" type="image/x-icon">
</head>
<body>
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
                    <div class="listamenu">
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
                    <ion-icon name="cart-outline" class="iconbtn"></ion-icon><br>Carrinho
                    <div class="listamenu btncarrinho">
<a href="#" class="link-listamenu mostrarcarrinho">Ver Carrinho</a>
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
        <ion-icon name="cart-outline"></ion-icon>
        <h1>Seu carrinho está vazio!</h1> <br>
        <p>Escolha algum produto e adicione ao carrinho para realizar sua compra!</p> <br>
        <a id="fecharcarrinho">Voltar</a>
    </aside>

    <!-- Link âncora para voltar ao topo da página -->
    <a name="topo"></a>

    <article id="catalogo">
        <!-- Imagens (por enquanto placeholders, eles são originais do index) -->
        <picture>
            <source media="(min-width: 1063px)" srcset="../src/img/catalogo-pc.jpeg">
            <source media="(min-width: 530px)" srcset="../src/img/catalogo-tablet.jpeg">
            <source media="(min-width: 0px)" srcset="../src/img/catalogo-mobile.jpeg">
            <img src="../src/img/ph-catalogo-pc.jpg" alt="Imagem de Catálogo">
        </picture>
    </article>
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
    if (!empty($mat)) {$result_pesquisa .= " and material_prod like '$mat'";}
    if (!empty($tam)) {$result_pesquisa .= " and tamanho_prod like '$tam'";}
    if (!empty($cat)) {$result_pesquisa .= " and tipo_prod like '$cat'";}

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

    echo "<div id='container-produtos' style='margin-top: 0;'>";
    // pesquisa maior que 0
    if ($pesquisa != '' && mysqli_num_rows($resultados) > 0) {
        echo "<h1>EXIBINDO RESULTADOS PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
        echo "<p>Resultado: " . $quantia_results . " produto(s)</p>";
    // pesquisa igual a 0
    } else if ($pesquisa != '' && mysqli_num_rows($resultados) == 0) {
        echo "<h1>NENHUM RESULTADO ENCONTRADO PARA &#34;" . strtoupper(htmlspecialchars($pesquisa)) . "&#34;</h1>";
    // pesquisa relacionada ao filtro, pois não terá termo definido na $pesquisa
    } else {
        if (mysqli_num_rows($resultados) == 0) {
            echo "<h1>NENHUM RESULTADO ENCONTRADO :( </h1>";
        } else {
            echo "<h1>EXIBINDO RESULTADOS</h1>";
            echo "<p>Resultado: " . $quantia_results . " produto(s)</p>";
        }
    }

    //FILTRO MOBILE
    echo "<span id='filtro-mobile' class='ajuste-filtro-mobile'><ion-icon name='options-outline'></ion-icon></span>";
    echo 
    "<div id='aba-filtro-mobile' class='ajustar-aba-filtro'>    
        <form action='pesquisa.php' method='get' name='pesquisa-filtro' id='pesquisa-filtro'>
        
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
            <option value='%Prata%'>Prata</option>
            <option value='%Joia%'>Pedras</option>
            <option value='%Aço Inoxidável%'>Aço inoxidável</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select name='tamanho' id='tamanho'>
            <option value=''>A escolher</option>
            <option value='pequeno'>Pequeno</option>
            <option value='médio'>Médio</option>
            <option value='grande'>Grande</option>
            <option value='ajustavel'>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select name='categoria' id='categoria'>
            <option value=''>A escolher</option>
            <option value='%pulseira%'>Pulseiras</option>
            <option value='%colar%'>Colares</option>
            <option value='%brinco%'>Brincos</option>
            <option value='%conjunto%'>Conjuntos</option>
        </select>

        <!-- BOTÃO FILTRAR -->
        <input type='submit' value='Filtrar' class='btn-filtrar'>
        </form>
    </div>";
    
    // Div que agrupa filtros e produtos mostrados
    echo "<div id='pesquisa-prod'>";
    // FILTRO
    echo 
    "<div id='filtro'>    
        <form action='pesquisa.php' method='get' name='pesquisa-filtro' id='pesquisa-filtro'>
        
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
            <option value='%Prata%'>Prata</option>
            <option value='%Joia%'>Pedras</option>
            <option value='%Aço Inoxidável%'>Aço inoxidável</option>
        </select>

        <!-- TAMANHO -->
        <h1>Tamanho</h1>
        <select name='tamanho' id='tamanho'>
            <option value=''>A escolher</option>
            <option value='pequeno'>Pequeno</option>
            <option value='médio'>Médio</option>
            <option value='grande'>Grande</option>
            <option value='ajustavel'>Ajustável</option>
        </select>

        <!-- TIPO - CATEGORIA -->
        <h1>Categoria</h1>
        <select name='categoria' id='categoria'>
            <option value=''>A escolher</option>
            <option value='%pulseira%'>Pulseiras</option>
            <option value='%colar%'>Colares</option>
            <option value='%brinco%'>Brincos</option>
            <option value='%conjunto%'>Conjuntos</option>
        </select>

        <!-- BOTÃO FILTRAR -->
        <input type='submit' value='Filtrar' class='btn-filtrar'>
        </form>
    </div>";

    // Div Produtos
    echo "<div id='produtos-resultado'>";

    // Listando Resultados
    while ($row_produtos = mysqli_fetch_array($resultados)) {
        $id = $row_produtos['id_prod'];
        $nome_img = "../src/img/produto" . $id . ".png";
        echo
        "<div class='produto' style='margin-top: 0px;'>
            <img src='$nome_img' alt='Produto'>
            <div class='info-prod-mobile'>
                <div class='info-txt'>
                    <p>" . $row_produtos['nome_prod'] . "</p>
                    <p class='preco'> R$" . $row_produtos['preco'] . 
                    "</p><p class='descricao-prod'>" . $row_produtos['descricao_prod'] . "</p>
                </div>
                <div class='botoes-produto'>
                    <button class='btn-compra' btn-placeholder='Comprar'></button>
                    <ion-icon name='add-outline'></ion-icon>
                    <ion-icon name='bag-check-outline' class='icon-mobile-compra'></ion-icon>
                </div>
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