<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
    //Conectar al servidor Mysql y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL (Elimina un categoria y su info)
    $sql = "DELETE FROM categoria WHERE idcat=".$_GET['id'];
    //echo $sql;
    //Verifica y ejecuta consulta
     $result = oci_parse($conexion, $sql);
    if (oci_execute($result) == true){
        echo "<script type=\"text/javascript\">alert(\"Eliminado\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"categorias.php\";</script>";
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    mysqli_close($conexion);
?>