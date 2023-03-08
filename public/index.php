<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

//?Login 
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);

//?crear cuenta
$router->get("/crear", [LoginController::class, "crear"]);
$router->post("/crear", [LoginController::class, "crear"]);

//?formulario de olvide mi password
$router->get("/olvide", [LoginController::class, "olvide"]);
$router->post("/olvide", [LoginController::class, "olvide"]);

//?formulario para el nuevo password
$router->get("/reestablecer", [LoginController::class, "restablecer"]);
$router->post("/reestablecer", [LoginController::class, "restablecer"]);

//?confirmacion de cuentas
$router->get("/mensaje", [LoginController::class, "mensaje"]);
$router->get("/confirmar", [LoginController::class, "confirmar"]);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();