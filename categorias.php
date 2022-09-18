<?php
    //Sesión no activa se redirecciona a login
    @session_start();
    if(@$_SESSION['tipo']!="admin")
        header('Location: login.php');
?>
<!DOCTYPE html>
<html>
  <head>
        <!-- Codificación de caracteres -->
        <meta charset="utf-8">
        <title>Categorías</title>
        <!-- Hoja de estilos-->
        <link rel="stylesheet" href="estilos/estilo.css">
        <!-- JS-->
        <script>
            function actualizar(id){
                var cat = document.getElementById('categoria'+id).value;
                //alert("cambiar-categoria.php?id="+id+"&categoria="+cat);
                window.location="cambiar-categoria.php?id="+id+"&categoria="+cat;
            }
            function agregar(){
                var cat = document.getElementById('agregar').value;
                //alert("cambiar-categoria.php?id="+id+"&categoria="+cat);
                if(cat!="")
                    window.location="registrar-categoria.php?categoria="+cat;
                else
                    alert("Escriba una categoría");
            }
        </script>
    </head>
    <body class="adm">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
        <div class="administrar">
          <img src="imagenes/adm-cat.png" class="logo" alt="logo">
          <h1>Administrar Categorías</h1>
            <a  class="boton-link"  href="productos.php">*Volver a Productos*</a>
          <table border="1" width="90%">
                <tr>                
                    <td><strong>ID<strong/></td>
                    <td><strong>Categoria<strong/></td>
                    <td colspan="2"><strong>Acciones<strong/></td>
                </tr>
            <?php
            //Conectar al servidor Mysql y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT * FROM lista_categorias";
            $result = oci_parse($conexion, $sql);
             oci_execute($result);
                //Recorremos cada registro y obtenemos los valores
                //de las columnas especificadas
                while ($row = oci_fetch_row($result)){
            ?>
                <tr>             
                    <td><?=$row[0];?></td>
                    <td>
                        <textarea name="categoria" id="categoria<?=$row[0];?>" rows="1" cols="15"><?=$row[1];?></textarea>
                    </td>
                    <td><a class="boton-link" onclick="actualizar(<?=$row[0];?>);">Guardar</a></td> 
                    <td><a class="boton-link" href="bajas-categoria.php?id=<?=$row[0];?>">Eliminar</a></td>  
                </tr>
            <?php
                }
            ?>
                <tr>             
                    <td>*</td>
                    <td>
                        <textarea name="categoria" id="agregar" rows="1" cols="15"></textarea>
                    </td>
                    <td colspan="2"><a class="boton-link" onclick="agregar();">Agregar</a></td> 
                </tr>
        </table>
        </div>
  </body>
</html>