<?php
    //Sesión activa se redirecciona a la seccion anterior 
    session_start();
    if(@$_SESSION['tipo']==""){
        ?>
    <script language="JavaScript">
        window.alert("Primero debe identificarse");
        window.history.back();
    </script>   
<?php   
    exit(0);
    }
    //Conectar al servidor Oracle y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    $result = oci_parse($conexion,"begin vaciar_comentario(:PARAM); end;");
    oci_bind_by_name($result,':PARAM',$_GET['id']);
    //echo $sql;
    //Verifica y ejecuta consulta
    if (oci_execute($result) == TRUE){
        echo "<script type=\"text/javascript\">alert(\"Comentarios vaciados exitosamente\");</script>";
        echo "<script type=\"text/javascript\">window.location=\"productos.php\";</script>";
    } else {
        //echo 'Error: '. $sql . '<br>'.$conexion->error;
        echo "<script type=\"text/javascript\">alert(\"Intente mas tarde".$_GET['id']."\");</script>";
        //echo "<script type=\"text/javascript\">window.history.back();</script>";
    }
    oci_close($conexion);
?>