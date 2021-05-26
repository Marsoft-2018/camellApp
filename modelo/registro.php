<?php
	require "ubicacion.php";
	class Registro extends conectar{
		private $sqlCargar;
		private $sqlAgregar;
		private $sqlEliminar;
		/*
			CREATE TABLE `proveedor` (
			  `id` bigint(9) NOT NULL AUTO_INCREMENT,
			  `nbres` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
			  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
			  `idMunicipio` bigint(6) NOT NULL,
			  `calificacion` char(5) COLLATE utf8_unicode_ci NOT NULL,
			  `latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
			  `longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
			  `fecha_nac` date NOT NULL,
			  `fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  `activo` tinyint(1) NOT NULL DEFAULT '1',
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		*/	
		function paso2($correo,$contrasenha){
			echo "<form action='' method='POST' onsubmit='return addRegistro()'>";
			echo '<div id="blog" class="blog">';
			echo '<div class="container" style="padding:50px;padding-bottom:250px;">';
			echo "<h3> Registro - Datos básicos </h3>";
			echo "<h4 style='padding:20px 0px;color:#8e8e8e;'>Paso 2 - Registre sus datos</h4>";
			echo "<div class='row'>";
			echo "  <div class='col-md-12'><label>Nit/Documento</label>
						<input type='text' class='form form-control' id='id' value=''  required>
					</div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "  <div class='col-md-12'>
			                <label>Nombres</label>
			                <input type='text' class='form form-control' id='nombres' value=''  required>
			          </div>";
			echo "</div>";
			echo "<div class='row'>";
			echo 	"<div class='col-md-8'>
			            <label>Apellidos</label>
			            <input type='text' class='form form-control' id='apellidos' value=''  required>
			         </div>";
			echo 	"<div class='col-md-4'>
			            <label>Fecha Nacimiento</label>
			            <input type='date' class='form form-control' id='fechaNac' value=''  required>
			         </div>";
			echo "</div>";
			echo "<div class='row'>"; 
			echo "</div>";
			echo "<div class='row'>";
			echo  	"<div class='col-md-12'>";
			echo 		'<input type="hidden" name="ciudad" id="ciudad" hide="hide">'.
    					'<label>Ciudad/Municipio</label>'.
    					'<input autocomplete="off" type="text" id="nbre_municipio"  class="form form-control" onkeyup="autocompletar()">'.
    					'<ul id="lista"></ul>';            
			echo  	"</div>";	
			echo "</div>";
			echo "<div class='row'>";
			echo 	"<div class='col-md-6'>
					    <label>Dirección</label>
					    <input type='text' class='form form-control' id='direccion' value=''  required>
					</div>";
			echo 	"<div class='col-md-6'>
					    <label>Teléfono</label>
					    <input type='text' class='form form-control' id='telefono' value=''  required>
					</div>";
			echo "</div>";
			echo "<div class='row' style='padding-top:20px;padding-bottom:20px;'>";
			echo  	"<div class='col-md-12'>";
			echo  		"<label >Quiero ser</label>";
			echo 		"<select id='tipo' name='tipo' class='form-control' required>";
			echo 			"<option value=''>Seleccione...</option>";
			echo 			"<option value='1'>Cliente</option>";
			echo 			"<option value='2'>Proveedor</option>";
			echo 			"<option value='3'>Ambos</option>";
			echo 		"</select>";
			echo  	"</div>";	
			echo "</div>";
			echo "<div class='row'>";

			echo  	"<div class='col-md-7'>";
					//aqui va el mapa
					echo "<div class='row'>";
							include("../vista/mapa.php");
					echo "</div>";
					
			echo    "</div>";

			echo  "</div>";

			echo "<div class='row'>";  					
			echo  "<div class='col-md-6'>
						<input type='checkbox' name='terminos' id='terminos' required>Acepto los <a href='#' onclick='mostrarTerminos()' style='color:#00f;'>términos y condiciones</a> <br><br>
						<input type='hidden' name='correo' id='correo' value='$correo'> 
						<input type='hidden' name='contrasenhia' id='contrasenhia' value='$contrasenha'>
					</div>";  
			echo  "</div>";
			echo "<div class='row'>";                 
			echo "    <div class='col-md-3'>";
			echo "        <input type='submit' class='btn btn-primary' style='width: 100%;padding:15px 30px;' value='Registrarme'>";
			echo "    </div>";
			//echo "    <div class='col-md-8'></div>";             
			echo "</div> "; 			           
			echo "</div> ";            
			echo "</div> ";
		echo '</form>';	        
		}

		function agregar($tipo,$correo,$contrasenha,$nombres,$apellidos,$direccion,$telefono,$municipio,$fechaNac,$lat,$lng){
	
			if($tipo==1){
				$this->sqlAgregar = mysql_query("INSERT INTO `usuariosclientes` (`usuario`,`contrasena`) VALUES ('$correo',AES_ENCRYPT('$contrasenha','Makers2018'));");

				$this->sqlAgregar = mysql_query("INSERT INTO `clientes` (`usuario`,`nombres`,`apellidos`, `idMunicipio`,`calificacion`,`fechaNac`) VALUES ('$correo','$nombres','$apellidos','$municipio',0,'$fechaNac');");
				
				$sqlBusqueda=$this->sqlCargar=mysql_query("SELECT `id` FROM `clientes` WHERE `usuario`='$correo';");

				while($ide = mysql_fetch_array($sqlBusqueda)){
					$this->sqlAgregar = mysql_query("INSERT INTO `localizacionclientes` (`idCliente`,`direccion`, `lat`,`lng`) VALUES ('$ide[0]','$direccion','$lat','$lng');");
					$this->sqlAgregar = mysql_query("INSERT INTO `telefonoclientes` (`idCliente`,`telefono`) VALUES ('$ide[0]','$telefono');");
				}
				echo '<div id="blog" class="blog">';
				echo 	'<div class="container" style="padding:50px;padding-bottom:250px;">';
				echo 		"<h3> Registro Exitoso </h3>";
				echo 		"<div style='padding:25px;border:1px solid #cecece;'>
								<p>
									Estimado Sr(a) ".strtoupper($nombres).". sus datos fueron registrados con éxito, Agradecemos por tenernos como alternativa para facilitar la solución a sus necesidades.

									A continuación puede iniciar su sesión..

									
								</p>
							</div>";
				echo 		"<button class='btn btn-primary' onclick='salir()'><i class='fa fa-home'></i> Regresar</button>";
				echo 	"</div> "; 			           
				echo "</div> ";
			}elseif($tipo==2){
				$this->sqlAgregar = mysql_query("INSERT INTO `usuariosproveedores` (`usuario`,`contrasena`,`Activo`) VALUES ('$correo',AES_ENCRYPT('$contrasenha','Makers2018'),'2');");

				$this->sqlAgregar = mysql_query("INSERT INTO `proveedores` (`usuario`,`nombres`,`apellidos`, `idMunicipio`,`calificacion`,`fechaNac`) VALUES ('$correo','$nombres','$apellidos','$municipio',0,'$fechaNac');");
				
				$sqlBusqueda=$this->sqlCargar=mysql_query("SELECT `id` FROM `proveedores` WHERE `usuario`='$correo';");

				while($ide = mysql_fetch_array($sqlBusqueda)){
					$this->sqlAgregar = mysql_query("INSERT INTO `localizacionproveedores` (`idProveedor`,`direccion`, `lat`,`lng`) VALUES ('$ide[0]','$direccion','$lat','$lng');");
					$this->sqlAgregar = mysql_query("INSERT INTO `telefonoproveedores` (`idProveedor`,`telefono`) VALUES ('$ide[0]','$telefono');");
				}
				echo '<div id="blog" class="blog">';
				echo 	'<div class="container" style="padding:50px;padding-bottom:250px;">';
				echo 		"<h3> Registro Exitoso </h3>";
				echo 		"<div style='padding:25px;border:1px solid #cecece;'>
								<p>
									Estimado Sr(a) ".strtoupper($nombres).". sus datos fueron registrados con éxito, Agradecemos por tenernos como alternativa para mostrar su trabajo y hacernos parte de sus posibilidades de avanzar como el mejor, pero aún es necesario por seguridad y eficencia de los procesos de calidad su solicitud será revisada por el personal de Maker's
								</p>
							</div>";
				echo 		"<button class='btn btn-primary' onclick='salir()'><i class='fa fa-home'></i> Regresar</button>";
				echo 	"</div> "; 			           
				echo "</div> ";
			}elseif($tipo == 3){
				$this->sqlAgregar = mysql_query("INSERT INTO `usuariosclientes` (`usuario`,`contrasena`) VALUES ('$correo',AES_ENCRYPT('$contrasenha','Makers2018'));");

				$this->sqlAgregar = mysql_query("INSERT INTO `clientes` (`usuario`,`nombres`,`apellidos`, `idMunicipio`,`calificacion`,`fechaNac`) VALUES ('$correo','$nombres','$apellidos','$municipio',0,'$fechaNac');");
				
				$sqlBusqueda=$this->sqlCargar=mysql_query("SELECT `id` FROM `clientes` WHERE `usuario`='$correo';");

				while($ide = mysql_fetch_array($sqlBusqueda)){
					$this->sqlAgregar = mysql_query("INSERT INTO `localizacionclientes` (`idCliente`,`direccion`, `lat`,`lng`) VALUES ('$ide[0]','$direccion','$lat','$lng');");
					$this->sqlAgregar = mysql_query("INSERT INTO `telefonoclientes` (`idCliente`,`telefono`) VALUES ('$ide[0]','$telefono');");
				}

				$this->sqlAgregar = mysql_query("INSERT INTO `usuariosproveedores` (`usuario`,`contrasena`,`Activo`) VALUES ('$correo',AES_ENCRYPT('$contrasenha','Makers2018'),'2');");

				$this->sqlAgregar = mysql_query("INSERT INTO `proveedores` (`usuario`,`nombres`,`apellidos`, `idMunicipio`,`calificacion`,`fechaNac`) VALUES ('$correo','$nombres','$apellidos','$municipio',0,'$fechaNac');");
				
				$sqlBusqueda=$this->sqlCargar=mysql_query("SELECT `id` FROM `proveedores` WHERE `usuario`='$correo';");

				while($ide = mysql_fetch_array($sqlBusqueda)){
					$this->sqlAgregar = mysql_query("INSERT INTO `localizacionproveedores` (`idProveedor`,`direccion`, `lat`,`lng`) VALUES ('$ide[0]','$direccion','$lat','$lng');");
					$this->sqlAgregar = mysql_query("INSERT INTO `telefonoproveedores` (`idProveedor`,`telefono`) VALUES ('$ide[0]','$telefono');");
				}
				echo '<div id="blog" class="blog">';
				echo 	'<div class="container" style="padding:50px;padding-bottom:250px;">';
				echo 		"<h3> Registro Exitoso </h3>";
				echo 		"<div style='padding:25px;border:1px solid #cecece;'>
								<p>
									Estimado Sr(a) ".strtoupper($nombres).". sus datos fueron registrados con éxito, Agradecemos por tenernos como alternativa para mostrar su trabajo y hacernos parte de sus posibilidades de avanzar como el mejor, pero aún es necesario por seguridad y eficencia de los procesos de calidad su solicitud será revisada por el personal de Maker's
								</p>
							</div>";
				echo 		"<button class='btn btn-primary' onclick='salir()'><i class='fa fa-home'></i> Regresar</button>";
				echo 	"</div> "; 			           
				echo "</div> ";

			}
		}

		function actualizar($antIdProveedor,$idProveedor,$nombre,$dir,$tel,$ciudad,$correo){
			mysql_query("UPDATE `proveedor` SET `idProveedor` = '$idProveedor' , `nombre` = '$nombre' , `Dir` = '$dir' , `TEL` = '$tel' , `CIUDAD` = '$ciudad' , `correo` = '$correo' WHERE `idProveedor` = '$antIdProveedor';");
			echo "<script>alertify.success('Proveedor(a) Actualizado con éxito');</script>";
			$this->cargarLista();
		}

		function eliminar($idRegistro){
			//mysql_query("UPDATE `proveedor` SET `ACTIVO` = 'NO' WHERE `ID_EMPLEADO` = '$idProveedor' AND `ID_NEGOCIO`='$idNegocio';");
		}

	}

?>