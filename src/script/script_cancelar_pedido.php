<?php
    include('conexao.php');
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_pedido = $_POST['id_pedido'];

        // Inicia uma transação
        $conexao->begin_transaction();

        try {
            // Tabela entrega
            $sql_entrega = "DELETE FROM entrega WHERE fk_pedido = ?";
            $stmt_entrega = $conexao->prepare($sql_entrega);
            $stmt_entrega->bind_param('i', $id_pedido);
            $stmt_entrega->execute();

            // Tabela item_pedido
            $sql_item = "DELETE FROM item_pedido WHERE fk_pedido = ?";
            $stmt_item = $conexao->prepare($sql_item);
            $stmt_item->bind_param('i', $id_pedido);
            $stmt_item->execute();

            // Quando excluir as dependências, exclui a tabela pedido
            $sql_pedido = "DELETE FROM pedido WHERE id_pedido = ?";
            $stmt_pedido = $conexao->prepare($sql_pedido);
            $stmt_pedido->bind_param('i', $id_pedido);
            $stmt_pedido->execute();

            $conexao->commit();

            echo "<script>alert('Pedido cancelado com sucesso!'); window.location.href = '/TCC/paginas/minha-conta.php';</script>";
        } catch (Exception $e) {
            // Se der erro
            $conexao->rollback();
            echo "<script>alert('Erro ao cancelar o pedido!'); window.location.href = '/TCC/paginas/minha-conta.php';</script>";
        }
    }
    mysqli_close($conexao);
?>
