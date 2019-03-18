<?php
include_once 'Conexion.inc.php';
include_once 'ControlSesion.inc.php';
include_once 'RepositorioGrupo.inc.php';

Conexion::abrir_conexion();

$grupos = RepositorioGrupo::obtener_grupos_por_user(Conexion::obtener_conexion(), $_GET['u']);

if (count($grupos)) {
    foreach ($grupos as $fila) {?>
      <a class="dropdown-item nav-link text-muted" href="<?php echo RUTA_GRUPO.'?g='.$fila -> obtener_id();?>&u=<?php echo $_GET['u'];?>">»&nbsp&nbsp<?php echo $fila -> obtener_nombre();?></a>
      <?php
    }
}

unset($grupos);

Conexion::cerrar_conexion();
?>