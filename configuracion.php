<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioGrupo.inc.php';
include_once 'app/RepositorioArchivo.inc.php';
include_once 'app/ValidadorLogin.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}
Conexion::abrir_conexion();
$alerta = false;
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);


if (isset($_POST['guardar_clave'])) {
  if($_POST['clave1'] == $_POST['clave2']){
    print $clave_cifrada = password_hash($_POST['clave1'], PASSWORD_DEFAULT);
    $clave_actualizada = RepositorioUsuario::actualizar_password(Conexion::obtener_conexion(), $usuario -> obtener_id(), $clave_cifrada);

    //redirigir a notificacion de actualizacion correcta y ofrecer link a login
    if ($clave_actualizada) {
      Redireccion::redirigir(RUTA_LOGIN);
    } else {
      //informar del error
      echo 'ERROR';
    }
  }
}

if (isset($_POST['guardar_cambios'])) {
  if (!empty($_FILES['foto']['tmp_name'])) {
    $directorio = DIRECTORIO_RAIZ.'/images/perfiles/';
    $carpeta_objetivo = $directorio.basename($_FILES['foto']['name']);
    $subida_correcta = 1;
    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

    $comprobacion = getimagesize($_FILES['foto']['tmp_name']);
    if ($comprobacion != false) {
      $subida_correcta = 1;
    }else{
      $subida_correcta = 0;
    }

    if($_FILES['foto']['size'] > 1000000){
      $alerta = "La imagen no debe ser superior a 1 Mb";
      $subida_correcta = 0;
    }

    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
      $alerta = "Sólo se admiten los formatos JPG, JPEG, PNG y GIF";
      $subida_correcta = 0;
    }
    
    if ($subida_correcta == 0) {
      $alerta = "Tu archivo no puede subirse";
    } else {

      $targ_w = $targ_h = 500;
      $jpeg_quality = 80;

      $src = $_FILES['foto']['tmp_name'];
      $img_r = imagecreatefromjpeg($src);
      $dst_r = ImageCreateTrueColor($targ_w, $targ_h);
      echo '<script type="text/javascript">console.log("X: '.$_POST['x'].' Y: '.$_POST['y'].' W: '.$_POST['w'].' H: '.$_POST['h'].'");</script>';

      imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

      if (imagejpeg($dst_r, "images/perfiles/".basename($_FILES['foto']['tmp_name']), $jpeg_quality)) {
          $subida_correcta = 2;
          $usuario -> cambiar_foto("images/perfiles/".basename($_FILES['foto']['tmp_name']));
          RepositorioUsuario::actualizar_usuario(Conexion::obtener_conexion(),$usuario);
          RepositorioArchivo::insertar_subida(Conexion::obtener_conexion(), $usuario -> obtener_id(), "images/perfiles/".basename($_FILES['foto']['tmp_name']), basename($_FILES['foto']['name']), $tipo_imagen, $_FILES['foto']['size']);
          $alerta = "La imagen ha sido subida correctamente.";
      }else {
        $alerta = "Ha ocurrido un error al subir la imagen.";
      }
    }
  }
  
}

$alerta_imagen = '<div class="alert colorOficial">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <a href="#" style="color: white;">'.$alerta.'</a>
          </div>';

$alerta_activo = '<div style="background-color: #6ABC6E;" class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <a href="#" style="color: white;"><strong>¡Hola '.$_SESSION['nombre_usuario'].'!</strong> tu cuenta aun espera a ser activada.</a>
          </div>';

Conexion::cerrar_conexion();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Social Producción</title>
    <link rel="icon" href="https://images.vexels.com/media/users/3/136972/isolated/preview/237e887ca5cbd7c674b48b9dac8fd02e-television-icon-by-vexels.png" sizes="32x32" >

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
  </head>
  <body onload="">
    <nav class="navbar navbar-dark fixed-top colorOficial flex-md-nowrap p-0">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo SERVIDOR?>"><i class='fas fa-chevron-left' style='font-size:27px'></i></a>
        </li>
      </ul>
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-3 bg-light sidebar">
      <div class="sidebar-sticky">
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=perfil">
              Perfil  <i class='  fas fa-user-cog' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=privacidad">
              Privacidad  <i class='fas fa-user-shield' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=seguridad">
              Seguridad  <i class='fas fa-shield-alt' style='font-size:20px'></i>
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=grupo">
              Grupo  <i class='fas fa-users' style='font-size:20px'></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>



      <main role="main" class="col-md-9 ml-sm-auto">
        <?php 
        if ($_GET['config'] == 'perfil'){
          include_once 'plantillas/configuracion_perfil.php';
        }
        
        if ($_GET['config'] == 'seguridad'){
          include_once 'plantillas/configuracion_clave.php';
        }

        if(isset($_POST['guardar_cambios'])){
          if (isset($subida_correcta)) {
            echo $alerta_imagen;
          }
        }
        ?>
        </div>
        







      <!-- Modal -->
      <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cortar imagen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="modal-body imgCuter">
                <img src="" id="imgTarget">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn colorOficial" data-dismiss="modal" onclick="cancelCut();">Cancelar</button>
              <button type="text" class="btn colorOficial" name="cortar_img" onclick="loadCut();">Cortar  <i class='fas fa-crop-alt' style='font-size:15px'></i></button>
            </div>
            </form>
          </div>
        </div>
      </div>


</main>
      


    </div>
  </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">

        $('#foto').on("change", function(){
          var preview = document.getElementById('imgUser');
          var previewCut = document.getElementById('imgTarget');
          var file    = document.querySelector('input[type=file]').files[0];
          var reader = new FileReader();

          reader.onloadend = function () {
            //preview.src = reader.result;
            previewCut.src = reader.result;
            $("#imgModal").modal();
            if (previewCut.width != previewCut.height) {
              
              if (previewCut.src != "") {
                //loadCut();
              }
            }
            
          }

          if (file) {
            reader.readAsDataURL(file);
          } else {
            preview.src = "";
          }

        });

        function loadCut() {
          jQuery(function($) {
              $('#imgTarget').Jcrop({
                  addClass: 'jcrop-centered',
                  onSelect:    showCoords,
                  bgColor:     'black',
                  bgOpacity:   .4,
                  setSelect:   [ 200, 200, 0, 0 ],
                  aspectRatio: 1 / 1
              });
          });

          function showCoords(c){
            console.log('Crop \nX: '+c.x+'\nY: '+c.y+'\nW: '+c.w+'\nH: '+c.h);
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
          };
        }

        function cancelCut(){
          $('#imgTarget').data('Jcrop').destroy();
        }

        $("#imgModal").on('hidden.bs.modal', function () {
          cancelCut();
        });

        $("#imgModal").on('show.bs.modal', function () {
          //loadCut();
        });

      </script>
  </body>
</html>