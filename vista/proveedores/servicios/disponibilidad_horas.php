<h2>3.) Horario en el que estarás disponible</h2> 
<div class='col-md-12 about-grid-pic' style="padding:40px 20px;">
<div class="row">
	<div class="col-md-12">
		<h2>Días</h2>							
		<div class="panel">
		 	<table class="table">
		 		<thead>
		 			<tr >
		 				<?php
		 					foreach ($objSerProveedor->dias as $d) {
		 						echo "<th style='text-align:center;'>$d</th>";
		 					}
		 				?>
		 			</tr>
		 		</thead>
		 		<tbody>
					<tr>
						<?php
		 					foreach ($objSerProveedor->dias as $d) {
		 						echo "<td style='text-align:center;'>".
		 							"<span id='dia".$d."'>";
	 							$objDia = new ServicioProveedor();
	 							$objDia->idUsuario = $_SESSION['id'];

	 							$sqlDia = $objDia->cargarDisponibilidadDias($d);
		 						if($sqlDia){
		 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '"."' value='".$d."' onclick='quitarDia(this.id,this.value)' checked>";
		 						}else{
		 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '"."'  value='".$d."' onclick='colocarDia(this.id,this.value)'>";
		 						}
		 						echo 	"</span>";  		
		 						echo "</td>";
		 					}
		 				?>
					</tr>
				</tbody>
		 	</table>
		</div> 								
	</div>
</div>
<div class="row">
	<div class="col-md-12" >
		<h2>Horas</h2>							
		<div class="panel" style="overflow: auto;" id='panelHorario' >
		 	<table class="table">
		 		<thead>
		 			<tr >
		 				<th></th>
		 				<?php
		 					for($i = 1; $i <= 12; $i++) {
		 						echo "<th style='text-align:center;'>$i:00</th>";
		 					}
		 				?>
		 			</tr>
		 		</thead>
		 		<tbody>
					<tr>
						<td>A.M</td>
						<?php
		 					for($i = 1;$i <= 12;$i++) {
		 						echo "<td style='text-align:center;'>".
		 							"<span id='hora".$i."'>";
		 						$objHora = new ServicioProveedor();
	 							$objHora->idUsuario = $_SESSION['id'];

	 							$sqlHora = $objHora->cargarDisponibilidadDias($i);
		 						if($sqlHora){
		 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '"."' value='$i' onclick='quitarHora(this.id,this.value)' checked>";
		 						}else{
		 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '"."'  value='$i' onclick='colocarHora(this.id,this.value)'>";
		 						}
		 						echo 	"</span>";  		
		 						echo "</td>"; 						
		 					}
		 				?>
					</tr>
					<tr>
						<td>P.M</td>
						<?php
		 					for($i = 13;$i <= 24;$i++) {
		 						echo "<td style='text-align:center;'>".
		 							"<span id='hora".$i."'>";
		 						$objHora = new ServicioProveedor();
	 							$objHora->idUsuario = $_SESSION['id'];

	 							$sqlHora = $objHora->cargarDisponibilidadHoras($i.":00");
		 						if($sqlHora){
		 							echo "<input type='checkbox' class='form form-control' name='diaSel'  id = '"."' value='$i' onclick='quitarHora(this.id,this.value)' checked>";
		 						}else{
		 							echo "<input type='checkbox' class='form form-control' name='diaSel' id = '"."'  value='$i' onclick='colocarHora(this.id,this.value)'>";
		 						}
		 						echo 	"</span>";  		
		 						echo "</td>";
		 					}
		 				?>
					</tr>
				</tbody>
		 	</table>
		</div> 								
	</div>
</div>
</div>