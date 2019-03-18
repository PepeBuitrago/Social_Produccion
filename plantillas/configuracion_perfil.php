
<form method="post" enctype="multipart/form-data">

  <div class="imagen_contenedor">
    <img id="imgUser" class="imagenConfig" src="<?php echo $usuario -> obtener_foto();?>">
    <br>
      <label class="btn btn-default btn-file colorOficial" for="foto"><i class='fas fa-edit' style='font-size:15px'></i></label>
    <input type="file" name="foto" id="foto">
  </div>

<br><br>
  Nombre&nbsp&nbsp
  <input class="inputText" type="text" name="nombre" placeholder="<?php echo $usuario -> obtener_nombre();?>">
  <br>
  Apellidos&nbsp&nbsp
  <input class="inputText" type="text" name="apellido" placeholder="<?php echo $usuario -> obtener_apellido();?>">
  <br>
  Email&nbsp&nbsp
  <input class="inputText" type="email" name="email" placeholder="<?php echo $usuario -> obtener_email();?>">
  <br>
  <hr>


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content text-justify">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Debemos confirmar tu identidad antes de realizar los cambios.
              <input class="input100 inputText" type="password" name="pass" placeholder="Ingresa tu contraseña">
              <div class="text-center">
                <a href="#" class="txt1">
                  ¿OLvidaste tu contraseña?
                </a>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn colorOficial" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn colorOficial" name="guardar_cambios">Confirmar</button>
            </div>
          </div>
        </div>
      </div>
</form>
<div class="container-login100-form-btn">
    <button style="position: relative; left: 80%;" class="login100-form-btn colorOficial" data-toggle="modal" data-target="#exampleModal">
    Guardar cambios
    </button>
</div>