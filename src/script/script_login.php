<?php
    header("Content-type=text/html,charset=utf-8");
    include("conexao.php");
    //Variáveis
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = "SELECT * FROM cliente WHERE email_cli = '$email' AND senha_cli = '$senha'";
    $resultado = mysqli_query($conexao, $query);

    if (mysqli_num_rows($resultado) > 0) {    
        $usuario = mysqli_fetch_assoc($resultado);

        session_start();
        $_SESSION['nome_exibir'] = $usuario['nome_cli'] ? $usuario['nome_cli'] : '';
        $_SESSION['email_exibir'] = $usuario['email_cli'] ? $usuario['email_cli'] : '';
        $_SESSION['tel_exibir'] = $usuario['tel_cli'] ? $usuario['tel_cli'] : '';
        $_SESSION['id_usuario'] = $usuario['id_cliente'] ? $ussuario['id_cliente'] : '';

        echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
        exit;
    } else {
        echo "<script>alert('Dados incorretos!');</script>";
        echo "<script>window.location.href='/TCC/paginas/login.php';</script>";
    }
?>