<?php 
namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login (Router $router){
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            
        }
        $router->render("auth/login", ["titulo"=> "Inicia Sesión"]);
        
    }
    public static function logout (Router $router){
        
        
    }
    public static function crear (Router $router){
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            
        }
        $router->render("auth/crear", ["titulo"=>"Crea tu cuenta", ]);
        
    }
    public static function olvide (Router $router){
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            
        }
        $router->render("auth/olvide", []);
        
    }
    public static function restablecer (Router $router){
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            
        }
        
    }
    public static function mensaje (Router $router){
        
        
    }
    public static function confirmar (Router $router){
        
        
    }
}

?>