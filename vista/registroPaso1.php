<div id="blog" class="blog">
      <div class="container" style="padding:50px;padding-bottom:250px;">
      <h3> Registro de Usuarios </h3>
      <h4 style='padding:20px 0px;color:#8e8e8e;'>Paso 1 - Cree su cuenta</h4>
      <form action='' method='post' onsubmit='return registroPaso2()' id=''>
              <div class='row'>
                   <div class='col-md-12'>
                         <label>Correo/Email</label>
                          <div class='form-group input-group'>
                                <span class='input-group-addon'><i class='fa fa-envelope'></i></span>
                                <input type='email' class='form form-control' id='correo' value='josealf@correo.com' placeholder='Escriba su correo electrónico' required onchange='buscarUsuario(this.value)'>
                          </div>
                   </div>
              </div>
              <div id='mensajeValidacion1' class='row' style='display:none;width:100%;padding:10px;margin:-10px;'>

                  </div>
              <div class='row'>
                   <div class='col-md-12'>
                         <label>Contraseña</label>
                          <div class='form-group input-group'>
                                <span class='input-group-addon'><i class='fa fa-lock'></i></span>
                                <input type='password' class='form form-control' id='contrasenaRegistro' value='' onkeyup='seguridadClave(this.value)' required  maxlength='20'>
                          </div>
                          <div class="progress progress-striped active">
                                  <div class="progress-bar progress-bar-danger" id="nivelSeguridad" style="width: 0%;padding:0px;color:#000;"></div>
                              </div>
                   </div>
              </div>
              <div class='row'>
                    <div class='col-md-12'>
                         <label>Confirme la contraseña</label>
                          <div class='form-group input-group'>
                                <span class='input-group-addon'><i class='fa fa-key'></i></span>
                                <input type='password' class='form form-control' id='valContrasena' onkeyup='confirmContrasena()' value='' required  maxlength='20'>
                          </div>
                    </div>
              </div>
              <div id='mensajeValidacion2' class='row' style='display:none;width:100%;padding:10px;margin:-10px;'>

                  </div>
              <div class='row'>
                    <div class='col-md-12'>
                              <input type='submit' class='btn btn-primary' style='padding:15px 50px; margin-right: 20px;' value='Continuar'>
                              <button class='btn btn-warning' onclick='salir()' style='padding: 15px 50px;margin-left: 20px;'><i class='fa fa-home' ></i> Regresar</button>
                        </div> 
              </div>
      </form>
</div>