<?php
    session_start();
    include('conexao.php');   

    $nome = !empty($_POST['editar-nome']) ? mysqli_real_escape_string($conexao, $_POST['editar-nome']) : null;
    $tel = !empty($_POST['editar-tel']) ? mysqli_real_escape_string($conexao, $_POST['editar-tel']) : null;
    $senha = !empty($_POST['editar-senha']) ? mysqli_real_escape_string($conexao, $_POST['editar-senha']) : null;
    $id = $_SESSION['id_usuario'];

    // Verifica se os campos foram preenchidos
    // Não é necessário que o usuário altere todos os dados, apenas aquilo que ele deseja
    $updates = [];

    if (!empty($nome)) {
        $updates[] = "nome_cli='$nome'";
    }
    if (!empty($tel)) {
        if (strlen($tel) != 14) {
            echo "<script>alert('Telefone inválido!')</script>";
            echo "<script>window.location.href='/TCC/paginas/editar-dados.php';</script>";
        } else {
           $updates[] = "tel_cli='$tel'"; 
        }
    }
    if (!empty($senha)) {
        if (strlen($senha) < 8) {
            echo "<script>alert('A senha deve conter pelo menos 8 caracteres!')</script>";
            echo "<script>window.location.href='/TCC/paginas/editar-dados.php';</script>";
        } else {
            $updates[] = "senha_cli='$senha'";
        }
    }

    if (count($updates) > 0) {
    // Concatena todas as partes da query de atualização
    $update_query = "UPDATE cliente SET " . implode(", ", $updates) . " WHERE id_cliente='$id'";

    if (count($updates) > 0) {
        // Concatena todas as partes da query de atualização
        $update_query = "UPDATE cliente SET " . implode(", ", $updates) . " WHERE id_cliente='$id'";
    
        if (mysqli_query($conexao, $update_query)) {
            // Atualiza os valores na sessão se eles foram alterados
            if (!empty($nome)) {
                $_SESSION['nome_exibir'] = $nome;
            }
            if (!empty($tel)) {
                $_SESSION['tel_exibir'] = $tel;
            }
            
            echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='/TCC/paginas/minha-conta.php';</script>";

        } elseif (count($updates) == 0) {
            echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
        }
        } else {
            echo "<script>alert('Erro ao atualizar os dados.'); window.location.href='/TCC/paginas/minha-conta.php';</script>" . mysqli_error($conexao);
        }
    } else {
        // Se nenhum dado foi preenchido, exibe uma mensagem informando o usuário
        echo "<script>window.location.href='/TCC/paginas/minha-conta.php';</script>";
    }
    mysqli_close($conexao);
?>