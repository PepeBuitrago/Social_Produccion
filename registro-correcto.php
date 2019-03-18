<?php
include_once 'app/config.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if(isset($_GET['n']) && !empty($_GET['n'])){
	$nombre = $_GET['n'];
}
if(isset($_POST['ingresar'])){
	Redireccion::redirigir(RUTA_LOGIN);
}
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
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title" style="background-image: url(images/recursos/bg-02.jpg);">
						<span class="login100-form-title-1">
							Bienvenido<br> <?php echo $nombre?>
						</span>
					</div>

					<form class="login100-form validate-form text-justify" method="post" action="registro-correcto.php">
						<span>Tu cuenta ha sido creada satisfactoriamente, ahora puedes ingresar para comenzar a utilizar tu cuenta.</span>
						<br>
						<a href="<?php echo RUTA_LOGIN?>"> Ingresar</a>
					</form>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>