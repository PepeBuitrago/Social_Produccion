<?php

class Usuario {
    
    private $id;
    private $nombre;
    private $descripcion;
    private $apellido;
    private $url_foto;
    private $email;
    private $password;
    private $fecha_registro;
    private $activo;
    private $grupo;
    
    public function __construct($id, $nombre, $apellido, $descripcion, $url_foto, $email, $password, $fecha_registro, $activo, $grupo) {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> descripcion = $descripcion;
        $this -> url_foto = $url_foto;
        $this -> email = $email;
        $this -> password = $password;
        $this -> fecha_registro = $fecha_registro;
        $this -> activo = $activo;
        $this -> grupo = $grupo;
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

    public function obtener_apellido() {
        return $this -> apellido;
    }
    
    public function obtener_foto() {
        return $this -> url_foto;
    }

    public function obtener_email() {
        return $this -> email;
    }
    
    public function obtener_password() {
        return $this -> password;
    }
    
    public function obtener_fecha_registro() {
        return $this -> fecha_registro;
    }
    
    public function esta_activo() {
        return $this -> activo;
    }

    public function obtener_grupo() {
        return $this -> grupo;
    }
    
    public function cambiar_nombre($nombre) {
        $this -> nombre = $nombre;
    }

    public function cambiar_descripcion($descripcion) {
        $this -> descripcion = $descripcion;
    }


    public function cambiar_apellido($apellido) {
        $this -> apellido = $apellido;
    }

    public function cambiar_foto($foto) {
        $this -> url_foto = $foto;
    }
    
    public function cambiar_email($email) {
        $this -> email = $email;
    }
    
    public function cambiar_password($password) {
        $this -> password = $password;
    }
    
    public function cambiar_activo($activo) {
        $this -> activo = $activo;
    }

    public function cambiar_grupo($grupo) {
        $this -> grupo = $grupo;
    }

}