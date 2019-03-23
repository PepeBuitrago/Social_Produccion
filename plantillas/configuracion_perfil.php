<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <i class='fas fa-cogs h1' style="color: #6C757D; margin-right: 20px;"></i>
  <h1 style="color: #6C757D;" class="h3">Configuración de perfil</h1>
</div>
<div style="text-align: center;">
<form method="post" action="<?php echo RUTA_CONFIGURACION?>?config=perfil" enctype="multipart/form-data">
  <div class="jumbotron">
    <div class="imagen_contenedor">
      <img id="imgUser" width="200" height="200" class="imagenConfig img-thumbnail" src="<?php echo $usuario -> obtener_foto();?>">
      <br>
        <label class="btn btn-default btn-file colorOficial editImg" for="foto"><i class='fas fa-edit' style='font-size:15px'></i></label>
      <input type="file" name="foto" id="foto">
    </div>
  </div>
  Nombre&nbsp&nbsp
  <input class="inputText" type="text" name="nombre" placeholder="<?php echo $usuario -> obtener_nombre();?>">
  <br>
  Apellidos&nbsp&nbsp
  <input class="inputText" type="text" name="apellido" placeholder="<?php echo $usuario -> obtener_apellido();?>">
  <br>
  Email&nbsp&nbsp
  <input class="inputText" type="email" name="email" placeholder="<?php echo $usuario -> obtener_email();?>">
  <br>
  Descripción&nbsp&nbsp
  <br>
  <textarea style="padding: 5px;" class="inputText" type="text" name="descripcion" placeholder="<?php echo $usuario -> obtener_descripcion();?>"></textarea>
  <hr>
  <input type="hidden" id="x" name="x" />
  <input type="hidden" id="y" name="y" />
  <input type="hidden" id="w" name="w" />
  <input type="hidden" id="h" name="h" />

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
<hr>