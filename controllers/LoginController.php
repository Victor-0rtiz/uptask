<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        }
        $router->render("auth/login", ["titulo" => "Inicia Sesión"]);
    }
    public static function logout(Router $router)
    {
    }
    public static function crear(Router $router)
    {

        // Instanciamos un usuario
        $usuario = new Usuario;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //sincronizamos
            $usuario->sincronizar($_POST);
            //validamos
            $alertas = $usuario->validarNuevoUsuario();
            if (empty($alertas)) {
                //verificamos si hay un usuario con ese email
                $existente = Usuario::where("email", $usuario->email);
                if ($existente) {
                    Usuario::setAlerta("error", "El usuario ya esta registrado");
                } else {
                    //hasheamos el password y creamos un token
                    $usuario->hashearPassword();
                    unset($usuario->password2);
                    $usuario->crearToken();
                    //enviamos un email con instrucciones atravez de una instancia de la clase email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header("location: /mensaje");
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/crear", ["titulo" => "Crea tu cuenta", "alertas" => $alertas, "usuario" => $usuario]);
    }
    public static function olvide(Router $router)
    {
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = new Usuario($_POST);
            //validamos el email
            $alertas = $usuario->validarEmail();
            if (empty($alertas)) {
                //buscamos el usuario
                $usuario= Usuario::where("email", $usuario->email);
                
                if ($usuario && $usuario->confirmado == "1") {
                    //creamos un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);
                    //guardamos el token y enviamos el email
                    $usuario->guardar();
                    Usuario::setAlerta("exito", "Hemos enviado los pasos a tu correo");
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();


                } else {
                    Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/olvide", ["titulo" => "Olvide mi Password", "alertas" => $alertas]);
    }
    public static function restablecer(Router $router)
    {
        //obtenemos el token
        $token =s($_GET["token"]);
        //verificamos que haya uno
        if(!$token) header("lcation: /");
        $alertas = [];
        $mostrar = true;
        //buscamos un usuario con ese token
        $usuario= Usuario::where("token",$token );
        //verificamos si esta vacio
        if (empty($usuario)) {
            Usuario::setAlerta("error", "Token no valido");
            $mostrar= false;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //sincronizamos la instancia
            $usuario->sincronizar($_POST);
            $alertas =$usuario->validarPassword();
            if (empty($alertas)) {
               $usuario->hashearPassword();
               $usuario->token= null;
               $resultado = $usuario->guardar();
               if ($resultado) {
                header("location: /");
               }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/reestablecer", ["titulo" => "Reestablecer Password", "mostrar" =>$mostrar, "alertas"=>$alertas]);
    }
    public static function mensaje(Router $router)
    {
        $router->render("auth/mensaje", ["titulo" => "Cuenta Creada Exitosamente"]);
    }
    public static function confirmar(Router $router)
    {
        //leer token 
        $token = s($_GET["token"]);
        $alertas = [];
        if (!$token) header("location: /");
        //buscar usuario con ese token
        $usuario = Usuario::where("token", $token);
        if (empty($usuario)) {
            //alerta de token 
            Usuario::setAlerta("error", "El token no es valido");
        } else {
            //confirmamos el usuario
            $usuario->confirmado = 1;
            unset($usuario->password2);
            //eliminamos el token y guardamos
            $usuario->token = null;
            $usuario->guardar();

            Usuario::setAlerta("exito", "Cuenta comprobada correctamente");
        }
        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar", ["titulo" => "Confirma tu cuenta uptask", "alertas" => $alertas]);
    }
}
