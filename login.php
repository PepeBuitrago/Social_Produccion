<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {
    Conexion::abrir_conexion();
    
    $validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::obtener_conexion());
    
    if ($validador -> obtener_error() === '' && !is_null($validador -> obtener_usuario())) {
    	$nombre = $validador -> obtener_usuario() -> obtener_nombre();
    	$apellido = $validador -> obtener_usuario() -> obtener_apellido();
        ControlSesion::iniciar_sesion(
                $validador -> obtener_usuario() -> obtener_id(),
                $nombre.' '.$apellido,
            	$validador -> obtener_usuario() -> obtener_grupo());
        Redireccion::redirigir(SERVIDOR);
    }
    
    Conexion::cerrar_conexion();
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
		<nav class="navbar navbar-expand-lg navbar-dark colorOficial">
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	      </button>

	      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
	        <ul class="navbar-nav">
	          <li class="nav-item active nav-link">
	            SOCIAL PRODUCCIÓN  <span class="sr-only">(current)</span>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="<?php echo RUTA_REGISTRO?>">Registrarse</a>
	          </li>
	        </ul>
	      </div>
	    </nav>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title" style="background-image: url(images/recursos/bg-01.jpg);">
						<span class="login100-form-title-1">
							Ingresar
						</span>
					</div>

					<form class="login100-form validate-form" method="post" action="login.php">
						<div class="wrap-input100 validate-input m-b-26" data-validate="Es necesario un correo electronico">
							<span class="label-input100">Email</span>
							<input class="input100" type="email" name="email" placeholder="Ingresa tu correo electronico" <?php
                               if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                                   echo 'value="' . $_POST['email'] . '"';
                               } 
                               ?>
                               required autofocus>
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Es necesaria una clave de usuario">
							<span class="label-input100">Contraseña</span>
							<input class="input100" type="password" name="clave" placeholder="Ingresa una clave">
							<?php
	                        if (isset($_POST['login'])) {
	                            $validador -> mostrar_error();
	                        }
	                        ?>
							<span class="focus-input100"></span>
						</div>

						<div class="flex-sb-m w-full p-b-30">
							<div class="contact100-form-checkbox">
								<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
								<label class="label-checkbox100" for="ckb1">
									Recordarme
								</label>
							</div>

							<div>
								<a href="#" class="txt1">
									¿OLvidaste tu contraseña?
								</a>
							</div>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn colorOficial" name="login">
								Ingresar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>