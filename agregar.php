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
    //Extraer valor de variables
    $array = array_keys($_GET);
    foreach ($array as $get) {
    	$$get = $_GET[$get];
    	//echo $_GET[$get];
    }
	//Conectar al servidor Mysql y a la base de datos tienda
    include ("conexion.php");
        $conexion = conectar();
        $sql = "INSERT INTO carrito (idp, idu, cantidad) VALUES (lpad(to_char(".$id."), 4, '0'), '".$_SESSION['idu']."', '".$cantidad."')";
        echo $sql; 
        $result = oci_parse($conexion,$sql);
        if(oci_execute($result) == TRUE){

    echo "<script language=\"JavaScript\">
    	window.alert(\"Articulo agregado\");
    	window.location=\"articulo.php?id=".$id.".\";
	   </script>";	
				}else{
?>
    <script language="JavaScript">
    	window.alert("Intente más tarde");
    	//window.history.back();
	</script>	
<?php 	        	
	        }
    //echo mysqli_error($conexion);
?>