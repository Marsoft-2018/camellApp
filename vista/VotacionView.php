<?php 
	require("../modelo/Conexion.php");
	require("../modelo/votacion.php");
?>
<div>
	<?php 
		$objVoto -> new Votar();
		$sql = $objVoto->cargar();
		
	?>
</div>