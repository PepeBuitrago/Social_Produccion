<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioLocaciones.inc.php';
include_once 'app/RepositorioUsuario.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}
Conexion::abrir_conexion();
$locacion = RepositorioLocaciones::obtener_locacion_por_id(Conexion::obtener_conexion(), $_GET['s']);
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $locacion -> obtener_usuario());

$alerta_grupo = '<div class="alert colorOficial">
          <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
          <a href="#" style="color: white;">Tu grupo aun no tiene ningun proyecto.</a>
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
  </head>
  <body onload="">
    <nav class="navbar navbar-dark fixed-top colorOficial flex-md-nowrap p-0">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="<?php echo SERVIDOR?>?p=Locaciones"><i class='fas fa-chevron-left' style='font-size:27px'></i></a>
        </li>
      </ul>
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-3 bg-light sidebar">
      <div class="sidebar-sticky">
        <hr>
        <h4 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><span class="h6"><strong>Contacto</strong></span></h4>
        <span class="justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><?php echo $usuario -> obtener_nombre().' '.$usuario -> obtener_apellido(); ?></span>
        <span class="justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><?php echo $usuario -> obtener_email(); ?></span>
        <hr>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link text-muted" href="#">
              Configuración  <i class='fas fa-cogs' style='font-size:20px'></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>



      <main role="main" class="col-md-9 ml-sm-auto">
        <div style="position: relative;" class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        </div>
        <div class="row">
          <div class="img-thumbnail" style="margin: 20px;">
            <img width="400" src="<?php echo $locacion -> obtener_foto(); ?>">
            <div style="width:100%;">
              <img style="width: 400px;" src="https://www.c2dh.uni.lu/sites/default/files/styles/full_width/public/field/image/capture.png?itok=REb8jh_H">
            </div>
            <!--<div id="googleMap" style="width:100%;height:250px;"></div>-->
          </div>
          <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <label style="color: #6C757D;" class="h3"><?php echo $locacion -> obtener_nombre(); ?>
            <br>
            <p>Carrera 48 No. 7 – 151 | El Poblado.</p>
            <p><?php echo $locacion -> obtener_descripcion(); ?></p>
            </label>
          </div>
        </div>
        <hr>
        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam doloribus placeat, cum repellat vitae deleniti quod quos molestiae neque ipsam odit temporibus qui sed. Adipisci dolores debitis optio quod dignissimos!</p>

      </main>
    </div>
  </div>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script>
    function myMap() {
    var mapProp= {
      center:new google.maps.LatLng(51.508742,-0.120850),
      zoom:5,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
  </body>
</html>