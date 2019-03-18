<?php
class RepositorioChat{

    public static function insertar_mensaje($conexion, $usuario, $grupo, $mensaje) {
        $mensaje_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO chat(grupo_id, usuario_id, mensaje, fecha_envio, activo) VALUES(:grupo_id, :usuario_id, :mensaje, NOW(), 1)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':grupo_id', $grupo, PDO::PARAM_STR);
                $sentencia -> bindParam(':usuario_id', $usuario, PDO::PARAM_STR);
                $sentencia -> bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
                
                $mensaje_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $mensaje_insertado;
    }

    public static function obtener_mensajes_por_grupo($conexion, $grupo) {
        $mensajes = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'Mensaje.inc.php';
                
                $sql = "SELECT * FROM chat WHERE grupo_id =".$grupo;
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $mensajes[] = new Mensaje(
                                $fila['id'], $fila['grupo_id'], $fila['usuario_id'], $fila['mensaje'], $fila['fecha_envio'], $fila['activo']
                        );
                    }
                }                
            }catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $mensajes;
    }
}
?>