<?php 

  session_start();
  include("../modelo/Conexion.php");
  include("../modelo/validar.php");

  $accion = 0;


  if(isset($_GET['accion'])){
  	$accion = $_GET['accion'];
  }else if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
  }

  switch ($accion) {
    case 'validar':
      if (isset($_POST["usuario"])){
        $objUsuario = new Usuario();
        $objUsuario->setDatos($_POST["usuario"],$_POST["contrasena"]);
        $objUsuario->tipo = $_POST["tipo"];
        echo json_encode($objUsuario->Validar());
      } 
      break;

    case 'cargarSubCategorias':
      require("../modelo/subCategoria.php");
      $idCat = $_POST['idCategoria'];
      $objSC = new subCategoria();
      $objSC->cargarCombo($idCat);
      break;

    case 'BuscarUsuario':
      $usuario = $_POST['usuario'];
      $objUsuario=new Usuario();                   
      $encontrado = $objUsuario->buscar($usuario);
      if($encontrado){
        echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                Ya existe un usuario registrado con esta direccion de correo, por favor verifique
        </div>";
      }
      break;

    case 'modificarUsuario':
      $campo = $_POST['campo'];
      $clave = $_POST['clave'];
      $valor = $_POST['valor'];
      $objUsuario=new Usuario();                   
      $objUsuario->modificar($campo,$clave,$valor);
      break;

    case 'modificarPerfil':
      $tabla = $_POST['tabla'];//1 = Usuario, 2 = Administrador, 3 = Profesor, 4 = Estudiante
      $campo = $_POST['campo'];
      $clave = $_POST['clave'];
      $valor = $_POST['valor'];
      $objUsuario=new Usuario(); 
      if($tabla==1){
        $objUsuario->modificar($campo,$clave,$valor);
      }
      if($tabla==2){
        $objUsuario->modificarDato($tabla-2,$campo,$clave,$valor);
      }                  
      if($tabla==3){
        $objUsuario->modificarDato($tabla-2,$campo,$clave,$valor);
      }
      if($tabla==4){
        $objUsuario->modificarDato($tabla-2,$campo,$clave,$valor);
      }
      break;

    case 'cambiarContrasena':
      $usuario = $_POST['usuario'];
      $contrasenaNueva = $_POST['contrasenaNueva'];
      $contrasenaActual = $_POST['contrasenaActual'];

      $objUsuario = new Usuario();
      $contraBDt = $objUsuario->contrasena($usuario);
      if($contrasenaActual==$contraBDt){
        $objUsuario->cambiarContrasena($usuario,$contrasenaNueva);
      }else{
        echo "<script>alertify.error('No se actualizó el dato en el perfil la contrasena actual no coincide con la guardada'); </script>";
      }
      break;

    case 'value':
      # code...
      break;

    
    default:
      # code...
      break;
  }

/*
  if($accion=='cambiarFoto'){ 
      $usuario = $_POST['idUsuario'];
      $fotoAnterior = $_POST['fotoAnterior'];
      if ($_FILES["archivoImagen"]["error"] > 0){
          echo "ha ocurrido un error, al cargar la imagen";
      }

      if(isset($_FILES['archivoImagen'])){
          $archivo = $_FILES['archivoImagen'];
          
          $objUsuario=new Usuario();                   
          $objUsuario->cambiarFoto($usuario,$fotoAnterior,$archivo);                       
      }else{
          echo '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  No se pudo recibir el archivo con la imágen.
              </div>';
      }
  }  
*/
 ?>