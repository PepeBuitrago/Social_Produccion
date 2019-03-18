<?php
class RepositorioGrupo{

    public static function insertar_grupo($conexion, $usuario, $nombre, $descripcion) {
        $grupo_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO grupos(nombre, descripcion, admin_id, fecha_creacion, activo) VALUES(:nombre, :descripcion, :admin_id, NOW(), 1)";

                $sql2 = "INSERT INTO integrantes_grupo(grupo_id, usuario_id, fecha_ingreso, admin, activo) VALUES(:grupo_id, :usuario_id, NOW(), 1, 1)";

                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $sentencia -> bindParam(':admin_id', $usuario, PDO::PARAM_STR);
                $grupo_insertado = $sentencia -> execute();

                $sentencia2 = $conexion -> prepare($sql2);
                $lastid = $conexion -> lastInsertId();
                $sentencia2 -> bindParam(':grupo_id', $lastid, PDO::PARAM_STR);
                $sentencia2 -> bindParam(':usuario_id', $usuario, PDO::PARAM_STR);
                $usuario_insertado = $sentencia2 -> execute();

            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $grupo_insertado;
    }

    public static function obtener_grupos_por_user($conexion, $usuario) {
        $grupos = array();

        if (isset($conexion)) {
            
            try {

                include_once 'Grupo.inc.php';

                $sql = "SELECT grupo_id FROM integrantes_grupo WHERE usuario_id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $usuario, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {

                        $sql = "SELECT * FROM grupos WHERE id = :id";

                        $sentencia = $conexion -> prepare($sql);
                        $sentencia -> bindParam(':id', $fila['grupo_id'], PDO::PARAM_STR);
                        $sentencia -> execute();
                        
                        $resultado2 = $sentencia -> fetchAll();

                        if (count($resultado2)) {
                            foreach ($resultado2 as $fila) {
                                $grupos[] = new Grupo($fila['id'], $fila['nombre'], $fila['descripcion'], $fila['admin_id'], $fila['fecha_creacion'], $fila['activo']);
                            }
                        }
                    }
                } else {
                    print '<label class="dropdown-item nav-link text-muted" style=\'font-size:14px\'>No hay grupos</label>';

                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $grupos;
    }

    public static function obtener_grupo_por_id($conexion, $grupo_id) {
        $grupo = null;

        if (isset($conexion)) {
            
            try {

                include_once 'Grupo.inc.php';

                $sql = "SELECT * FROM grupos WHERE id = :grupo";

                        $sentencia = $conexion -> prepare($sql);
                        $sentencia -> bindParam(':grupo', $grupo_id, PDO::PARAM_STR);
                        $sentencia -> execute();
                
                        $resultado = $sentencia -> fetch();
                        
                        if (!empty($resultado)) {
                            $grupo = new Grupo($resultado['id'], $resultado['nombre'], $resultado['descripcion'], $resultado['admin_id'], $resultado['fecha_creacion'], $resultado['activo']);
                        }
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $grupo;
    }

}
?>
