<?php 
	class Perfil extends Conectar{
		public $tabla;
		public $usuario;
		public $nombre;
		private $sql;
		public function cargarNombre(){
            $this->sql = "SELECT nombres, apellidos FROM ".$this->tabla." WHERE usuario= ? AND activo='1'"; 
            try {
				$this->nombre = "Dato no encontrado";
			   	$stm = $this->Conexion->prepare($this->sql);
			   	$stm->bindparam(1,$this->usuario);
			   	$stm->execute();
			   	$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($datos as $value) {
					$this->nombre = $value['nombres']." ".$value['apellidos'];
				}
		    } catch (PDOException $e) {
				$this->nombre = "Dato no encontrado";
		    }           
        	
			return $this->nombre;            
        }

        public function cargarDatos($usuario){		
			$sqlBuscar = mysql_query("SELECT * FROM ".$this->tabla." WHERE `usuario` = '$usuario';");
			//echo "<script>alertify.success('Llego el dato del proveedor al modelo id: $idProveedor; hasta aquí no sé que pasa si sigue mostrando el listado');</script>";
			while($row = mysql_fetch_array($sqlBuscar)){	
				echo "<div class='row'>";
	            echo "    <div class='col-md-2'><label>Nit/Documento</label><input type='text' class='form form-control' id='documento' value='$row[0]'></div>";
	            echo "    <div class='col-md-4'><label>Nombre</label><input type='text' class='form form-control' id='nombre' value='$row[1]'></div>";            
	            echo "    <div class='col-md-4'><label>Dirección</label><input type='text' class='form form-control' id='dir' value='$row[2]'></div>";
	            echo "    <div class='col-md-2'><label>Teléfono</label><input type='text' class='form form-control' id='tel' value='$row[3]'></div>";
	            echo "</div>";
	            echo "<div class='row'>";
	            echo "    <div class='col-md-3'><label>Ciudad</label><input type='text' class='form form-control' id='ciudad' value='$row[4]'></div>";
	            echo "    <div class='col-md-3'><label>Correo</label><input type='text' class='form form-control' id='correo' value='$row[5]'></div>";	            
			}
            echo "    <div class='col-md-3'>";
            echo "		  <br>";
            echo "        <button class='btn btn-success' id='$usuario' name='".$this->tabla."' style='width: 100%;' onclick='actualizarPersona(this.id,this.name)'>";
            echo "            <i class='fa fa-check'> </i> Listo";
            echo "        </button> ";                       
            echo "    </div>";
            echo "    <div class='col-md-3'>
						<br>";
            echo "        <button class='btn btn-warning' name='".$this->tabla."' style='width: 100%;' onclick='cargarNuevoPersona()'>";
            echo "            <i class='fa fa-check'> </i> Cancelar";
            echo "        </button> ";
            echo 	  "</div>";
            
            echo "</div> "; 
		}
	}

?>