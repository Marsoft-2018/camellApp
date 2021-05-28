<?php 
  	//include("menuClientes.php");	
	//include("serviciosDestacados.php");
	require("modelo/Conexion.php");
	require("modelo/combos.php");
	require("modelo/servicioProveedor.php");
	require("modelo/perfil.php");
	require("modelo/proveedor.php");
	require("modelo/buscarUbicacion.php");
?>
<?php 
	$objUsu = new Perfil();
	$objUsu->tabla = "proveedores";
	$objUsu->usuario = $_SESSION["usuario"];
	$nombre = "";
	$idCiudad = "";

	foreach ($objUsu->cargar() as $value) {
		$nombre = $value['nombres']." ".$value['apellidos'];
		$idCuidad = $value['idMunicipio'];
	}
	;
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
<div class="top-banner-grids wow bounceInLeft menuProveedor" data-wow-delay="0.4s">
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
			include("proveedores/servicios/serviciosProveedor.php");
		?>
	</div>
	<div class="container" style="padding:50px;padding-top:0px;padding-bottom:250px;">
		
	</div>
</div>
<script type="text/javascript" src="js/proveedor.js"></script>
<script type="text/javascript" src="../complementos/sweetalert2/sweetalert2.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0L8BsANJeB5NuaBwjccRGAxtFvRf9R8o"></script>