<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vitriservicios</title>
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		 <!-- Custom Theme files -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link href="css/theme-style.css" rel='stylesheet' type='text/css' />
		<link href="css/misestilos.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="complementos/sweetalert2/sweetalert2.css">
		<link rel="stylesheet" href="complementos/alertifyjs/css/alertify.css"> 
		<link rel="stylesheet" href="fonts/css/font-awesome.css">
   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript">
		 addEventListener("load", function() {
		  setTimeout(hideURLbar, 0); }, false);
		  function hideURLbar(){
		   window.scrollTo(0,1); } 
		</script>
		</script>
		<!---- animated-css ---->
		<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script type="text/javascript" src="js/jquery.corner.js"></script> 
		<script src="js/wow.min.js"></script>
		<script>
		 new WOW().init();
		</script>
		<!---- animated-css ---->
		<!---- start-smoth-scrolling---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body>  
<?php 
  session_start();
  //echo $_SESSION['usuario'];
  if (!isset($_SESSION['usuario'])) {
    header("Location: /vitriservicios/web/index.php");
  }else{
    switch ($_SESSION['rol']) {
      case 'Administrador':
        include("vista/Administrar.php");
        break;
      case 'clientes':
        include("vista/mnuClientes.php");
        break;
      case 'proveedores':
        include("vista/mnuProveedores.php");
        break;
      default:
        # code...
        break;
    }
  }
 ?>
 		</div>
			<?php 
				include 'vista/footer.php';	
			 ?>
		</div>
		<script src="complementos/alertifyjs/alertify.js"></script>
    	<script src="complementos/sweetalert2/sweetalert2.js"></script>
		<script src="js/acciones.js"></script>
	</body>
</body>
</html>
