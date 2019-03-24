<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioChat.inc.php';
include_once 'app/Mensaje.inc.php';

if (!ControlSesion::sesion_iniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
}
Conexion::abrir_conexion();
$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

if (isset($_POST['enviar']) && isset($_GET['g']) && $_GET['g'] != 0) {
  if (RepositorioChat::insertar_mensaje(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $_GET['g'], $_POST['mensaje'])) {
    echo '<embed hidden="true" src="Beep.mp3" autoplay="true" loop="false"></embed>';
  }
}

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
    <link rel="stylesheet" type="text/css" href="css/chat.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	</head>

	<body>
    <nav class="navbar navbar-dark fixed-top colorOficial flex-md-nowrap p-0">
  	  <ul class="navbar-nav px-3">
  	    <li class="nav-item text-nowrap">
  	      <a class="nav-link" href="<?php echo RUTA_GRUPO.'?g='.$_GET['g'].'&u='.$_GET['u'];?>"><i class='fas fa-chevron-left' style='font-size:27px'></i></a>
  	    </li>
  	  </ul>
  	</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-4 bg-light sidebar">
      <div class="sidebar-sticky">
        <div class="nav flex-column">
          <div class="chat_list active_chat">
                <div class="chat_people">
                  <div class="chat_img"> <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-group-512.png" style="border-radius: 50%" alt="sunil"> </div>
                  <div class="chat_ib" id="ListaGrupo"></div>
                </div>
              </div>
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"> <img style="border-radius: 50%" src="https://scontent.feoh4-2.fna.fbcdn.net/v/t1.0-9/35804818_10214831358196613_4687025607429586944_n.jpg?_nc_cat=111&_nc_ht=scontent.feoh4-2.fna&oh=c98e314184d499c570887c3eedbe7907&oe=5D21243F" alt="sunil"> </div>
                  <div class="chat_ib">
                    <h5>Pepe <span class="chat_date">Dec 25</span></h5>
                    <p>Test, which is a new approach to have all solutions 
                      astrology under one roof.</p>
                  </div>
                </div>
              </div>
              <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_img"> <img style="border-radius: 50%" src="https://static1.squarespace.com/static/51d245aae4b02a811927ccf9/52759543e4b0c10d4aa174e2/53690fe6e4b04e767ae98650/1399394280673/ROBOT-GIF.gif" alt="sunil"> </div>
                  <div class="chat_ib">
                    <h5>Admin <span class="chat_date">Dec 25</span></h5>
                    <p>Test, which is a new approach to have all solutions 
                      astrology under one roof.</p>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </nav>

    <main role="main" class="col-md-8 ml-sm-auto col-lg-10 px-4">
      <div class="mesgs">
            <div class="msg_history" id="msg_history">
              
            </div>
            <div class="type_msg">
              <div class="input_msg_write">
              	<form method="post" action="chat.php?g=<?php echo $_SESSION['grupo_usuario'];?>">
              		<input type="text" class="write_msg" placeholder="Escribe un mensaje..." name="mensaje" autocomplete="off" />
                  <button class="file_send_btn colorOficial" type="button" name="file"><i class='fas fa-paperclip'></i></button>
                	<button class="msg_send_btn colorOficial" type="submit" name="enviar"><i class='fas fa-paper-plane'></i></button>
              	</form>
              </div>
            </div>
          </div>
    </main>

    
</div>
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function loadChat() {
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           document.getElementById("msg_history").innerHTML = this.responseText;
          }
        };
        req.open("GET", "app/chat.inc.php?u=<?php echo $_SESSION['id_usuario'];?>&g=<?php echo $_SESSION['grupo_usuario'];?>", true);
        req.send();

        var req2 = new XMLHttpRequest();
        req2.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           document.getElementById("ListaGrupo").innerHTML = this.responseText;
          }
        };
        req2.open("GET", "app/ListaChatGrupo.inc.php?g=<?php echo $_SESSION['grupo_usuario'];?>", true);
        req2.send();
      }

      setInterval(function(){loadChat();}, 1000);
    </script>
	</body>
</html>