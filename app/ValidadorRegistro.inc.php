<?php
include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro {
    
    private $aviso_inicio;
    private $aviso_cierre;
    
    private $nombre;
    private $apellido;
    private $foto;
    private $email;
    private $clave;
    
    private $error_nombre;
    private $error_apellido;
    private $error_email;
    private $error_clave1;
    private $error_clave2;
    
    public function __construct($nombre, $apellido, $email, $clave1, $clave2, $conexion) {
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this -> nombre = "";
        $this -> apellido = "";
        $this -> foto = 'https://ptetutorials.com/images/user-profile.png';
        $this -> email = "";
        $this -> clave = "";
        
        $this -> error_nombre = $this -> validar_nombre($conexion, $nombre);
        $this -> error_apellido = $this -> validar_apellido($conexion, $apellido);
        $this -> error_email = $this -> validar_email($conexion, $email);
        $this -> error_clave1 = $this -> validar_clave1($clave1);
        $this -> error_clave2 = $this -> validar_clave2($clave1, $clave2);
        
        if ($this -> error_clave1 === "" && $this -> error_clave2 === "") {
            $this -> clave = $clave1;
        }
    }
    
    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }
    
    private function validar_nombre($conexion, $nombre) {
        if (!$this -> variable_iniciada($nombre)) {
            return "Debes escribir un nombre de usuario.";
        } else {
            $this -> nombre = $nombre;
        }
        
        if (strlen($nombre) < 3) {
            return "El nombre debe ser más largo que 3 caracteres.";
        }
        
        if (strlen($nombre) > 24) {
            return "El nombre no puede ocupar más de 24 caracteres.";
        }
        
        /*if (RepositorioUsuario :: nombre_existe($conexion, $nombre)) {
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }*/
        
        return "";
    }

    private function validar_apellido($conexion, $nombre) {
        if (!$this -> variable_iniciada($nombre)) {
            return "Debes escribir un apellido de usuario.";
        } else {
            $this -> apellido = $nombre;
        }
        
        if (strlen($nombre) < 3) {
            return "El apellido debe ser más largo que 3 caracteres.";
        }
        
        if (strlen($nombre) > 24) {
            return "El apellido no puede ocupar más de 24 caracteres.";
        }
        
        /*if (RepositorioUsuario :: nombre_existe($conexion, $nombre)) {
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }*/
        
        return "";
    }
    
    private function validar_email($conexion, $email) {
        if (!$this -> variable_iniciada($email)) {
            return "Debes proporcionar un email.";
        } else {
            $this -> email = $email;
        }
        
        if (RepositorioUsuario :: email_existe($conexion, $email)) {
            return "Este email ya está en uso. Por favor, pruebe otro email o <a href='#'>intente recuperar su contraseña</a>.";
        }
        
        return "";
    }
    
    private function validar_clave1($clave1) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Debes escribir una contraseña.";
        }
        
        return "";
    }
    
    private function validar_clave2($clave1, $clave2) {
        if (!$this -> variable_iniciada($clave1)) {
            return "Primero debes rellenar la contraseña.";
        }
        
        if (!$this -> variable_iniciada($clave2)) {
            return "Debes repetir tu contraseña.";
        }
        
        if ($clave1 !== $clave2) {
            return "Ambas contraseñas deben coincidir.";
        }
        
        return "";
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }

    public function obtener_apellido() {
        return $this -> apellido;
    }

    public function obtener_foto() {
        return $this -> foto;
    }

    
    public function obtener_email() {
        return $this -> email;
    }
    
    public function obtener_clave() {
        return $this -> clave;
    }
    
    public function obtener_error_nombre() {
        return $this -> error_nombre;
    }

    public function obtener_error_apellido() {
        return $this -> error_apellido;
    }
    
    public function obtener_error_email() {
        return $this -> error_email;
    }
    
    public function obtener_error_clave1() {
        return $this -> error_clave1;
    }
    
    public function obtener_error_clave2() {
        return $this -> error_clave;
    }
    
    public function mostrar_nombre() {
        if ($this -> nombre !== "") {
            echo 'value="'. $this -> nombre . '"';
        }
    }
    
    public function mostrar_error_nombre() {
        if ($this -> error_nombre !== "") {
            echo $this -> aviso_inicio . $this -> error_nombre . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_apellido() {
        if ($this -> apellido !== "") {
            echo 'value="'. $this -> apellido . '"';
        }
    }
    
    public function mostrar_error_apellido() {
        if ($this -> error_apellido !== "") {
            echo $this -> aviso_inicio . $this -> error_apellido . $this -> aviso_cierre;
        }
    }

    public function mostrar_email() {
        if ($this -> email !== "") {
            echo 'value="'. $this -> email . '"';
        }
    }
    
    public function mostrar_error_email() {
        if ($this -> error_email !== "") {
            echo $this -> aviso_inicio . $this -> error_email . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave1() {
        if ($this -> error_clave1 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave1 . $this -> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2() {
        if ($this -> error_clave2 !== "") {
            echo $this -> aviso_inicio . $this -> error_clave2 . $this -> aviso_cierre;
        }
    }
    
    public function registro_valido() {
        if ($this -> error_nombre === "" &&
                $this -> error_apellido === "" &&
                $this -> error_email === "" &&
                $this -> error_clave1 === "" &&
                $this -> error_clave2 === "") {
            return true;
        } else {
            return false;
        }
    }
}