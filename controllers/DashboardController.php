<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index (Router $router){
        session_start();
        isAuth();
        $router->render("dashboard/index", ["titulo"=>"Proyectos"]);

    }
    public static function crearProyecto (Router $router){
        session_start();
        isAuth();        
        $alertas = [] ;
        $router->render("dashboard/crear-proyecto", ["titulo"=>"Crear Proyectos", "alertas"=>$alertas]);

    }
    public static function perfil (Router $router){
        session_start();
        isAuth();
        $router->render("dashboard/perfil", ["titulo"=>"Perfil"]);

    }
}

?>