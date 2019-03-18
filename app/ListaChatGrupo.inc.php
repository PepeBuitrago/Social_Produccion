<?php
include_once 'RepositorioGrupo.inc.php';
include_once 'RepositorioChat.inc.php';
include_once 'Conexion.inc.php';

Conexion::abrir_conexion();
if($_GET['g'] != 0){
$grupo = RepositorioGrupo::obtener_grupo_por_id(Conexion::obtener_conexion(), $_GET['g']);

$Mensajes = RepositorioChat::obtener_mensajes_por_grupo(Conexion::obtener_conexion(), $_GET['g']);
$mensajes_amoun = count($Mensajes) - 1;

if (count($Mensajes) > 0) {
?>
<h5>Grupo <?php echo $grupo -> obtener_nombre();?><span class="chat_date"><?php echo $Mensajes[$mensajes_amoun] -> formatear_fecha($Mensajes[$mensajes_amoun] -> obtener_fecha());?></span></h5>
<p><?php echo $Mensajes[$mensajes_amoun] -> obtener_mensaje();?></p>
<?php
}else{
	?><h5>Grupo <?php echo $grupo -> obtener_nombre();?></h5><?php
}
}else{
	?><a href="#"><h5><i class='fas fa-user-plus'></i> Crear nuevo grupo</h5></a><?php
}
Conexion::cerrar_conexion();
?>