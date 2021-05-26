<?php 
    //require "Conexion.php";
	class buscarUbicacion extends ConectarPDO{
		public $idPais;
		public $idDepartamento;
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
			$this->sql = "SELEC * FROM paises ORDER BY nombre";
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
			$this->sql = "SELEC * FROM departamentos WHERE idPais = ? ORDER BY nombre";
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
			$this->sql = "SELECT id, nombre FROM municipios WHERE idDepto = ?");
						
			try {
				$stm = $this->Conexion->prepare($this->sql);
				$stm->bindparam(1,$this->idDepartemeno);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				return $datos;
			} catch (Exception $e) {
				echo "Error: ".$e;
			}
		}

		public function ciudadUsuario(){
			$this->sql = "SELEC * FROM departamentos WHERE idPais = ? ORDER BY nombre";
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

	}
?>

