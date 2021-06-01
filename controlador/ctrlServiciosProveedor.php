<?php 
	session_start();

  require ("../modelo/Conexion.php");
  require ("../modelo/categoria.php");
  require ("../modelo/servicio.php");
  require ("../modelo/servicioProveedor.php");
  require ("../modelo/perfil.php");
  require ("../modelo/proveedor.php");
  require ("../modelo/buscarUbicacion.php");

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
    include("../vista/proveedores/servicios/serviciosProveedor.php");
  }elseif($accion == 'cargarServicios'){
      $objSC = new Servicio();
      $objSC->idCategoria = $_POST['idCategoria']; 
      echo json_encode($objSC->listarPorCategoria());

  }elseif($accion == 'cargarTablaServicios'){
      $objSC = new Servicio();
      $objSC->idCategoria = $_POST['idCategoria']; 
      echo json_encode($objSC->listarPorCategoria());

  }elseif($accion == 'cargarListaProveedor'){	
		include '../vista/proveedores/servicios/lista.php';
	}elseif ($accion == 'modificar_servicio') {
		$idServicio =$_POST['id'];
    $valor = $_POST['valor'];
		$objSC = new ServicioProveedor();
		$objSC->modificar($idServicio,$valor);

	}elseif($accion == "guardarServicios"){
    $obj = new ServicioProveedor();
    $obj->idUsuario = $_SESSION['id'];
    $obj->idServicio = $_POST['idServicio'];
    $obj->valor = $_POST['valor'];
    if($obj->guardar()){
      include("../vista/proveedores/servicios/lista.php");
    }

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