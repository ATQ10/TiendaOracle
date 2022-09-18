<?php
    //Sesión no activa se redirecciona a login
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');  
    //Conectar al servidor Mysql y a la base de datos foro
    include ("conexion.php");
    $conexion = conectar();
   //Agregamos imagenes a la carpeta /imagenes/productos/
   if(is_file($_FILES['archivo']['tmp_name'])){
        copy($_FILES['archivo']['tmp_name'],"imagenes/productos/".$_FILES['archivo']['name']);
        echo "<script type=\"text/javascript\">alert(\"Imagen agregada\");</script>";
        //Sentencias de consulta SQL
        $sql="UPDATE producto SET nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']." ', imagen = '".$_FILES['archivo']['name']."', idcat = '".$_POST['categoria']."', precio = '".$_POST['precio']."', existencia = '".$_POST['existencia']."', idprov = '".$_POST['idprov']."' WHERE idp = ".$_SESSION['idc-act'];
   }else{
        $sql="UPDATE producto SET nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']."', idcat = '".$_POST['categoria']."', precio = '".$_POST['precio']."', existencia = '".$_POST['existencia']."', idprov = '".$_POST['idprov']."' WHERE idp = ".$_SESSION['idc-act'];
   }
    
    //Verificamos consulta
    $result = oci_parse($conexion, $sql);
    //Recorremos cada registro y obtenemos los valores
    //de las columnas especificadas
            
    if (oci_execute($result) == TRUE){
        echo "<script type=\"text/javascript\">alert(\"Actualizado\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"cambiar-producto.php?id=".$_SESSION['idc-act']."\";</script>";
        $_SESSION['idc-act']=0;
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
        //echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    oci_close($conexion);
?>