<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['autentificado']!=TRUE)
        header('Location: login.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Perfil</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/estilo.css">
  </head>
  <body class="per">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="perfil">
      <img src="imagenes/login.png" class="logo" alt="logo">
      <h1>Info. Personal</h1>
      <form method="POST" action="actualizar-perfil.php">
        <!-- Nombre INPUT -->
        <span>Nombre</span>
        <input class="text" type="text" placeholder="Escriba su nombre" name="nombre" required value="<?php echo $_SESSION['nombre'];?>">
        <!-- Ape Pat INPUT -->
        <span>Apellido Paterno</span>
        <input class="text" type="text" placeholder="Escriba su apellido paterno" name="ape_pat" required value="<?php echo $_SESSION['ape_pat'];?>">
        <!-- Ape Mat INPUT -->
        <span>Apellido Materno</span>
        <input class="text" type="text" placeholder="Escriba su apellido materno" name="ape_mat" required value="<?php echo $_SESSION['ape_mat'];?>">
        <!-- Fecha INPUT -->
        <span>Fecha de nacimiento</span>
        <input class="text" type="date" name="fecha" required value="<?php echo $_SESSION['fecha'];?>">
        <!-- Tel INPUT -->
        <span>Teléfono</span>
        <input class="text" type="number" placeholder="Escriba su teléfono" name="telefono" required value="<?php echo $_SESSION['telefono'];?>">
        <!-- Email INPUT -->
        <span>Email</span>
        <input class="text" type="text" placeholder="Escriba su email" name="email" required value="<?php echo $_SESSION['email'];?>">
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Escriba su contraseña" name="password" required value="<?php echo $_SESSION['password'];?>">
        <!-- Contraseña INPUT -->
        <span>Confirmar contraseña</span>
        <input class="password" type="password" placeholder="Confirme su contraseña" name="cpassword" required value="<?php echo $_SESSION['password'];?>">
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
        
        while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" <?php echo "value=\"".$row[0]."\""; if($row[0]==$_SESSION['idnac']) echo "selected";?>> <?php echo $row[2];?> </option>
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
        
        while ($row = oci_fetch_row($result)){
            ?>
          <option class="text" <?php echo "value=\"".$row[1]."\""; if($row[1]==$_SESSION['gustos']) echo "selected";?>> <?php echo $row[1];?> </option>
            <?php
        }
        oci_close($conexion);
        ?>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Guardar">
        <a href="domicilio.php">*Editar domicilio*</a>
      </form>
    </div>
  </body>
</html>