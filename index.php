<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioGrupo.inc.php';
include_once 'app/RepositorioLocaciones.inc.php';
include_once 'app/RepositorioArchivo.inc.php';

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
	 	<a class="col-sm-auto col-md-3 imgUser" href="<?php echo RUTA_CONFIGURACION?>?config=perfil"><img style="border-radius: 50%; width: 30px;" src="<?php echo $usuario -> obtener_foto(); ?>">&nbsp&nbsp&nbsp<?php echo $_SESSION['nombre_usuario']; ?></a>
	 	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	  	<div class="collapse navbar-collapse">
	  		<input class="form-control form-control-dark w-100" type="text" placeholder="Buscar" aria-label="Search">
		  	<ul class="navbar-nav px-3">
		    	<li class="nav-item text-nowrap">
		      		<a class="nav-link" href="logout.php">Salir <i class='fas fa-sign-out-alt' style='font-size:15px'></i></a>
		    	</li>
		  	</ul>
	  	</div>
	</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-3 bg-light sidebar navbar-collapse" id="navbarsExample08">
      <div class="sidebar-sticky">
      	<hr>
        <ul class="nav flex-column">
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
			<li class="nav-item">
			    <a class="nav-link text-muted" href="logout.php">
            	Cerrar sesion  <i class='fas fa-sign-out-alt' style='font-size:20px'></i>
            	</a>
			</li>
        </ul>
      </div>
    </nav>

	<main role="main" class="col-md-9 ml-sm-auto">
	      




<?php

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
		?><br><div class="jumbotron" style="background-image: linear-gradient(#718791, #99AFBA); color: white;">
		    <h1><i class='fas fa-bullhorn'></i>  Social Producción</h1>
		  </div><?php
}

if(isset($_POST['crear_grupo'])){
 	if(RepositorioGrupo::insertar_grupo(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $_POST['nombre_grupo'], $_POST['descripcion'])){
 	echo $alerta_grupo;}
}

Conexion::cerrar_conexion();
?>
		


	    </main>
	    	<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 style="color: #6C757D;" class="modal-title" id="exampleModalLabel"><i class='fas fa-users' style='font-size:30px'></i>  |  Nuevo grupo de trabajo</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      <form method="post" action="index.php">
			      	<label class="">Nombre del grupo</label>
					<input class="input100 inputText" type="text" name="nombre_grupo" placeholder="Ingresa un nombre" required="true">
					<br>
					<label class="">Descripción</label>
					<br>
					<textarea rows="3" class="input100 inputText" name="descripcion" placeholder="Ingresa una descripción corta (Opcional)"></textarea>
					<div id="listaIntegrantes">
						<ul>
							<li style="margin-bottom: 10px;">
								<img style="border-radius: 50%;" width="25" src="https://lorempixel.com/800/800">  Test Integrante
							</li>
							<li style="margin-bottom: 10px;">
								<img style="border-radius: 50%;" width="25" src="https://lorempixel.com/800/800">  Test Integrante
							</li>
						</ul>
					</div>
					<br>
					<div class="input-group">
    					<input type="text" class="form-control" placeholder="Buscar participantes">
	    				<div class="input-group-btn">
	      					<button class="btn btn-default colorOficial" type="button"><i class='fas fa-user-plus' style='font-size:15px'></i></button>
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

	      $("#locacionModal").on('show.bs.modal', function () {
				if ("geolocation" in navigator){ //check geolocation available 
				    //try to get user current location using getCurrentPosition() method
				    navigator.geolocation.getCurrentPosition(function(position){ 
				            console.log("Latitud: "+position.coords.latitude+"\nLongitud: "+ position.coords.longitude);
				            $('#coor_x').val(position.coords.longitude);
				            $('#coor_y').val(position.coords.latitude);
				        });
				}else{
				    alert('Tu navegador no soporta la geolocalización.');
				}	
		    });
	    </script>
	</body>
</html>