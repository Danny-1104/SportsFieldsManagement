<?php
class CanchasController extends Controller {

    public function index() {
        $canchaModel = $this->model('Cancha');
        $datos_canchas = $canchaModel->obtenerTodas();
        
        $titulo_pagina = "Gestión de Canchas Deportivas";
        $vista_interna = '../app/views/canchas/index.php';
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Capturamos los datos usando los nombres del 'name' del HTML
        $nombre = $_POST['can_nombre'] ?? '';
        $precio = $_POST['can_precio_hora'] ?? 0;
        $desc   = $_POST['can_descripcion'] ?? '';

        $canchaModel = $this->model('Cancha');
        
        if ($canchaModel->registrar($nombre, $precio, $desc)) {
            // Redirigir con mensaje de éxito
            header("Location: index.php?controller=Canchas&action=index&msg=save_ok");
            exit(); // IMPORTANTE: Detiene la ejecución para que la cabecera funcione
        } else {
            // Si falla el insert en la DB
            header("Location: index.php?controller=Canchas&action=index&msg=error");
            exit();
        }
    }
}

    public function eliminar() {
        if (isset($_GET['id'])) {
            $canchaModel = $this->model('Cancha');
            $canchaModel->eliminar($_GET['id']);
            header("Location: index.php?controller=Canchas&action=index&msg=delete_ok");
            exit;
        }
    }
}