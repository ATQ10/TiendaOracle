<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['autentificado']!=TRUE)
        header('Location: login.php');
    if($_POST['password']!=$_POST['cpassword']){
?>
    <script language="JavaScript">
        window.alert("Las contraseñas no coinciden");
        window.history.back();
    </script>   
<?php 
    }else{
        //Conectar al servidor Oracle y a la base de datos foro
        include ("conexion.php");
        $conexion = conectar();
        //Sentencias de consulta SQL
        $sql = "UPDATE usuario SET nombre = '".$_POST['nombre']."', ape_pat = '".$_POST['ape_pat']."', ape_mat = '".$_POST['ape_mat']."', email = '".$_POST['email']."', telefono = '".$_POST['telefono']."', fecha = to_date('".$_POST['fecha']."', 'YYYY-mm-dd'), password = '".$_POST['password']."', gustos = '".$_POST['gustos']."', idnac = '".$_POST['pais']."' WHERE idu = ".$_SESSION['idu'];
        //Verificamos consulta
        $result = oci_parse($conexion, $sql);
        if (oci_execute($result) == TRUE){
            //Actualizamos variables de sesión
            $_SESSION['autentificado']=TRUE;
            $_SESSION['nombre']=$_POST["nombre"];
            $_SESSION['ape_pat']=$_POST["ape_pat"];
            $_SESSION['ape_mat']=$_POST["ape_mat"];
            $_SESSION['fecha']=$_POST["fecha"];
            $_SESSION['email']=$_POST["email"];
            $_SESSION['telefono']=$_POST["telefono"];
            $_SESSION['password']=$_POST['password'];
            $_SESSION['gustos']=$_POST['gustos'];
            $_SESSION['idnac']=$_POST['pais'];
            echo "<script type=\"text/javascript\">alert(\"Actualizado\");</script>";
            echo "<script type=\"text/javascript\">window.location=\"perfil.php\";</script>";
        } else {
            //echo 'Error: '. $sql . '<br>'.$conexion->error;
            echo "<script type=\"text/javascript\">alert(\"Intente mas tarde\");</script>";
            //echo "<script type=\"text/javascript\">window.history.back();</script>";
        }
        oci_close($conexion);
    }
?>