
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<title>camellApp</title>
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
		
		 <!---- start-smoth-scrolling---->
		<!----webfonts--->
		<!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>-->
		<!---//webfonts--->
		
	</head>

	<body>
		<div  id="contenido">
			
		
		<div class="bg">
		<!----- start-header---->
		<div class="container">
			<div id="home" class="header wow bounceInDown" data-wow-delay="0.4s">
					<div class="top-header">
						 <nav class="top-nav">
							<ul class="top-nav">
								<li class="active"><a href="" class="scroll" onclick="salir()">Inicio</a></li>
								<li><a href="#about" class="scroll">Acerca</a></li>
									<li class="mnuIngreso">
										<a href="#" class="scroll" onclick="iniciarSesion()">Iniciar Sesión</a>
									</li>
								<li><a href="#process" id="#registro" onclick="cargarRegistro()" class="scroll">Registrate</a></li>
								
								<li class="page-scroll"><a href="#contact" class="scroll">contacto</a></li>
								
							</ul>
							<a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
						</nav>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			<!----- //End-header---->
			<!---- banner-info ---->
			<div class="banner-info">
				<div class="container">
					<h1 class="wow fadeIn" data-wow-delay="0.5s">
						<!-- <span>Bienvenido </span><br /><label>
						<img src="images/logoVitriser.png" alt="camellApp" width="450"> </label> -->
						<img src="images/LogoVitriser_sombra.png" alt="camellApp" style='position: absolute; right: 8%; top: 15%; width: 47%;'> 
					</h1>
					<br>

					<div class="top-banner-grids wow bounceInUp" data-wow-delay="0.4s">
						 <div class="banner-grid text-center" onclick="cargarRegistro()">
							<span class="top-icon1"> </span>
							<h3>Registrate</h3>
						</div>
						<div class="banner-grid banner-grid-active text-center" onclick="iniciarSesion()">
							<span class="top-icon2"> </span>
							<h3>Logueate</h3>
						</div>
						<div class="banner-grid text-center">
							<span class="top-icon3"> </span>
							<h3>Buscalo</h3>
						</div>
						<div class="banner-grid text-center">
							<span class="top-icon4"> </span>
							<h3>Pidelo </h3>
						</div>
						<div class="banner-grid text-center">
							<span class="top-icon5"> </span>
							<h3>Pagalo</h3>
						</div>
						<div class="clearfix"> </div> <!---->
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
			<div id='ingreso' class="ingreso">
				
			</div>
			
			<div id="about" class="about">
				<div class="head-section">
					<div class="container">
						<h3><span>Acerca de </span><label>camellApp</label></h3>
					</div>
				</div>
					<!--- about-grids ---->
					<div class="about-grids">
						<div class="col-md-4 about-grid about-grid1 wow fadeInLeft" data-wow-delay="0.4s">
							<div class="about-grid-info">
								<h4><a href="#">¿Qué es camellApp? </a></h4>
								<p class="blanco">Es una vitrina que provee soluciones a las necesidades de servicios de nuestros clientes, brindando un listado de proveedores y de soluciones a las necesidades de éstos. Donde el cliente puede seleccionar entre un sin número de proveedores, el que mejor considere en la fecha y horario que requiera </p>
							</div>
							<div class="about-grid-pic">
							<img src="images/about-pic1.jpg" title="name" />
							</div>
						</div>
						<div class="col-md-4 about-grid about-grid2 wow fadeInUp" data-wow-delay="0.4s">
							<div class="about-grid-pic">
							<img src="images/about-pic2.jpg" title="name" />
							</div>
							<div class="about-grid-info">
								<h4><a href="#">Misi&oacute;n</a></h4>
								<p class="blanco">Somos una empresa de intermediación, una vitrina que aporta soluciones a las necesidades de nuestros usuarios, brindándole un abanico de proveedores que puede seleccionar de forma confiable, teniendo en cuenta el calendario y horario que el cliente escoja de acuerdo con su disponibilidad. </p>
							</div>
						</div>
						<div class="col-md-4 about-grid about-grid1 wow fadeInRight" data-wow-delay="0.4s">
							<div class="about-grid-info">
								<h4><a href="#">Visi&oacute;n</a></h4>
								<p class="blanco">Ser en el año 2020 el mejor asociado comercial, la mejor alternativa de solución a las necesidades de nuestros clientes, la más práctica y segura, obteniendo satisfacción total a través de la calidad en cada uno de nuestros servicios.  </p>
							</div>
							<div class="about-grid-pic">
							<img src="images/about-pic3.jpg" title="name" />
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
			</div>
			<div class="clearfix"> </div>

		</div>
			<?php 
				include 'php/footer.php';	
			 ?>
		</div>
		<script src="complementos/alertifyjs/alertify.js"></script>
    	<script src="complementos/sweetalert2/sweetalert2.js"></script>
		<script src="js/acciones.js"></script>
	</body>


</html>

