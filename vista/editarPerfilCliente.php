<style>
    
    #register-form .control-inline {
      display: inline-block;
    }
    #register-form input.input-huge {
      width: 318px;
    }
    #register-form .control-group {
      margin-bottom: 0;
    }
    #register-form .body {
      overflow-y: auto;
      height: auto;
    }

    #register-info h1 {
      font-size: 42px;
      font-family: "Open Sans", sans-serif;
      line-height: 55px;
      font-weight: 700;
      text-align: right;
      padding-bottom: 50px;
      color: white;
    }
    #register-info hr {
        border: 0;
        border-top: 1px solid silver;
        border-top-style: dashed;
        margin-top:3px;
    }
    #register-form legend {
      margin-bottom: 15px;
      border-bottom: none;
    }
    .cont2 {
        text-align:center;
        margin-top:8px;
    }

    .cont3 {
        text-align:left;
        margin-left:8px;
        color:#bdbdbd;
    }

    .cont3 ok {
        color:#b2c831;
    }

</style> 
       
       
<div class="container" >
        <div class="row">

        	<div class="col-lg-12">        		
        		<div class="register-info-wraper" style='border:1px solid rgba(253,253,253,0.5);border-radius:0px;box-shadow:0px 0px 23px; margin:0 auto;margin-top:50px;width:50%;'>
        			<div id="register-info">
        				<div class="cont2">
        				    <?php 
                                require('CONECT.php');
                                $usuario=$_POST['usuario'];
                                $sqlus=mysql_query("SELECT ad.IDUsuario,ad.Password,ad.Foto,ad.PrimerNombre,ad.`SegundoNombre`,ad.`PrimerApellido`,ad.`SegundoApellido`,ad.email,ad.`estado`,tr.`Tipo`
FROM administrar ad INNER JOIN roles r ON r.`idUsuario`=ad.`IDUsuario` INNER JOIN tipoderol tr ON tr.`idRol`=r.`idRol` WHERE ad.`IDUsuario`='$usuario';");
                                $rUsu=mysql_num_rows($sqlus);
                                $datos=array(); 
                                $tabla=0;
                                if($rUsu>0){
                                    $tabla=1;
                                    while($u=mysql_fetch_array($sqlus)){
                                        $datos[]=$u[0];//Usuario
                                        $datos[]=$u[1];//Contraseña
                                        $datos[]=$u[2];//Foto
                                        $datos[]=$u[3];//Primer nombre
                                        $datos[]=$u[4];//Segundo Nombre
                                        $datos[]=$u[5];//Primer Apellido
                                        $datos[]=$u[6];//Segundo Apellido
                                        $datos[]=$u[7];//Correo
                                        $datos[]=$u[8];//Estado
                                        $datos[]=$u[9];//Rol
                                    }    
                                }else{
                                    $sqlus=mysql_query("SELECT pf.IDUsuario,pf.Password,pf.PrimerNombre,pf.`SegundoNombre`,pf.`PrimerApellido`,pf.`SegundoApellido`,pf.email,pf.`estado`,pf.rol 
FROM profesores pf WHERE pf.`IDUsuario`='$usuario'");
                                $rUsu=mysql_num_rows($sqlus);
                                     if($rUsu>0){
                                        $tabla=2;
                                        while($u=mysql_fetch_array($sqlus)){
                                            ///---- Voy por aqui estoy cambiando las claves en el array con los valores de la consulta
                                            $datos[0]=$u[0];//Usuario
                                            $datos[1]=$u[1];//Contraseña
                                            $sql_foto=mysql_query("SELECT foto FROM fotoprofesores WHERE IDUsuario='$usuario'");
                                            $rsFoto=mysql_num_rows($sql_foto);
                                            if($rsFoto>0){
                                                while($ft=mysql_fetch_array($sql_foto)){
                                                    $datos[2]=$ft[0];
                                                }
                                            }else{
                                                $datos[2]="silueta.jpg";
                                            }
                                            
                                            $datos[3]=$u[2];//Primer nombre
                                            $datos[4]=$u[3];//Segundo Nombre
                                            $datos[5]=$u[4];//Primer Apellido
                                            $datos[6]=$u[5];//Segundo Apellido
                                            $datos[7]=$u[6];//Correo
                                            $datos[8]=$u[7];//Estado
                                            $datos[9]=$u[8];//Rol
                                        }                                      
                                     }
                                }
                            ?>
        					<div class="thumbnail" style="border:0px;background-color:rgba(255,255,255,1);">
        					    <?php 
                                    echo "<img src='IMAGENES/Usuarios/".$datos[2]."'  alt='Foto de usuario' class='img-circle'>";
                                ?>
							</div><!-- /thumbnail -->
							<h2 style='text-align:center;'><?php echo $datos[3]." ".$datos[4]." ".$datos[5]." ".$datos[6]; ?></h2>
        				</div>
        				<div class="row"> 
        				    <div class="col-md-1"></div>       					
        					<div class="col-lg-10" style='text-align:right;'>
        						<form id="register-form" class="form">
                                    <legend>Datos Registrados</legend>
                                    <div class='body'>
                                       <?php
                                        echo "<label for='nombre'>Primer Nombre</label>";
                                        echo "<input name='$datos[0]' class='input-huge' type='text' id='PrimerNombre' value='$datos[3]' onchange='modificarPerfil(this.id,this.value,".$tabla.",this.name)'>";
                                        echo "<label for='segundoNombre'>Segundo Nombre</label>";
                                        echo "<input name='$datos[0]' class='input-huge' type='text' id='SegundoNombre' value='$datos[4]' onchange='modificarPerfil(this.id,this.value,".$tabla.",this.name)'>";
                                        echo "<label for='primerApellido'>Primer Apellido</label>";
                                        echo "<input name='$datos[0]' class='input-huge' type='text' id='PrimerApellido' value='$datos[5]' onchange='modificarPerfil(this.id,this.value,".$tabla.",this.name)'>";
                                        echo "<label for='segundoApellido'>Segundo Apellido</label>";
                                        echo "<input name='$datos[0]' class='input-huge' type='text' id='SegundoApellido' value='$datos[6]' onchange='modificarPerfil(this.id,this.value,'$tabla; ')'>";
                                        echo "<label>Nombre de Usuario</label>";
                                        echo "<input class='input-huge' name='$datos[0]' type='text' id='IDUsuario' value='$datos[0]' onchange='modificarPerfil(this.id,this.value,".$tabla.",this.name)'>";
                                        echo "<label>Contraseña Actual</label>";
                                        echo "<input class='input-huge' type='password' id='contrasenaAct' value=''>";
                                        
                                        echo "<label>Contraseña Nueva</label>";
                                        echo "<input class='input-huge' type='password' id='Password' style='width:238px;'>";
                                        echo "<input type='button' class='btn btn-success' id='$datos[0]' onclick='cambiarContrasena(this.id,".$tabla.")' value='Cambiar' style='width:80px;padding:2px;margin:0px;'>";
                                        echo "<label>Correo Electrónico</label>";
                                        echo "<input class='input-huge' type='mail' id='email' name='$datos[0]' value='$datos[7]' onchange='modificarPerfil(this.id,this.value,".$tabla.",this.name)'>";
                                        ?>
                                    </div>
                                </form>
        					</div>
        					<div class="col-md-1"></div>  
        				</div><!-- /inner row -->
						<hr>
                        <div class="footer" id='resultados' style='text-align:center;padding:10px;'>
                            
                        </div>								
        			</div>
        		</div>
        	</div>
        </div>
    </div>
    
   
<script type="text/javascript">
    function modificarPerfil(id,valor,tabla,clave){
        var accion='modificarPerfil';
        document.getElementById('resultados').innerHTML='';        
        $('#resultados').load('vistas/perfil.php',{accion:accion,tabla:tabla,campo:id,clave:clave,valor:valor});
    }
    function cambiarContrasena(clave,tabla){
        var contrasenaActual=document.getElementById('contrasenaAct').value;
        if(contrasenaActual==''){
            alertify.error('Por favor digite su contraseña actual en el campo con el mismo nombre');
        }else{
            document.getElementById('resultados').innerHTML='';
            var valor=document.getElementById('Password').value;
            var accion='cambiarContrasena';
            alertify.alert('Entro en modificar contraseña y los valores son: Valor: '+valor+" Tabla: "+tabla+" IDUsuario: "+clave);
            $('#resultados').load('vistas/perfil.php',{accion:accion,tabla:tabla,clave:clave,valor:valor,contrasenaActual:contrasenaActual}); 
        }
        
    }
</script>