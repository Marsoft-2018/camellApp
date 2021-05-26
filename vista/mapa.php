<div class="row" >
	<div class="col-md-3" style="padding-top: 20px;">
		 <button class="btn btn-success" onclick="buscarmeMapa()">Mostrar mi ubicación</button> 
	</div><!--
	<div class="col-md-3" style="padding-top: 20px;">
		<button class="btn btn-warning" onclick="mostrarMapa2()">Mostrar mi ubicación</button> 
	</div>-->
	<div class="col-md-3">
		<label for="">Latitud</label>
		<input type="text" id="lat" class="form-control" style="text-align:right;" required value='9.7173996'>
	</div>
	<div class="col-md-3">
		<label for="">Longitud</label>
		<input type="text" id="lng" class="form-control" style="text-align:right;" required value='-75.1202316'>
	</div>
</div>
<div class="row">
	
	
	<div class="col-md-12" id="mapaRegistro"  style='padding:0px;height: 400px; width: 98%;border:1px solid #cecece;'>
		
	</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0L8BsANJeB5NuaBwjccRGAxtFvRf9R8o"></script>