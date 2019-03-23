<?php
	include_once 'RepositorioLocaciones.inc.php';
	include_once 'RepositorioUsuario.inc.php';
	include_once 'ControlSesion.inc.php';
	include_once 'Conexion.inc.php';

	Conexion::abrir_conexion();
	$locaciones = RepositorioLocaciones::obtener_todo(Conexion::obtener_conexion());

foreach ($locaciones as $fila) {
?>
<div class="itemLocacion">
	<img src="<?php echo $fila -> obtener_foto(); ?>">
	<h1 class="h4"><i class='fas fa-map-marker-alt' style='font-size:17px'></i> <?php echo $fila -> obtener_nombre(); ?></h1>
	<p style="max-width: 100%;"><?php echo $fila -> obtener_descripcion(); ?></p>
	<div>
		<p>
			<span class="w3-tag w3-small w3-theme-d5">tag</span>
			<span class="w3-tag w3-small w3-theme-d4">tag</span>
			<span class="w3-tag w3-small w3-theme-d3">tag</span>
			<span class="w3-tag w3-small w3-theme-d2">tag</span>
			<span class="w3-tag w3-small w3-theme-d1"> tag</span>
			<span class="w3-tag w3-small w3-theme">tag</span>
			<span class="w3-tag w3-small w3-theme-l1">tag</span>
		</p>
	</div>
</div>
<?php
}
	Conexion::cerrar_conexion();
?>