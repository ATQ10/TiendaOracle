<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
    //Conectar al servidor Mysql y a la base de datos foro
    include ("conexion.php");
    $conexion = conectar();
    //Sentencias de consulta SQL
    //Actualizamos la información del usuario (se asume que la longitud de 32 se debe a misma contraseña encriptada en md5)
    //(De no ser asi, se vuelve a encriptar en el else con md5)
    if(strlen($_POST['password'])==2**5) 
        $sql = "UPDATE usuario SET nombre = '".$_POST['nombre']."', ape_pat = '".$_POST['ape_pat']."', ape_mat = '".$_POST['ape_mat']."', email = '".$_POST['email']."', telefono = '".$_POST['telefono']."', fecha = to_date('".$_POST['fecha']."', 'YYYY-mm-dd'), password = '".$_POST['password']."', gustos = '".$_POST['gustos']."', tipo = '".$_POST['tipo']."' WHERE usuario.idu = ".$_SESSION['idu-act'];
    else
        $sql = "UPDATE usuario SET nombre = '".$_POST['nombre']."', ape_pat = '".$_POST['ape_pat']."', ape_mat = '".$_POST['ape_mat']."', email = '".$_POST['email']."', telefono = '".$_POST['telefono']."', fecha = to_date('".$_POST['fecha']."', 'YYYY-mm-dd'), password = '".$_POST['password']."', gustos = '".$_POST['gustos']."', tipo = '".$_POST['tipo']."' WHERE usuario.idu = ".$_SESSION['idu'];
    $sql2 = "UPDATE domicilio SET cp=".$_POST["cp"].", calle='".$_POST["calle"]."', n_ext=".$_POST["n_ext"].", n_int=".$_POST["n_int"].", colonia='".$_POST["colonia"]."', ciudad='".$_POST["ciudad"]."', estado='".$_POST["estado"]."' WHERE domicilio.idu =".$_SESSION['idu-act'];
    //Verificamos consulta
    verificarDomicilio();
    $result = oci_parse($conexion, $sql);
    $result2 = oci_parse($conexion, $sql2);
    if (oci_execute($result) == TRUE){
        if(oci_execute($result2) == TRUE){
            echo "<script type=\"text/javascript\">alert(\"Actualizado\");</script>";
            echo "<script type=\"text/javascript\">window.location=\"administrar.php\";</script>";
        }
        $_SESSION['idu-act']=0;
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    //mysqli_close($conexion);
    function verificarDomicilio(){
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM domicilio WHERE idu='".$_SESSION['idu-act']."'";
        $result = oci_parse($conexion, $sql);
        if(oci_execute($result) == true){
            /*
             while ($row = $result->fetch_assoc()){
                $_SESSION['cp']=$row["cp"];
                $_SESSION['calle']=$row["calle"];
                $_SESSION['n_ext']=$row["n_ext"];
                $_SESSION['n_int']=$row["n_int"];
                $_SESSION['colonia']=$row["colonia"];
                $_SESSION['ciudad']=$row["ciudad"];
                $_SESSION['estado']=$row["estado"];
             }
            */
        }
        else{
            $sql = "INSERT INTO domicilio (idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('".$_SESSION['idu-act']."', '', NULL, '', '', NULL, NULL, NULL)";
            $result = oci_parse($conexion, $sql);
            /*
            if($result)
                    echo "<script type=\"text/javascript\">alert(\"Generado\");</script>";
            else
                    echo "<script type=\"text/javascript\">alert(\"".mysqli_error($conexion)."\");</script>";
            */
        }
        //mysqli_close($conexion);
    }
?>