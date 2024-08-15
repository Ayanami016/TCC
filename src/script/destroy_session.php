<?php
    session_start();
    $_SESSION = array();

    session_destroy();
    header("Location: /TCC/paginas/index.html");
    exit();
?>