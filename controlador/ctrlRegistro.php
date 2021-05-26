<?php 
   require "../modelo/Conexion.php";
	require "../modelo/registro.php";

	$accion = 0;


	if(isset($_GET['accion'])){
		$accion = $_GET['accion'];
	}else if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}

	if($accion=='iniciarRegistro'){
		include("../vista/registroPaso1.php");
	}

	elseif($accion=='pasarUsuario'){
		$correo=$_POST["correo"];
		$contrasenha=$_POST["contrasenha"];
		$objUsuario = new registro();
        $objUsuario->paso2($correo,$contrasenha);
	}

	elseif($accion=='cargarDepartamentos'){
		$idPais=$_POST["idPais"];
		$objDepartamento = new ubicacion();
        $objDepartamento->comboDepartamento($idPais);
	}

	elseif($accion=='cargarCiudades'){
		$idDepartamento=$_POST["idDepartamento"];
		$objCiudad = new ubicacion();
        $objCiudad->comboCiudad($idDepartamento);
	}

	elseif($accion=='addRegistro'){
		$tipo = $_POST['tipo'];
		$correo = $_POST['correo'];
		$contrasena = $_POST['contrasena'];
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];
		$municipio = $_POST['municipio'];
		$fechaNac = $_POST['fechaNac'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];

		$objUsuario = new registro();
        $objUsuario->agregar($tipo,$correo,$contrasena,$nombres,$apellidos,$direccion,$telefono,$municipio,$fechaNac,$lat,$lng);
	}

?>