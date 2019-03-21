<?php

include_once 'app/RepositorioRecuperacionClave.inc.php';
include_once 'app/Redireccion.inc.php';

Conexion::abrir_conexion();

if (RepositorioRecuperacionClave::url_secreta_existe(Conexion::obtener_conexion(), $url_personal)) {
  $id_usuario = RepositorioRecuperacionClave::obtener_id_usuario_mediante_url_secreta(Conexion::obtener_conexion(), $url_personal);

} else {
  //lanzar error 404
  echo '404';
}

if (isset($_POST['guardar-clave'])) {
  //validar clave 1
  //comprobar si la clave 2 coincide

  //convertir en transaccion
  $clave_cifrada = password_hash($_POST['clave'], PASSWORD_DEFAULT);
  $clave_actualizada = RepositorioUsuario::actualizar_password(Conexion::obtener_conexion(), $id_usuario, $clave_cifrada);
  //eliminar solicitud de recuperación de contraseña

  //redirigir a notificacion de actualizacion correcta y ofrecer link a login
  if ($clave_actualizada) {
    Redireccion::redirigir(RUTA_LOGIN);
  } else {
    //informar del error
    echo 'ERROR';
  }
}

Conexion::cerrar_conexion();

$titulo = 'Recuperación de contraseña';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<img src="https://lorempixel.com/400/400" id="target">

  <script type="text/javascript">


      jQuery(function($) {
          $('#target').Jcrop({
              onSelect:    showCoords,
              bgColor:     'black',
              bgOpacity:   .4,
              setSelect:   [ 200, 200, 0, 0 ],
              aspectRatio: 1 / 1
          });
      });

      function showCoords(c){
        alert('X: ' + c.x + ' / Y: ' + c.y);
      };



  </script>