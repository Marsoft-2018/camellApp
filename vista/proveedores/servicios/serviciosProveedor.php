<?php 
	$objSerProveedor = new ServicioProveedor();
	if($objSerProveedor->hayServiciosCargados()){
		include("servicios/p3.php");
	}else{
?>
	<div id="programacion">
        <h3>PLANEACIÓN DE LOS SERVICIOS </h3>
        <span id="marcoServicios">
           	<div class='row'>
        		<h2>1.) Escoge tus Servicios</h2>                 		
				<div class='col-md-5' style="height:300px;padding: 40px 20px; overflow: auto;">
					<?php 
						//_POST['usuario'];							
						$obj = new ServicioProveedor();
						include_once("seleccionar.php");
					?>
				</div>
				<div class='col-md-2' style="padding: 0px; text-align: center;overflow: auto;">
					<button class="btn btn-primary" id='agregar' onclick="agregarSeleccionado()" style="padding: 20px 30px;margin-top: 40px;">
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
						$objUbicacion = new buscarUbicacion();
						$objUbicacion->idCiudad = $idCiudad;
					?>
					<p>Seleccione lugares</p>
					<select multiple id = 'liMunicipios' name = 'liMunicipios' class = 'listaServicios' style='height:100%;' ondblclick = 'agregarMunicipioSeleccionado()'>
					<?php
						foreach ($objUbicacion->ciudadCercanas as $cities) {
							?>
							<option value="<?php echo $cities['id'] ?>"><?php echo $cities['nombre'] ?></option>
						<?php 
						}
					?>
					</select>
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

} ?>