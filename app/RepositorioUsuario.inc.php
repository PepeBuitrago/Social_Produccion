<?php

class RepositorioUsuario {
 
    public static function obtener_todos($conexion) {
        
        $usuarios = array();
        
        if (isset($conexion)) {
            
            try {
                
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM usuarios";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $usuarios[] = new Usuario(
                                $fila['id'], $fila['nombre'], $fila['apellido'], $fila['descripcion'], $fila['url_foto'], $fila['email'], $fila['password'], $fila['fecha_registro'], $fila['activo'], $fila['grupo']
                        );
                    }
                } else {
                    print 'No hay usuarios';
                }
                
            } catch (PDOException $ex) {
                print "ERROR" . $ex -> getMessage();
            } 
        }
        
        return $usuarios;      
    }
    
    public static function obtener_numero_usuarios($conexion) {
        $total_usuarios = null;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM usuarios";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_usuarios = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $total_usuarios;
    }
    
    public static function insertar_usuario($conexion, $usuario) {
        $usuario_insertado = false;
        
        if (isset($conexion)) {
            try {

                $descripcion = 'Usuario nuevo.';
                $nombre = $usuario -> obtener_nombre();
                $apellido = $usuario -> obtener_apellido();
                $foto = $usuario -> obtener_foto();
                $email = $usuario -> obtener_email();
                $password = $usuario -> obtener_password();


                $sql = "INSERT INTO usuarios(nombre, apellido, descripcion, url_foto, email, password, fecha_registro, activo, grupo) VALUES(:nombre, :apellido, :descripcion, :url_foto, :email, :password, NOW(), 0, 0)";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $sentencia -> bindParam(':apellido', $apellido, PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $sentencia -> bindParam(':url_foto', $foto, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $password, PDO::PARAM_STR);
                
                $usuario_insertado = $sentencia -> execute();
            } catch (PDOException $ex) {
                print 'ERROR' . $ex->getMessage();
            }
        }
        
        return $usuario_insertado;
    }
    
    public static function nombre_existe($conexion, $nombre) {
        $nombre_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $nombre_existe;
    }
    
    public static function email_existe($conexion, $email) {
        $email_existe = true;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $email_existe;
    }
    
    public static function obtener_usuario_por_email($conexion, $email) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'],
                            $resultado['nombre'],
                            $resultado['apellido'],
                            $resultado['descripcion'],
                            $resultado['url_foto'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['fecha_registro'],
                            $resultado['activo'],
                            $resultado['grupo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }
    
    public static function obtener_usuario_por_id($conexion, $id) {
        $usuario = null;
        
        if (isset($conexion)) {
            try {
                include_once 'Usuario.inc.php';
                
                $sql = "SELECT * FROM usuarios WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetch();
                
                if (!empty($resultado)) {
                    $usuario = new Usuario($resultado['id'],
                            $resultado['nombre'],
                            $resultado['apellido'],
                            $resultado['descripcion'],
                            $resultado['url_foto'],
                            $resultado['email'],
                            $resultado['password'],
                            $resultado['fecha_registro'],
                            $resultado['activo'],
                            $resultado['grupo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuario;
    }

    public static function actualizar_password($conexion, $id_usuario, $nueva_clave) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try  {
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";

                $sentencia = $conexion -> prepare($sql);

                $sentencia -> bindParam(':password', $nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id_usuario, PDO::PARAM_STR);

                $sentencia -> execute();

                $resultado = $sentencia -> rowCount();

                if (count($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
            } catch(PDOException $ex) {
                print 'ERROR'.$ex -> getMessage();
            }
        }

        return $actualizacion_correcta;
    }

    public static function actualizar_usuario($conexion, $usuario) {
        $actualizacion_correcta = false;

        if (isset($conexion)) {
            try  {
                $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, descripcion = :descripcion, url_foto = :url_foto, email = :email, activo = :activo, grupo = :grupo WHERE id = :id";

                $sentencia = $conexion -> prepare($sql);
                $nombre_nuevo = $usuario -> obtener_nombre();
                $apellido_nuevo = $usuario -> obtener_apellido();
                $descripcion_nuevo = $usuario -> obtener_descripcion();
                $foto_nuevo = $usuario -> obtener_foto();
                $email_nuevo = $usuario -> obtener_email();
                $activo_nuevo = $usuario -> esta_activo();
                $grupo_nuevo = $usuario -> obtener_grupo();
                $id_nuevo = $usuario -> obtener_id();
                $sentencia -> bindParam(':nombre', $nombre_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':apellido', $apellido_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion', $descripcion_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':url_foto', $foto_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $email_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':activo', $activo_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':grupo', $grupo_nuevo, PDO::PARAM_STR);
                $sentencia -> bindParam(':id', $id_nuevo, PDO::PARAM_STR);

                $sentencia -> execute();

                $resultado = $sentencia -> rowCount();

                if (!empty($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }
            } catch(PDOException $ex) {
                print 'ERROR'.$ex -> getMessage();
            }
        }

        return $actualizacion_correcta;
    }
}