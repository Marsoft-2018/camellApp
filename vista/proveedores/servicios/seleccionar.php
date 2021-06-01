<table class="table table-striped">
    <thead>
      <tr>
        <th scope='col'>Categoria</th>
        <th scope='col'>Tipo Servicios</th>
        <th scope='col' >Seleccione</th>
     </tr>
    </thead>
    <tbody>
    <?php 
    	foreach ($objSerProveedor->consultaServicios() as $value) {
    ?>
		<tr>
			<td>
        <?php echo  ucwords(utf8_encode($value['categoria'])) ?>
      </td>
  		<td>
        <?php echo ucwords(utf8_encode($value['servicio'])) ?>
      </td>
      <td>
        <input type="checkbox" name="valorServicio" id="valorServicio	<?php echo $value['idServicio'] ?>	" class="form form-control" value="<?php echo $value['idCategoria'] ?>" >
      </td>
		</tr>
    <?php 
    	}
    ?>
 	</tbody>
</table>