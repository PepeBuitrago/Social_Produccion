<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), 2);

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
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark colorOficial">
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	      </button>

	      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo SERVIDOR;?>?p=Perfil"><img style="border-radius: 50%; width: 30px;" src="<?php echo $usuario -> obtener_foto(); ?>">&nbsp&nbsp&nbsp<?php echo $usuario -> obtener_nombre(); ?></a>

	      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
	        <ul class="navbar-nav">
	          <li class="nav-item active nav-link">
	            <a class="nav-link" href="logout.php">Salir <i class='fas fa-sign-out-alt' style='font-size:15px'></i></a>
	          </li>
	        </ul>
	      </div>
	    </nav>

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>



<!--






<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 style="color: #6C757D;" class="h2">Proyectos</h1>
	        <div class="btn-toolbar mb-2 mb-md-0">
	          <div class="btn-group mr-2">
	            <button type="button" class="btn btn-sm btn-outline-secondary"><a href="<?php echo RUTA_CHAT;?>?g=<?php echo $_SESSION['grupo_usuario'];?>">Chat&nbsp<i class='far fa-comment' style='font-size:17px'></i><span style="border-radius: 50%;" class="badge colorOficial">9</span></a></button>
	            <button type="button" class="btn btn-sm btn-outline-secondary"><a href="test.php">Test&nbsp<i class='fas fa-crop' style='font-size:17px'></i></a></button>
	          </div>
	        </div>
	      </div>



<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown"><i class='far fa-calendar-check' style='font-size:17px'></i>&nbspEsta semana</button>

<li class="nav-item">
            <div class="dropdown">
			    <button class="nav-link text-muted" data-toggle="dropdown">
            		Grupos de trabajo <i class='fa fa-users' style='font-size:20px'></i>
            	</button>
			    <div class="dropdown-menu">
			      <a class="dropdown-item nav-link text-muted" data-toggle="modal" data-target="#exampleModal">Nuevo Grupo&nbsp&nbsp<i class='fas fa-plus' style='font-size:14px'></i></a>
			      <hr>
			      <div id="listaGrupos"></div>
			    </div>
			  </div>
          </li>

