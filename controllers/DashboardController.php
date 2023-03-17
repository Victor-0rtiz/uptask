<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        session_start();
        isAuth();
        //buscamos el id de la sesion 
        $id = $_SESSION["id"];
        //traemos todos los registros que tengan el id del usuario/propietario
        $proyectos = Proyecto::belongTo("propietarioId", $id);
        $router->render("dashboard/index", [
            "titulo" => "Proyectos",
            "proyectos" => $proyectos
        ]);
    }
    public static function crearProyecto(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proyecto = new Proyecto($_POST);
            //validacion
            $alertas = $proyecto->validarProyecto();
            if (empty($alertas)) {
                //generar url unica
                $proyecto->url = md5(uniqid());
                //obtenemos el id del usuario por la sesion
                $proyecto->propietarioId = $_SESSION["id"];
                $proyecto->guardar();
                header("location: /proyecto?id={$proyecto->url}");
            }
        }
        $alertas = Proyecto::getAlertas();
        $router->render("dashboard/crear-proyecto", ["titulo" => "Crear Proyectos", "alertas" => $alertas]);
    }
    public static function proyecto(Router $router)
    {
        $url = $_GET["id"];
        //iniciamos la sesion para obtener el id del usuario 
        session_start();
        isAuth();
        //buscamos un proyecto con la url actual
        $proyecto = Proyecto::where("url", $url);
        //verificamos si el usuario es el propietario del proyecto
        if ($_SESSION["id"] !== $proyecto->propietarioId) {
            header("location: /dashboard");
        }

        $router->render("dashboard/proyecto", [
            "titulo" => $proyecto->proyecto
        ]);
    }
    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION["id"]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPerfil();
            if (empty($alertas)) {
                //verificamos si existe otro usuario con este email
                $existeUsuario = Usuario::where("email", $usuario->email);
                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    $alertas = Usuario::setAlerta("exito", "Email no valido, pertenece a otra persona");
                } else {
                    $usuario->guardar();
                    $_SESSION["nombre"] =  $usuario->nombre;
                    $alertas = Usuario::setAlerta("exito", "Guardado Correctamente");
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render("dashboard/perfil", ["titulo" => "Perfil", "alertas" => $alertas, "usuario" => $usuario]);
    }
    public static function cambiarPassword(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $usuario = Usuario::find($_SESSION["id"]);
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevoPassword();
            if (empty($alertas)) {
                $resultado = $usuario->comprobarPassword();
                if ($resultado) {
                    $usuario->password = $usuario->password_nuevo;
                    $usuario->hashearPassword();
                    unset($usuario->password_nuevo);
                    unset($usuario->password_actual);
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        Usuario::setAlerta("exito", "Password guardado correctamente ");
                    }

                } else {
                    Usuario::setAlerta("error", "Contraseña incorrecta");
                }
                
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("dashboard/cambiar-password", ["titulo" => "Cambiar Password", "alertas" => $alertas]);
    }
}
