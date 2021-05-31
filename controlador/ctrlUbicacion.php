<?php 
	require "../modelo/Conexion.php";
	require "../modelo/buscarUbicacion.php";
	require "../modelo/ubicacion.php";

	$accion = 0;


	if(isset($_GET['accion'])){
		$accion = $_GET['accion'];
	}else if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}

	if($accion=='cargarPaises'){
		$idContinente=$_POST["idContinente"];
		$objPais = new ubicacion();
        $objPais->comboPais($idContinente);
	}
	elseif($accion == 'cargarDepartamentos'){
		$idPais = $_POST["idPais"];
		$objDepartamento = new ubicacion();
        $objDepartamento->comboDepartamento($idPais);
	}
	elseif($accion == 'cargarCiudades'){
		$obj = new buscarUbicacion();
		$obj->idDepartamento = $_POST["idDepartamento"];
        echo json_encode($obj->ciudades());
        
	}elseif($accion == 'cargarUbicacion'){
		$objUbicacion = new buscarUbicacion();
		$objUbicacion->Cargar($_POST["palabra"]);
	}

?>