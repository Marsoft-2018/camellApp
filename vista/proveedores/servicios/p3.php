<div id="programacion">
    <h2>DISPONIBILIDAD</h2>
    <span id="marcoServicios">	               	
		<div class='row about-grid about-grid1 wow fadeInLeft' style = "color: #fff; padding: 10px 40px;">
			<h2>2.) Escoge el lugar donde prestarás tus servicios</h2> 
			<div class='col-md-5 about-grid-info' style = "height:300px; padding: 40px 20px;">
				<?php 
					//_POST['usuario'];							
					$obj = new ServicioProveedor();
					$obj->listarCiudades($this->idUsuario);
				?>
			</div>
			<div class='col-md-2' style="padding: 20px; text-align: center;overflow: auto;">
				<button class="btn btn-primary" id='agregarMunicipio' onclick = 'agregarMunicipioSeleccionadoTabla(<?php echo $idProv; ?>)' style="padding: 20px 30px;margin-top: 40px;">
					<i class="fa fa-angle-double-right"></i> 
				</button>
				<button class="btn btn-primary" id='quitarMunicipio' onclick='quitarMunicipioSeleccionadoTabla(<?php echo $idProv; ?>)' style="padding: 20px 30px;margin-top: 40px;"><i class="fa fa-angle-double-left"></i> </button>
			</div>
			<div class='col-md-5' style="height:300px; padding: 40px 20px;">
				<p>Lugares Seleccionados</p>
				<select multiple name="municipioSeleccionado" id="municipioSeleccionado" class="listaServicios" style="height: 100%;" ondblclick = 'quitarMunicipioSeleccionadoTabla(<?php echo $idProv; ?>)'>	
					<?php

						$this->sql = mysql_query("SELECT ra.idMunicipio, m.`nombre` FROM rango_accion_servicios ra INNER JOIN municipios m ON m.`id` = ra.`idMunicipio` WHERE ra.idProveedor ='".$idProv."' and ra.`estado` = '1';");
						while($mun = mysql_fetch_array($this->sql) ){
							echo "<option value='$mun[0]'>".utf8_encode($mun[1])."</option>";
						} 
					?>

				</select>
			</div>
			<span id="resMunicipio"></span>
		</div>
		<div class='row about-grid about-grid2 wow fadeInUp' style='background-color: #C3CA9C; margin-top: 20px;'>
			<h2>3.) Horario en el que estarás disponible</h2> 
			<div class='col-md-12 about-grid-pic' style="padding:40px 20px;">
				<div class="row">
					<div class="col-md-12">
						<h2>Días</h2>							
						<div class="panel">
						 	<table class="table">
						 		<thead>
						 			<tr >
						 				<?php
						 					foreach ($this->dias as $d) {
						 						echo "<th style='text-align:center;'>$d</th>";
						 					}
						 				?>
						 			</tr>
						 		</thead>
						 		<tbody>
									<tr>
										<?php
						 					foreach ($this->dias as $d) {
						 						echo "<td style='text-align:center;'>".
						 							"<span id='dia".$idProv.$d."'>";
						 						$sqlDia = mysql_query("SELECT * FROM disponibilidad_dias WHERE idProveedor = ".$idProv." AND Dias = '".$d."' AND estado = 1;");
						 						$rd = mysql_num_rows($sqlDia);
						 						if($rd > 0){
						 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$idProv."' value='".$d."' onclick='quitarDia(this.id,this.value)' checked>";
						 						}else{
						 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '".$idProv."'  value='".$d."' onclick='colocarDia(this.id,this.value)'>";
						 						}
						 						echo 	"</span>";  		
						 						echo "</td>";
						 					}
						 				?>
									</tr>
								</tbody>
						 	</table>
						</div> 								
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" >
						<h2>Horas</h2>							
						<div class="panel" style="overflow: auto;" id='panelHorario' >
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
						 						echo "<td style='text-align:center;'>".
						 							"<span id='hora".$idProv.$i."'>";
						 						$sqlHora = mysql_query("SELECT * FROM disponibilidad_horas WHERE idProveedor = ".$idProv." AND Hora ='".$i."' AND estado = 1;");
						 						$rd = mysql_num_rows($sqlHora);
						 						if($rd > 0){
						 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$idProv."' value='$i' onclick='quitarHora(this.id,this.value)' checked>";
						 						}else{
						 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '".$idProv."'  value='$i' onclick='colocarHora(this.id,this.value)'>";
						 						}
						 						echo 	"</span>";  		
						 						echo "</td>"; 						
						 					}
						 				?>
									</tr>
									<tr>
										<td>P.M</td>
										<?php
						 					for($i = 13;$i <= 24;$i++) {
						 						echo "<td style='text-align:center;'>".
						 							"<span id='hora".$idProv.$i."'>";
						 						$sqlHora2 = mysql_query("SELECT * FROM disponibilidad_horas WHERE idProveedor = ".$idProv." AND Hora ='".$i.":00' AND estado = 1;");
						 						$rd = mysql_num_rows($sqlHora2);
						 						if($rd > 0){
						 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$idProv."' value='$i' onclick='quitarHora(this.id,this.value)' checked>";
						 						}else{
						 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '".$idProv."'  value='$i' onclick='colocarHora(this.id,this.value)'>";
						 						}
						 						echo 	"</span>";  		
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
			<div class="clear-fix"></div>
			<div class="col-xs-5 col-md-5">
				<span id="resultadoGuardar"></span>
			</div>					
		</div>
	</span>	
</div>