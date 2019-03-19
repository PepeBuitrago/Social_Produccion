<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorLogin.inc.php';
include_once 'app/ControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioNota.inc.php';

Conexion::abrir_conexion();

echo RepositorioNota::insertar_nota(Conexion::obtener_conexion(), 1, 1, 'Test', 'Test_');

?>

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


