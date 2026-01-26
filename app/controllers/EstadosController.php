<?php
class EstadosController extends Controller {

    public function index() {
        $estadoModel = $this->model('Estado');
        $datos_estados = $estadoModel->obtenerTodos();
        
        $titulo_pagina = "Gestión de Estados del Sistema";
        $vista_interna = '../app/views/estados/index.php';
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['est_nombre'])) {
            $nombre = strtoupper(trim($_POST['est_nombre'])); // Guardamos en mayúsculas para estandarizar
            $estadoModel = $this->model('Estado');
            
            if ($estadoModel->registrar($nombre)) {
                header("Location: index.php?controller=Estados&action=index&msg=save_ok");
            } else {
                header("Location: index.php?controller=Estados&action=index&msg=error_dup");
            }
            exit;
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $estadoModel = $this->model('Estado');
            $estadoModel->eliminar($_GET['id']);
            header("Location: index.php?controller=Estados&action=index&msg=delete_ok");
            exit;
        }
    }
}