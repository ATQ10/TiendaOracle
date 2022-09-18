<?php SESSION_START();
	if ($_SESSION['usuario']=='') {
			//echo "<script>location.href='perfil.php'</script>";
            //require("Assets/php/crear_db.php"); 
	}else{
			echo $_SESSION['usuario'];
			//echo "<script>location.href='perfil.php'</script>";	
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="UTF-8">
  <meta http-equiv="Content-Type">
  <title>PHPMailer Adivinanding</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <h1>Verificación de cuenta adivinanding.</h1>
  <div align="center">
    <a href="http://adivinanding.epizy.com/"><img src="images/phpmailer.png" height="90" width="340" alt="Adivinanding.png"></a>
  </div>
  <p><strong>* Sus datos son: </strong></p>
  <p><strong> 1) Nombre de usuario: [</strong><?echo $_SESSION['GlobalUser'];?><strong>]</strong></p>
  <p><strong> 2) Contraseña: [</strong><?echo $_SESSION['GlobalPass'];?><strong>]</strong></p>
  <p><strong> 3) Email: [</strong><?echo $_SESSION['GlobalEmail'];?><strong>]</strong></p>
  <p><strong> 4) Fecha: [</strong><?echo $_SESSION['Globaldate'];?><strong>]</strong></p>
  <p><strong>- - - - - - - - - - - </strong></p>
  <p><strong>* Para validar su cuenta entre al siguiente enlace: </strong></p>
  <p><strong> Enlace: </strong><a href="http://adivinanding.epizy.com/">http://adivinanding.epizy.com/</a></p>
  <p><strong>- - - - - - - - - - - </strong></p>
  <p><strong> *IMPORTANTE* </strong></p>
  <p>Si usted desconoce este movimiento, ignore este correo, puesto que se trata de un error</p>
</div>
</body>
</html>
