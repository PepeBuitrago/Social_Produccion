<?php
class RepositorioNota{

    public static function insertar_nota($conexion, $usuario, $grupo, $titulo, $mensaje) {
        $nota_insertada = false;
        
        if (isset($conexion)) {
            try {
                $icono = "far fa-sticky-note";
                $color = "warning";

                $sql = "INSERT INTO notas(grupo_id, usuario_id, icono, color, titulo, mensaje, fecha_envio, activo) VALUES(:grupo_id, :usuario_id, :icono, :color, :titulo, :mensaje, NOW(), 1)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':grupo_id', $grupo, PDO::PARAM_STR);
                $sentencia -> bindParam(':usuario_id', $usuario, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
                $sentencia -> bindParam(':icono', $icono, PDO::PARAM_STR);
                $sentencia -> bindParam(':color', $color, PDO::PARAM_STR);
                
                $nota_insertada = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $nota_insertada;
    }

    public static function obtener_nota_por_grupo($conexion, $grupo) {
        $notas = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'Nota.inc.php';
                
                $sql = "SELECT * FROM notas WHERE grupo_id =".$grupo." ORDER BY id DESC";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $notas[] = new Nota(
                                $fila['id'], $fila['grupo_id'], $fila['usuario_id'], $fila['icono'], $fila['color'], $fila['titulo'], $fila['mensaje'], $fila['fecha_envio'], $fila['activo']
                        );
                    }
                }                
            }catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $notas;
    }
}
?>