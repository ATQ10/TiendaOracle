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
    <title>Domicilio</title>
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
      <h1>Info. Domicilio</h1>
      <form method="POST" action="actualizar-domicilio.php">
        <!-- Código Postal INPUT -->
        <span>Código Postal</span>
        <input class="text" type="number" placeholder="Escriba su cp" name="cp" required value="<?php echo $_SESSION['cp'];?>">
        <!-- Calle INPUT -->
        <span>Calle</span>
        <input class="text" type="text" placeholder="Escriba su calle" name="calle" required value="<?php echo $_SESSION['calle'];?>">
        <!-- No. Exterior INPUT -->
        <span>No. Exterior</span>
        <input class="text" type="number" placeholder="Escriba su no. ext." name="n_ext" required value="<?php echo $_SESSION['n_ext'];?>">
        <!-- No. Interior INPUT -->
        <span>No. Interior</span>
        <input class="text" type="number" placeholder="Escriba su no. int." name="n_int" required value="<?php echo $_SESSION['n_int'];?>">
        <!-- Colonia INPUT -->
        <span>Colonia</span>
        <input class="text" type="text" placeholder="Escriba su colonia" name="colonia" required value="<?php echo $_SESSION['colonia'];?>">
        <!-- Ciudad INPUT -->
        <span>Ciudad</span>
        <input class="text" type="text" placeholder="Escriba su ciudad" name="ciudad" required value="<?php echo $_SESSION['ciudad'];?>">
        <!-- Estado INPUT -->
        <span>Estado</span>
        <input class="text" type="text" placeholder="Escriba su estado" name="estado" required value="<?php echo $_SESSION['estado'];?>">
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Guardar">
        <a href="perfil.php">*Editar perfil*</a>
      </form>
    </div>
  </body>
</html>