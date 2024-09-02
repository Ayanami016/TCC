<?php
    session_start();
    include('conexao.php');   

    $nome = mysqli_real_escape_string($conexao, $_POST['editar-nome']);
    $tel = mysqli_real_escape_string($conexao, $_POST['editar-tel']);
    $senha = mysqli_real_escape_string($conexao, $_POST['editar-senha']);

    // Verifica se os campos foram preenchidos
    // Não é necessário que o usuário altere todos os dados, apenas aquilo que ele deseja
    if (!empty($nome) || !empty($tel) || !empty($senha)) {
        // Atualizando
        $id = $_SESSION['id_usuario'];
        $att = "UPDATE cliente SET nome_cli='$nome', tel_cli='$tel', senha_cli='$senha' WHERE id_cliente='$id'";

        if (mysqli_query($conexao, $att)) {
            $_SESSION['nome_exibir'] = $nome ? $nome : '';
            $_SESSION['tel_exibir'] = $tel ? $tel : '';

            echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
        } else {
            mysqli_error($conexao);
        }
    }
    mysqli_close($conexao);
?>