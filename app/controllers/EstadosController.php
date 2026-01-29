<?php
// app/controllers/EstadosController.php
require_once '../app/models/Estado.php';

class EstadosController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Estado($this->db);
        $estados = $modelo->obtenerTodos();
        $vista_interna = '../app/views/estados/index.php';
        $titulo_pagina = "Gestión de Estados del Sistema";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
            if(!empty($nombre)) {
                $modelo = new Estado($this->db);
                if ($modelo->guardar($nombre)) {
                    header("Location: index.php?controller=Estados&action=index&msg=save_ok");
                } else {
                    echo "<script>alert('Error: Ya existe.'); window.history.back();</script>";
                }
            } else {
                header("Location: index.php?controller=Estados&action=index");
            }
        }
    }

    // --- CARGAR VISTA DE EDICIÓN ---
    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Estado($this->db);
            $estado = $modelo->obtenerPorId($_GET['id']);
            
            if ($estado) {
                // Esta es la vista que creaste en el paso 2
                $vista_interna = '../app/views/estados/editar.php'; 
                $titulo_pagina = "Editar Estado";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                require_once '../app/views/dashboards/admin.php';
            } else {
                header("Location: index.php?controller=Estados&action=index");
            }
        }
    }

    // --- GUARDAR CAMBIOS ---
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Estado($this->db);
            if ($modelo->actualizar($_POST['id'], trim($_POST['nombre']))) {
                header("Location: index.php?controller=Estados&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $modelo = new Estado($this->db);
            $modelo->eliminar($_GET['id']);
            header("Location: index.php?controller=Estados&action=index&msg=delete_ok");
        }
    }
}