<?php
// app/core/Controller.php

class Controller {
    // Variable para la conexión a la base de datos
    protected $db;

    public function __construct() {
        // 1. Buscamos el archivo en la carpeta CORE (donde lo tienes tú)
        // Ajustamos la ruta: ../app/core/Database.php
        if (file_exists('../app/core/Database.php')) {
            require_once '../app/core/Database.php';
            $this->db = new Database();
        } else {
            // Mensaje de error si no lo encuentra
            die("Error Crítico: No se encuentra app/core/Database.php");
        }
    }

    // Cargar modelo
    public function model($modelo) {
        if (file_exists('../app/models/' . $modelo . '.php')) {
            require_once '../app/models/' . $modelo . '.php';
            return new $modelo($this->db);
        } else {
            die("El modelo $modelo no existe.");
        }
    }

    // Cargar vista
    public function view($vista, $datos = []) {
        if (file_exists('../app/views/' . $vista . '.php')) {
            // Desempaquetar datos para la vista
            if (!empty($datos)) {
                extract($datos);
            }
            require_once '../app/views/' . $vista . '.php';
        } else {
            die('La vista ' . $vista . ' no existe.');
        }
    }
}