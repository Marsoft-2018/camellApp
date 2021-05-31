<?php 
if (isset($_POST['accion'])) {
	if ($_POST['accion']=="cargarProgramacion") {
		require("../../../modelo/Conexion.php");
		require("../../../modelo/combos.php");
		require("../../../modelo/categoria.php");
		require("../../../modelo/servicio.php");
		require("../../../modelo/servicioProveedor.php");
		require("../../../modelo/perfil.php");
		require("../../../modelo/proveedor.php");
		require("../../../modelo/buscarUbicacion.php");
		$objSerProveedor = new ServicioProveedor();
		$objSerProveedor->idUsuario = $_SESSION['usuario'];
	}
}else{
	$objSerProveedor = new ServicioProveedor();
	$objSerProveedor->idUsuario = $_SESSION['usuario'];
}
	// $objSerProveedor = new ServicioProveedor();
	// $objSerProveedor->idUsuario = $_SESSION['usuario'];
	// if($objSerProveedor->hayServiciosCargados()){
	// }
?>
	<div id="programacion">
        <h3>PLANEACIÓN DE LOS SERVICIOS </h3>
        <span id="marcoServicios">
        	<h2 style="width: 100%;">1.) Escoge tus Servicios</h2> 	
           	<div class='row'>	
				<div class='col-md-5'>
					<label for="">Categoria</label>
					<select name='categorias' class='form-control' id='categoriaServicio' onchange='buscarServicios(this.value)'>
						<option value=''>Seleccione...</option>
						<?php 
							$objCategoria = new Categoria();
							foreach($objCategoria->listar() as $rs){
						?>
						<option value="<?php echo $rs['id'] ?>"><?php echo $rs['nombre'] ?></option>
					<?php } ?>
					</select>
				</div>
				<div class='col-md-5'>
					<label for="">Servicios</label>
					<select name='servicios' class='form-control' id='idServicio'>
						<option value=''>Seleccione...</option>			
					</select>
				</div>
				<div class='col-md-2' style="padding: 0px; text-align: center;overflow: auto;">
					<button class="btn btn-primary" id='agregar' onclick="agregarSeleccionado()" style="padding: 5px 30px;margin-top: 30px;">
						<i class="fa fa-plus">Agregar</i> 
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-ms-12">
					<?php include("lista.php") ?>
				</div>
			</div>			
			<h2>2.) Escoge el lugar donde prestarás tus servicios</h2> 		
           	<div class='row'>	
				<div class='col-md-5'>
					<label for="">Departamento</label>
					<select name='departamento' class='form-control' id='idDepartamento' onchange='cargarCiudad(this.value)'>
						<option value=''>Seleccione...</option>
						<?php 
							$objDepartamento = new buscarUbicacion();
							$objDepartamento->idPais = 1;
							foreach($objDepartamento->departamentos() as $rs){
						?>
						<option value="<?php echo $rs['id'] ?>"><?php echo $rs['nombre'] ?></option>
					<?php } ?>
					</select>
				</div>
				<div class='col-md-5'>
					<label for="">Ciudad/Municipio</label>
					<select name='ciudad' class='form-control' id='ciudad'>
						<option value=''>Seleccione...</option>			
					</select>
				</div>
				<div class='col-md-2' style="padding: 0px; text-align: center;overflow: auto;">
					<button class="btn btn-primary" id='agregar'  onclick = 'agregarMunicipioSeleccionado()' style="padding: 5px 30px;margin-top: 25px;">
						<i class="fa fa-plus">Agregar</i> 
					</button>
				</div>
			</div>			
			<div class="row">
				<div class="col-ms-12" id="listaCiudades">
					<?php include("ubicacion.php") ?>
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
											<?php
							 					foreach ($obj->dias as $d) {
							 						echo "<td style='text-align:center;'>".
							 							"<input type='checkbox' class='form form-control' name='diaSel' value='".$d."' onclick='seleccionDia(this.value)'>".
							 						"</td>";
							 					}
							 				?>
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
							 				<th></th>
							 				<?php
							 					for($i = 1;$i <= 12;$i++) {
							 						echo "<th style='text-align:center;'>$i:00</th>";
							 					}
							 				?>
							 			</tr>
							 		</thead>
							 		<tbody>
										<tr>
											<td>A.M</td>
											<?php
							 					for($i = 1;$i <= 12;$i++) {
							 						echo "<td style='text-align:center;'>";
							 						
							 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = ''  value='$i' onclick='seleccionHora(this)'>";
							 						echo "</td>"; 						
							 					}
							 				?>
										</tr>
										<tr>
											<td>P.M</td>
											<?php
							 					for($i = 13;$i <= 24;$i++) {
							 						echo "<td style='text-align:center;'>";
							 						echo "<input type='checkbox' class='form form-control' name='diaSel' id = ''  value='$i' onclick='seleccionHora(this)'>";
							 						echo "</td>";
							 					}
							 				?>
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
<?php 

?>