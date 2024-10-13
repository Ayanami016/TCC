<?php
    include('conexao.php');
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        // Deleta a conta
        $delete = "DELETE FROM cliente WHERE id_cliente = '$id_usuario'";

        if (mysqli_query($conexao, $delete)) {
            session_unset();
            session_destroy();

            header("Location: /TCC/paginas/index.php");
            exit();
        } else {
            echo "Erro ao excluir a conta: " . mysqli_error($conexao);
        }
    } else {
        // Caso o usuário não esteja logado
        header("Location: /TCC/paginas/login.php");
        exit();
    }
    mysqli_close($conexao);
?>