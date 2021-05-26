<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/ 
TR/html4/strict.dtd"> 
<html> 
<head> 
<title>Pasar un select a otro</title> 
<script type="text/javascript" src="../js/jquery.min.js"></script> 
<script type="text/javascript"> 
$(document).ready(function(){ 
        $('#enlace').click(function(){ 
                var datostxt = new Array(); 
                var datosvalue = new Array(); 
                $('#frutas option:selected').each(function(){ 
                        datostxt.push($(this).text()); 
                        datosvalue.push($(this).val()); 

                }); 

                for(i=0; i<datosvalue.length; i++){
                	console.log(datosvalue[i]+" "+datostxt[i]);
                }

                $("#resultado").load("prueba2.php",{variable:datosvalue, variable2:datostxt});
                /*$.ajax({
                	type: "POST",
                	url: "prueba2.php",
                	datatype: "JSON",
                	data: {variable:datosvalue, variable2:datostxt},
                	success: function(r){
                		$("#resultado").html(r);
                	}
                });*/
        }); 
}); 

</script> 
</head> 
<body> 
<select multiple="multiple" id="frutas"> 
        <option value="1">Manzanas</option> 
        <option value="2">Papaya</option> 
        <option value="3">Piña</option> 
        <option value="4">Naranja</option> 
</select> 
<div id="resultado">
	
</div>
<a href="#45d" id="enlace">Enviar</a>