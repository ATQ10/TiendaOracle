<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Cambiar producto</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="cam">
  <?php
    //Implementación de header
    include ("header.php");
    //No es el admin
    @session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');

    //Conectar al servidor Oracle y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    $sql = "SELECT * FROM producto LEFT JOIN categoria ON producto.idcat = categoria.idcat WHERE producto.idp=".$_GET['id'];
    $result = oci_parse($conexion, $sql);
    //Recorremos cada registro y obtenemos los valores
    //de las columnas especificadas
    oci_execute($result);
    while ($row = oci_fetch_row($result)){
        $_SESSION['idc-act']=$row[0];
        $idcat=$row[1];
        $nombre=$row[2];
        $descripcion=$row[3];
        $precio=$row[4];
        $existencia=$row[5];
        $promedio=$row[6];
        $imagen=$row[7];
        $categoria=$row[10];
        $idprov=$row[8];
    }
    
  ?>
    <div class="cambiar">
      <img src="imagenes/editarproducto.jpg" class="logo" alt="logo">
      <h1>Editar producto</h1>
      <form method="POST" action="cambiar-producto-admin.php" enctype="multipart/form-data">
        <a  class="boton-link"  href="productos.php">*Volver a Productos*</a>
        <span> Seleccione tipo de producto</span>
        <select name="categoria" class="text">
            <?php
            $sql = "SELECT * FROM categoria";
            $result = oci_parse($conexion, $sql);
            //Recorremos cada registro y obtenemos los valores
            //de las columnas especificadas
            oci_execute($result);
            while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" value="<?php echo $row[0];?>" <?php if($row[1]==$categoria) echo " selected";?> > <?php echo $row[1];?> </option>
            <?php
                }
            
            //echo mysqli_error($conexion2);
            ?>
        </select>
        <span> Seleccione proveedor</span>
        <select name="idprov" class="text">
            <?php
            $sql = "SELECT * FROM proveedor";
            $result = oci_parse($conexion, $sql);
            //Recorremos cada registro y obtenemos los valores
            //de las columnas especificadas
            oci_execute($result);
            while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" value="<?php echo $row[0];?>" <?php if($row[0]==$idprov) echo " selected";?> > <?php echo $row[1];?> </option>
            <?php
                }
            
            //echo mysqli_error($conexion2);
            ?>
        </select>
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba nombre" name="nombre" value="<?php echo $nombre;?>" required>
        <!-- Descripcion INPUT -->
        <span>Descripción</span>
        <input class="text" type="text" placeholder="Escriba descripción" name="descripcion" value="<?php echo $descripcion;?>" required>
        <!-- Precio INPUT -->
        <span>Precio</span>
        <input class="text" type="number" placeholder="Escriba precio" name="precio" value="<?php echo $precio;?>" min="0" required>
        <!-- Existencia INPUT -->
        <span>Existencia</span>
        <input class="text" type="number" placeholder="Escriba existencia" name="existencia" value="<?php echo $existencia;?>" min="0" required>
        <!-- Submit INPUT -->
        <span>Imagen actual</span>
        <center>
          <img src="<?php echo "imagenes/productos/".$imagen;?>" height="80">
        </center>
        <span>Editar Imagen</span>
        <input class="text" type="file" name="archivo" />
        <input class="submit" type="submit" value="Actualizar">
      </form>
    </div>
  </body>
</html>