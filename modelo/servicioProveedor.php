<?php
	//require("Conexion.php");
	require("votacion.php"); 
	class ServicioProveedor extends Conectar{
		private $sql;
		public $idUsuario;
		public $idServicio;
		public $valor;
		public $dias = array("Lun","Mar","Mie","Jue","Vie","Sab","Dom"); 
		//public $dias = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun"); 			

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

		public function hayServiciosCargados(){			
			$this->sql = "SELECT * FROM proveedorservicios WHERE idProveedor = (SELECT id FROM proveedores WHERE usuario = ?) AND activo =1"; 
            try {
			   	$stm = $this->Conexion->prepare($this->sql);
			   	$stm->bindparam(1,$this->idUsuario);
			   	$stm->execute();
			   	$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($datos as $value) {
					return true;					
				}
		    } catch (PDOException $e) {
				echo "Dato no encontrado";
		    }           
		}

		public function guardar(){
			$this->sql = "INSERT INTO proveedorservicios(idProveedor, idServicio,valor) VALUES(?, ?, ?)";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idUsuario);	
				$stm->bindparam(2,$this->idServicio);
				$stm->bindparam(3,$this->valor);
				if($stm->execute()){
					return true;
				}else{
					return false;
				}
			} catch (Exception $e) {
				echo "Error: ".$e;
			}		    
		}

		public function quitar(){
			$this->sql = "UPDATE proveedorservicios SET activo = 2 WHERE idProveedor = ? AND id = ?";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idUsuario);	
				$stm->bindparam(2,$this->idServicio);
				if($stm->execute()){
					return true;
				}else{
					return false;
				}
			} catch (Exception $e) {
				echo "Error: ".$e;
			}		    
		}

		public function cargarDisponibilidadDias($dia){
			$estado = false;
			$this->sql = "SELECT * FROM disponibilidad_dias WHERE idProveedor = ? AND Dias = ? AND estado = 1";  
		    try {
		    	$stm = $this->Conexion->prepare($this->sql);
		    	$stm->bindparam(1,$this->idUsuario);
		    	$stm->bindparam(2,$dia);
		    	$stm->execute();
		    	$data = $stm->fetchAll(PDO::FETCH_ASSOC);
		    	foreach ($data as $value) {
		    		$estado = true;
		    	}
		    	return $estado;
		    } catch (PDOException $e) {
		    	echo "Error: ".$e;
		    }
		}

		public function cargarDisponibilidadHoras($hora){
			$estado = false;
			$this->sql = "SELECT * FROM disponibilidad_horas WHERE idProveedor = ? AND Hora = ? AND estado = 1";  
		    try {
		    	$stm = $this->Conexion->prepare($this->sql);
		    	$stm->bindparam(1,$this->idUsuario);
		    	$stm->bindparam(2,$hora);
		    	$stm->execute();
		    	$data = $stm->fetchAll(PDO::FETCH_ASSOC);
		    	foreach ($data as $value) {
		    		$estado = true;
		    	}
		    	return $estado;
		    } catch (PDOException $e) {
		    	echo "Error: ".$e;
		    }
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

		public function quitarMunicipio(){
			$sqlLista = mysql_query(";");
			$this->sql = "UPDATE rango_Accion_Servicios SET estado = '2' WHERE `idProveedor`= ? AND idMunicipio = ?";
		    try {
		    	$stm = $this->Conexion->prepare($this->sql);
		    	$stm->bindparam(1,$this->idUsuario);
		    	$stm->bindparam(2,$this->idCiudad);
		    	$stm->execute();
		    } catch (Exception $e) {
		    	echo "Error: ".$e;
		    }
		}

		public function ponerMunicipio(){			
			$this->sql = "INSERT INTO rango_Accion_Servicios(idProveedor,idMunicipio) VALUES (?, ?)";
		    try {
		    	$stm = $this->Conexion->prepare($this->sql);
		    	$stm->bindparam(1,$this->idUsuario);
		    	$stm->bindparam(2,$this->idCiudad);
		    	$stm->execute();
		    } catch (Exception $e) {
		    	echo "Error: ".$e;
		    }
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