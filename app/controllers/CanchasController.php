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
        $nombre = $_POST['can_nombre'] ?? '';
        $precio = $_POST['can_precio_hora'] ?? 0;

        $canchaModel = $this->model('Cancha');
        
        // Enviamos solo los dos parámetros que el modelo espera ahora
        if ($canchaModel->registrar($nombre, $precio)) {
            header("Location: index.php?controller=Canchas&action=index&msg=save_ok");
            exit(); 
        } else {
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