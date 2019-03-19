<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioGrupo.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}

Conexion::abrir_conexion();
ControlSesion::cambiar_grupo($_GET['g']);
$grupo = RepositorioGrupo::obtener_grupo_por_id(Conexion::obtener_conexion(), $_GET['g']);
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_GET['u']);
$usuario -> cambiar_grupo($_GET['g']);
RepositorioUsuario::actualizar_usuario(Conexion::obtener_conexion(),$usuario);

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
          <a class="nav-link" href="<?php echo SERVIDOR?>"><i class='fas fa-chevron-left' style='font-size:27px'></i></a>
        </li>
      </ul>
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <hr>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CHAT;?>?g=<?php echo $_SESSION['grupo_usuario'];?>">
              Chat  <i class='  far fa-comment' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CHAT;?>?g=<?php echo $_SESSION['grupo_usuario'];?>">
              Notas  <i class='far fa-calendar-check' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CHAT;?>?g=<?php echo $_SESSION['grupo_usuario'];?>">
              Archivos  <i class='far fa-folder-open' style='font-size:20px'></i>
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CHAT;?>?g=<?php echo $_SESSION['grupo_usuario'];?>">
              Añadir integrante  <i class='fas fa-user-plus' style='font-size:15px'></i>
            </a>
          </li>
        </ul>
         <hr>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><strong>Integrantes</strong></span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
              <a class="nav-link text-muted" href="#"><i class='fas fa-user' style='font-size:12px'></i>&nbspTest...</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-muted" href="#"><i class='fas fa-user' style='font-size:12px'></i>&nbspTest...</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-muted" href="#"><i class='fas fa-user' style='font-size:12px'></i>&nbspTest...</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-muted" href="#"><i class='fas fa-user' style='font-size:12px'></i>&nbspTest...</a>
          </li>
        </ul>
        <hr>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=grupo">
              Configuración  <i class='fas fa-cogs' style='font-size:20px'></i>
            </a>
          </li>
        </ul>
      </div>
    </nav>



      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div style="position: relative;" class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <i class='fas fa-group h1' style="color: #6C757D; margin-right: 20px;"></i>

          <div>
            <label style="color: #6C757D;" class="h3">Grupo&nbsp<strong><?php echo $grupo -> obtener_nombre();?></strong></label>
            <label style="color: #6C757D;" class="h6"><?php echo $grupo -> obtener_descripcion();?></label>

          </div>

          <div style="position: absolute; left: 85%;" class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-secondary">Nueva nota&nbsp<i class='far fa-edit' style='font-size:17px'></i></a>
              </div>
          </div>

          <br>
        </div>
        <?php //echo $alerta_grupo;?>



        <div class="alert alert-warning">
          <span class="closebtn" style="color: #85641D;" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong><i class='fas fa-bullhorn' style='font-size:17px'></i>  Dirección:</strong><br>
          Prueba de texto para nota. 
          <hr>
          <label style="text-align: right;">10:00 pm</label>
        </div>
        
        <div class="alert alert-success">
          <span class="closebtn" style="color: #155724;" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong><i class='fas fa-palette' style='font-size:17px'></i>  Departamento de arte:</strong><br>
          Prueba de texto para nota. 
          <hr>
          <label style="text-align: right;">10:00 pm</label>
        </div>

        <div class="alert alert-info">
          <span class="closebtn" style="color: #0C5460;" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong><i class='fas fa-theater-masks' style='font-size:17px'></i>  Casting:</strong><br>
          Prueba de texto para nota. 
          <hr>
          <label style="text-align: right;">10:00 pm</label>
        </div>

        <div class="alert alert-danger">
          <span class="closebtn" style="color: #721C24;" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong><i class='fas fa-exclamation' style='font-size:17px'></i>  Atención:</strong><br>
          Prueba de texto para nota. 
          <hr>
          <label style="text-align: right;">10:00 pm</label>
        </div>




        <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo nota</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="post" action="index.php">
            <div class="dropdown">
              <button class="nav-link text-muted" data-toggle="dropdown">
                    Tipo <i class='fa fa-users' style='font-size:20px'></i>
                  </button>
              <div class="dropdown-menu">
                <a class="dropdown-item nav-link text-muted" data-toggle="modal" data-target="#exampleModal">Nuevo Grupo&nbsp&nbsp<i class='far fa-edit' style='font-size:14px'></i></a>
                <hr>
                <div id="listaGrupos"></div>
              </div>
            </div>
            <textarea rows="5" class="input100 inputText" name="descripcion" placeholder="Ingresa un mensaje"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn colorOficial" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn colorOficial" name="crear_grupo">Siguiente</button>
            </div>
            </form>
          </div>
        </div>
      </div>




      </main>
    </div>
  </div>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function loadGrupos() {
          var req = new XMLHttpRequest();
          req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             document.getElementById("listaGrupos").innerHTML = req.responseText;
            }
          };
          req.open("GET", "app/ListaGrupos.inc.php", true);
          req.send();
        }

        setInterval(function(){loadChat();}, 1000);
      </script>
  </body>
</html>