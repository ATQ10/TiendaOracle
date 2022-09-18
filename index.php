<?php
    //Sesión no activa se redirecciona a login
    // Hola equipo
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Inicio</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css"> 
  </head>
  <body class="ind">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="index">
      <table class="listado" border="0" align="center" width="70%">
        <tr>
          <td colspan="2">
            <center>
              <H1>Productos</H1>
            </center>
          </td>
        </tr>
<?php
    //Conectar al servidor Oracle y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //echo $conexion;
    //Sentencia de consulta SQL
    
    if(@$_GET['categoria']!=0)
    {
      if(@$_GET['buscar']=="")
        $sql = "SELECT * FROM producto WHERE idcat=".@$_GET['categoria']."";
      else
        $sql = "SELECT * FROM producto WHERE idcat='".@$_GET['categoria']."' AND ' ' || descripcion || ' ' || nombre || ' ' || imagen || ' ' LIKE '%".@$_GET['buscar']."%'";
    }else{
      if(@$_GET['buscar']=="")
        $sql = "SELECT * FROM producto";
      else
        $sql = "SELECT * FROM producto WHERE ' ' || descripcion || ' ' || nombre || ' ' || imagen || ' ' LIKE '%".@$_GET['buscar']."%'";
    }
    $result = oci_parse($conexion,$sql);
    oci_execute($result);
        //Recorremos cada registro y obtenemos los valores
        //de las columnas especificadas
    $vacio=0;
        while ($row = oci_fetch_row($result)){
          $vacio=1;
          $_SESSION['idc-act']=$row[0];
          $idcat=$row[1];
          $nombre=$row[2];
          $descripcion=$row[3];
          $precio=$row[4];
          $existencia=$row[5];
          $promedio=$row[6];
          $imagen=$row[7];
          $idProv=$row[8];
?>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <img class="efecto" src="<?php echo "imagenes/productos/".$row[7];?>"  style="max-height: 150px; max-width: 300px;">
            </center>
          </td>
          <td>
            <span class="titulo"><STRONG>Nombre:</STRONG></span><br>
            <span class="contenido"><?php echo $nombre;?></span><br>
            <span class="titulo"><STRONG>Precio:</STRONG></span><br>
            <span class="contenido"><?php echo "$".$precio." MXN";?></span>
            <br>
            <br>
            <a class="boton-link2" href="articulo.php?id=<?php echo $row[0];?>"><STRONG>Detalles</STRONG></span><br>
          </td>
        </tr>

<?php
        }
    if($vacio==0){    
?>        
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <span class="titulo"><STRONG><center>No se encontraron resultados</center></STRONG></span><br>
          </td>
        </tr>
<?php
    }
?>
      </table>
    </div>
  <?php
    //Implementación de footer
    include ("footer.php");
  ?>
  </body>
</html>