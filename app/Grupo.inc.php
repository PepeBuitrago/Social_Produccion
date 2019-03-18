<?php

class Grupo {
    
    private $id;
    private $nombre;
    private $descripcion;
    private $admin_id;
    private $fecha_creacion;
    private $activo;

    public function __construct($id, $nombre, $descripcion, $admin_id, $fecha_creacion, $activo) {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> admin_id = $admin_id;
        $this -> fecha_creacion = $fecha_creacion;
        $this -> activo = $activo;
    }

    public function obtener_id() {
        return $this -> id;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }

    public function obtener_descripcion() {
        return $this -> descripcion;
    }

    public function obtener_admin() {
        return $this -> admin_id;
    }

    public function obtener_fecha() {
        return $this -> fecha_creacion;
    }

    public function esta_activo() {
        return $this -> activo;
    }

    public function cambiar_nombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function cambiar_descripcion($descripcion) {
        $this -> descripcion = $descripcion;
    }

    public function cambiar_activo($activo) {
        $this -> activo = $activo;
    }
}
?>