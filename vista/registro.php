<div class='row'>
          <div class='col-md-2'><label>Nit/Documento</label><input type='text' class='form form-control' id='idProveedor' value=''></div>
        <div class='col-md-4'>
>                        <input type='text' class='form form-control' id='nombres' value=''>
                  </div>
        <div class='col-md-4'>
                        <label>Apellidos</label>
                        <input type='text' class='form form-control' id='apellidos' value=''>
                  </div> 
      </div>
      <div class='row'>
      <div class='col-md-3'>
            <input type="text" id="id_municipio" >
            <label>Municipio donde buscar&aacute;</label>
            <input autocomplete="off" type="text" id="nbre_municipio"  onkeyup="autocompletar()">
            <ul id="lista"></ul>
      <div class='col-md-3' id='espacioPais'>
     <label>País</label> 
     <select class='form-control'>
                        <option value=''>Seleccione...</option>                         
     </select>           
      </div>
      <div class='col-md-3' id='espacioDepartamento'>
     <label>Departamento</label>              
     <select class='form-control'>
                        <option value=''>Seleccione...</option>                         
     </select>           
      </div>
      <div class='col-md-3' id='espacioCiudad'>
     <label>Ciudad</label>              
     <select class='form-control'>
                        <option value=''>Seleccione...</option>                         
     </select>           
      </div> 
      </div>
      <div class='row'>
        <div class='col-md-4'>
                        <label>Dirección</label>
                        <input type='text' class='form form-control' id='dir' value=''>
                  </div>
        <div class='col-md-2'>
                        <label>Teléfono</label>
                        <input type='text' class='form form-control' id='tel' value=''>
                  </div>
      <div class='col-md-3'>
                        <label>Correo</label>
                        <input type='text' class='form form-control' id='correo' value=''>
                  </div>
      <div class='col-md-3'>
                        <br>
                        Cliente<input type='Radio' name='tipo' class='' id='tipo' value=''>
                        Proveedor<input type='Radio' name='tipo' class='' id='tipo' value=''>
                  </div>

      </div>
      <div class='row'>
      
      </div>
      <div class='row'>                     
          <div class='col-md-3'>
              <br>
              <button class='btn btn-primary' style='width: 100%;' onclick='addProveedor()'>
                  <i class='fa fa-plus'> </i> Registrarme
              </button>
          </div>
      //    <div class='col-md-8'></div>            
      </div>
<?php 
      
 ?>