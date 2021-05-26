

function cargarPaises(idContinente){
	$("#espacioPais").load("controlador/ctrlUbicacion.php",{accion:'cargarPaises',idContinente:idContinente});
	$("#espacioDepartamento").html("<label>Departamento</label><select class='form-control'><option value=''>Seleccione...</option></select>");
	$("#espacioCiudad").html("<label>Ciudad</label><select class='form-control'><option value=''>Seleccione...</option></select>");
}

function cargarDepartamentos(idPais){
	$("#espacioDepartamento").load("controlador/ctrlUbicacion.php",{accion:'cargarDepartamentos',idPais:idPais});
}

function cargarCiudad(idDepartamento){
	$("#espacioCiudad").load("controlador/ctrlUbicacion.php",{accion:'cargarCiudades',idDepartamento:idDepartamento});
}

function cargarRegistro(){
	$("#registro").slideDown('fast');
	$("#ingreso").load("vista/registroPaso1.php",function(){		
		document.getElementById("usuario").value="";
	});
}

function salir(){	
	location = "index.php";
}


function iniciarSesion(){
	$("#ingreso").load("vista/login.php");
}	

$("#editarPerfil").click(function(){
	cargarPerfil();
});

function cargarPerfil(){
	$("#registro").slideDown('fast');
	alert("se supone que debe cargar el perfil ");
	var usuario = document.getElementById("usuario").value;
	$("#contenido").load("controlador/ctrlPerfil.php",
		{
			accion : "editarPerfil",
			tipoUsuario : "cliente",
			usuario : usuario
		}
	);
}

function seguridadContrasena(clave){
	//var contrasena = $("#contrasenaRegistro").val();
	var numeros="0123456789";
	var letras="abcdefghyjklmnñopqrstuvwxyz";
	var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
	var signos = "!#$%&'()*+,-./:;<=>?@[]^_`{|}~";

	function tiene_numeros(texto){
	   for(i=0; i<texto.length; i++){
	      if (numeros.indexOf(texto.charAt(i),0)!=-1){
	         return 1;
	      }
	   }
	   return 0;
	} 

	function tiene_letras(texto){
	   texto = texto.toLowerCase();
	   for(i=0; i<texto.length; i++){
	      if (letras.indexOf(texto.charAt(i),0)!=-1){
	         return 1;
	      }
	   }
	   return 0;
	} 

	function tiene_minusculas(texto){
	   for(i=0; i<texto.length; i++){
	      if (letras.indexOf(texto.charAt(i),0)!=-1){
	         return 1;
	      }
	   }
	   return 0;
	} 

	function tiene_mayusculas(texto){
	   for(i=0; i<texto.length; i++){
	      if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1){
	         return 1;
	      }
	   }
	   return 0;
	} 

	function tieneSignos(texto){
	   for(i=0; i<texto.length; i++){
	      if (signos.indexOf(texto.charAt(i),0)!=-1){
	         return 1;
	      }
	   }
	   return 0;
	} 

	var seguridad = 0;
	if (clave.length!=0){
		if (tiene_numeros(clave) && tiene_letras(clave)){
			seguridad += 10;
		}

		if (tiene_minusculas(clave)){
			seguridad += 10;
		}
		if (tiene_mayusculas(clave)){
			seguridad += 10;
		}
		if (tieneSignos(clave)){
			seguridad += 10;
		}

		if (clave.length >= 6 && clave.length <= 8){
			seguridad += 30;
		}else{
			if (clave.length > 8){
				seguridad += 60;
			}			
		}
	}
	return seguridad;		
}

function seguridadClave(clave){
	seguridad = seguridadContrasena(clave);
	if(seguridad<=25){
		$("#nivelSeguridad").css('width',seguridad + "%");
		$("#nivelSeguridad").removeClass("progress-bar-warning");
		$("#nivelSeguridad").removeClass("progress-bar-info");
		$("#nivelSeguridad").removeClass("progress-bar-success");
		$("#nivelSeguridad").css('width',seguridad + "%").addClass("progress-bar-danger");
		$("#nivelSeguridad").text("Muy Débil");
	}else if(seguridad<=40){
		$("#nivelSeguridad").css('width',seguridad + "%");
		$("#nivelSeguridad").removeClass("progress-bar-warning");
		$("#nivelSeguridad").removeClass("progress-bar-info");
		$("#nivelSeguridad").removeClass("progress-bar-success");
		$("#nivelSeguridad").addClass("progress-bar-danger");
		$("#nivelSeguridad").text("Débil");
	}else if(seguridad<=60){
		$("#nivelSeguridad").css('width',seguridad + "%");
		$("#nivelSeguridad").removeClass("progress-bar-danger");
		$("#nivelSeguridad").removeClass("progress-bar-info");
		$("#nivelSeguridad").removeClass("progress-bar-success");
		$("#nivelSeguridad").addClass("progress-bar-warning");
		$("#nivelSeguridad").text("Fuerte");
	}else if(seguridad<100){
		$("#nivelSeguridad").css('width',seguridad + "%");
		$("#nivelSeguridad").removeClass("progress-bar-danger");
		$("#nivelSeguridad").removeClass("progress-bar-warning");
		$("#nivelSeguridad").removeClass("progress-bar-success");
		$("#nivelSeguridad").addClass("progress-bar-info");
		$("#nivelSeguridad").text("Muy Fuerte");
	}else if(seguridad==100){
		$("#nivelSeguridad").css('width',seguridad + "%");
		$("#nivelSeguridad").removeClass("progress-bar-danger");
		$("#nivelSeguridad").removeClass("progress-bar-info");
		$("#nivelSeguridad").removeClass("progress-bar-warning");
		$("#nivelSeguridad").addClass("progress-bar-success");
		$("#nivelSeguridad").text("Excelente");
	}

	
}

function confirmContrasena(){
	var contrasena1 = $("#contrasenaRegistro").val();
	var contrasena2 = $("#valContrasena").val();
	//alert("Esta validadando la contrasena 1: "+contrasena1);
	//alert("Esta validadando la contrasena 2: "+contrasena2);
	var resultado;
	
	if(contrasena1==""){
		$("#mensajeValidacion2").slideDown("fast");
		$("#mensajeValidacion2").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><i class='fa fa-key'></i> Por favor escriba una contraseña.</div>").css("color","#00ff02");
		$("#contrasena").focus();
		resultado =false;
	}else if(contrasena1==contrasena2){
		$("#mensajeValidacion2").slideDown("fast");
		$("#mensajeValidacion2").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>La contraseña es correcta, ya puede continuar</div>").css("color","#00ff02");
		resultado =true;
	}else{
		$("#mensajeValidacion2").slideDown("fast");
		$("#mensajeValidacion2").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Por favor verifique, las contraseñas no coinciden</div>").css("color","#00ff02");
		resultado =false;
	}

	return resultado;
}


function buscarUsuario(usuario){
	$("#mensajeValidacion1").slideDown("fast");
	$("#mensajeValidacion1").load("controlador/ctrlValidacion.php",{accion:"BuscarUsuario",usuario:usuario});
}

function buscarmeMapa(){
	var salida = document.getElementById("mapaRegistro");
	/*if(navigator.geolocation){
		salida.innerHTML="<p>El navegador soporta geolocalización</p>";
	}else{
		salida.innerHTML="<p>El navegador no soporta geolocalización</p>";
	}*/

	function localizacion(posicion){
		var latitud = posicion.coords.latitude;
		var longitud = posicion.coords.longitude;



		var options = {
	        zoom:15,
	        center:{lat:latitud,lng:longitud}
	      }

	      // New map
	      var map = new google.maps.Map(document.getElementById('mapaRegistro'), options);

	      // Listen for click on map
	      google.maps.event.addListener(map, 'click', function(event){
	        // Add marker
	        addMarker({coords:event.latLng});
	      });

      
	      // Add marker
	      var marker = new google.maps.Marker({
	        position:{lat:latitud,lng:longitud},
	        map:map,
	        icon:''
	      });

	      $("#lat").val(latitud);
	      $("#lng").val(longitud);


	}

	function error(){
		salida.innerHTML="<p>No se pudo obtener su ubicación</p>";
	}

	navigator.geolocation.getCurrentPosition(localizacion,error);
}

function mostrarMapa2(){

	// coordenadoas el carmen center:{lat:9.7173996,lng:-75.1202316}

	$("#mapaRegistro").show(100);

	var opcionesMapa= {
		zoom:15,
		center:{lat:9.72564215,lng:-75.14119924}
	}

	//Se dibuja el mapa
	var objMapa = new google.maps.Map(document.getElementById("mapaRegistro"),opcionesMapa);

	// para dibujar el marcador 
	var marcador = new google.maps.Marker({
		position:{lat:9.72564215,lng:-75.14119924},
		map:objMapa
	});

	var marcador2 = new google.maps.Marker({
		position:{lat:9.72584383,lng:-75.12435861},
		map:objMapa
	});

/*
	var marcador3 = new google.maps.Marker({
		position:{lat:9.719157, lng:-75.125455},
		map:objMapa
	});
*/
}

function registroPaso2(){
	var verContrasena = confirmContrasena();
	if(verContrasena){
		var correo = document.getElementById("correo").value;
		var contrasenha = document.getElementById("contrasenaRegistro").value;
		var usuarioRes = buscarUsuario(correo);
	
		$("#contenido").load("controlador/ctrlRegistro.php",{accion:"pasarUsuario",correo:correo,contrasenha:contrasenha},function(){
			buscarmeMapa();	
			document.getElementById("id").focus();
		}).fadeIn();
	}else{
		$("#mensajeValidacion2").slideDown("fast");
		$("#mensajeValidacion2").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Por favor verifique, las contraseñas no coinciden</div>").css("color","#00ff02");		
	}	
	return false;
}

function addRegistro(){
		
	var nombres = document.getElementById("nombres").value;	
	var apellidos = document.getElementById("apellidos").value;
	var fechaNac = document.getElementById("fechaNac").value;
	var lat = document.getElementById("lat").value;
	var lng = document.getElementById("lng").value;
	var municipio = document.getElementById("ciudad").value;
	var direccion = document.getElementById("direccion").value;
	var telefono = document.getElementById("telefono").value;
	var correo = document.getElementById("correo").value;	
	var contrasena = document.getElementById("contrasenhia").value;
	var tipo = document.getElementById("tipo").value;
	

	/**/

	// agregar($tipo,$correo,$contrasenha,$nombres,$apellidos,$direccion,$telefono,$municipio,$fechaNac,$lat,$lng)


	$("#contenido").load("controlador/ctrlRegistro.php",
		{
			accion:"addRegistro",
			tipo:tipo,
			correo:correo,
			contrasena:contrasena,
			nombres:nombres,
			apellidos:apellidos,
			direccion:direccion,
			telefono:telefono,
			municipio:municipio,
			fechaNac:fechaNac,
			lat:lat,
			lng:lng
		}
	);

	return false;
}

function validarUsuario(){
	var tipo = $('input:radio[name=tipo]:checked').val();
	var correo = $("#correoSesion").val();
	var contrasenha = $("#contrasenaSesion").val();
		
	var datos = {
		"usuario" : correo,
		"contrasena" : contrasenha,
    	"tipo"	: tipo
	}

	$.ajax({
		url : "controlador/ctrlValidacion.php",
		type : "post",
		data : datos,
		cache : false,
		success : function(respuesta){
			//alert("la respuesta es: "+respuesta);
			if(respuesta){
                  cargarUsuario(correo,contrasenha,tipo);
	          }else{
	              alertify.alert("!ERROR AL INGRESAR!","<br>Usted no se encuentra registrado por favor registrese para porder ingresar a Makers");
	          }
		},
		error: function(status,err){
			alert("! ocurrio un error "+error);
		},
	});

}

function logear() {
	var tipo = $('input:radio[name=tipo]:checked').val();
	var correo = $("#usuario").val();
	var contrasenha = $("#contrasena").val();
	
	var datos = {
		"usuario" : correo,
		"contrasena" : contrasenha,
		"tipo"	: tipo,
		"accion" : "validar"
	}
    $.ajax({
        type:"POST",
        data: datos,
        url:"controlador/ctrlValidacion.php",
        success:function(data){
            data = JSON.parse(data);
			
            //data = JSON.parse(data);
            console.log('Mensaje: '+data["mensaje"]);
            //console.log(data);
			$("#mensajeValidacion1").html(data["mensaje"]);
            // respuesta = respuesta.trim();
            // console.log(respuesta);
            if(data["estado"] == 1) {
                window.location="inicio.php";
            }else{
                $("#mensajeValidacion1").html(data["mensaje"]).addClass("animated zoomIn").show('fast',function(){
                    setTimeout(function(){ $("#error").hide() }, 3000);
                });
            }
        }
    });
    return false;
}

function cargarUsuario(idUsu,contrasena,tipo){
	if(tipo == "clientes"){
		$("#contenido").load("vista/mnuClientes.php",{usuario:idUsu},function(){
	    		$("#divMenu").fadeOut();
	    	}
    	);
	}else if(tipo == "proveedores"){
		$("#contenido").load("vista/mnuProveedores.php",{usuario:idUsu},function(){
	    		$("#divMenu").fadeOut();
	    	}
    	);
	} 	
}

function buscarServicios(cat){
	$("#divSubCategoria").load("controlador/ctrlValidacion.php",
    	{
    		accion:"cargarServicios",
    		idCategoria:cat
    	}
    );
}

function cargarProveedoresServicios(){
	var servicio = document.getElementById("idServicio").value;
	$("#vistaProveedores").load("controlador/ctrlServiciosProveedor.php",
    	{
    		accion:"cargarProveedorServicios",
    		idServicio:servicio
    	},function(){
			mostrarMapa2();
    	}
    );
}

/*para votaciones */


function ventanaModal(){
    swal({
      width: 1100,
      html:'<div id="flotante"></div>',
      showCloseButton: true,
      showCancelButton: false,
      showConfirmButton:true,
      focusConfirm: false,
      allowOutsideClick: false
    });
}

function cargarOpiniones(tUsuario,usuario,voto){
	ventanaModal();
	var accion = "CargarOpiniones";
	$("#flotante").load("controlador/ctrlVotacion.php",{accion:accion,usuario:usuario,voto:voto,tUsuario:tUsuario});
}

function autocompletar() {
    var minimo_letras = 2; // minimo letras visibles en el autocompletar
    var palabra = $('#nbre_municipio').val();
    $('#lista').show();
    //Contamos el valor del input mediante una condicional
    if (palabra.length >= minimo_letras) {
        $.ajax({
            url: 'controlador/ctrlUbicacion.php',
            type: 'POST',
            data: {palabra:palabra,accion:"cargarUbicacion"},
            success:function(data){
                $('#lista').show();
                $('#lista').html(data);
            }
        });
    } else {
        //ocultamos la lista
        $('#lista').hide();
    }
}
 
// Funcion Mostrar valores
function set_item(opciones) {
    var id_municipio = opciones[0][0];
    //alert("Datos en el id municipio: "+id_municipio);
    // Cambiar el valor del formulario input
    $('#ciudad').val(id_municipio);
    $('#nbre_municipio').val(opciones);
    // ocultar lista de proposiciones
    $('#lista').hide();
   
}