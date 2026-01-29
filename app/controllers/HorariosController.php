<?php
// app/controllers/HorariosController.php
require_once '../app/models/Horario.php';

class HorariosController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Horario($this->db);
        $horarios = $modelo->obtenerTodos();
        $vista_interna = '../app/views/horarios/index.php';
        $titulo_pagina = "Gestión de Horarios";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Horario($this->db);
            if ($modelo->guardar($_POST['hora'])) {
                header("Location: index.php?controller=Horarios&action=index&msg=save_ok");
            } else {
                echo "<script>alert('Error: Esa hora ya está registrada.'); window.history.back();</script>";
            }
        }
    }

    // --- NUEVO: Cargar vista de edición ---
    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Horario($this->db);
            $horario = $modelo->obtenerPorId($_GET['id']);
            
            if ($horario) {
                // Nombre del archivo de vista que crearemos en el paso 4
                $vista_interna = '../app/views/horarios/editar.php'; 
                $titulo_pagina = "Modificar Horario";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                require_once '../app/views/dashboards/admin.php';
            } else {
                header("Location: index.php?controller=Horarios&action=index");
            }
        }
    }

    // --- NUEVO: Procesar actualización ---
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Horario($this->db);
            if ($modelo->actualizar($_POST['id'], $_POST['hora'])) {
                header("Location: index.php?controller=Horarios&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error: Esa hora ya está ocupada.'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $modelo = new Horario($this->db);
            $modelo->eliminar($_GET['id']);
            header("Location: index.php?controller=Horarios&action=index&msg=delete_ok");
        }
    }
}