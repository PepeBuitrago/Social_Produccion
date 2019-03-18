<?php
	include_once 'RepositorioChat.inc.php';
	include_once 'RepositorioUsuario.inc.php';
	include_once 'ControlSesion.inc.php';
	include_once 'Conexion.inc.php';

	Conexion::abrir_conexion();
	$grupo = $_GET['g'];
	$Mensajes = RepositorioChat::obtener_mensajes_por_grupo(Conexion::obtener_conexion(), $grupo);

	foreach ($Mensajes as $fila) {
		$usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $fila -> obtener_usuario());
		if ($fila -> obtener_usuario() == $_GET['u']) {
		?>
		<div class="outgoing_msg">
            <div class="sent_msg">
                <p class=""><?php echo $fila -> obtener_mensaje();?></p>
            	<span class="time_date"> <?php echo $fila -> formatear_fecha($fila -> obtener_fecha());?>    |    <?php echo $usuario -> obtener_nombre();?></span> 
            </div>
        </div>
	<?php
		}else{
	?>
		<div class="incoming_msg">
            <div class="incoming_msg_img"> 
            	<img style="border-radius: 50%" src="<?php echo $usuario -> obtener_foto();?>" alt="sunil"> 
            </div>
            <div class="received_msg">
                <div class="received_withd_msg">
                   	<p><?php echo $fila -> obtener_mensaje();?></p>
                    <span class="time_date"> <?php echo $fila -> formatear_fecha($fila -> obtener_fecha());?>   |    <?php echo $usuario -> obtener_nombre();?></span>
                </div>
        	</div>
        </div>
	<?php
		}
		unset($usuario);
	}
	Conexion::cerrar_conexion();
?>
	
