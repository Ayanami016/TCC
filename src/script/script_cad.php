<?php
    header("Content-type=text/html,charset=utf-8");
    include("conexao.php");
    //Variáveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['tel'];
    $senha = $_POST['senha'];
    $confirmarsenha = $_POST['confirmarsenha'];
    $pontos = 0;

    //Validação dos Dados
    //Nome
    $expressaoNome = '/^[a-zA-ZÀ-ÿ\s]+$/';
    if (!preg_match($expressaoNome, $nome)) {
        echo "<script>alert('Nome inválido!')</script>";
        echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
    } else {
        $pontos = $pontos + 1;
    }

    //CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        echo "<script>alert('CPF inválido!')</script>";
        echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
    } else {
        $pontos = $pontos + 1;
    }

    //Telefone
    if (strlen($telefone) != 14) {
        echo "<script>alert('Telefone inválido!')</script>";
        echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
    } else {
        $pontos = $pontos + 1;
    }

    //Senha
    if (strlen($senha) < 8) {
        echo "<script>alert('A senha deve conter pelo menos 8 caracteres!')</script>";
        echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
    } else {
        $pontos = $pontos + 1;
    }

    //Confirmar Senha
    if ($senha != $confirmarsenha) {
        echo "<script>alert('As senhas não coincidem!')</script>";
        echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
    } else {
        $pontos = $pontos + 1;
    }

    // Para validar, $pontos == 5
    // Inserção no Banco
    if ($pontos == 5) {
        $insert = "insert into cliente (nome_cli, email_cli, cpf_cli, tel_cli, senha_cli) values ('$nome','$email','$cpf','$telefone','$senha')";
    
        if (mysqli_query($conexao, $insert)) {
            // Verificação se os dados existem no banco
            $query = "SELECT * FROM cliente WHERE nome_cli = '$nome' AND email_cli = '$email' AND tel_cli = '$telefone'";
            $resultado = mysqli_query($conexao, $query);
            $usuario = mysqli_fetch_assoc($resultado);

            session_start();
            $_SESSION['nome_exibir'] = $usuario['nome_cli'] ? $usuario['nome_cli'] : '';
            $_SESSION['email_exibir'] = $usuario['email_cli'] ? $usuario['email_cli'] : '';
            $_SESSION['tell_exibir'] = $usuario['tel_cli'] ? $usuario['tel_cli'] : '';
            
            echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
        } else {
            die(mysqli_error($conexao));
            echo "<script>window.location.href='/TCC/paginas/cadastro.php';</script>";
        }
    }
    mysqli_close($conexao);
?>