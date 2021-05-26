<?php 
	require "../modelo/Conexion.php";
	require "../modelo/registro.php";

	$accion = 0;


	if(isset($_GET['accion'])){
		$accion = $_GET['accion'];
	}else if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}

	if($accion == 'editarPerfil' && $tipoUsuario == "cliente"){
		include("../vista/editarPerfilCliente.php");
	}
 ?>