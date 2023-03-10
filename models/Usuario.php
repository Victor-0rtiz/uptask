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
    public $token;
    public $confirmado;

    public function __construct($args= [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->password2 = $args["password2"] ?? "";
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
?>