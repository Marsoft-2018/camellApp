<?php 
	session_start();
  require("../modelo/Conexion.php");
  require("../modelo/servicioProveedor.php");
  require ("../modelo/servicio.php");
  require("../modelo/buscarUbicacion.php");

	$accion = 0;


	if(isset($_GET['accion'])){
		$accion = $_GET['accion'];
	}else if(isset($_POST['accion'])){
		$accion = $_POST['accion'];
	}

	if($accion == 'cargarProveedorServicios'){
		$idServicio = $_POST['idServicio'];
		$objSC = new ServicioProveedor();
		$objSC->cargarProveedores($idServicio);
	}elseif($accion == 'cargarProgramacionServicios'){   
    $usuario  = $_SESSION['usuario'];    
    $objSC = new ServicioProveedor(); 
    $objSC->idUsuario = $usuario;
    $objSC->vistaServiciosP1();
  }elseif($accion == 'cargarListaProveedor'){	
		include '../vista/proveedores/servicios/lista.php';
	}elseif ($accion == 'modificar_servicio') {
		$idServicio =$_POST['id'];
    $valor = $_POST['valor'];
		$objSC = new ServicioProveedor();

		$objSC->modificar($idServicio,$valor);
	}elseif($accion == "guardarServicios"){
    $usuario  = $_POST['idUsuario'];
    $servicios = $_POST['servicios'];
    $municipios = $_POST['municipios'];
    $dias = $_POST['dias'];
    $horas = $_POST['horas'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->guardar($usuario, $servicios, $municipios, $dias, $horas);    
  }elseif($accion == "quitarMunicipio"){
    $obj = new ServicioProveedor();
    $obj->idUsuario = $_SESSION['id'];
    $obj->idCiudad = $_POST['ciudad'];
    $obj->quitarMunicipio();
    include("../vista/proveedores/servicios/ubicacion.php");

  }elseif($accion == "agregarMunicipio"){
    $obj = new ServicioProveedor();
    $obj->idUsuario = $_SESSION['id'];
    $obj->idCiudad = $_POST['ciudad'];
    $obj->ponerMunicipio();
    include("../vista/proveedores/servicios/ubicacion.php");

  }elseif($accion == "quitarDia"){
    $usuario  = $_POST['idUsuario'];
    $dia = $_POST['dia'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->quitarDia($dia);
  }elseif($accion == "colocarDia"){
    $usuario  = $_POST['idUsuario'];
    $dia = $_POST['dia'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->colocarDia($dia);
  }elseif($accion == "quitarHora"){
    $usuario  = $_POST['idUsuario'];
    $hora = $_POST['hora'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->quitarHora($hora);
  }elseif($accion == "colocarHora"){
    $usuario  = $_POST['idUsuario'];
    $hora = $_POST['hora'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->colocarHora($hora);
  }



?>