<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $banco = "tcc";

    $conexao = @mysqli_connect($host,$user,$password,$banco) or die ("Problemas com a conexão no banco de dados.");
?>