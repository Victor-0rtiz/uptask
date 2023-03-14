<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tareas;

class TareasController
{

    public static function index()
    {
        session_start();
        isAuth();

        $idUrl = $_GET["id"];
        $proyecto = Proyecto::where("url", $idUrl);
        if (!$proyecto || $proyecto->propietarioId !== $_SESSION["id"]) {
            header("location: /dashboard");
        }
        $tareas = Tareas::belongTo("proyectoId", $proyecto->id);
        echo json_encode(["tareas" => $tareas]);
    }
    public static function crear()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $idProyecto = $_POST["proyectoId"];
            $proyecto = Proyecto::where("url", $idProyecto);
            if (!$proyecto || $proyecto->propietarioId !== $_SESSION["id"]) {
                $respuesta = [
                    "tipo" => "error",
                    "mensaje" => "Ocurrio un error inesperado"
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tareas($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            if ($resultado) {
                $respuesta = [
                    "id" => $resultado["id"],
                    "tipo" => "exito",
                    "mensaje" => "La tarea se agrego correctamente",
                    "proyectoId" => $proyecto->id

                ];


                echo json_encode($respuesta);
            }
        }
    }
    public static function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $idProyecto = $_POST["url"];
            $proyecto = Proyecto::where("url", $idProyecto);

            if (!$proyecto || $proyecto->propietarioId !== $_SESSION["id"]) {
                $respuesta = [
                    "tipo" => "error",
                    "mensaje" => "Ocurrio un error inesperado al actualizar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }

            $tarea = new Tareas($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            if ($resultado) {
                $respuesta = [
                    "id" => $tarea->id,
                    "tipo" => "exito",
                    "mensaje" => "La tarea se actualizo correctamente",
                    "proyectoId" => $proyecto->id

                ];


                echo json_encode(["respuesta" => $respuesta]);
            }
        }
    }
    public static function eliminar()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            $idProyecto = $_POST["url"];
            $proyecto = Proyecto::where("url", $idProyecto);

            if (!$proyecto || $proyecto->propietarioId !== $_SESSION["id"]) {
                $respuesta = [
                    "tipo" => "error",
                    "mensaje" => "Ocurrio un error inesperado al actualizar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }
            $tarea = new Tareas($_POST);
            $resultado = $tarea->eliminar();
            $resultado = [
                "mensaje" => "La tarea se elimino correctamente",
                "tipo" => "exito",
                "resultado" => $resultado
            ];

            echo json_encode($resultado);
        }
    }
}
