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
	$alerta = false;
	if($_POST['nombre_locacion'] != "" && $_POST['descripcion_locacion'] != "" && !empty($_FILES['foto_locacion']['tmp_name'])){
		$directorio = DIRECTORIO_RAIZ.'/images/locaciones/';
	    $carpeta_objetivo = $directorio.basename($_FILES['foto_locacion']['name']);
	    $subida_correcta = 1;
	    $tipo_imagen = pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

	    $comprobacion = getimagesize($_FILES['foto_locacion']['tmp_name']);
	    if ($comprobacion != false) {
	      $subida_correcta = 1;
	    }else{
	      $subida_correcta = 0;
	    }

	    if($_FILES['foto_locacion']['size'] > 8000000000){
	      $alerta = "La imagen no debe ser superior a 1 Gb";
	      $subida_correcta = 0;
	    }

	    if ($tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif") {
	      $alerta = "Sólo se admiten los formatos JPG, JPEG, PNG y GIF";
	      $subida_correcta = 0;
	    }
	    
	    if ($subida_correcta == 0) {
	      $alerta = "Tu archivo no puede subirse";
	    } else {
	/*
	      $targ_w = $targ_h = 200;
	      $jpeg_quality = 90;

	      $src = $_FILES['foto']['tmp_name'];
	      $img_r = imagecreatefromjpeg($src);
	      $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

	      imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
	          $targ_w,$targ_h,$_POST['w'],$_POST['h']);

	      header('Content-type: image/jpeg');
	      imagejpeg($dst_r, DIRECTORIO_RAIZ."/images/perfiles/".basename($_FILES['foto']['tmp_name']), $jpeg_quality);
	*/
	      if (move_uploaded_file($_FILES['foto_locacion']['tmp_name'],
	      DIRECTORIO_RAIZ."/images/locaciones/".basename($_FILES['foto_locacion']['tmp_name']))) {
	        $subida_correcta = 2;
		    $foto = "images/locaciones/".basename($_FILES['foto_locacion']['tmp_name']);
			if(RepositorioLocaciones::insertar_locacion(Conexion::obtener_conexion(), $_SESSION['id_usuario'], $_POST['nombre_locacion'], $_POST['descripcion_locacion'], $foto, $_POST['coor_x'], $_POST['coor_y'])){
		 	$alerta = 'Locacion insertada correctamente';}
	        RepositorioArchivo::insertar_subida(Conexion::obtener_conexion(), $usuario -> obtener_id(), "images/perfiles/".basename($_FILES['foto_locacion']['tmp_name']), basename($_FILES['foto_locacion']['name']), $tipo_imagen, $_FILES['foto_locacion']['size']);
	        $alerta = "La imagen ha sido subida correctamente.";
	        echo '<script type="text/javascript">alert('.$alerta.');</script>';
	      }else {
	        $alerta = "Ha ocurrido un error al subir la imagen.";
	      }
	    }
	}
}
?>

<div class="containerLocacion" id="listaLocaciones"></div>

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
			      <form method="post" action="index.php?p=Locaciones" enctype="multipart/form-data">
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
        setInterval(function(){loadSitios();}, 1000);
</script>