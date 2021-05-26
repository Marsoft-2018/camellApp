<?php 
  session_start();
?>

<div id="blog" class="blog">
      <div class="container" style="padding:50px;padding-bottom:250px;">
            <h3> Iniciar Sesión - Login </h3>
            <section class='contenidoIngreso contact-grids' id='formIngreso'>
                  <form id='formLogin' action='' method='Post' target='_self'  onsubmit='return logear()'>
                        <div class='row'>
                              <div class='col-md-12'>
                                    <label>Correo/Email</label>
                                    <div class='form-group input-group'>
                                          <span class='input-group-addon'>
                                                <i class='fa fa-envelope'></i>
                                          </span>
                                          <input type='email' class='form form-control mailSesion' id='usuario' name='usuario' value='ingjerson2014@gmail.com' placeholder='Escriba su correo electrónico' required>
                                    </div>
                              </div>
                        </div>
                        <div class='row'>
                              <div class='col-md-12'>
                                    <label>Contraseña</label>
                                    <div class='form-group input-group'>
                                          <span class='input-group-addon'>
                                                <i class='fa fa-lock'></i>
                                          </span>
                                          <input type='password' class='form form-control contrasenaSesion' id='contrasena' name='contrasena' value='123456' required>
                                    </div>
                              </div>
                        </div>
                        <div class='row'>
                              <div class="col-md-12">
                                    <div class="wrapper">
                                          <input type="radio" name="tipo" id="option-1" value="clientes" checked>
                                          <input type="radio" name="tipo" id="option-2" value="proveedores">
                                          <label for="option-1" class="option option-1">
                                                <div class="dot"></div>
                                                <span>Soy Cliente</span>
                                          </label>
                                          <label for="option-2" class="option option-2">
                                                <div class="dot"></div>
                                                <span>Soy Proveedor</span>
                                          </label>
                                    </div>
                              </div>
                        </div>
                              
                        <div class='row' style='text-align:center;'>
                              <div class="col-md-12">
                                    <a href='#' style='display: inline-block;width: 100%;margin: 20px 0px;'>Olvidé mi contraseña</a>     
                              </div>                              
                        </div>
                        <div class="row">
                              <div class='col-md-12' style='text-align:center;'>
                                    <!-- <input type='button' class='btn btn-primary' style='padding: 15px;margin: 25px;width: 150px;' value='Soy Cliente' onclick="validarUsuario()"' >
                                    <input type='submit' class='btn btn-success' style='padding: 15px;margin: 20px 0px;width: 100%; font-size: 2em;' value='Ingresa' > -->
                                    <input type='submit' class='btn btn-success' style='padding: 15px;margin: 20px 0px;width: 100%; font-size: 2em;' value='Ingresa'>
                              </div> 
                        </div>                                          
                  </form>
                  <div id='mensajeValidacion1' class='row' style='display:none; width:100%; padding:10px;margin:-10px;'>
                  </div>
            </section>
      </div>
</div>