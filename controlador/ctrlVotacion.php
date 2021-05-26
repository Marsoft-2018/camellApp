<?php 
	require("../modelo/Conexion.php");
	require("../modelo/votacion.php");
	$accion = $_POST["accion"];
	if($accion =="CargarOpiniones"){
		$tipoVoto = $_POST["voto"];
		$usuario = $_POST["usuario"];
		$tUsuario = $_POST["tUsuario"];		
		include("../vista/blog.php");

	}

?>