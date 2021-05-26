<?php
    //require "Conexion.php";	
	class Usuario extends Conectar{		
        public $usuario;
        public $contrasena;
        public $tipo;
        private $foto;
        private $nombre;
        private $sql;
        public $resultado = array();
        
        public function Validar(){            
            if($this->tipo === "clientes"){
                $this->sql = "SELECT us.id, us.usuario, us.contrasena FROM usuariosclientes us WHERE us.`usuario`= '".$this->usuario."' AND us.`contrasena`= AES_ENCRYPT('".$this->contrasena."','Makers2018') AND us.`activo`='1' ";                
            }elseif($this->tipo === "proveedores"){
                $this->sql = "SELECT us.id,us.usuario,us.contrasena FROM usuariosproveedores us WHERE us.`usuario`= '".$this->usuario."' AND us.`contrasena`= AES_ENCRYPT('".$this->contrasena."','Makers2018') AND us.`activo`='1' ";
            }

            try {
                $this->resultado['mensaje'] = ["Usuario '".$this->usuario."' no pudo ser encontrado en nuestros ".$this->tipo.", lo invitamos a registrarse presionando en botón registrate"];
                $this->resultado['estado'] = [0];
				$stm = $this->Conexion->prepare($this->sql);
				$stm->execute();
				$datos = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach ($datos as $value) {
					//$_SESSION['nombre'] = $value['nombre'];
					// $_SESSION['direccion'] = $value['direccion'];
					// $_SESSION['telefono'] = $value['telefono'];
					// $_SESSION['foto'] = $value['foto'];
					// $_SESSION['estado'] = $value['estado'];
					// $_SESSION['fecha_reg'] = $value['fecha_reg'];
					$_SESSION['usuario'] = $value['usuario'];
					$_SESSION['contrasena'] = $this->contrasena;
					$_SESSION['rol'] = $this->tipo;
					
                    $this->resultado['mensaje'] = ["Ingresando con éxito"];
                    $this->resultado['estado'] = [1];
				}
            } catch (PDOException $e) {             
                $this->resultado['mensaje'] = ["Error al ingresar  '".$this->tipo."' ".$e];
                $this->resultado['estado'] = [0];
            }
				
			return $this->resultado;

        }

        public function buscar($correo){  
            //echo "El correo ".$correo;
            $this->resultado = false;          
            $sqlBusca = mysql_query("SELECT usuario FROM usuariosclientes WHERE  usuario LIKE '$correo'") or die ("Error ".mysql_error());
            $resultado = mysql_num_rows($sqlBusca);
            if($resultado>0){
                $this->resultado = true;
            }else{
                $sqlBuscaP=mysql_query("SELECT `usuario` FROM usuariosproveedores WHERE  `usuario` LIKE '$correo'");
                $resultadoP=mysql_num_rows($sqlBuscaP);
                if($resultadoP>0){
                    $this->resultado = true;
                }
            }
            return $this->resultado;
        }//ok

          

        public function mostrarFoto($usuario){
            $sqlFoto=mysql_query("SELECT ft.`foto` FROM fotoUsuarios ft INNER JOIN usuarios us ON ft.`idUsuario`=us.`idUsuario` WHERE us.`idUsuario`='$usuario' AND us.`estado`='Activo'");
            $result=mysql_num_rows($sqlFoto);
            if($result>0){
                while($f=mysql_fetch_array($sqlFoto)){
                    $this->foto=$f[0];
                }
            }else{
                $this->foto="silueta.jpg";
            }
            return $this->foto;
        }//ok 

        function agregarFoto($idUsuario,$archivo){
            $nombreIMG=$archivo["name"];
            $tipo=$archivo["type"];
            $nombreTemp=$archivo["tmp_name"];
            $tamanho=$archivo["size"];
            $destino="../Vista/Imagenes/";
            if($nombreIMG!=''){
                if($tipo!="image/jpg" && $tipo!="image/jpeg" && $tipo!="image/png"){
                    echo "El archivo no es del tipo permitido, por favor seleccione otro";
                    return;
                }elseif($tamanho>1024*1024){
                    echo "Error: la imagén excede el tamaño máximo permitido de 1Mb";
                    return;
                }else{
                    $extension = end(explode(".", $nombreIMG));//con esta linea guardo la extension de la imagen, el cual busca el . al final en el nombre del archivo
                    $id;
                    $datosTabla=mysql_query("SELECT idFoto FROM fotoUsuarios WHERE idFoto=1");
                    $resultado=mysql_num_rows($datosTabla);
                    if($resultado==0){
                        $id=1;
                    }else{
                        $datosTabla=mysql_query("SELECT MAX(idFoto) FROM fotoUsuarios");
                        while($r=mysql_fetch_array($datosTabla)){ $id=$r[0]+1; }
                    }                     
                }

                $nuevoNombre="IMG".$id.".".$extension;

                $resultado = @move_uploaded_file($nombreTemp, $destino.$nuevoNombre);//ejecuto el comando para que sea movida la imagen temporal a la carpeta destino con el nuevo nombre.
                if ($resultado){
                    mysql_query("INSERT INTO `fotousuarios`(`idUsuario`, `foto`) VALUES('$idUsuario','$nuevoNombre')");                    
                } else {
                    echo "ocurrio un error al mover el archivo.";
                }
            }
        }

        public function cambiarFoto($usuario,$fotoAnterior,$archivo){    
            $nombreIMG=$archivo["name"];//Obtengo el nombre del nuevo archivo
            $tipo=$archivo["type"];//Obtengo el tipo de archivo
            $nombreTemp=$archivo["tmp_name"];//Obtengo el nombre temporar del archivo
            $tamanho=$archivo["size"];//obtengo el tamaño
            $destino="../Vista/Imagenes/";//Defino la carpeta de destino para la carga

            
            if($tipo!="image/jpg" && $tipo!="image/jpeg" && $tipo!="image/png"){//Compruebo que el tipo de imagen sea el adecuado
                echo "<script>alertify.error('El archivo no es del tipo permitido, por favor seleccione otro'); </script>";                
            }elseif($tamanho>1024*1024){//Si la imagen es del tipo adecuado Compruebo que el peso sea el adecuado
                echo "<script>alertify.error('Error: la imagén excede el tamaño máximo permitido de 1Mb'); </script>";
            }else{//Si la imagen cumple con las condiciones para ser cargada entonces
                $extension = end(explode(".", $nombreIMG));//con esta linea guardo la extension de la imagen contenida en el nuevo archivo               
                $id;//esta variable permitirá almacenar el numero con que se identificará la imagen posteriormente
                $datosTabla=mysql_query("SELECT idFoto FROM `fotousuarios` WHERE idFoto='1'");//Con esta consulta se comprueba si existe alguna foto en la tabla
                $resultado=mysql_num_rows($datosTabla);//almaceno el numero de registros que devuelve la consulta anterior
                if($resultado==0){//si el numero de registros es 0 entonces inicio el id con el numero 1
                    $id=1;
                }else{ //si el numero de registros es mayor que 0 entonces busco cual es el ultimo id almacenado en la tabla
                    $datosTabla=mysql_query("SELECT MAX(idFoto) FROM `fotousuarios`"); //Con esta consulta obtengo el último id almacenado en la tabla
                    while($r=mysql_fetch_array($datosTabla)){
                        $id=$r[0]+1;//Asigno el id con el que se debe guardar e identificar el archivo de la foto
                    }
                }                     
            }

            $nombreAnterior="Ninguno";      
            $nuevoNombre="IMG".$id.".".$extension;

            $sqlImagenAnterior=mysql_query("SELECT foto FROM `fotousuarios` WHERE idUsuario='$usuario';");
            $resFT=mysql_num_rows($sqlImagenAnterior);
            if($resFT>0){
                while ($fta=mysql_fetch_array($sqlImagenAnterior)) {
                    $nombreAnterior=$fta[0];  //defino el nombre de la imagen anterior y utilizarlo posteriormente para borrar la imagen con este mismo nombre

                }                 
            }
            

            if ($nombreAnterior == "Ninguno"){                              
                 $resultado = @move_uploaded_file($nombreTemp, $destino.$nuevoNombre);
                if ($resultado){                      
                    echo "<script>alertify.success('La foto fue actualizada con éxito'); </script>";
                    mysql_query("INSERT INTO `fotousuarios`(`idFoto`,`idUsuario`,`foto`) VALUES('$id','$usuario','$nuevoNombre');");                                    
                } else {
                    echo "<script>alertify.error('Ocurrio un error al subir la imágen al servidor.'); </script>"; 
                    return;
                }                               
            }else{  
                //echo "<script>alertify.alert('La foto anterior es $nombreAnterior - usuario: $usuario'); </script>";                               
                if(@unlink($destino.$nombreAnterior)){//elimino la imagen anterior para depues reemplazarla con la nueva
                    mysql_query("DELETE FROM fotousuarios WHERE idUsuario='$usuario'");
                    $resultado = @move_uploaded_file($nombreTemp, $destino.$nuevoNombre);
                    if ($resultado){                      
                        mysql_query("INSERT INTO `fotousuarios`(`idFoto`,`idUsuario`,`foto`) VALUES('$id','$usuario','$nuevoNombre');"); 
                        echo "<script>alertify.success('La foto fue actualizada con éxito'); </script>";                               
                    } else {
                        echo "<script>alertify.error('Ocurrio un error al subir la imágen al servidor.'); </script>";
                    }   
                }else{
                    echo "<script>alertify.error('Ocurrio un error al borrar la imágen del servidor.'); </script>";
                }                  
            }
        }
        
        public function modificar($campo,$clave,$valor){
            $sqlRol=mysql_query("SELECT rl.`Rol` FROM usuarios us INNER JOIN roles rl ON rl.`id`=us.`rol` WHERE us.`idUsuario`='$clave' AND us.`estado`='Activo';");
            $rol;
            while($r=mysql_fetch_array($sqlRol)){
                $rol=$r[0];
            }

            if($rol=="Instructor"){
               if($campo=='idUsuario'){
                    $sql_modificar=mysql_query("UPDATE profesores SET $campo='$valor' WHERE idUsuario='$clave';"); 
               }  
            }

            if($rol=="Administrador"){
                if($campo=='idUsuario'){
                    $sql_modificar=mysql_query("UPDATE administrar SET $campo='$valor' WHERE idUsuario='$clave';"); 
                }                 
            }
            
            if($rol=="Estudiante"){
                if($campo=='idUsuario'){
                    $sql_modificar=mysql_query("UPDATE estudiantes SET idUsuario='$valor' WHERE idUsuario='$clave';"); 
                }  
            }

            $sql_modificar=mysql_query("UPDATE usuarios SET $campo='$valor' WHERE idUsuario='$clave';");
            echo "<script>alertify.success('Se actualizó con éxito el dato en el perfil.'); </script>";
        }//ok

        public function modificarDato($tabla,$campo,$clave,$valor){
            $tablas = array('administrar','profesores','estudiantes');            
            $sql_modificar=mysql_query("UPDATE $tablas[$tabla] SET $campo='$valor' WHERE idUsuario='$clave';");
            echo "<script>alertify.success('Se actualizó con éxito el dato en el perfil.'); </script>";
        }//ok
        
        public function modificarContrasena($clave,$valor){
            $sql_modificar=mysql_query("UPDATE user1 SET Password='$valor' WHERE usuario='$clave';");
            echo "
                <div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Se actualizó la contrasena con éxito.
                </div>
            ";
        }// no utilizada hasta el momento
        
        public function contrasena($usuario){           
            $sql_comprobarContrasena=mysql_query("SELECT contrasena FROM usuarios WHERE  `idUsuario`='$usuario'");
            
            $rSql=mysql_num_rows($sql_comprobarContrasena);
            if($rSql>0){
                while($cn=mysql_fetch_array($sql_comprobarContrasena)){
                    $this->contrasena=$cn[0];
                }
            }
            return $this->contrasena;
        }//no utilizada hasta el momento

        public function cambiarContrasena($usuario,$valor){           
            $sql_comprobarContrasena=mysql_query("UPDATE usuarios SET contrasena='$valor' WHERE  `idUsuario`='$usuario'");
            echo "<script>alertify.success('Se actualizó con éxito el dato en el perfil.'); </script>";            
        }//no utilizada hasta el momento

        function agregarUsuario($usuario,$contrasena,$rol,$estado){
            mysql_query("INSERT INTO usuarios(`idUsuario`,`contrasena`,`rol`,`estado`) VALUES('$usuario','$contrasena','$rol','$estado');");
            $resultado=mysql_affected_rows();
            return $resultado;
        }//ok

        function datosUsuario($idUsuario){
            $this->sql=mysql_query("SELECT * FROM usuarios WHERE  `idUsuario`='$idUsuario'");
            return $this->sql;
        }

        public function datosNombre($usu){
            $sqlRol=mysql_query("SELECT rl.`Rol` FROM usuarios us INNER JOIN roles rl ON rl.`id`=us.`rol` WHERE us.`idUsuario`='$usu' AND us.`estado`='Activo';");
            
            while($r=mysql_fetch_array($sqlRol)){
                $this->rol=$r[0];
            }
            if($this->rol=="Instructor"){
              $this->nombre=mysql_query("SELECT primerNombre,segundoNombre,primerApellido,segundoApellido,email FROM profesores Where idUsuario='$usu' AND estado='Activo';");                   
            }

            if($this->rol=="Administrador"){
              $this->nombre=mysql_query("SELECT primerNombre,segundoNombre,primerApellido,segundoApellido,email FROM administrar Where idUsuario='".$usu."' AND estado='Activo'");                
            }

            if($this->rol=="Estudiante"){
              $this->nombre=mysql_query("SELECT primerNombre,segundoNombre,primerApellido,segundoApellido,email FROM estudiante Where idUsuario='".$usu."' AND estado='Activo'");                
            }
            return $this->nombre;            
        }//ok

        function generarContrasena(){
            //Se define una cadena de caractares. Te recomiendo que uses esta.
            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            //Obtenemos la longitud de la cadena de caracteres
            $longitudCadena=strlen($cadena);
             
            //Se define la variable que va a contener la contraseña
            $pass = "";
            //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
            $longitudPass=10;
             
            //Creamos la contraseña
            for($i=1 ; $i<=$longitudPass ; $i++){
                //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
                $pos=rand(0,$longitudCadena-1);
             
                //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
                $pass .= substr($cadena,$pos,1);
            }
            return $pass;
        }

        function __destruc(){
            
        }
	}  
?>