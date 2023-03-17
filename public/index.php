<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\DashboardController;
use Controllers\LoginController;
use Controllers\TareasController;
use Controllers\TareasControllers;
use MVC\Router;
$router = new Router();

//?Login 
$router->get("/", [LoginController::class, "login"]);
$router->post("/", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

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

//?Dashboard
$router->get("/dashboard", [DashboardController::class, "index"]);
$router->get("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->post("/crear-proyecto", [DashboardController::class, "crearProyecto"]);
$router->get("/proyecto", [DashboardController::class, "proyecto"]);
$router->get("/perfil", [DashboardController::class, "perfil"]);
$router->post("/perfil", [DashboardController::class, "perfil"]);
$router->get("/cambiar-password", [DashboardController::class, "cambiarPassword"]);
$router->post("/cambiar-password", [DashboardController::class, "cambiarPassword"]);

//!api de tareas
$router->get("/api/tareas", [TareasController::class, "index"]);
$router->post("/api/tareas", [TareasController::class, "crear"]);
$router->post("/api/tareas/actualizar", [TareasController::class, "actualizar"]);
$router->post("/api/tareas/eliminar", [TareasController::class, "eliminar"]);






// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();