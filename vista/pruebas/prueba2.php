<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Recibir array Ajax</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php 
		//var_dump($_POST['variable']);

		//var_dump($_POST['variable2']);

		$variable = $_POST['variable'];

		$variable2 = $_POST['variable2'];

		foreach ($variable2 as $clave => $value) {
			echo "<br>$variable[$clave] - ".$value;				
		}		
	?>
</body>
</html>