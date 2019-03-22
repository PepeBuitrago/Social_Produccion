<br>
<div class="jumbotron">
	<div class="row">
		<div style="margin: 0px 40px 0px 40px;">
			<img class="imagenConfig img-thumbnail" width="200" src="<?php echo $usuario -> obtener_foto(); ?>">
		</div>
		<div style="display: flex; align-items: center;">
			<div>
				<h1><?php echo $_SESSION['nombre_usuario']; ?></h1> 
				<p><?php echo $usuario -> obtener_descripcion(); ?></p>
				<div style="width: 50%;">
					<p>
						<span class="w3-tag w3-small w3-theme-d5">Admin</span>
						<span class="w3-tag w3-small w3-theme-d4">Programador</span>
						<span class="w3-tag w3-small w3-theme-d3">Director</span>
						<span class="w3-tag w3-small w3-theme-d2">Diva</span>
						<span class="w3-tag w3-small w3-theme-d1"> Pre-Suggar Daddy</span>
						<span class="w3-tag w3-small w3-theme">#BaleBergaLaBida</span>
						<span class="w3-tag w3-small w3-theme-l1">Yolo</span>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>