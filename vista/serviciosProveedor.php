<?php 
	$datos = $_POST['datos'];

	var_dump($datos);
?>

<div class="panel panel-primary">
	<div class="panel-heading" style='padding: 2px;'>
		<h2 style='margin: 2px;margin-left: 20px;'>
			Servicios del Proveedor
		</h2>
	</div>	

	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Categoria</th>
      <th scope="col">Servicios</th>
      <th scope="col" colspan="3">Accion</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  		foreach ($datos as $key) {
  			echo "<tr><td>".$key."</td><td>".$key."</td><td>".$key."</td></tr>";
  		}/*
  		for($i = 0; $i < sizeof($datos);$i++) {
  			echo "<tr><td>".$datos["id"]."</td><td>".$datos["categoria"]."</td><td>".$datos["servicio"]."</td></tr>";
  		}*/
  	?>   
  </tbody>
</table>
	
</div>