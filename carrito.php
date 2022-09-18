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
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Carrito</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css">
    <!-- JS-->
    <script>
    function precioTotal() {
      let items = document.getElementsByName("item[]");
      let cantidad = document.getElementsByName("cantidad[]");
      let precio = document.getElementsByName("precio[]");
      let total = 0;
      for (let i = 0; i < items.length; i++) 
          if (items[i].checked) 
              total += parseFloat(precio[i].value)*parseFloat(cantidad[i].value);
      total = total.toFixed(2);
      document.getElementById("total").value = "$" + total;
    }
    </script>
  </head>
  <body class="ind">
  <?php
    //Implementación de header
    include ("header.php");
?>
    <div class="index">
      <form method="POST" action="comprar.php">
      <table class="listado" border="0" align="center" width="70%">
        <tr>
          <td colspan="7">
            <center>
              <H1>Mi carrito de compras</H1>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="7">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td><strong>No.<strong/></td> 
          <td><strong>Imagen<strong/></td>              
          <td><strong>Nombre<strong/></td>
          <td><strong>Descripción<strong/></td>
          <td><strong>Precio c/u<strong/></td>
          <td><strong>Cantidad<strong/></td>
          <td><strong>Deseo comprar...<strong/></td>
        </tr>
<?php
    //Conectar al servidor Oracle y a la base de datos
    //include ("conexion.php");
    $conexion = conectar();
    //Sentencia de consulta SQL
    $articulo=0;
    $sql = "SELECT * FROM carrito LEFT JOIN producto ON carrito.idp = producto.idp WHERE carrito.idu=".@$_SESSION['idu'];
    $result = oci_parse($conexion,$sql);
    oci_execute($result);
    $i=0;
    while ($row = oci_fetch_row($result)){
?>
        <tr style=" font-size: 20px;">
            <td><?php echo $i+1;?></td>   
            <td><img src="imagenes/productos/<?=$row[10];?>" height="60"></td>             
            <td><?=$row[5];?></td>
            <td>
                <textarea name="descripcion" rows="3" cols="15" readonly><?=$row[6];?></textarea>
            </td>
            <td>
              $<input name="precio[]" style="width: 60px; font-size: 20px;" type="number" id="precio_<?=$i;?>"  value="<?=$row[7];?>" disabled>
            </td>
            <td> 
              <input onclick="precioTotal()" name="cantidad[]" style="width: 60px; font-size: 20px;" type="number" id="cantidad_<?=$i;?>"  value="<?=$row[2];?>" min="1" max="<?=$row['existencia'];?>">
            </td>
            <td>
              <input type="checkbox" name="item[]" value="<?=$row[0];?>" onclick="precioTotal()" id="item_<?=$i;?>">
            </td>
        </tr>
<?php
      $i++;
        }
        if($i!=0){
?>
        <tr>
          <td colspan="7">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <a href="vaciar.php" class="boton-link2">Vaciar</a>
          </td>
          <td colspan="4">
            <span class="titulo">Total a pagar:</span>
            <input style="width: 200px; font-size: 30px;" value="$0.00" type="text" name="total" id="total" disabled>
              <input type="submit" name="Comprar" class="boton-link2" value="Comprar"><br>
          </td>
        </tr>

<?php
    }else{
?>        
        <tr>
          <td colspan="7">
            <span class="contenido"><STRONG><center>Sin artículos</center></STRONG></span><br>
          </td>
        </tr>
<?php
    }
?>
      </table>
      </form>
    </div>
  <?php
    //Implementación de footer
    include ("footer.php");
  ?>
  </body>
</html>