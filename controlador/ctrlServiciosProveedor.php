<?php 
	require("../Modelo/conexion.php");
  require("../Modelo/servicioProveedor.php");
  require ("../modelo/servicio.php");

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
    $usuario  = $_POST['idUsuario'];    
    $objSC = new ServicioProveedor(); 
    $objSC->idUsuario = $usuario;
    $objSC->vistaServiciosP1();
  }elseif($accion == 'cargarListaProveedor'){	
		$idUsuario = $_POST['idUsuario'];
		$objServicio = new  Servicio();
		$res =	$objServicio->lista($idUsuario);
     
   	$resul = array();
   	$cont = 0; 
   	echo "<h3> LISTA DE SUS SERVICIOS </h3>".
   	"<table class='table'>".
	    "<thead>".
	      "<tr>".
	       "<th scope='col'>ID</th>".
	        "<th scope='col'>Categoria</th>".
	        "<th scope='col'>Servicios</th>".
          "<th scope='col'>Valor</th>".
	       "<th scope='col' colspan='3'>Accion</th>".
	     "</tr>".
	    "</thead>".
	    "<tbody>";

     	while ($r = mysql_fetch_array($res)) {
    		echo "<tr>";
      		echo "<td>".$r[0]."</td>";
      		echo "<td><p>".strtoupper($r[1])."</p></td>";
      		echo "<td><p>".strtoupper(utf8_encode($r[2]))."</p></td>";
          echo "<td><input type='number' name='valorServicio' id='valorServicio$r[0]' class='form form-control' value='".$r[3]."' placeholder='Valor del Servicio'></td>";
    		  echo "<td>";
    		    echo 	"<button class='btn btn-warning'  onclick='modificarServicio(this.id)' id='$r[0]' ><i class='fa fa-pencil' title='Editar'> Cambiar Valor</i></button>";
    		  echo "</td>";
    		  echo "<td>";
    		    echo 	"<button class='btn btn-danger' onclick='eliminar_servicio(this.id)' id='$r[0]' ><i class='fa fa-trash' title='Eliminar'>Eliminar Servicio</i></button>";
    		  echo "</td>";
    		echo "</tr>";
    	}

     	echo "</tbody>";
      echo "</table>";
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
    $usuario  = $_POST['idUsuario'];
    $municipios = $_POST['municipios'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->quitarMunicipio($usuario, $municipios);
  }elseif($accion == "ponerMunicipio"){
    $usuario  = $_POST['idUsuario'];
    $municipios = $_POST['municipios'];

    $obj = new ServicioProveedor();
    $obj->idUsuario = $usuario;
    $obj->ponerMunicipio($usuario, $municipios);
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