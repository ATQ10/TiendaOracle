<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');  
    //Conectar al servidor Mysql y a la base de datos foro
    include ("conexion.php");
    $conexion = conectar();
    $sql="UPDATE categoria SET categoria = '".$_GET['categoria']."' WHERE idcat = ".$_GET['id'];
  
     $result = oci_parse($conexion, $sql);
    //Verificamos consulta
    if (oci_execute($result) == TRUE){
        echo "<script type=\"text/javascript\">alert(\"Actualizado\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"categorias.php\";</script>";
        $_SESSION['idc-act']=0;
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
   // mysqli_close($conexion);
?>