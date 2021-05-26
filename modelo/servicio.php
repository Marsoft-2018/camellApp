<?php 
	class Servicio extends Conectar{
		private $sqlServicio;
		public function cargar($categoria){
			$this->sqlServicio = mysql_query("SELECT * FROM servicios WHERE idcategoria = '$categoria' AND `activo` = 1;");
			return $this->sqlServicio;
		}

		public function cargarCombo($categoria){
			$this->sqlServicio = mysql_query("SELECT * FROM servicios WHERE idcategoria = '$categoria' AND `activo` = 1;");
			$res=mysql_num_rows($this->sqlServicio);	
			echo "<label>Servicios</label>";
			echo "<select name='servicios' class='form-control' id='idServicio' >";
			echo	"<option value=''>Seleccione...</option>";				
			if($res>0){
				while($rs=mysql_fetch_array($this->sqlServicio)){
					echo "<option value='$rs[2]'>".utf8_encode($rs[3])."</option>";
				}
			}
			echo "</select>";
		}

		public function agregar($idCategoria,$nombre){
			$sqlAdd=mysql_query("INSERT INTO servicios(`idCategoria`,`nombre`) VALUES('$idCategoria','$nombre');");
		}
		
		public function editar($id){
			$sqlLista=mysql_query("SELECT `id`,`nombre` FROM servicios WHERE `id`='$id' ");
			while($dS=mysql_fetch_array($sqlLista)){
				echo "<div class='col-md-4'>";
				echo "	<label for=''>Nombre Servicio:</label>";
				echo "	<input type='text' name='nombreServicio' id='$id' class='form form-control' value='$dS[1]' placeholder='Nombre del Servicio' onchange='modificarServicio(this.name,this.id,this.value)'>";
				echo "</div>";
			
				echo "<div class='col-md-2'>";
				echo "	<br>";
				echo "	<button class='btn btn-success' onclick='nuevaServicio()'><i class='fa fa-check'> </i>Listo</button>";
				echo "</div>";	
				echo "<div id='resultadoEdicion'></div>";	
			}	
		}


		public function modificar($campo,$clave,$valor){
			$sqlMod=mysql_query("UPDATE servicios SET `$campo`='$valor' WHERE `id`='$clave'");			
		}

		public function eliminar($id){
			$sqlDel=mysql_query("UPDATE servicios SET activo =0 WHERE `id`='$id';");
			echo "<script>alertify.success('Servicio eliminado con éxito'); </script>";
			$this->cargarLista();
		}


		public  function lista($id) {
			$this->sqlServicio=mysql_query("SELECT  id  FROM proveedores WHERE  usuario  = '$id'");


			while($res=mysql_fetch_array($this->sqlServicio)) {
				$id = $res[0];
		 	}

		 	$this->sqlServicio = mysql_query("SELECT  proveedorservicios.`id`,  categorias.`nombre` as 'categoria',  servicios.`nombre` as 'servicio', proveedorservicios.`valor` as 'valor'  FROM proveedorservicios INNER JOIN `servicios` ON (`proveedorservicios`.`idServicio` = `servicios`.`id`) INNER JOIN `categorias`  ON categorias.`id` = servicios.`idcategoria` WHERE proveedorservicios.`idProveedor`='$id';");

		 
           return $this->sqlServicio;
 
		}
	}

?>