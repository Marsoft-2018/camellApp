 <?php 
  	class Combo extends Conectar{
  		private $consulta;
  		public function llenar($tabla, $condicion){	        
	        
            $this->consulta = "SELECT Id, nombre FROM ".$tabla." WHERE Activo = 1 ";
            if($condicion != null){ $this->consulta = $this->consulta." AND ".$condicion; }
            $this->consulta = $this->consulta." ORDER BY nombre ASC";
            $rows = array();
            $this->consulta = mysql_query($this->consulta)or die("Ocurrio un ERROR: " . mysql_error());
            $rows = mysql_fetch_array($this->consulta);
	        
	        return json_encode($rows);
	    }
  	}
?>