<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    Conexion :: abrir_conexion();
    
    $validador = new ValidadorRegistro($_POST['nombre'], $_POST['apellido'], $_POST['email'],
            $_POST['clave1'], $_POST['clave2'], Conexion :: obtener_conexion());
    
    if ($validador -> registro_valido()) {
        $usuario = new Usuario('', $validador-> obtener_nombre(),
        		$validador -> obtener_apellido(),
        		'',
        		$validador -> obtener_foto(),
                $validador -> obtener_email(), 
                password_hash($validador -> obtener_clave(), PASSWORD_DEFAULT), 
                '', 
                '',
                '');
        $usuario_insertado = RepositorioUsuario::insertar_usuario(Conexion::obtener_conexion(), $usuario);
        
        if ($usuario_insertado) {
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '?n=' . $usuario -> obtener_nombre().' '.$usuario -> obtener_apellido());
        }
    }
    
    Conexion:: cerrar_conexion();
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
	            <a class="nav-link" href="<?php echo RUTA_LOGIN?>">Ingresar</a>
	          </li>
	        </ul>
	      </div>
	    </nav>


		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title" style="background-image: url(images/recursos/bg-03.jpg);">
						<span class="login100-form-title-1">
							Registrarse
						</span>
					</div>
					<form class="login100-form validate-form" method="post" action="registro.php">
						<?php
                        if (isset($_POST['enviar'])) {
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
					</form>
				</div>
			</div>
		</div>


		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>