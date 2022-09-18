<?php
    //Sesión no activa se redirecciona a login
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
    if(@$_SESSION['tipo']=="admin"){
      $_SESSION['chat']=$_GET['chat'];
    }
    if(@$_SESSION['tipo']=="normal"){
      $_SESSION['chat']=$_SESSION['idu'];
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Chat</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css">
    <script src="javascripts/ajax.js"></script>
    <script src="javascripts/push.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <?php
              $conexion = conectar();
              $sql = "SELECT nombreus(".$_GET['chat'].") as nombre from dual";
              $result = oci_parse($conexion, $sql);
              //Recorremos cada registro y obtenemos los valores
              //de las columnas especificadas
              oci_execute($result);
              while ($row = oci_fetch_row($result)){
                echo "<h4>Chat de: ".$row[0]."</h4>";
              }
            ?>
<form method="post" action="enviar.php">
<input style="font-size: 20px;" type="text" class="caja" name="mensaje" size="50" placeholder="Escribe un mensaje..." required>
<button type='submit' class="boton-link2" value='Enviar'>Enviar</button>
</form>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <HR noshade size=5px width=100% COLOR=#7F5035 style="border-bottom-width: 0px; margin-bottom: 0px;">
            <HR noshade size=5px width=100% COLOR=#FF7583 style="margin-top: 0px; border-top-width: 0px;">
          </td>
        </tr>
        <tr>
          <td colspan="2">
<div id="cajachat">
<div name="timediv" id="timediv">
</div>
          </td>
        </tr>

      </table>
    </div>
  <?php
    //Implementación de footer
    include ("footer.php");
  ?>
  </body>
</html>