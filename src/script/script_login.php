<?php
    header("Content-type=text/html,charset=utf-8");
    include("conexao.php");
    //Variáveis
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $query = "SELECT * FROM cliente WHERE email_cli = '$email' AND senha_cli = '$senha'";

    if (mysqli_query($conexao, $query)) {
        $resultado = mysqli_query($conexao, $query);
        $usuario = mysqli_fetch_assoc($resultado);

        session_start();
        $_SESSION['nome_exibir'] = $usuario['nome_cli'] ? $usuario['nome_cli'] : '';
        $_SESSION['email_exibir'] = $usuario['email_cli'] ? $usuario['email_cli'] : '';
        $_SESSION['tell_exibir'] = $usuario['tel_cli'] ? $usuario['tel_cli'] : '';

        echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
        exit;
    } else {
        echo "<script>alert('Dados incorretos!');</script>";
        echo "<script>window.location.href='/TCC/paginas/login.php';</script>";
    }
?>