<?php

class RepositorioArchivo
{
	public static function insertar_subida($conexion, $usuario_id, $url, $nombre, $formato, $size) {
        $registro_insertado = false;
        
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO subida_archivos(usuario_id, url, nombre, formato, size, fecha_subida, activo) VALUES(:usuario_id, :url, :nombre, :formato, :size, NOW(), 1)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':usuario_id', $usuario_id, PDO::PARAM_STR);
                $sentencia -> bindParam(':url', $url, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':formato', $formato, PDO::PARAM_STR);
                $sentencia -> bindParam(':size', $size, PDO::PARAM_STR);
                
                $registro_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $registro_insertado;
    }
}

?>