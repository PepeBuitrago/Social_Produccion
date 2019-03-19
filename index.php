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
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

if (isset($_POST['nombre_grupo'])) {
	$grupo = $_POST['nombre_grupo'];

	$alerta_grupo = '<div class="alert colorOficial">
			  	<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
			  	<a href="#" style="color: white;">El nuevo grupo <b>'.$grupo.'</b> a sido creado correctamente.</a>
			  	</div>';
}

$alerta_activo = '<div style="background-color: #6ABC6E;" class="alert">
			  	<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
			  	<a href="#" style="color: white;"><strong>¡Hola '.$_SESSION['nombre_usuario'].'!</strong> tu cuenta aun espera a ser activada.</a>
			  	</div>';
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

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">

		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	</head>
	<body>
    <nav class="navbar navbar-expand-lg navbar-dark colorOficial fixed-top">
    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	      </button>
	  <a class="col-sm-3 col-md-2 mr-0" href="<?php echo SERVIDOR;?>?p=Perfil"><img style="border-radius: 50%; width: 30px;" src="<?php echo $usuario -> obtener_foto(); ?>">&nbsp&nbsp&nbsp<?php echo $_SESSION['nombre_usuario']; ?></a>
	  <div class="collapse navbar-collapse" id="navbarsExample08">
	  	<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		  <ul class="navbar-nav px-3">
		    <li class="nav-item text-nowrap">
		      <a class="nav-link" href="logout.php">Salir <i class='fas fa-sign-out-alt' style='font-size:15px'></i></a>
		    </li>
		  </ul>
	  </div>
	</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
      	<hr>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo SERVIDOR;?>">
              Inicio  <i class='fas fa-home' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo SERVIDOR;?>?p=Archivos">
              Archivos  <i class='fas fa-folder-open' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo SERVIDOR;?>?p=Perfil">
              Mi perfil  <i class='fas fa-user-circle' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo SERVIDOR;?>?p=Locaciones">
              Locaciones  <i class='fas fa-map-marked-alt' style='font-size:20px'></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted" href="<?php echo RUTA_CHAT;?>">
              Chat  <i class='far fa-comment' style='font-size:20px'></i>
            </a>
          </li>
        </ul>
        <hr>
        <ul class="nav flex-column">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><strong>Grupos de trabajo</strong></span>
        </h6>
          <li class="nav-item">
            <a style='font-size:10px' class="nav-link text-muted" data-toggle="modal" data-target="#exampleModal">
              Nuevo grupo  <i class='fas fa-plus'></i>
            </a>
          </li>
        <div id="listaGruposHome"></div>
        <hr>
        </ul>
        
        
        <ul class="nav flex-column mb-2">
        	<li class="nav-item">
			    <a class="nav-link text-muted" href="<?php echo RUTA_CONFIGURACION?>?config=perfil">
            	Configuración  <i class='fas fa-cogs' style='font-size:20px'></i>
            	</a>
			</li>
        </ul>
      </div>
    </nav>

	    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	      




<?php

if(isset($_POST['crear_grupo'])){
 	if(RepositorioGrupo::insertar_grupo(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $_POST['nombre_grupo'], $_POST['descripcion'])){
 	echo $alerta_grupo;}
}

if (isset($_GET['p'])) {
	if ($_GET['p'] == "Archivos") {
		include_once 'plantillas/archivos.inc.php';
	}
}

if (isset($_GET['p'])) {
	if ($_GET['p'] == "Locaciones") {
		include_once 'plantillas/locaciones.inc.php';
	}
}

if (isset($_GET['p'])) {
	if ($_GET['p'] == "Perfil") {
		include_once 'plantillas/perfil.inc.php';
	}
}else{
		?><br><div class="jumbotron colorOficial">
		    <h1><i class='fas fa-bullhorn'></i>  Social Producción</h1>
		  </div><?php
}

if(!$usuario -> esta_activo()){
	echo $alerta_activo;
}

Conexion::cerrar_conexion();
?>
		
		


	    </main>
	    	<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Nuevo grupo de trabajo</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      <form method="post" action="index.php">
			      	<label class="">Nombre del grupo</label>
					<input class="input100 inputText" type="text" name="nombre_grupo" placeholder="Ingresa un nombre">
					<br>
					<label class="">Descripción</label>
					<br>
					<textarea rows="3" class="input100 inputText" name="descripcion" placeholder="Ingresa una descripción corta (Opcional)"></textarea>
					<div class="input-group">
    				<input type="text" class="form-control" placeholder="Buscar participantes">
    				<div class="input-group-btn">
      				<button class="btn btn-default colorOficial" type="submit">
        			<i class='fas fa-user-plus' style='font-size:15px'></i>
      				</button>
    				</div>
  					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn colorOficial" data-dismiss="modal">Cancelar</button>
			        <button type="submit" class="btn colorOficial" name="crear_grupo">Siguiente</button>
			      </div>
			      </form>
			    </div>
			  </div>
			</div>

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
	           document.getElementById("listaGruposHome").innerHTML = req.responseText;
	          }
	        };
	        req.open("GET", "app/ListaGrupos.inc.php?u=<?php echo $_SESSION['id_usuario'];?>", true);
	        req.send();
	      }

	      setInterval(function(){loadGrupos();}, 1000);
	    </script>
	</body>
</html>