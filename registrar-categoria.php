<?php
    //Sesión activa se redirecciona a index 
    session_start();
    if(@$_SESSION['tipo']!="admin")
        header('Location: index.php');
    //Extraer valor de variables
    $array = array_keys($_GET);
    foreach ($array as $get) {
    	$$get = $_GET[$get];
    	//echo $_GET[$get];
    }
    
	//Conectar al servidor Mysql y a la base de datos tienda
        include ("conexion.php");
        $conexion = conectar();
        $sql = "INSERT INTO categoria(idcat, categoria) VALUES (sec_categoria.nextval,'".$categoria."')";
 $result = oci_parse($conexion, $sql);
        if(oci_execute($result) == true){
?>
    <script language="JavaScript">
    	window.alert("Registro exitoso");
    	window.location="categorias.php";
	</script>	
<?php 	      
				}else{
?>
    <script language="JavaScript">
    	window.alert("Intente más tarde");
    	window.history.back();
	</script>	
<?php 	        	
	        }
    //echo mysqli_error($conexion);
?>