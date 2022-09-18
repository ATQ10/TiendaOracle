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
        <title>Proveedores</title>
        <!-- Hoja de estilos-->
        <link rel="stylesheet" href="estilos/estilo.css">
        <!-- JS-->
        <script>
            function actualizar(id){
                var prov = document.getElementById('proveedor'+id).value;
                var desc = document.getElementById('proveedordesc'+id).value;
                //alert("cambiar-categoria.php?id="+id+"&categoria="+cat);
                window.location="cambiar-proveedor.php?nombre="+prov+"&descripcion="+desc+"&idprov="+id;
            }
            function agregar(){
                var prov = document.getElementById('agregar1').value;
                var desc = document.getElementById('agregar2').value;
                //alert("cambiar-categoria.php?id="+id+"&categoria="+cat);
                if(prov!="" || desc!="")
                    window.location="registrar-proveedor.php?nombre="+prov+"&descripcion="+desc;
                else
                    alert("Complete los campos");
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
          <h1>Administrar Proveedores</h1>
            <a  class="boton-link"  href="productos.php">*Volver a Productos*</a>
          <table border="1" width="90%">
                <tr>                
                    <td><strong>ID<strong/></td>
                    <td><strong>Proveedor<strong/></td>
                        <td><strong>Descripcion</strong></td>
                    <td colspan="2"><strong>Acciones<strong/></td>
                </tr>
            <?php
            //Conectar al servidor Mysql y a la base de datos
            //include ("conexion.php");
            $conexion = conectar();
            //Sentencia de consulta SQL
            $sql = "SELECT * FROM Proveedor";
            $result = oci_parse($conexion, $sql);
             oci_execute($result);
                //Recorremos cada registro y obtenemos los valores
                //de las columnas especificadas
                while ($row = oci_fetch_row($result)){
            ?>
                <tr>             
                    <td><?=$row[0];?></td>
                    <td>
                        <textarea name="proveedor" id="proveedor<?=$row[0];?>" rows="1" cols="15"><?=$row[1];?></textarea>
                    </td>
                    <td><textarea name="proveedordesc" id="proveedordesc<?=$row[0];?>" rows="1" cols="15"><?=$row[2];?></textarea></td>
                    <td><a class="boton-link" onclick="actualizar(<?=$row[0];?>);">Guardar</a></td> 
                    <td><a class="boton-link" href="bajas-proveedor.php?id=<?=$row[0];?>">Eliminar</a></td>  
                </tr>
            <?php
                }
            ?>
                <tr>             
                    <td>*</td>
                    <td>
                        <textarea name="proveedor" id="agregar1" rows="1" cols="15"></textarea>
                    </td>
                    <td>
                        <textarea name="proveedordesc" id="agregar2" rows="1" cols="15"></textarea>
                    </td>
                    <td colspan="2"><a class="boton-link" onclick="agregar();">Agregar</a></td> 
                </tr>
        </table>
        </div>
  </body>
</html>