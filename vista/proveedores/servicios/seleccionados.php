<table>
    <thead>
      <tr>
        <th scope='col'>Categoria</th>
       <th scope='col'>ID</th>
        <th scope='col'>Servicios</th>
       <th scope='col' >Seleccione</th>
     </tr>
    </thead>
    <tbody>
    <?php 
    	foreach ($objSerProveedor->consultaServicios() as $value) {
    ?>
		<tr>
			<td><p><?php echo  ucwords(utf8_encode($value['categoria'])) ?></p></td>
  			<td><?php  echo $value['idServicio'] ?></td>
  			<td><p><?php echo ucwords(utf8_encode($value['servicio'])) ?>.</p></td>
      		<td><input type="checkbox" name="valorServicio" id="valorServicio	<?php echo $value['idServicio'] ?>	" class="form form-control" value="<?php echo $value['idCategoria'] ?>" ></td>
		</tr>
    <?php 
    	}
    ?>
 	</tbody>
</table>