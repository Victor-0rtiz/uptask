<?php

namespace Model;
class Usuario extends ActiveRecord{
    protected static $tabla= "usuarios";
    protected static $columnasDB= ["id", "nombre", "email", "password", "token", "confirmado"];


    public $id;
    public $nombre;
    public $email;
    public $password;
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
        $this->confirmado = $args["confirmado"] ?? "";
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
            self::$alertas["error"][]= "El password debe contener almenos 6 caracteres";
        }
        return self::$alertas;            
    }
}
?>