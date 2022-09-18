<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['tipo']!="admin")
        header('Location: login.php');
?>
<!DOCTYPE html>
<html>
  <head>
        <!-- Codificación de caracteres -->
        <meta charset="utf-8">
        <title>Administrar</title>
        <!-- Hoja de estilos-->
        <link rel="stylesheet" href="estilos/estilo.css">
    </head>
    <body class="adm">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
        <div class="administrar">
          <img src="imagenes/admin.jpg" class="logo" alt="logo">
          <h1>Administrar</h1>
            <a class="boton-link" href="altas.php">*Nuevo usuario*</a>
          <table border="1" width="90%">
                <tr>
                    <td><strong>Cambios<strong/></td>
                    <td><strong>Bajas<strong/></td>                
                    <td><strong>Nombre<strong/></td>
                    <td><strong>Ape. Pat.<strong/></td>
                    <td><strong>Ape. Mat.<strong/></td>
                    <td><strong>Email<strong/></td>
                    <td><strong>Gustos<strong/></td>
                    <td><strong>Vaciar carrito<strong/></td>
                    <td><strong>Ocultar<strong/></td>
                </tr>
            <?php
            //Conectar al servidor Oracle y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT * from lista_usuarios";
            if(isset($_GET['id']))
              $sql = "SELECT * from lista_usuarios MINUS SELECT * from lista_usuarios WHERE idu=".$_GET['id'];
            $result = oci_parse($conexion, $sql);
             oci_execute($result);
                while ($row = oci_fetch_row($result)){
            ?>
                <tr>
                    <td><a class="boton-link" href="cambiar.php?id=<?=$row[0];?>">Editar</a></td>
                    <td><a class="boton-link" href="bajas.php?id=<?=$row[0];?>">Eliminar</a></td>                
                    <td><?=$row[1];?></td>
                    <td><?=$row[2];?></td>
                    <td><?=$row[3];?></td>
                    <td><a class="boton-link" href="chat.php?chat=<?=$row[0];?>"><?=$row[4];?></a></td>
                    <td><?=$row[5];?></td>
                    <td><a class="boton-link" href="vaciar_carrito_usuario.php?id=<?=$row[0];?>">Vaciar</a></td>                
                    <td><a class="boton-link" href="administrar.php?id=<?=$row[0];?>">Ocultar</a></td>                
                </tr>
            <?php
                }
            ?>
        </table>
        </div>
  </body>
</html>