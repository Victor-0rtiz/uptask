<?php

namespace Model;
class Usuario extends ActiveRecord{
    protected static $tabla= "usuarios";
    protected static $columnasDB= ["id", "nombre", "email", "password", "token", "confirmado"];


    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2; 
    public $password_actual; 
    public $password_nuevo; 
    public $token;
    public $confirmado;

    public function __construct($args= [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->password2 = $args["password2"] ?? "";
        $this->password_actual = $args["password_actual"] ?? "";
        $this->password_nuevo= $args["password_nuevo"] ?? "";
        $this->token = $args["token"] ?? "";
        $this->confirmado = $args["confirmado"] ?? 0;
    }

    public function validarUsuario(){
        if (!$this->email) {
            self::$alertas["error"][]= "El email no debe ir vacio";
                      
        }
        if (!filter_var( $this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][]= "El email no es valido";
                      
        }
        if (!$this->password) {
            self::$alertas["error"][]= "El password no debe ir vacio";
        }
        return self::$alertas;

    }
    public function validarNuevoUsuario (){
        
        if (!$this->nombre) {
            self::$alertas["error"][]= "El nombre de usuario no debe ir vacio";
                       
        }
        if (!$this->email) {
            self::$alertas["error"][]= "El email no debe ir vacio";
                      
        }
        if (!$this->password) {
            self::$alertas["error"][]= "El password no debe ir vacio";
        }
        if (strlen($this->password)<6) {
            self::$alertas["error"][]= "El password debe contener almenos 6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas["error"][]= "Los passwords no coinciden";
        }
        return self::$alertas;            
    }

    public function validarPerfil (){
        
        if (!$this->nombre) {
            self::$alertas["error"][]= "El nombre de usuario no debe ir vacio";
                       
        }
        if (!$this->email) {
            self::$alertas["error"][]= "El email no debe ir vacio";
                      
        }
        return self::$alertas;
    }
    public function validarNuevoPassword (){
        
        if (!$this->password_actual) {
            self::$alertas["error"][]= "El password actual no puede ir vacio";
                       
        }
        if (!$this->password_nuevo) {
            self::$alertas["error"][]= "El password nuevo no puede ir vacio";
                      
        }
        if (strlen($this->password_nuevo)<6) {
            self::$alertas["error"][]= "El password debe tener almenos 6 caracteres";
                      
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if (!$this->password) {
            self::$alertas["error"][]= "El password no debe ir vacio";
        }
        if (strlen($this->password)<6) {
            self::$alertas["error"][]= "El password debe contener almenos 6 caracteres";
        }
        return self::$alertas;    

    }

    //? Hashea los passwords
    public function hashearPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //?Crea tokens unicos
    public function crearToken (){
        $this->token = uniqid();
    }
    //comprobar nuevo password
    public function comprobarPassword (){
        return password_verify($this->password_actual, $this->password);
    }

    //valida el email
    public function validarEmail(){
        if (!$this->email) {
            self::$alertas["error"][]= "El email no debe ir vacio";
                      
        }
        if (!filter_var( $this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][]= "El email no es valido";
                      
        }
        return self::$alertas;

    }
}
