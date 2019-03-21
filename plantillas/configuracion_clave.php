
<form method="post" action="<?php echo RUTA_CONFIGURACION?>?config=seguridad">
  Nueva contraseña&nbsp&nbsp
  <input class="inputText" type="password" name="pass">
  <br>
  Repetir contraseña&nbsp&nbsp
  <input class="inputText" type="password" name="pass2">
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
              <button type="submit" class="btn colorOficial" name="guardar_clave">Confirmar</button>
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