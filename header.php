<?php
@session_start();
?>
		<header>
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-right" style="margin-right: 10px;">
						<?php
							if(@$_SESSION['tipo']==""){
								echo '
								<li>
									<a href="login.php">
									<i class="fa fa-sign-out"></i>Ingresar</a>
								</li>
								<li>
									<a href="registro.php">
									<i class="fa fa-handshake-o"></i>Registro</a>
								</li>
								';
							}else
							if(@$_SESSION['tipo']=="normal"){
								echo '
								<li>
									<a href="chat.php">
									<i class="fa fa-weixin"></i>Chat</a>
								</li>
								<li>
									<a href="perfil.php">
									<i class="fa fa-address-card"></i>Mi perfil</a>
								</li>
								<li>
									<a href="desconectar.php">
									<i class="fa fa-sign-out"></i>Salir</a>
								</li>
								';	
							}else
							if(@$_SESSION['tipo']=="admin"){
								echo '
								<li>
									<a href="perfil.php">
									<i class="fa fa-address-card"></i>Mi perfil</a>
								</li>
								<li>
									<a href="productos.php">
									<i class="fa fa-product-hunt"></i>Productos</a>
								</li>
								<li>
									<a href="administrar.php">
									<i class="fa fa-users"></i>Usuarios</a>
								</li>
								<li>
									<a href="desconectar.php">
									<i class="fa fa-sign-out"></i>Salir</a>
								</li>
								';
							}
						?>
					</ul>
				</div>
			</div>
			<div id="header">
				<div class="container"> 
					<div class="row">
							<a href="index.php">
								<div class="header-logo">
								<img src="./imagenes/logo.png" alt="" style="padding-left: 50px; padding-left: 50px;">
							</div>
							</a>
						<div class="col-md-6">
							<div class="header-search">
								<form method="GET" action="index.php">
									<select name="categoria" class="input-select" style="margin-left: 100px;">
										<option value="0">Todas las categorias:</option>
										<?php
									    //Conectar al servidor Oracle y a la base de datos
									    include ("conexion.php");
									    
									    $conexion = conectar();
									    
							            $sql = "SELECT * FROM CATEGORIA";
							            $result = oci_parse($conexion,$sql);
							            oci_execute($result);
							            $prueba = oci_num_rows($result);
							            
						                while ($row = oci_fetch_row($result)){
								            ?>
								          <option class="text" value="<?php echo $row[0];?>"> <?php echo $row[1];?> </option>
								            <?php
						                }
							            $sql = "SELECT * FROM carrito WHERE idu=".@$_SESSION['idu'];
							            $result = oci_parse($conexion,$sql);
							            oci_execute($result);
							            $cantidad = oci_fetch_all($result, $res);
							            oci_close($conexion);
							            ?>
									</select>
								<input class="input" placeholder="Buscar producto" type="text" name="buscar" style="width: 320px;height: 30px;">	
								<button type="submit" class="search-btn">Buscar</button>
									<div class="header-ctn">								
										<div class="dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="carrito.php">
												<i class="fa fa-shopping-cart"></i>
												<span>Mi carrito</span>
												<div class="qty"><?php echo $cantidad;?></div>
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>