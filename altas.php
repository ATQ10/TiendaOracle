<?php
    //No es el admin
    session_start();
   if(@$_SESSION['tipo']!="admin")
       header('Location: index.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Altas</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="reg">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="registro">
      <img src="imagenes/login.png" class="logo" alt="logo">
      <h1>Dar de alta</h1>
      <form method="POST" action="registrar.php">
        <a  class="boton-link"  href="administrar.php">*Volver a Administrar*</a>
        <span>Tipo de usuario:</span>
        <select name="tipo" class="text">
          <option class="text" value="admin">Administrador</option>
          <option class="text" value="normal" selected>Normal</option>
        </select>
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba nombre" name="nombre" required>
        <!-- Ape Pat INPUT -->
        <span>Apellido Paterno</span>
        <input class="text" type="text" placeholder="Escriba apellido paterno" name="ape_pat" required>
        <!-- Ape Mat INPUT -->
        <span>Apellido Materno</span>
        <input class="text" type="text" placeholder="Escriba apellido materno" name="ape_mat" required>
        <!-- Fecha INPUT -->
        <span>Fecha de nacimiento</span>
        <input class="text" type="date" name="fecha" required>
        <!-- Tel INPUT -->
        <span>Teléfono</span>
        <input class="text" type="number" placeholder="Escriba teléfono" name="telefono" required>
        <!-- Email INPUT -->
        <span>Email</span>
        <input class="text" type="text" placeholder="Escriba email" name="email" required>
        <span>Pais</span>
        <!-- Selecciona tu pais INPUT -->
        <select name="pais" style="margin-bottom: 10px;">
        <option value="">Selecciona tu pais</option>
        <br>
        <?php
        //Conectar al servidor Oracle y a la base de datos
        //include ("conexion.php");
        
        $conexion = conectar();
        
        $sql = "SELECT * FROM ORIGEN";
        $result = oci_parse($conexion,$sql);
        oci_execute($result);
        $prueba = oci_num_rows($result);
        
        while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" value="<?php echo $row[0];?>"> <?php echo $row[2];?> </option>
            <?php
        }
        ?>
        </select>
        <span>Gustos</span>
        <!-- Selecciona tu pais INPUT -->
        <select name="gustos" style="margin-bottom: 10px;">
        <option value="">Selecciona tu gusto</option>
        <br>
        <?php
        //Conectar al servidor Oracle y a la base de datos
        //include ("conexion.php");
        
        $conexion = conectar();
        
        $sql = "SELECT * FROM CATEGORIA";
        $result = oci_parse($conexion,$sql);
        oci_execute($result);
        $prueba = oci_num_rows($result);
        
        while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" value="<?php echo $row[1];?>"> <?php echo $row[1];?> </option>
            <?php
        }
        oci_close($conexion);
        ?>
        </select>
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Escriba contraseña" name="password" required>
        <!-- Contraseña INPUT -->
        <span>Confirmar contraseña</span>
        <input class="password" type="password" placeholder="Confirme contraseña" name="cpassword" required>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Añadir">
      </form>
    </div>
  </body>
</html>