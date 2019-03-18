<?php
//info de la base de datos
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'social_prod');

//rutas de la web
define("SERVIDOR", "http://localhost/SP");
define("RUTA_REGISTRO", SERVIDOR."/registro.php");
define("RUTA_CONFIGURACION", SERVIDOR."/configuracion.php");
define("RUTA_GRUPO", SERVIDOR."/grupo.php");
define("RUTA_CHAT", SERVIDOR."/chat.php");
define("RUTA_REGISTRO_CORRECTO", SERVIDOR."/registro-correcto.php");
define("RUTA_LOGIN", SERVIDOR."/login.php");
define("RUTA_LOGOUT", SERVIDOR."/logout");
define("RUTA_ENTRADA", SERVIDOR."/entrada");
define("RUTA_GESTOR", SERVIDOR."/gestor");
define("RUTA_GESTOR_ENTRADAS", RUTA_GESTOR."/entradas");
define("RUTA_GESTOR_COMENTARIOS", RUTA_GESTOR."/comentarios");
define("RUTA_GESTOR_FAVORITOS", RUTA_GESTOR."/favoritos");
define("RUTA_NUEVA_ENTRADA", SERVIDOR."/nueva-entrada");
define("RUTA_BORRAR_ENTRADA", SERVIDOR."/borrar-entrada");
define("RUTA_EDITAR_ENTRADA", SERVIDOR."/editar-entrada");
define("RUTA_RECUPERAR_CLAVE", SERVIDOR."/recuperar-clave");
define("RUTA_GENERAR_URL_SECRETA", SERVIDOR."/generar-url-secreta");
define("RUTA_PRUEBA_MAIL", SERVIDOR."/mail");
define("RUTA_RECUPERACION_CLAVE", SERVIDOR."/recuperacion-clave");
define("RUTA_BUSCAR", SERVIDOR."/buscar");
define("RUTA_PERFIL", SERVIDOR."/perfil");

//recursos
define("RUTA_CSS", SERVIDOR . "/css/");
define("RUTA_JS", SERVIDOR . "/js/");
define("DIRECTORIO_RAIZ", realpath(__DIR__."/.."));