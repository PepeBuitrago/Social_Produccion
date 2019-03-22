<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 style="color: #6C757D;" class="h2">Locaciones</h1>
	<div class="btn-toolbar mb-2 mb-md-0">
	    <div class="btn-group mr-2">
	        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#locacionModal">Compartir&nbsp<i class='fas fa-map-marker-alt' style='font-size:17px'></i></button>
	    </div>
	 </div>
</div>

<?php
if(isset($_POST['compartir_locacion'])){
	if(RepositorioLocaciones::insertar_locacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $_POST['nombre_locacion'], $_POST['descripcion_locacion'], $_POST['foto_locacion'], $_POST['coor_x'], $_POST['coor_y'])){
 	echo '<script type="text/javascript">alert("Locacion agregada");</script>';}
}
?>

<div class="containerLocacion" id="listaLocaciones">
	<!--<div class="itemLocacion">
		<img src="https://lorempixel.com/400/300">
		<h1 class="h4"><i class='fas fa-map-marker-alt' style='font-size:17px'></i> Nombre locación</h1>
		<p>Prueba de descripción de una locación. Prueba de descripción de una locación.</p>
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
	</div>-->
	
</div>

<hr>


<!-- Modal -->
			<div class="modal fade" id="locacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 style="color: #6C757D;" class="modal-title" id="exampleModalLabel"><i class='fas fa-map-marked-alt' style='font-size:30px'></i>  |  Compartir locación</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			      <form method="post" action="index.php?p=Locaciones">
			      	<label class="">Nombre</label>
					<input class="input100 inputText" type="text" name="nombre_locacion" placeholder="Ingresa un nombre" required="true">
					<br>
					<label class="">Descripción</label>
					<br>
					<textarea rows="3" class="input100 inputText" name="descripcion_locacion" placeholder="Ingresa una descripción corta" required="true"></textarea>
					<label class="" for="foto_locacion">Foto</label>
					<input type="file" name="foto_locacion" id="foto_locacion" required="true">
					<hr>
					<input type="hidden" name="coor_x" id="coor_x">
					<input type="hidden" name="coor_y" id="coor_y">
					<div class="input-group">
    					<input type="text" class="form-control" placeholder="Agregar etiquetas">
	    				<div class="input-group-btn">
	      					<button class="btn btn-default colorOficial" type="button"><i class='fas fa-tags' style='font-size:15px'></i></button>
	    				</div>
  					</div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn colorOficial" data-dismiss="modal">Cancelar</button>
			        <button type="submit" class="btn colorOficial" name="compartir_locacion">Siguiente</button>
			      </div>
			      </form>
			    </div>
			  </div>
			</div>


<script type="text/javascript">
		function loadSitios() {
          var req = new XMLHttpRequest();
          req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             document.getElementById("listaLocaciones").innerHTML = req.responseText;
            }
          };
          req.open("GET", "app/locacion.inc.php", true);
          req.send();
        }
        loadSitios();
        //setInterval(function(){loadSitios();}, 1000);
</script>