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
        <title>Productos</title>
        <!-- Hoja de estilos-->
        <link rel="stylesheet" href="estilos/estilo.css">
    </head>
    <body class="adm">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
        <div class="administrar">
          <img src="imagenes/adm-prod.png" class="logo" alt="logo">
          <h1>Administrar Productos</h1>
            <a class="boton-link" href="altas-producto.php">*Nuevo producto*</a>
            <a  class="boton-link"  href="categorias.php">*Administrar Categorias*</a>
            <a  class="boton-link"  href="proveedores.php">*Administrar Proveedores*</a>
          <table border="1" width="90%">
              <?php 
              if(isset($_GET['detalles'])=='ver'){
                ?>
                <tr>
                    <td><strong>Proveedor<strong/></td>
                    <td><strong>Producto<strong/></td>                
                    <td><strong>Cantidad<strong/></td>
                </tr>
              <?php
              }else{

              ?>
                <tr>
                    <td><strong>Cambios<strong/></td>
                    <td><strong>Bajas<strong/></td>                
                    <td><strong>Nombre<strong/></td>
                    <td><strong>Descripcion<strong/></td>
                    <td><strong>Precio<strong/></td>
                    <td><strong>Existencia<strong/></td>
                    <td><strong>Categoria<strong/></td>
                    <td><strong>Imagen<strong/></td>
                    <td><strong>Proveedor<strong/></td>
                    <td><strong>Comentarios<strong/></td>
                    <td><strong>Carrito<strong/></td>
                </tr>
              <?php
              }
              
              
            //Conectar al servidor Oracle y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT idp, categoria, nombre, descripcion, precio, existencia, promedio, imagen, nombreprov(idp) FROM lista_productos";
            if(isset($_GET['detalles'])=='ver')
              $sql = "select  nombreprov(idp), nombre, sum(existencia) from producto group by rollup (nombreprov(idp), nombre)";
            $result = oci_parse($conexion, $sql);
            //Recorremos cada registro y obtenemos los valores
            //de las columnas especificadas
            oci_execute($result);
            if(isset($_GET['detalles'])=='ver'){
              while ($row = oci_fetch_row($result)){
                ?>
                <tr>
                    <td><?=$row[0];?></td>
                    <td><?=$row[1];?></td>
                    <td><?=$row[2];?></td>
                </tr>
                <?php
                }
            }else{
              while ($row = oci_fetch_row($result)){
              ?>
              <tr>
                  <td><a class="boton-link" href="cambiar-producto.php?id=<?=$row[0];?>">Editar</a></td>
                  <td><a class="boton-link" href="bajas-productos.php?id=<?=$row[0];?>">Eliminar</a></td>                
                  <td><?=$row[2];?></td>
                  <td>
                      <textarea name="categoria" rows="3" cols="15" readonly><?=$row[3];?></textarea>
                  </td>
                  <td><?=$row[4];?></td>
                  <td><?=$row[5];?></td>
                  <td>
                      <?=$row[1];?>
                  </td>
                  <td><img src="imagenes/productos/<?=$row[7];?>" height="60"></td>
                  <td><?=$row[8];?></td>
                  <td><a class="boton-link" href="vaciar_comentario.php?id=<?=$row[0];?>">Vaciar</a></td>                
                  <td><a class="boton-link" href="vaciar_producto_carrito.php?id=<?=$row[0];?>">Vaciar</a></td>                
              </tr>
              <?php
              }
            }
            ?>
        </table>
        <?php
        $sql = "SELECT sum(existencia) as total FROM lista_productos";
        $result = oci_parse($conexion, $sql);
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
        oci_execute($result);
        while ($row = oci_fetch_row($result)){
          echo "<h3>Total de existencia: ".$row[0]." | <a href=\"productos.php?detalles=ver\">Clic para ver detalles</a></h3>";
        }
        ?>
        <?php
        $sql = "SELECT avg(precio) as promedio FROM lista_productos";
        $result = oci_parse($conexion, $sql);
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
        oci_execute($result);
        while ($row = oci_fetch_row($result)){
          echo "<h3>Promedio de precios: ".$row[0]."</h3>";
        }
        ?>
        </div>
  </body>
</html>