<?php
include('conexao.php');
include('.../paginas/pesquisa.php');

// Filtro
$filtro = $_POST['pesquisa-filtro'];
    // Preço
$precoMin = $_POST['min'];
$precoMax = $_POST['max'];
$precoOrdenado = $_POST['preco-ordem'];
    // Material
$mat = $_POST['material'];
    // Tamanho
$tam = $_POST['tamanho'];
    // Categoria
$cat = $_POST['categoria']; 
//   |\__/,|   (`\
// _.|o o  |_   ) )
// -(((---(((--------

$result_filtro = "select * from produto where 
    tipo_prod like '%$cat%' and
    material_prod like '%$mat%' and
    tamanho_prod like '%$tam%'";

$result_precomin = "select from produto where preco = (select MIN(preco) from produto";
$result_precomax = "select from produto where preco = (select MAX(preco) from produto";

function OrdenarPreco($precoOrdenado) {
    if (this.value == 'Maiores preços') {
        $precoOrdenado = "select * from produtos order by preco Asc";
    } else if (this.value == 'Menores preços') {
        $precoOrdenado = "select * from produtos order by preco Desc";
    } else {
        return false;
    }
}

$resultados_filtro = mysqli_query($conexao, $result_filtro, $result_precomin, $result_precomax, OrdenarPreco);
?>