<?php 
	require ("modelo/Conexion.php");
  	include("menuClientes.php");	
	include("serviciosDestacados.php");
	require("modelo/categoria.php");
	require("modelo/perfil.php");
	require("modelo/proveedor.php");

	echo '<div id="blog" class="blog">';
	$objUsu = new Perfil();
	$objUsu->usuario = $_SESSION["usuario"];
	$objUsu->tabla = "clientes";
	$nombre = "";
	foreach ($objUsu->cargar() as $value) {
		$nombre = $value['nombres']." ".$value['apellidos'];
		$idCuidad = $value['idMunicipio'];
	}

	echo "<h4>Bienvenido: ".$nombre."</h4>";
	echo '<div class="container" style="padding:50px;padding-top:0px;padding-bottom:250px;">';
	echo 	"<h3> SOLICITUD DE SERVICIOS </h3>";

		

	//echo $_POST['usuario'];
	echo 	"<div class='row'>";
	echo 		"<div class='col-md-4'>";
					$objCategoria = new Categoria();
					$objCategoria->cargarLista();
	echo		"</div>";
	echo 		"<div class='col-md-4' id='divSubCategoria'>
	                
	          	</div>";
	//echo 		"<div class='col-md-4' id='divServicios'>
	                
	//          	</div>";

	echo 		"<div class='col-md-4' id='divBotonContinuar' style='padding-top:22px;'>";
	echo 			"<button class='btn btn-primary' style='padding:10px;width:90%;' onclick='cargarProveedoresServicios()'>Continuar</button>";	                
	echo 		"</div>";
	echo 	"</div>";
	echo 	"<div class='row' >";
	echo 		"<div class='col-md-12' id='vistaProveedores' style='padding-top:40px;'>";
			echo "<table class='display table table-striped table-hover dataTable no-footer'>";
			echo 	"<thead>";
			echo	  "<tr>";
			echo		"<th>Nombre</th>";
			echo		"<th>Calificaciones</th>";
			echo		"<th>Accion</th>";
			echo	  "</tr>";
			echo    "</thead>";
			echo    "<tbody>";			
				echo "<tr>";
				echo 	"<td colspan='6' style='text-align:center;'>";
				echo 	"</td>";
				echo "</tr>";
			echo 	"</tbody>";
			echo "</table>";
	echo		"</div>";
	echo 		"<!--<div class='col-md-7' style='padding-top:40px;'>
					
	                <label>Ubicacion de proveedores cercanos </label><span onclick='mostrarMapa2()' title='Ver ubicacion de proveedores'>  <i class='fa fa-eye'> </i></span>
	                <div id='mapaRegistro'  style='padding:0px;height: 400px; width: 98%;border:1px solid #cecece;'>
					</div>
			</div>-->";
	echo 	"<div class='row' style='padding-bottom:40px;'>";
	echo	"</div>";
	echo "</div>";

?>
<script type="text/javascript" src="../js/acciones.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0L8BsANJeB5NuaBwjccRGAxtFvRf9R8o"></script>