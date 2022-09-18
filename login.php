<?php
    //Sesión no activa se redirecciona a login
    session_start();
    if(@$_SESSION['autentificado']==TRUE)
        header('Location: index.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Codificación de caracteres -->
    <meta charset="utf-8">
    <title>Iniciar sesión</title>
    <!-- Hoja de estilos-->
    <link rel="stylesheet" href="estilos/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/estilo.css"> 
  </head>
  <body class="log">
  <?php
    //Implementación de header
    include ("header.php");
  ?>
    <div class="login">
      <img src="imagenes/login.png" class="logo" alt="logo">
      <h1>Iniciar sesión</h1>
      <form method="POST" action="verificar.php">
        <!-- Email INPUT -->
        <span>Email</span>
        <input class="text" type="text" placeholder="Email" name="email" required>
        <!-- Contraseña INPUT -->
        <span>Contraseña</span>
        <input class="password" type="password" placeholder="Contraseña" name="password"  required>
        <!-- Submit INPUT -->
        <input class="submit" type="submit" value="Acceder">
        <a href="registro.php">*Crear nueva cuenta*</a>
      </form>
    </div>
  <?php
    //Implementación de footer
    include ("footer.php");
  ?>
  </body>
</html>