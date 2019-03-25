<?php
class RepositorioLocaciones{

    public static function insertar_locacion($conexion, $usuario, $nombre, $descripcion, $url_foto, $coor_x, $coor_y) {
        $sitio_insertado = false;
        
        if (isset($conexion)) {
            try {
                
                $sql = "INSERT INTO locaciones(usuario, nombre, descripcion, url_foto, coor_x, coor_y, coor_z, fecha_subida, activo) VALUES(:usuario, :nombre, :descripcion, :url_foto, :coor_x, :coor_y, 1, NOW(), 1)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $sentencia -> bindParam(':url_foto', $url_foto, PDO::PARAM_STR);
                $sentencia -> bindParam(':coor_x', $coor_x, PDO::PARAM_STR);
                $sentencia -> bindParam(':coor_y', $coor_y, PDO::PARAM_STR);
                
                $sitio_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $sitio_insertado;
    }

    public static function obtener_todo($conexion) {
        
        $locaciones = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'Locacion.inc.php';
                
                $sql = "SELECT * FROM locaciones WHERE activo = 1 ORDER BY id DESC";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $locaciones[] = new Locacion(
                                $fila['id'], $fila['nombre'], $fila['descripcion'], $fila['url_foto'], $fila['coor_x'], $fila['coor_y'], $fila['coor_z'], $fila['fecha_subida'], $fila['activo']
                        );
                    }
                } else {
                    echo '<script type="text/javascript">alert("No hay locaciones.");</script>';
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $locaciones;      
    }
}
?>