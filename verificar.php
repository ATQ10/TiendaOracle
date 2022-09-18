<?php
    //Sesión activa se redirecciona a index
    session_start();
    if(@$_SESSION['autentificado']==TRUE)
        header('Location: index.php');
    else{
        //Conectar al servidor Mysql y a la base de datos foro
        include ("conexion.php");
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM usuario WHERE email='".$_POST['email']."'";
        $result = oci_parse($conexion,$sql);
        oci_execute($result);

        $existe=0;
        while ($row = oci_fetch_row($result)){
            $existe=1;
            //verificamos contraseña
            if($row[8]== $_POST['password']){
                //Guardamos info en variables de sesión
                $_SESSION['autentificado']=TRUE;
                $_SESSION['idu']=$row[0];
                $_SESSION['nombre']=$row[1];
                $_SESSION['ape_pat']=$row[2];
                $_SESSION['ape_mat']=$row[3];
                $_SESSION['fecha']=$row[4];
                $_SESSION['email']=$row[5];
                $_SESSION['telefono']=$row[6];
                $_SESSION['tipo']=$row[7];
                $_SESSION['password']=$_POST['password'];
                $_SESSION['gustos']=$row[9];
                $_SESSION['idnac']=$row[10];
                //Fecha
                $_SESSION['fecha'] = DateTime::createFromFormat('d/m/y', $_SESSION['fecha'])->format('Y-m-d');
                verificarDomicilio();
                echo "<script type=\"text/javascript\">alert(\"Bienvenid@\");</script>";
                echo "<script type=\"text/javascript\">window.location=\"index.php\";</script>";
            }else{
                //Contraseña incorrecta
                echo "<script type=\"text/javascript\">alert(\"Contraseña incorrecta\");</script>";
                echo "<script type=\"text/javascript\">window.history.back();</script>";
            }
        }
        if($existe==0) {
            //No existe usuario
            echo "<script type=\"text/javascript\">alert(\"No existe usuario\");</script>";
            echo "<script type=\"text/javascript\">window.history.back();</script>";
        }
        oci_close($conexion);
    }

    function verificarDomicilio(){
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
        $sql = "SELECT * FROM domicilio WHERE idu='".$_SESSION['idu']."'";
        $result = oci_parse($conexion,$sql);
        oci_execute($result);
        $nuevo=0;

        
        while ($row = oci_fetch_row($result)){
            $nuevo=1;
            $_SESSION['cp']=$row[1];
            $_SESSION['calle']=$row[2];
            $_SESSION['n_ext']=$row[3];
            $_SESSION['n_int']=$row[4];
            $_SESSION['colonia']=$row[5];
            $_SESSION['ciudad']=$row[6];
            $_SESSION['estado']=$row[7];
        }
    

        if($nuevo==0){
            $sql = "INSERT INTO domicilio (idu, cp, calle, n_ext, n_int, colonia, ciudad, estado) VALUES ('".$_SESSION['idu']."', '', NULL, '', '', NULL, NULL, NULL)";
            $result = oci_parse($conexion,$sql);
            oci_execute($result);
            /*
            if($result)
                    echo "<script type=\"text/javascript\">alert(\"Generado\");</script>";
            else
                    echo "<script type=\"text/javascript\">alert(\"".mysqli_error($conexion)."\");</script>";
            */
            $_SESSION['cp']="";
            $_SESSION['calle']="";
            $_SESSION['n_ext']="";
            $_SESSION['n_int']="";
            $_SESSION['colonia']="";
            $_SESSION['ciudad']="";
            $_SESSION['estado']="";
        }
        oci_close($conexion);
    }
?>