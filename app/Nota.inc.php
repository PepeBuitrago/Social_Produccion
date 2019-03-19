<?php
class Nota{

	private $id;
	private $grupo_id;
	private $usuario_id;
    private $icono;
    private $color;
    private $titulo;
	private $mensaje;
	private $fecha_envio;
	private $activo;

	public function __construct($id, $grupo_id, $usuario_id, $icono, $color, $titulo, $mensaje, $fecha_envio, $activo) {
        $this -> id = $id;
        $this -> grupo_id = $grupo_id;
        $this -> usuario_id = $usuario_id;
        $this -> icono = $icono;
        $this -> color = $color;
        $this -> titulo = $titulo;
        $this -> mensaje = $mensaje;
        $this -> fecha_envio = $fecha_envio;
        $this -> activo = $activo;
    }

    public function obtener_id() {
        return $this -> id;
    }

    public function obtener_grupo() {
        return $this -> grupo_id;
    }

    public function obtener_usuario() {
        return $this -> usuario_id;
    }

    public function obtener_icono() {
        return $this -> icono;
    }

    public function obtener_color() {
        return $this -> color;
    }

    public function obtener_titulo() {
        return $this -> titulo;
    }

    public function obtener_mensaje() {
        return $this -> mensaje;
    }

    public function obtener_fecha() {
        return $this -> fecha_envio;
    }

    public function esta_activo() {
        return $this -> activo;
    }

    public function formatear_fecha($fecha){
        return date('g:i a', strtotime($fecha));
    }
}
?>