<?php
	include_once 'RepositorioNota.inc.php';
	include_once 'RepositorioUsuario.inc.php';
	include_once 'ControlSesion.inc.php';
	include_once 'Conexion.inc.php';

	Conexion::abrir_conexion();
	$grupo = $_GET['g'];
	$notas = RepositorioNota::obtener_nota_por_grupo(Conexion::obtener_conexion(), $grupo);

	foreach ($notas as $fila) {
		$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $fila -> obtener_usuario());

		?><div class="alert alert-warning">
          <span class="closebtn" style="color: #85641D;" onclick="this.parentElement.style.display='none';">&times;</span> 
          <strong><i class='<?php echo $fila -> obtener_icono(); ?>' style='font-size:17px'></i>  <?php echo $fila -> obtener_titulo(); ?></strong><br>
          <?php echo $fila -> obtener_mensaje(); ?> 
          <hr>
          <label style="text-align: right;"><?php echo $fila -> formatear_fecha($fila -> obtener_fecha());?> |  <strong><?php echo $_GET['u']; ?></strong></label>
        </div><?php
		
		unset($usuario);
	}

	Conexion::cerrar_conexion();
?>
	