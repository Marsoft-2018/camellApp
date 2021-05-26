<!DOCTYPE html>
<html>
	<head>
		<title>Maker's | Inicio</title>
		<link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		 <script src="../../js/jquery.min.js"></script>
		 <!---- start-smoth-scrolling---->
		<script type="text/javascript" src="../../js/move-top.js"></script>
		<script type="text/javascript" src="../../js/easing.js"></script>
		
		<!---- start-smoth-scrolling---->
		 <!-- Custom Theme files -->
		<link href="../../css/theme-style.css" rel='stylesheet' type='text/css' />
		<link href="../../css/misestilos.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="../../complementos/sweetalert2/sweetalert2.css">
		<link rel="stylesheet" href="../../complementos/alertifyjs/css/alertify.css">   
    	<link rel="icon" href="images/IconoMakers.ico" />
   		 <!-- Custom Theme files -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!----font-Awesome----->
   		<link rel="stylesheet" href="../../fonts/css/font-awesome.min.css">
   		<!----font-Awesome----->
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600,200,700,800,900' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!----start-top-nav-script---->
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();
				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});
				$(window).resize(function(){
	        		var w = $(window).width();
	        		if(w > 320 && menu.is(':hidden')) {
	        			menu.removeAttr('style');
	        		}
	    		});
			});
		</script>	
		<!-- //End-top-nav-script-->
	</head>
	<body style="padding: 20px;">
		<div class="row">
			<div class="col-md-3">
				<label for="">Servicio:</label>
			</div>
			<div class="col-md-9">
				<input type="text" value="EJEMPLO DE SERVICIOS" class="form form-control">
			</div>			
		</div>
		<div class="row">
			<div class="col-md-3">
				<label for="">Valor:</label>
			</div>
			<div class="col-md-9">
				<input type="number" value="0" class="form form-control">
			</div>			
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Horas</th>
							<th>Lun</th>
							<th>Mar</th>
							<th>Mie</th>
							<th>Jue</th>
							<th>Vie</th>
							<th>Sab</th>
							<th>Dom</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1:00 PM</td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
						</tr>
						<tr>
							<td>2:00 PM</td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
						</tr>
						<tr>
							<td>4:00 PM</td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
						</tr>
						<tr>
							<td>5:00 PM</td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
						</tr>
						<tr>
							<td>6:00 PM</td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
							<td><input type="checkbox" class="form-control"></td>
						</tr>
					</tbody>
				</table>
			</div>			
		</div>
	</body>
</html>