<?php 
  	//include("menuClientes.php");	
	//include("serviciosDestacados.php");
	require("modelo/Conexion.php");
	//require("../modelo/categoria.php");
	require("modelo/combos.php");
	require("modelo/servicioProveedor.php");
	require("modelo/perfil.php");
	require("modelo/proveedor.php");
?>
<?php 
	$objUsu = new Perfil();
	$objUsu->tabla = "proveedores";
	$objUsu->usuario = $_SESSION["usuario"];
	$nombre = $objUsu->cargarNombre($_SESSION["usuario"]);
?>

<div id="home" class="header scroll headerProveedor">
	<div class="container">
		<div class="logo logoMenuProveedor">
			<a href="#">
				<img src="../web/images/LogoVitriser.png" style="width:190px;margin-top: 20px;" title="Vitriservicios" />
			</a>
		</div>		
		<div class="clearfix"> </div>
	</div>	
	<?php 
		echo "<h4 class='nombreUsu'>Bienvenido: ".$nombre."</h4>";
		//echo date("D");
	?>		
</div>
<div class="top-banner-grids wow bounceInUp menuProveedor" data-wow-delay="0.4s">
	<div class="banner-grid-cuadrado banner-grid-active text-center scroll btnMenu" id='cargarProgramacionServicios' onclick="cargarProgramacionServicios()">
		<span class="top-icon1"> </span>
		<h3>Programacion de Servicios</h3>
	</div>
	<div class="banner-grid-cuadrado  text-center scroll btnMenu" id="servicio">
		<span class="top-icon2"> </span>
		<h3>Servicios</h3>
	</div>
	<div class="banner-grid-cuadrado text-center scroll btnMenu">
		<span class="top-icon3"> </span>
		<h3>Calificaciones</h3>
	</div>
	<div class="banner-grid-cuadrado text-center scroll btnMenu">
		<span class="top-icon5"> </span>
		<h3>Pagos</h3>
	</div>
	<div class="banner-grid-cuadrado text-center scroll btnMenu">
		<i class="fa fa-user"> </i>
		<h3>Perfil</h3>
	</div>		
	<div class="banner-grid-cuadrado text-center scroll btnMenu" onclick="salir()">
		<i class="fa fa-gear"> </i>
		<h3>Salir</h3>
	</div>
</div>
<div id="blog" class="blog">
	<div id="resultado">		
		<?php 
			$obj = new ServicioProveedor();
			$obj->idUsuario = ($_SESSION["usuario"]);
			$obj->vistaServiciosP1();
		 ?>
	</div>
	<div class="container" style="padding:50px;padding-top:0px;padding-bottom:250px;">
		
		<!--

		    <div id="programacion">
                <h3>PLANEACIÓN DE LOS SERVICIOS </h3>
                <span id="marcoServicios">
	               	<div class='row'>
                		<h2>1.) Escoge tus Servicios</h2>                 		
						<div class='col-md-5' style="height:300px;padding: 40px 20px;">
							<?php 
								//_POST['usuario'];							
								$obj = new ServicioProveedor();
								$obj->listarSeleccionarServicios();
							?>
						</div>
						<div class='col-md-2' style="padding: 0px; text-align: center;overflow: auto;">
							<button class="btn btn-primary" id='agregar' style="padding: 20px 30px;margin-top: 40px;">
								<i class="fa fa-angle-double-right"></i> 
							</button>
							<button class="btn btn-primary" id='quitar' style="padding: 20px 30px;margin-top: 40px;"><i class="fa fa-angle-double-left"></i> </button>
						</div>
						<div class='col-md-5' style="height:300px; padding: 40px 20px;">
							<p>Servicios Seleccionados</p>
							<select multiple name="servicioSeleccionado" id="servicioSeleccionado" class="listaServicios" ondblclick = 'quitarSeleccionado()' style="height: 100%;">
								
							</select>
						</div>
					</div>
					<div class='row'>
						<h2>2.) Escoge el lugar donde prestarás tus servicios</h2> 
						<div class='col-md-5' style="height:300px;padding: 40px 20px;">
							<?php 
								//_POST['usuario'];							
								$obj = new ServicioProveedor();
								$obj->listarCiudades($_POST["usuario"]);
							?>
						</div>
						<div class='col-md-2' style="padding: 20px; text-align: center;overflow: auto;">
							<button class="btn btn-primary" id='agregarMunicipio' onclick = 'agregarMunicipioSeleccionado()' style="padding: 20px 30px;margin-top: 40px;">
								<i class="fa fa-angle-double-right"></i> 
							</button>
							<button class="btn btn-primary" id='quitarMunicipio' onclick='quitarMunicipioSeleccionado()' style="padding: 20px 30px;margin-top: 40px;"><i class="fa fa-angle-double-left"></i> </button>
						</div>
						<div class='col-md-5' style="height:300px; padding: 40px 20px;">
							<p>Lugares Seleccionados</p>
							<select multiple name="municipioSeleccionado" id="municipioSeleccionado" class="listaServicios" style="height: 100%;" ondblclick = 'quitarMunicipioSeleccionado()'>								
							</select>
						</div>
					</div>
					<div class='row'>
						<h2>3.) Horario en el que estarás disponible</h2> 
						<div class='col-md-12' style="padding:40px 20px;">
							<div class="row">
								<div class="col-md-12">
									<h2>Días</h2>							
									<div class="panel">
									 	<table class="table">
									 		<thead>
									 			<tr >
									 				<th style='text-align:center;'>Lun</th>
									 				<th style='text-align:center;'>Mar</th>
									 				<th style='text-align:center;'>Mie</th>
									 				<th style='text-align:center;'>Jue</th>
									 				<th style='text-align:center;'>Vie</th>
									 				<th style='text-align:center;'>Sab</th>
									 				<th style='text-align:center;'>Dom</th>
									 			</tr>
									 		</thead>
									 		<tbody>
												<tr>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Lun' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Mar' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Mie' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Jue' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Vie' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Sab' onclick='seleccionDia(this)'>
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='diaSel' value='Dom' onclick='seleccionDia(this)'>
													</td>
												</tr>
											</tbody>
									 	</table>
									</div> 								
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Horas</h2>							
									<div class="panel">
									 	<table class="table">
									 		<thead>
									 			<tr >
									 				<th style='text-align:center;'></th>
									 				<th style='text-align:center;'>1:00</th>
									 				<th style='text-align:center;'>2:00</th>
									 				<th style='text-align:center;'>3:00</th>
									 				<th style='text-align:center;'>4:00</th>
									 				<th style='text-align:center;'>5:00</th>
									 				<th style='text-align:center;'>6:00</th>
									 				<th style='text-align:center;'>7:00</th>
									 				<th style='text-align:center;'>8:00</th>
									 				<th style='text-align:center;'>9:00</th>
									 				<th style='text-align:center;'>10:00</th>
									 				<th style='text-align:center;'>11:00</th>
									 				<th style='text-align:center;'>12:00</th>
									 			</tr>
									 		</thead>
									 		<tbody>
												<tr>
													<td>A.M</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='1:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='2:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='3:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='4:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='5:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='6:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='7:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='8:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='9:00'> 
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='10:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='11:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='12:00' >
													</td>
												</tr>
												<tr>
													<td>
													P.M</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='13:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='14:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='15:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='16:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='17:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='18:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='19:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='20:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='21:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='22:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='23:00' >
													</td>
													<td>
														<input type="checkbox" class='form form-control' name='horaSel' onclick='seleccionHora(this)' value='00:00' >
													</td>
												</tr>
											</tbody>
									 	</table>
									</div> 								
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="text-align: center; padding: 0px;">
						<div class='col-md-2' id='divBotonContinuar' >
							<button class='btn btn-primary' onclick='guardarServiciosProveedor()' style="padding: 15px 30px;">	Guardar
							</button> 
						</div>
						<div class="clear-fix"></div>
						<div class="col-xs-5 col-md-5">
							<span id="resultadoGuardar"></span>
						</div>					
					</div>
				</span>			
			</div>
		-->
	</div>
</div>
<input type="hidden" id="usuario" name='usuario' value="<?php echo $_POST["usuario"]; ?>">
<script type="text/javascript" src="js/proveedor.js"></script>
<script type="text/javascript" src="../complementos/sweetalert2/sweetalert2.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0L8BsANJeB5NuaBwjccRGAxtFvRf9R8o"></script>