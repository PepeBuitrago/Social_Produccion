<?php
class RepositorioNota{

    public static function insertar_nota($conexion, $usuario, $grupo, $titulo, $mensaje) {
        $nota_insertada = false;
        
        if (isset($conexion)) {
            try {
                $icono = "<i class='far fa-sticky-note' style='font-size:17px'></i>";
                $sql = "INSERT INTO notas(grupo_id, usuario_id, icono, titulo, mensaje, fecha_envio, activo) VALUES(:grupo_id, :usuario_id, :icono, :titulo, :mensaje, NOW(), 1)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':grupo_id', $grupo, PDO::PARAM_STR);
                $sentencia -> bindParam(':usuario_id', $usuario, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $sentencia -> bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
                $sentencia -> bindParam(':icono', $icono, PDO::PARAM_STR);
                
                $nota_insertada = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $nota_insertada;
    }
}
?>