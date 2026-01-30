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
            // Renderizar la vista en un buffer para poder inyectar el favicon
            ob_start();
            require_once '../app/views/' . $vista . '.php';
            $output = ob_get_clean();

            // Etiqueta del favicon (ruta relativa a public/ desde vistas)
            $faviconTag = '<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">\n'
                        . '<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">\n'
                        . '<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">';

            // Si la vista contiene un </head>, insertamos el favicon justo antes
            if (stripos($output, '</head>') !== false) {
                $output = str_ireplace('</head>', $faviconTag . "\n</head>", $output);
            }

            echo $output;
        } else {
            die('La vista ' . $vista . ' no existe.');
        }
    }
}