<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController{
    public static function index (Router $router){
        session_start();
        isAuth();
        //buscamos el id de la sesion 
        $id= $_SESSION["id"];
        //traemos todos los registros que tengan el id del usuario/propietario
        $proyectos = Proyecto::belongTo("propietarioId", $id);
        $router->render("dashboard/index", ["titulo"=>"Proyectos",
        "proyectos"=> $proyectos
    ]);

    }
    public static function crearProyecto (Router $router){
        session_start();
        isAuth();        
        $alertas = [] ;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proyecto = new Proyecto($_POST);
            //validacion
            $alertas = $proyecto->validarProyecto();
            if (empty($alertas)) {
                //generar url unica
                 $proyecto->url= md5(uniqid());
                 //obtenemos el id del usuario por la sesion
                 $proyecto->propietarioId = $_SESSION["id"];
                 $proyecto->guardar();
                 header("location: /proyecto?id={$proyecto->url}");
            }
        }
        $alertas= Proyecto::getAlertas();
        $router->render("dashboard/crear-proyecto", ["titulo"=>"Crear Proyectos", "alertas"=>$alertas]);

    }
    public static function proyecto(Router $router){
        $url= $_GET["id"];
        //iniciamos la sesion para obtener el id del usuario 
        session_start();
        isAuth();
        //buscamos un proyecto con la url actual
        $proyecto= Proyecto::where("url", $url);
        //verificamos si el usuario es el propietario del proyecto
        if ($_SESSION["id"] !== $proyecto->propietarioId) {
            header("location: /dashboard");
        }

        $router->render("dashboard/proyecto",[
            "titulo"=>$proyecto->proyecto
        ]);

    }
    public static function perfil (Router $router){
        session_start();
        isAuth();
        $router->render("dashboard/perfil", ["titulo"=>"Perfil"]);

    }
}

?>