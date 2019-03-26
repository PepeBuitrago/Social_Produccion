<?php

class Locacion {
    
    private $id;
    private $ususario;
    private $nombre;
    private $descripcion;
    private $url_foto;
    private $coor_x;
    private $coor_y;
    private $coor_z;
    private $fecha_subida;
    private $activo;
    
    public function __construct($id, $ususario, $nombre, $descripcion, $url_foto, $coor_x, $coor_y, $coor_z, $fecha_subida, $activo) {
        $this -> id = $id;
        $this -> ususario = $ususario;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> url_foto = $url_foto;
        $this -> coor_x = $coor_x;
        $this -> coor_y = $coor_y;
        $this -> coor_z = $coor_z;
        $this -> fecha_subida = $fecha_subida;
        $this -> activo = $activo;
    }
    
    public function obtener_id() {
        return $this -> id;
    }

    public function obtener_usuario(){
        return $this -> ususario;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }

    public function obtener_descripcion() {
        return $this -> descripcion;
    }
    
    public function obtener_foto() {
        return $this -> url_foto;
    }

    public function obtener_coor_x() {
        return $this -> coor_x;
    }
    
    public function obtener_coor_y() {
        return $this -> coor_y;
    }

    public function obtener_coor_z() {
        return $this -> coor_z;
    }
    
    public function obtener_fecha() {
        return $this -> fecha_subida;
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

    public function cambiar_foto($foto) {
        $this -> url_foto = $foto;
    }
    
    public function cambiar_coor_x($coor_x) {
        $this -> coor_x = $coor_x;
    }
    
    public function cambiar_coor_y($coor_y) {
        $this -> coor_y = $coor_y;
    }

    public function cambiar_coor_z($coor_z) {
        $this -> coor_z = $coor_z;
    }
    
    public function cambiar_activo($activo) {
        $this -> activo = $activo;
    }

}