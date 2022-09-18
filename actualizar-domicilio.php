<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['autentificado']!=TRUE)
        header('Location: login.php');
    else{
        //Conectar al servidor Mysql y a la base de datos foro
        include ("conexion.php");
        $conexion = conectar();
        //Sentencias de consulta SQL
        $sql = "UPDATE domicilio SET cp=".$_POST["cp"].", calle='".$_POST["calle"]."', n_ext=".$_POST["n_ext"].", n_int=".$_POST["n_int"].", colonia='".$_POST["colonia"]."', ciudad='".$_POST["ciudad"]."', estado='".$_POST["estado"]."' WHERE idu =".$_SESSION['idu'];
        //Verificamos consulta
        $result = oci_parse($conexion, $sql);
        if (oci_execute($result) == TRUE){
            //Actualizamos variables de sesión
            $_SESSION['autentificado']=TRUE;
            $_SESSION['cp']=$_POST["cp"];
            $_SESSION['calle']=$_POST["calle"];
            $_SESSION['n_ext']=$_POST["n_ext"];
            $_SESSION['n_int']=$_POST["n_int"];
            $_SESSION['colonia']=$_POST["colonia"];
            $_SESSION['ciudad']=$_POST["ciudad"];
            $_SESSION['estado']=$_POST['estado'];
            echo "<script type=\"text/javascript\">alert(\"Actualizado\");</script>";
            echo "<script type=\"text/javascript\">window.location=\"domicilio.php\";</script>";
        } else {
            //echo 'Error: '. $sql . '<br>'.$conexion->error;
            echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
            echo "<script type=\"text/javascript\">window.history.back();</script>";
        }
        mysqli_close($conexion);
    }
?>