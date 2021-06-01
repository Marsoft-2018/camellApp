
var serviciotxt = new Array(); 
var serviciovalue = new Array();
var municipiotxt = new Array(); 
var municipiovalue = new Array();
var diasSel = new Array();
var horasSel = new Array();

function cargarProgramacionServicios(){
  // var idUsuario = $("#usuario").val();
  // $("#programacion").load("controlador/ctrlServiciosProveedor.php",{accion:"cargarProgramacionServicios",idUsuario:idUsuario});
    $.ajax({
    type:"POST",
    url: "controlador/ctrlServiciosProveedor.php",
    data:{accion:"cargarProgramacionServicios"},
    success:function(data){
      $("#resultado").html(data);
    },
    error:function(err){
      console.log('test: '+err);
    }

  });
}

$('#servicio').click(function () {
	var usuario = $("#usuario").val();  
	cargarServicio(usuario);
});

function cargarServicio(usuario){
	//alertify.alert("Esta todo ok el usuario es: "+usuario);	
	$("#programacion").load("controlador/ctrlServiciosProveedor.php",{accion:"cargarListaProveedor", idUsuario:usuario});
	/*
  	$.ajax({
  		url : "controlador/ctrlServiciosProveedor.php",
  		type : "post",
  		dataType : "json",
  		data : {"accion":"cargarListaProveedor", "idUsuario":usuario},
  		success : function(r){
  			alertify.success("los servicio son: "+r);
  			var servicio = r;
  			if(r){
  				$("#resultado").append("vista/serviciosProveedor.php",{servicio:servicio});
  			}
  		},
  		error : function(e){
  			alertify.error("ocurrio un error "+e);
  		}
  	});
	*/
}

function ventanaFlotante() { 
   swal({
   	width:800,
   	html:'<div id="divCarga" style="text-align: left;"> </div>',
   	showCloseButton:true,
   	showCancelButton:false,
   	showConfirmButton:false,
   	confirmButtonText:"",
   	confirmButtonColor:"#2A9B18",
   	focusConfirm:false,
   	allowOutsideClick:false,
   });
}

function editar_servicio(id) { 
	//ventanaFlotante();
  var accion = 'editar_servicio';
  $("#editar"+id).slideDown('fast');
  $("#editar"+id).load("controlador/ctrlServiciosProveedor.php",{
    		accion:accion,id:id
    });
}

function modificarServicio(id) { 
    var accion = 'modificar_servicio';
    var valor = $("#valorServicio"+id).val();
    $("#resultado").load("controlador/ctrlServiciosProveedor.php",{
    		accion:accion,id:id,valor:valor
    },function(){      
      alertify.success("El valor se modificó a: "+valor);
    });
}

$("#agregar").click(function(){		
  agregarSeleccionado();
});

$("#quitar").click(function(){ quitarSeleccionado(); });

//agregar opciones
$('#servicios option').dblclick(function(){ agregarSeleccionado(); });

//remover opciones
$('#servicioSeleccionado option').dblclick(function(){  quitarSeleccionado(); });

function agregarSeleccionado(){
  var idServicio = $("#cmb_servicios").val();
  var valor = $("#valorServicio").val();
  $.ajax({
    type:"POST",
    url: "controlador/ctrlServiciosProveedor.php",
    data:{accion:"guardarServicios", idServicio:idServicio, valor:valor},
    success:function(data){
      $("#listaServicios").html(data);
    },
    error:function(err){
      console.log('test: '+err);
    }
  });
}

function quitarSeleccionado(){
  var valor = $('#servicioSeleccionado option:selected').val();
  var clave = serviciovalue.indexOf(valor);
  serviciotxt.splice(clave,1); 
  serviciovalue.splice(clave,1);
  for(i=0; i<serviciovalue.length; i++){
    console.log(serviciovalue[i]+" "+serviciotxt[i]);    
  }

  $('#servicioSeleccionado option[value="' + valor + '"]').remove();  
}

function agregarMunicipioSeleccionado(){
  var ciudad = $("#ciudad").val();
  $.ajax({
    type : "POST",
    url  : "controlador/ctrlServiciosProveedor.php",
    data:{accion:"agregarMunicipio", ciudad:ciudad},
    success:function(data){
      $("#listaCiudades").html(data);
    },
    error:function(err){
      console.log('test: '+error);
    }
  })
}

function quitarMunicipioSeleccionado(ciudad){
  $.ajax({
    type : "POST",
    url  : "controlador/ctrlServiciosProveedor.php",
    data:{accion:"quitarMunicipio", ciudad:ciudad},
    success:function(data){
      $("#listaCiudades").html(data);
    },
    error:function(err){
      console.log('test: '+error);
    }
  })  
}

function seleccionDia(dia){
  if( $(dia).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        //alert("El checkbox con valor " + $(dia).val() + " ha sido seleccionado");
        diasSel.push($(dia).val());
        //console.log("Día: "+diasSel); 
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        //alert("El checkbox con valor " + $(dia).val() + " ha sido quitado");
        var clave = diasSel.indexOf($(dia).val());
        diasSel.splice(clave,1);        
        //console.log("Día: "+diasSel);  
    }
}

function seleccionHora(hora){
  if( $(hora).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
        //alert("El checkbox con valor " + $(hora).val() + " ha sido seleccionado");
        
        horasSel.push($(hora).val());
        //console.log("Horas: "+horasSel); 
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        //alert("El checkbox con valor " + $(hora).val() + " ha sido quitado");
        var clave = horasSel.indexOf($(hora).val());
        horasSel.splice(clave,1);           
        //console.log("Horas: "+horasSel);       
    }
}

function guardarServiciosProveedor(){
  var usuario = $("#usuario").val();
  $("#programacion").load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "guardarServicios",
      idUsuario   : usuario,
      servicios   : serviciovalue, 
      municipios  : municipiovalue,
      dias        : diasSel,
      horas       : horasSel
    });
}

function agregarMunicipioSeleccionadoTabla(usuario){

  $('#liMunicipios option:selected').each(function(){ 
    municipiotxt.push($(this).text()); 
    municipiovalue.push($(this).val()); 
  }); 

  for(i=0; i<municipiovalue.length; i++){
    //console.log(municipiovalue[i]+" "+municipiotxt[i]);
    if ( $('#municipioSeleccionado option[value="' + municipiovalue[i] + '"]').length === 0 ){
        $('#municipioSeleccionado').append($('<option>', {value: municipiovalue[i], text: municipiotxt[i] }));
    }
  }
  $("#resMunicipio").load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "ponerMunicipio",
      idUsuario   : usuario, 
      municipios  : municipiovalue
  });
}

function quitarMunicipioSeleccionadoTabla(usuario){  
  var valor = $('#municipioSeleccionado option:selected').val();
  var clave = municipiovalue.indexOf(valor);
  municipiotxt.splice(clave,1); 
  municipiovalue.splice(clave,1);
  for(i=0; i<municipiovalue.length; i++){
    //console.log(municipiovalue[i]+" "+municipiotxt[i]);    
  }

  $('#municipioSeleccionado option[value="' + valor + '"]').remove();  
  //console.log("Hola "+valor+" idProv "+usuario);  
  $("#resMunicipio").load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "quitarMunicipio",
      idUsuario   : usuario, 
      municipios  : valor
    });
}

function quitarDia(idProv,dia){

 $("#dia"+idProv+dia).load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "quitarDia",
      idUsuario   : idProv, 
      dia  : dia
    });
}

function colocarDia(idProv,dia){
 $("#dia"+idProv+dia).load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "colocarDia",
      idUsuario   : idProv, 
      dia  : dia
    });
}

function quitarHora(idProv,hora){
 $("#hora"+idProv+hora).load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "quitarHora",
      idUsuario   : idProv, 
      hora  : hora
    });
}

function colocarHora(idProv,hora){
 $("#hora"+idProv+hora).load("controlador/ctrlServiciosProveedor.php",
    {
      accion      : "colocarHora",
      idUsuario   : idProv, 
      hora  : hora
    });
}


