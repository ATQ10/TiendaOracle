<?php
    //continua la sesión
    session_start();
    //destruye la sesión
    session_unset();
    session_destroy();
    //regresa al index
    header('Location: index.php');
?>