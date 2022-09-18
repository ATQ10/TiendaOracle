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
    //Conectar al servidor Mysql y a la base de datos
    include ("conexion.php");
    $conexion = conectar();
    //Extraemos la tabla productos (id y existancia)
    if($_SESSION['tipo']=="admin"){
        $sql = "INSERT INTO mensaje (idm, idu, mensaje, fecha_hora, estado) VALUES (sec_mensaje.nextval, '".$_SESSION['chat']."', '".$_POST['mensaje']."', systimestamp, '1')";
        echo "<script type=\"text/javascript\">window.location=\"chat.php?chat=".$_SESSION['chat']."\";</script>";
    }
    else{
        $sql = "INSERT INTO mensaje (idm, idu, mensaje, fecha_hora, estado) VALUES (sec_mensaje.nextval, '".$_SESSION['chat']."', '".$_POST['mensaje']."', systimestamp, '0')";
        echo "<script type=\"text/javascript\">window.location=\"chat.php\";</script>";
    }
    $result = oci_parse($conexion,$sql);
    oci_execute($result);
?>
