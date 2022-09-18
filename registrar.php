<?php
    //Sesión activa se redirecciona a index 
    session_start();
    if(@$_SESSION['autentificado']==TRUE && $_SESSION['tipo']=="normal")
        header('Location: index.php');
    //Extraer valor de variables
    $array = array_keys($_POST);
    foreach ($array as $post) {
    	$$post = $_POST[$post];
    	echo $_POST[$post];
    }
    //Contraseñas diferentes
    if($password!=$cpassword){
?>
    <script language="JavaScript">
    	window.alert("Las contraseñas no coinciden");
    	window.history.back();
	</script>	
<?php 
	}
	//Verificar si el usuario existe
	//Conectar al servidor Mysql y a la base de datos tienda
        include ("conexion.php");
        $conexion = conectar();
        if(!$conexion){
            echo 'ERROR';
        }else{
            //echo 'Conn ok';
        }
        //Sentencia de consulta SQL
	    $sql = "SELECT * FROM usuario WHERE email='".$email."'";
        $result = oci_parse($conexion,$sql);
        oci_execute($result);
        $nrows = oci_fetch_all($result, $res);
        if($nrows > 0){
?>
    <script language="JavaScript">
    	window.alert("Ya existe una cuenta con este email");
    	window.history.back();
	</script>	
<?php    
		exit(0);     	
        }else{
        	//reordenar fecha
        	//list($dia, $mes, $anio) = explode("/", $fecha);
        	//$fecha=$anio."-".$mes."-".$dia;
        	//Sentencia de consulta SQL
            if(@$tipo==NULL)
                $tipo="normal";
	        $sql = "INSERT INTO usuario (idu, nombre, ape_pat, ape_mat, fecha, email, telefono, tipo, password, gustos, idnac) VALUES (to_char(SEC_USUARIO.nextval), '".$nombre."', '".$ape_pat."', '".$ape_mat."',to_date('".$fecha."', 'yyyy-mm-dd'), '".$email."', '".$telefono."', '".$tipo."', '".$password."', '".$gustos."', '".$pais."')";
	       $result = oci_parse($conexion,$sql);
           oci_execute($result);
	        if(oci_num_rows($result)>0){
	        	if(@$_SESSION['tipo']!="admin"){
?>
    <script language="JavaScript">
    	window.alert("Registro exitoso, ahora inicie sesión");
    	window.location="login.php";
	</script>	
<?php 	      
				}else{
?>
    <script language="JavaScript">
    	window.alert("Usuario dado de alta");
    	window.location="administrar.php";
	</script>	
<?php 	 		
				}  	
	        }else{
	        	//echo mysqli_error($conexion);
?>
    <script language="JavaScript">
    	window.alert("Intente más tarde");
    	//window.history.back();
	</script>	
<?php 	        	
	        }
        }
?>