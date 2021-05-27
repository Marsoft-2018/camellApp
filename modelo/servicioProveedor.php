<?php
	//require("Conexion.php");
	require("votacion.php"); 
	class ServicioProveedor extends Conectar{
		private $sql;
		public $idUsuario;
		//public $dias = array("Lun","Mar","Mie","Jue","Vie","Sab","Dom"); 
		public $dias = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun"); 			

		public function cargarProveedores($idServicio){		
			$this->sql = mysql_query("SELECT pr.* FROM proveedores pr INNER JOIN proveedorservicios ps ON ps.`idProveedor` = pr.`id` WHERE ps.`idServicio` = '$idServicio' AND ps.`activo` = 1 ORDER BY pr.`apellidos`,pr.`nombres`; ");

			$res=mysql_num_rows($this->sql);
			echo '<h4>Datos de los proveedores relacionados</h4>';
			echo "<table class='display table table-striped table-hover dataTable no-footer'>";
			echo 	"<thead>";
			echo	  "<tr>";
			echo		"<th rowspan='2'>Nombre</th>";
			echo		"<th colspan='3'>Calificaciones</th>";
			echo		"<th rowspan='2'>Accion</th>";
			echo	  "</tr>";
			echo 	  "<tr style='font-size:10px;'>";
			echo		"<th>Bueno</th>";
			echo		"<th>Regular</th>";
			echo		"<th>Malo</th>";
			echo	  "</tr>";
			echo    "</thead>";
			echo    "<tbody>";
			if($res>0){
				while($rs=mysql_fetch_array($this->sql)){
					$objVotos = new Votar();
					$objVotos->tipoUsuario = "Cliente";	
					$objVotos->UsuarioCalificado = $rs[0];
					
					echo "<tr>";
					echo "<td style='font-size:10px;padding:2px;'>".$rs[2]." ".$rs[3]."</td>";
					echo "<td style='padding:0px;'>";
					$sqlVotosB = $objVotos->cargarVotosBuenos();
					$numVotosB = mysql_num_rows($sqlVotosB);
					if($numVotosB > 0){
						while($vt = mysql_fetch_array($sqlVotosB)){
							echo "<div style='background-color:#499815;text-align:center;'>";
							echo "<a href='#' id='$rs[0]' name='Bueno' onclick='cargarOpiniones(1,this.id,this.name)'>$vt[0]</a>";
							echo "</div>";
						}
					}else{
						echo "0";
					} 
					echo "</td>";
					echo "<td style='padding:0px;'>";
					$sqlVotosR = $objVotos->cargarVotosRegular();
					$numVotosR = mysql_num_rows($sqlVotosR);
					if($numVotosR > 0){
						while($vt = mysql_fetch_array($sqlVotosR)){
							echo "<div style='background-color:#faCe02;text-align:center;'>";
							echo "<a href='#' id='$rs[0]' name='Regular' onclick='cargarOpiniones(1,this.id,this.name)'>$vt[0]</a>";
							echo "</div>";
						}
					}else{
						echo "0";
					}
					echo "</td>";
					echo "<td style='padding:0px;'>";
					$sqlVotosM = $objVotos->cargarVotosMalos();
					$numVotosM = mysql_num_rows($sqlVotosM);
					if($numVotosM > 0){
						while($vt = mysql_fetch_array($sqlVotosM)){
							echo "<div style='background-color:#ffaa02;text-align:center;'>";
							echo "<a href='#' id='$rs[0]' name='Malo' onclick='cargarOpiniones(1,this.id,this.name)'>$vt[0]</a>";
							echo "</div>";
						}
					}else{
						echo "<div style='color:#ff0202;text-align:center;height:100%;width:100%;'>";
							echo "0";
							echo "</div>";
					}
					echo "</td>";
					echo "<td style='padding:0px;text-align:center;'>
							<button class='btn btn-warning' id='$rs[0]' title='Elegir' onclick='editarPrograma(this.id)' style='padding:0px;text-align:center;'><i class='fa fa-check'> </i></button> </td>";
					echo "</tr>";					
				}
			}else{
				echo "<tr>";
				echo 	"<td colspan='6' style='text-align:center;'>";
				echo 		"<div class='alert alert-warning' >No existen proveedores almacenados para este servicio en este momento</div>";
				echo 	"</td>";
				echo "</tr>";

			}
			echo 	"</tbody>";
			echo "</table>";
		}

		public function consultaServicios(){
			$this->sql = "SELECT c.id as 'idCategoria', c.`nombre` AS 'categoria',  s.`nombre` AS 'servicio', s.id as 'idServicio' FROM servicios s RIGHT JOIN `categorias` c ON c.`id` = s.`idcategoria` ORDER BY categoria, servicio ASC";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);

				return $datos;
			} catch (Exception $e) {
				echo "Error al consultar los servicios";
			}	 
		}

		public function listarCiudades($idUsuario){
			echo '<p>Seleccione lugares</p>';
			$sqlPais = mysql_query("SELECT pa.`id`,pa.`nombre` FROM paises pa INNER JOIN departamentos d ON pa.`id` = d.`idPais` INNER JOIN municipios m ON d.`id` = m.`idDepto` INNER JOIN proveedores pv ON m.`id` = pv.`idMunicipio` WHERE pv.`usuario` = '$idUsuario'");
			$sqlDep = "";
			while($pa = mysql_fetch_array($sqlPais)){
				$sqlDep = mysql_query("SELECT id, nombre FROM departamentos WHERE idPais = '$pa[0]' ");
			}			
			echo "<select multiple id = 'liMunicipios' name = 'liMunicipios' class = 'listaServicios' style='height:100%;' ondblclick = 'agregarMunicipioSeleccionado()'>";
			while($c = mysql_fetch_array($sqlDep)){
				echo "<optgroup label='".utf8_encode($c[1])."'>";
				$this->sql = mysql_query("SELECT id, nombre FROM municipios WHERE idDepto = '$c[0]'");
				while($p = mysql_fetch_array($this->sql) ){
					echo "<option value='$p[0]'>".utf8_encode($p[1])."</option>";
				} 
				echo "</optgroup>";
			}
			echo "</select>";			
		}

		public function hayServiciosCargados(){			
			$this->sql = "SELECT id FROM proveedores WHERE usuario = '".$this->idUsuario."'"; 
            try {
			   	$stm = $this->Conexion->prepare($this->sql);
			   	$stm->bindparam(1,$this->usuario);
			   	$stm->execute();
			   	$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($datos as $value) {
					$this->sql = "SELECT * FROM proveedorservicios WHERE idProveedor = ". $value['id']." and activo =1";
					$stm = $this->Conexion->prepare($this->sql);
					$stm->execute();
					$res = $stm->fetchAll(PDO::FETCH_ASSOC);
				 	foreach ($res as $row) {
						return true;
					}
				}
		    } catch (PDOException $e) {
				echo "Dato no encontrado";
		    }           
		}

		public function vistaServiciosP1(){
			if($this->hayServiciosCargados()){
				$this->vistaServiciosP3();
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
								$obj->listarSeleccionarServicios();
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
								$obj = new ServicioProveedor();
								$obj->listarCiudades($this->idUsuario);
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
													<?php
									 					foreach ($this->dias as $d) {
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
			}
		}

		public function vistaServiciosP2(){
			$idUsuario = $this->idUsuario;
			$objServicio = new  Servicio();
			$res =	$objServicio->lista($idUsuario);
	     
		   	$resul = array();
		   	$cont = 0; 
		   	echo "<h3> LISTA DE SUS SERVICIOS </h3>".
		   	  	"<div class='alert alert-info'>
                  	A continuacion, Por favor establezca el valor para cada uno de los servicios. tenga en cuenta que sobre el valor colocado se aplica el porcentaje de cobro establecido por vitriservicios colombia.
              	</div>".
		   	"<table class='table'>".
			    "<thead>".
			      "<tr>".
			       "<th scope='col'>ID</th>".
			        "<th scope='col'>Categoria</th>".
			        "<th scope='col'>Servicios</th>".
		          "<th scope='col'>Valor</th>".
			       "<th scope='col' colspan='3'>Accion</th>".
			     "</tr>".
			    "</thead>".
			    "<tbody>";

		     	while ($r = mysql_fetch_array($res)) {
		    		echo "<tr>";
		      		echo "<td>".$r[0]."</td>";
		      		echo "<td><p>".strtoupper($r[1])."</p></td>";
		      		echo "<td><p>".strtoupper(utf8_encode($r[2]))."</p></td>";
		          echo "<td><input type='number' name='valorServicio' id='valorServicio$r[0]' class='form form-control' value='".$r[3]."' placeholder='Valor del Servicio'></td>";
		    		  echo "<td>";
		    		    echo 	"<button class='btn btn-warning'  onclick='modificarServicio(this.id)' id='$r[0]' ><i class='fa fa-pencil' title='Editar'> Cambiar Valor</i></button>";
		    		  echo "</td>";
		    		  echo "<td>";
		    		    echo 	"<button class='btn btn-danger' onclick='eliminar_servicio(this.id)' id='$r[0]' ><i class='fa fa-trash' title='Eliminar'>Eliminar Servicio</i></button>";
		    		  echo "</td>";
		    		echo "</tr>";
		    	}

		     	echo "</tbody>";
	      echo "</table>";	      
		}

		public function vistaServiciosP3(){
			$sqlProv = mysql_query("SELECT id FROM proveedores WHERE usuario = '".$this->idUsuario."'");
			$idProv;
			while($id = mysql_fetch_array($sqlProv)){
				$idProv = $id[0];
			}
			?>
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
			<?php
		}

		public function guardar($usuario, $servicios, $municipios, $dias, $horas){
			$sqlProv = mysql_query("SELECT id FROM proveedores WHERE usuario = '".$usuario."'");
			$idProv;
			while($id = mysql_fetch_array($sqlProv)){
				$idProv = $id[0];
			}

			foreach ($servicios as $clave => $value) {
				$sqlServicios = mysql_query("INSERT INTO proveedorservicios(idProveedor, idServicio) VALUES('".$idProv."','".$value."')");					      	        
		    }	
		    
		    $this->guardarDisponibilidadDias($idProv, $dias);
		    $this->guardarDisponibilidadHoras($idProv, $horas);
		    $this->guardarRangoDeAccion($idProv, $municipios);
		    $this->vistaServiciosP2();
		}

		public function guardarDisponibilidadDias($idProv, $dias){
			//Se llena la tabla de la disponibilidad en días
		    foreach ($dias as $clave => $value) {
		      $sqlDias = mysql_query("INSERT INTO disponibilidad_dias(idProveedor, Dias) VALUES('".$idProv."','".$value."')")or die("error al ingresar los días ".mysql_error());  
		    }
		}

		public function guardarDisponibilidadHoras($idProv, $horas){
			foreach ($horas as $clave => $value) {
		      $sqlHoras = mysql_query("INSERT INTO disponibilidad_horas(idProveedor, Hora) VALUES('".$idProv."','".$value.":00')")or die("error al ingresar las horas ".mysql_error());
		    }	
		}

		public function guardarRangoDeAccion($idProv, $municipios){
			foreach ($municipios as $claveM => $valueM) {
		        $this->sql = mysql_query("INSERT INTO rango_Accion_Servicios(idProveedor,idMunicipio) VALUES (".$idProv.",".$valueM.")")or die("error al ingresar los datos ".mysql_error());               
		    }
		}

		public function modificar($id,$valor){
			$sqlLista = mysql_query("UPDATE proveedorservicios SET proveedorservicios.`valor` = '$valor' WHERE proveedorservicios.`id`='$id'; ");
			//echo "Se actualizó el valor";			
		}

		public function quitarMunicipio($idProv,$municipio){
			$sqlLista = mysql_query("UPDATE rango_Accion_Servicios SET estado = '2' WHERE `idProveedor`='$idProv' AND idMunicipio = $municipio;");
			//echo "Se actualizó el valor";
		}

		public function ponerMunicipio($idProv,$municipios){
			foreach ($municipios as $claveM => $valueM) {
		        
		        $sqlExiste = mysql_query("SELECT * FROM rango_accion_servicios WHERE idProveedor = '".$idProv."' AND idMunicipio	= '".$valueM."';");
		        $res = mysql_num_rows($sqlExiste);
		        if($res > 0){
					$sqlActualiza = mysql_query("UPDATE rango_Accion_Servicios SET estado = '1' WHERE `idProveedor`='$idProv' AND idMunicipio = ".$valueM.";".mysql_error());  
		        }else{
		        	//echo "Esta listo para insertar $idProv ".$valueM;
 					$sqlIngresa = mysql_query("INSERT INTO rango_Accion_Servicios(idProveedor,idMunicipio) VALUES (".$idProv.",".$valueM.")")or die("error al ingresar los datos ".mysql_error());
		        }
		                
		    }
			//echo "Se actualizó el valor";
		}
		
		public function quitarDia($dia){
			$sqlDia = mysql_query("UPDATE disponibilidad_dias SET estado = '2' WHERE idProveedor = '".$this->idUsuario."' AND Dias = '".$dia."';");
			echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$this->idUsuario."' value='".$dia."' onclick='colocarDia(this.id,this.value)'>";
		}

		public function colocarDia($dia){		
		        
	        $sqlExiste = mysql_query("SELECT * FROM disponibilidad_dias WHERE idProveedor = '".$this->idUsuario."' AND Dias = '".$dia."';");
	        $res = mysql_num_rows($sqlExiste);
	        if($res > 0){
				$sqlActualiza =mysql_query("UPDATE disponibilidad_dias SET estado = '1' WHERE idProveedor = '".$this->idUsuario."' AND Dias = '".$dia."';".mysql_error()); 
				echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$this->idUsuario."' value='".$dia."' onclick='quitarDia(this.id,this.value)' checked>";
	        }else{
	        	//echo "Esta listo para insertar $idProv ".$valueM;
				$sqlIngresa = mysql_query("INSERT INTO disponibilidad_dias(idProveedor,Dias) VALUES (".$this->idUsuario.",'".$dia."')")or die("error al ingresar los datos ".mysql_error());
				echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '".$this->idUsuario."' value='".$dia."' onclick='quitarDia(this.id,this.value)' checked>";
	        }
		}

		public function quitarHora($hora){
			//echo "Se quitó la hora el valor $hora";
			$sqlDia = mysql_query("UPDATE disponibilidad_horas SET estado = '2' WHERE idProveedor = '".$this->idUsuario."' AND hora = '".$hora.":00';")or die("error al actualizar".mysql_error());
			echo "<input type='checkbox' class='form form-control' name='horaSel'  id = '".$this->idUsuario."' value='".$hora."' onclick='colocarHora(this.id,this.value)'>";		
		}

		public function colocarHora($hora){		
		        
	        $sqlExiste = mysql_query("SELECT * FROM disponibilidad_horas WHERE idProveedor = '".$this->idUsuario."' AND hora = '".$hora.":00';");
	        $res = mysql_num_rows($sqlExiste);
	        if($res > 0){
				$sqlActualiza =mysql_query("UPDATE disponibilidad_horas SET estado = '1' WHERE idProveedor = '".$this->idUsuario."' AND hora = '".$hora.":00';".mysql_error()); 
				echo "<input type='checkbox' class='form form-control' name='horaSel'  id = '".$this->idUsuario."' value='".$hora."' onclick='quitarHora(this.id,this.value)' checked>";
	        }else{
	        	//echo "Esta listo para insertar $idProv ".$valueM;
				$sqlIngresa = mysql_query("INSERT INTO disponibilidad_horas(idProveedor,hora) VALUES (".$this->idUsuario.",'".$hora.":00')")or die("error al ingresar los datos ".mysql_error());
				echo "<input type='checkbox' class='form form-control' name='horaSel'  id = '".$this->idUsuario."' value='".$hora."' onclick='quitarHora(this.id,this.value)' checked>";
	        }
		}

	}
?>