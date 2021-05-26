<?php 
	 class tipoAgenda extends Conectar{
	 	public  function NuevoTipoAgenda(){
  		echo "<div class='col-md-4'>";
			echo "	<label for=''>Tipo Agenda:</label>";
			echo "	<input type='text' id='nomTipoAgenda' class='form form-control' value='' placeholder='Tipo Agenda'>";
			echo "</div>";
		
			echo "<div class='col-md-2'>";
			echo "	<br>";
			echo "	<button class='btn btn-primary' onclick='agregarAgenda()'>
						<i class='fa fa-plus'> </i>Agregar
					</button>";
			echo "</div>";
			echo "<div class='col-md-2'>";
			echo "	<br>";
			echo "	<button class='btn btn-success' onclick='listarAgenda()'><i class='fa fa-eye'> </i>Ver Lista</button>";
			echo "</div>";
  		}


  		public function cargarLista(){
			$sqlLista=mysql_query("SELECT `id`,`nombre` FROM `tipoAgenda` WHERE `activo` =1");
			$res=mysql_num_rows($sqlLista);	
			echo "<label>Tipo Agenda</label>";
			echo "<select name='tipoAgenda' id='tipoAgenda' class='form-control'>";	
			echo "<option value=''>Seleccione...</option>";	
			if($res>0){
				while($rs=mysql_fetch_array($sqlLista)){
					echo "<option value='$rs[0]'>".$rs[1]."</option>";
				}
			}else{

			}
			echo "</select>";
		}


		//agregar un nuevo tipo agenda
		 public function agregarAgenda($nombre){
			$sqlAdd=mysql_query("INSERT INTO tipoAgenda(`nombre`,`fechaReg`) VALUES('$nombre','".date()."');");
		}


		public function editarAgenda($idTipoAgenda){
			$sqlLista=mysql_query("SELECT `id`,`nombre` FROM tipoAgenda WHERE `id`='$idTipoAgenda' ");
			while($dS=mysql_fetch_array($sqlLista)){
				echo "<div class='col-md-4'>";
				echo "	<label for=''>Tipo Agenda:</label>";
				echo "	<input type='text' name='nombre' id='$idTipoAgenda' class='form form-control' value='$dS[1]' placeholder='Nombre Tipo Agenda' onchange='modificarTipoAgenda(this.name,this.id,this.value)'>";
				echo "</div>";
			
				echo "<div class='col-md-2'>";
				echo "	<br>";
				echo "	<button class='btn btn-success' onclick='nuevoTipoAgenda()'><i class='fa fa-check'> </i>Listo</button>";
				echo "</div>";	
				echo "<div id='resultadoEdicion'></div>";	
			}	
		}


		public function modificarTipoAgenda($campo,$clave,$valor){
			$sqlMod=mysql_query("UPDATE tipoAgenda SET `$campo`='$valor' WHERE `id`='$clave'");			
		}


		public function eliminarTipoAgenda($idTipoAgenda){
			$sqlDel=mysql_query("UPDATE tipoAgenda SET activo =0 WHERE `id`='$idTipoAgenda';");
			echo "<script>alertify.success('Tipo Agenda eliminada con éxito'); </script>";
			$this->cargarLista();
		}


	 }
 ?>