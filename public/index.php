<?php
// public/index.php

// 1. INICIAR SESIÓN (Obligatorio para login y mensajes flash)
session_start();

// 2. Configuración y Core
require_once '../app/config/database.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';

// 3. Enrutador Simple (Front Controller)
// Detecta qué controlador y qué acción se pide en la URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : 'HomeController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Ruta al archivo del controlador
$controllerFile = '../app/controllers/' . $controllerName . '.php';

// 4. Cargar Controlador
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        if (method_exists($controller, $actionName)) {
            // Ejecutar la acción solicitada
            $controller->{$actionName}();
        } else {
            die("Error: El método '$actionName' no existe en '$controllerName'.");
        }
    } else {
        die("Error: La clase '$controllerName' no existe.");
    }
} else {
    // Si el controlador no existe, redirigir al Home o mostrar error
    // Para depurar, mostramos error:
    die("Error: El controlador '$controllerName' no se encuentra ($controllerFile).");
}