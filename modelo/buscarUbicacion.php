<?php 
    //require "Conexion.php";
	class buscarUbicacion extends Conectar{
		public $idPais;
		public $idDepartamento;
		public $idUsuario;
		public $idCiudad;
		public $letras;
		public $lista;
		private $sql;
		public function cargar($letras){			
			$this->letras = '%'.$letras.'%';
			$this->sql = "SELECT `municipios`.`Id`, `municipios`.`nombre` AS Municipio, `dptos`.`nombre` AS Dpto, `paises`.`nombre` AS Pais FROM `municipios` INNER JOIN departamentos AS `dptos` ON (`municipios`.`idDepto` = `dptos`.`Id`) INNER JOIN `paises` ON (`dptos`.`idPais` = `paises`.`Id`) INNER JOIN `continentes` ON (`paises`.`idContinente` = `continentes`.`Id`) WHERE  `municipios`.`nombre` LIKE ('".$this->letras."') ORDER BY Municipio ASC LIMIT 0, 5;";
            try{
                $stm = $this->Conexion->prepare($this->sql);
                $stm->execute();

                $this->lista = $stm->fetchAll();
                if($this->lista){                	
                    foreach ($this->lista as $registro) {
				     // Colocaremos negrita a los textos
				    	$nombre = $registro['Id']." - ".$registro['Municipio']." - ".$registro['Dpto']." - ".$registro['Pais'];

				     // Aquì, agregaremos opciones
			        echo '<span>'
			            	.'<a href="#mvto">'
				             	.'<li onclick="set_item(\''.$nombre.'\')">'
				             		.'<span>'.$nombre.'</span>'
				             	.'</li>'
				            ."</a>"
				          .'</span>';
				    }
                }
            }catch(PDOException $e){
                echo "Error en la consulta: <br>".$e;
            }
		}

		public function paises(){
			$this->sql = "SELECT * FROM paises ORDER BY nombre";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				return $datos;
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}

		public function departamentos(){
			$this->sql = "SELECT * FROM departamentos WHERE idPais = ? ORDER BY nombre";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idPais);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				return $datos;
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}

		public function ciudades(){
			$this->sql = "SELECT id, nombre FROM municipios WHERE idDepartamento = ?";
						
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idDepartamento);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				return $datos;
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}

		public function ciudadCercanas(){
			$this->sql = "SELECT d.id FROM departamentos d INNER JOIN municipios m ON d.id = m.idDepto WHERE m.id = ?";
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idCiudad);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($datos as $value){
					$this->idDepartamento = $value['id'];
					$this->ciudades();
				}				
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}

		public function cargarLugares(){
			$this->sql = "SELECT d.`nombre` as departamento, ra.idMunicipio , m.`nombre` as municipio FROM rango_accion_servicios ra INNER JOIN municipios m ON m.`id` = ra.`idMunicipio` INNER JOIN departamentos d ON d.`id` = m.`idDepartamento` WHERE ra.idProveedor = ? AND ra.`estado` = '1'";						
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idUsuario);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				return $datos;
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}
	}
?>

