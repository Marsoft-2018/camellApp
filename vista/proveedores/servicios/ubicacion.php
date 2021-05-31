<?php 
	$objLugaresServicio = new  buscarUbicacion();
	$objLugaresServicio->idUsuario = $_SESSION['id'];
   	//$resul = array();
?>
<h3> LUGARES SELECCIONADOS </h3>
<table class='table table-striped'>
    <thead>
      <tr>
       <th scope='col'>DEPARTAMENTO</th>
        <th scope='col'>CIUDAD/MUNICIPIO</th>
       <th scope='col' colspan='3'>Accion</th>
     </tr>
    </thead>
    <tbody>
    <?php 
    	foreach ($objLugaresServicio->cargarLugares() as $value) {
    ?>
    	<tr>
  			<td>
  				<?php echo $value['departamento'] ?>
  			</td>
  			<td>
  				<p><?php echo strtoupper($value['municipio']) ?></p>
  			</td>
		  	<td>
		    	<button class="btn btn-danger" onclick="quitarMunicipioSeleccionado('<?php echo $value['idMunicipio'] ?>')"><i class="fa fa-trash" title="Eliminar">Eliminar</i></button>		  
		  	</td>
		</tr>
	<?php 
    	}
    ?>
 	</tbody>
</table>