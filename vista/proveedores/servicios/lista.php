<?php 
	$objServicio = new  Servicio();
	$objServicio->idUsuario = $_SESSION['usuario'];
   	//$resul = array();
?>
<h3> LISTA DE SERVICIOS AGREGADOS </h3>
<table class='table table-striped'>
    <thead>
      <tr>
       <th scope='col'>ID</th>
        <th scope='col'>Categoria</th>
        <th scope='col'>Servicios</th>
      <th scope='col'>Valor</th>
       <th scope='col' colspan='3'>Accion</th>
     </tr>
    </thead>
    <tbody>
    <?php 
    	foreach ($objServicio->lista() as $value) {
    ?>
    	<tr>
  			<td>
  				<?php echo $value['id'] ?>
  			</td>
  			<td>
  				<p><?php echo strtoupper($value['categoria']) ?></p>
  			</td>
  			<td>
  				<p><?php echo strtoupper($value['servicio']) ?></p>
  			</td>
      		<td>
      			<input type="number" name="valorServicio" id="valorServicio<?php echo $value['id'] ?>" class="form form-control" value="<?php echo $value['valor'] ?>" placeholder="Valor del Servicio">
      		</td>
		  	<td>
		    	<button class="btn btn-warning"  onclick="modificarServicio(this.id)" id="<?php echo $value['id'] ?>" ><i class="fa fa-pencil" title="Editar"> Cambiar Valor</i></button>		  	
		  	</td>
		  	<td>
		    	<button class="btn btn-danger" onclick="eliminar_servicio(this.id)" id="<?php echo $value['id'] ?>" ><i class="fa fa-trash" title="Eliminar">Eliminar Servicio</i></button>		  
		  	</td>
		</tr>
	<?php 
    	}
    ?>
 	</tbody>
</table>