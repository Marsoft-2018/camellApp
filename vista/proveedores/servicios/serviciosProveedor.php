<?php 
if (isset($_POST['accion'])) {
	if ($_POST['accion']=="cargarProgramacionServicios") {
		// require("../../../modelo/Conexion.php");
		// require("../../../modelo/categoria.php");
		// require("../../../modelo/servicio.php");
		// require("../../../modelo/servicioProveedor.php");
		// require("../../../modelo/perfil.php");
		// require("../../../modelo/proveedor.php");
		// require("../../../modelo/buscarUbicacion.php");
		$objSerProveedor = new ServicioProveedor();
		$objSerProveedor->idUsuario = $_SESSION['usuario'];
	}
}else{
	$objSerProveedor = new ServicioProveedor();
	$objSerProveedor->idUsuario = $_SESSION['usuario'];
}

?>
<div id="programacion">
    <h3>PLANEACIÓN DE LOS SERVICIOS </h3>
    <span id="marcoServicios">
    	<h2 style="width: 100%;">1.) Escoge tus Servicios</h2> 	
       	<div class='row'>	
			<div class='col-md-3'>
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
			<div class='col-md-4'>
				<label for="">Servicios</label>
				<select name='servicios' class='form-control' id='cmb_servicios'>
					<option value=''>Seleccione...</option>			
				</select>
			</div>
			<div class='col-md-3'>
				<label for="">Precio COP</label>
				<input type="number" class="form form-control" value="" id="valorServicio">
			</div>
			<div class='col-md-2' style="padding: 0px; text-align: center;overflow: auto;">
				<button class="btn btn-primary" id='agregar' onclick="agregarServicioProveedor()" style="padding: 5px 30px;margin-top: 30px;">
					<i class="fa fa-plus">Agregar</i> 
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col-ms-12" id="listaServicios">
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
			<div class="col-ms-12" id="tablaHoras">
				<?php include("disponibilidad_horas.php") ?>
			</div>
		</div>
	</span>
</div>	
