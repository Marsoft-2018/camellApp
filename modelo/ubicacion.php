<?php 
	//namespace modelo;

	class Ubicacion extends Conectar{
		private $sqlConsultar;
		public function Continente(){
			$this->sqlConsultar=mysql_query("SELECT * FROM continentes WHERE activo='1'");
			return $this->sqlConsultar;
		}

		public function Pais($idContinente){
			$this->sqlConsultar=mysql_query("SELECT * FROM paises WHERE idContinente='$idContinente' AND activo=1");
			return $this->sqlConsultar;
		}

		public function Departamento($idPais){
			$this->sqlConsultar=mysql_query("SELECT * FROM departamentos WHERE idPais='$idPais' AND activo=1");
			return $this->sqlConsultar;
		}

		public function Ciudad($idDpto){
			$this->sqlConsultar=mysql_query("SELECT * FROM municipios WHERE idDepto='$idDpto' AND activo=1");
			return $this->sqlConsultar;
		}

		public function comboPais($idContinente){
			echo "<label>País</label>";
			$sqlPais = $this->Pais($idContinente);
			echo "<select name='pais' id='pais' class='form-control' onchange='cargarDepartamentos(this.value)'>";
			echo "<option value=''>Seleccione...</option>";
			while($pa=mysql_fetch_array($sqlPais )){
				echo "<option value='$pa[1]'>$pa[2]</option>";
			}
			echo "</select>";
		}

		public function comboDepartamento($idPais){
			echo "<label>Departamento</label>";
			$sqlDepartamento = $this->Departamento($idPais);
			echo "<select name='departamento' id='departamento' class='form-control' onchange='cargarCiudad(this.value)'>";
			echo "<option value=''>Seleccione...</option>";
			while($dpt=mysql_fetch_array($sqlDepartamento )){
				echo "<option value='$dpt[1]'>$dpt[2]</option>";
			}
			echo "</select>";
		}

		public function comboCiudad($idDepartamento){
			echo "<label>Ciudad</label>";
			$sqlCiudad = $this->Ciudad($idDepartamento);
			echo "<select name='ciudad' id='ciudad' class='form-control' onchange='cargarDireccion()'>";
			echo "<option value=''>Seleccione...</option>";
			while($ciu=mysql_fetch_array($sqlCiudad )){
				echo "<option value='$ciu[1]'>$ciu[2]</option>";
			}
			echo "</select>";
		}

		public function miUbicacion($usuario,$tipo){

			if($tipo == 1){
				$sqlUsu = mysql_query("SELECT id FROM clientes WHERE  usuario = '$usuario' AND `activo` = 1;");
				$res = mysql_num_rows($sqlUsu);
				if($res > 0){
					while($rs = mysql_fetch_array($sqlUsu)){
						$this->sqlConsultar=mysql_query("SELECT lc.*  FROM localizacionclientes lc WHERE lc.`idCliente` = $rs[0] AND `activo` = 1;");
					}					
				}
			}elseif($tipo == 2){
				$sqlUsu = mysql_query("SELECT id FROM proveedores WHERE usuario = '$usuario' AND `activo` = 1;");
				$res = mysql_num_rows($sqlUsu);
				if($res > 0){
					while($rs = mysql_fetch_array($sqlUsu)){
						$this->sqlConsultar=mysql_query("SELECT lc.*  FROM localizacionproveedores lc WHERE lc.`idProveedor` = $rs[0] AND `activo` = 1;");
					}					
				}
			}
			return $this->sqlConsultar;
		}
	}

?>