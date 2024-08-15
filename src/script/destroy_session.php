<?php
    session_start();
    $_SESSION = array();

    session_unset();
    session_destroy();
    header("Location: /TCC/paginas/index.php");
    exit();
?>