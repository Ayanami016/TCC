<?php
    header("Content-type=text/html,charset=utf-8");
    include("conexao.php");

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['tel'];
    $senha = $_POST['senha'];

    $insere = "insert into cliente (nome_cli, email_cli, cpf_cli, tel_cli, senha_cli) values ('$nome','$email','$cpf','$telefone','$senha')";
    $resultado = mysqli_query($conexao,$insere);

    if (!$resultado) {
        die('Query Inválida: ' . @mysqli_error($conexao));
    } else {
        echo "Dados registrados com sucesso!";
    }
    mysqli_close($conexao);
?>