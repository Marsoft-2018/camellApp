 <?php 
  	class Categoria extends Conectar{
	  	public $sqlCategoria;
	  	public  function NuevaCategoria(){
	  		echo "<div class='col-md-4'>";
				echo "	<label for=''>Nombre Categoria:</label>";
				echo "	<input type='text' id='nomCategoria' class='form form-control' value='' placeholder='Nombre de la Categoria'>";
				echo "</div>";
			
				echo "<div class='col-md-2'>";
				echo "	<br>";
				echo "	<button class='btn btn-primary' onclick='agregarCategoria()'><i class='fa fa-plus'> </i>Agregar</button>";
				echo "</div>";
				echo "<div class='col-md-2'>";
				echo "	<br>";
				echo "	<button class='btn btn-success' onclick='listarCategoria()'><i class='fa fa-eye'> </i>Ver Lista</button>";
				echo "</div>";
	  	}

	  	public function cargarLista(){
			$this->sqlCategoria=mysql_query("SELECT `id`,`nombre` FROM `categorias` WHERE `activo` =1 ORDER BY `nombre`");
			$res=mysql_num_rows($this->sqlCategoria);	
			echo "<label>Categoria del servicio</label>";
			echo "<select name='categorias' class='form-control' id='categoriaServicio' onchange='buscarServicios(this.value)'>";
			echo	"<option value=''>Seleccione...</option>";				
			if($res>0){
				while($rs=mysql_fetch_array($this->sqlCategoria)){
					echo "<option value='$rs[0]'>".utf8_encode($rs[1])."</option>";
				}
			}
			echo "</select>";
		}

 		// agregar categoria
        public function agregarCategoria($nombre){
			$sqlAdd=mysql_query("INSERT INTO categorias(`nombre`,`fechaReg`) VALUES('$nombre','".date()."');");
		}

		public function editarCategoria($idCategoria){
			$sqlLista=mysql_query("SELECT `id`,`nombreCategoria` FROM categorias WHERE `id`='$idCategoria' ");
			while($dS=mysql_fetch_array($sqlLista)){
				echo "<div class='col-md-4'>";
				echo "	<label for=''>Nombre Categoria:</label>";
				echo "	<input type='text' name='nombre' id='$idCategoria' class='form form-control' value='$dS[1]' placeholder='Nombre de la Categoria' onchange='modificarCategoria(this.name,this.id,this.value)'>";
				echo "</div>";
			
				echo "<div class='col-md-2'>";
				echo "	<br>";
				echo "	<button class='btn btn-success' onclick='nuevaCategoria()'><i class='fa fa-check'> </i>Listo</button>";
				echo "</div>";	
				echo "<div id='resultadoEdicion'></div>";	
			}	
		}


		public function modificarCategoria($campo,$clave,$valor){
			$sqlMod=mysql_query("UPDATE categorias SET `$campo`='$valor' WHERE `id`='$clave'");			
		}

		public function eliminarCategoria($idCategoria){
			$sqlDel=mysql_query("UPDATE categorias SET activo =0 WHERE `id`='$idCategoria';");
			echo "<script>alertify.success('Categoria eliminada con éxito'); </script>";
			$this->cargarLista();
		}
	}
 ?>