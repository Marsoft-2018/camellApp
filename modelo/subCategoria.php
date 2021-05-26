<?php 
	class subCategoria extends Conectar{
		private $sqlCategoria;
		public function NuevaSubCategoria(){
			echo "<div class='col-md-4'>";
			echo "	<label for=''>Nombre Sub Categoria:</label>";
			echo "	<input type='text' id='nomSubCategoria' class='form form-control' value='' placeholder='SubCategoria'>";
			echo "</div>";
			echo "<div class='col-md-2'>";
			echo 	"<label for=''>Categoria:</label>";

			$sqlCategoria=mysql_query("SELECT nombre  FROM subcategoria  WHERE activo = 1 ORDER BY  nombre ASC ;");
			echo 	"<select id='idCategoria' class='form form-control'>";
			echo  		"<option value=''>Seleccione...</option>";
						while($nv=mysql_fetch_array($sqlCategoria)){
							echo "<option value='$nv[0]' >".utf8_encode($nv[1])."</option>";
						}			
			echo 	"</select>";
			echo "</div>";
			
			echo "<div class='col-md-3' style='padding:25px;'>";
			//echo "	<br>";
			echo "	<button class='btn btn-primary' onclick='agregarSubCategoria()' style='width:100px;'><i class='fa fa-plus'> </i> Agregar</button>";
			//echo "	<br>";
			echo "	<button class='btn btn-success' onclick='listarSubCategoria()' style='margin-left:5px;width:100px;'><i class='fa fa-eye'> </i> Ver Lista</button>";
			echo "</div>";
		}

		public function cargarCombo($idCategoria){
			$this->sqlCategoria = mysql_query("SELECT `id`, `nombre` FROM `subcategoria` WHERE `idcategoria` = '$idCategoria' AND `activo` = 1;");
			$res=mysql_num_rows($this->sqlCategoria);	
			if($res>0){
				echo "<label>Sub Categoria del servicio</label>";
				echo "<select name='categorias' class='form-control' id='subCategoriaServicio' onchange='buscarServicios(this.value)'>";
				echo	"<option value=''>Seleccione...</option>";			
					while($rs=mysql_fetch_array($this->sqlCategoria)){
						echo "<option value='$rs[0]'>".$rs[1]."</option>";
					}
				echo "</select>";
			}
		}

	 	// cargar lista de subcategorias
	 	public function cargarLista($idCategoria){
			$sqlLista=mysql_query("SELECT `id`, `nombre` FROM `subcategoria` WHERE `idcategoria` = '$idCategoria' AND `activo` = 1;");
			$res=mysql_num_rows($sqlLista);
			echo "<table class='table table-striped'>";
			echo 	"<thead>";
			echo	  "<tr>";
			echo		"<th>ID</th>";
			echo		"<th>Subcategoria</th>";
			echo		"<th>Categoria</th>";
			
			echo		"<th colspan='3'>Accion</th>";
			echo	  "</tr>";
			echo    "</thead>";
			echo    "<tbody>";
			if($res>0){
				while($rs=mysql_fetch_array($sqlLista)){
					echo "<tr>";
					echo "<td>".$rs[0]."</td>";
					echo "<td>".$rs[1]."</td>";
					echo "<td>".utf8_encode($rs[2])."</td>";
					
					echo "<td><button class='btn btn-warning' id='$rs[0]' title='Editar' onclick='editarSubCategoria(this.id)'><i class='fa fa-gears'> </i></button> </td>";
					echo "<td><button class='btn btn-danger' id='$rs[0]' title='Eliminar' onclick='eliminarSubCategoria(this.id)'><i class='fa fa-trash'> </i></button> </td>";
					echo "</tr>";
				}
			}else{
				echo "<tr>";
				echo 	"<td colspan='6' style='text-align:center;'>";
				echo 		"<div class='alert alert-warning' >No existen Categorias almacenados en este momento</div>";
				echo 	"</td>";
				echo "</tr>";

			}
			echo 	"</tbody>";
			echo "</table>";
		}



			// insertar subcategoria
		public function agregarSubCategoria($nombre,$idCategoria){
			$sqlAdd=mysql_query("INSERT INTO subCategoria(`nombre`,`idcategoria`) VALUES('$nombre','$idCategoria');");
		}

		// editar subcategoria
		public function modificarPrograma($campo,$clave,$valor){			
			$sqlMod=mysql_query("UPDATE subcategoria SET `$campo`='$valor' WHERE `id`='$clave';");			
		}

		public function eliminarPrograma($idsubcategoria){
			$sqlDel=mysql_query("UPDATE   subcategoria set  activo =0 WHERE `id`='$idsubcategoria';");
			echo "<script>alertify.success('Programa eliminado con éxito'); </script>";
			$this->cargarLista();
		}



	}
 ?>