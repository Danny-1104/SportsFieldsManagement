<?php
// app/controllers/CanchasController.php
require_once '../app/models/Cancha.php';

class CanchasController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Cancha($this->db);
        $canchas = $modelo->obtenerTodos();
        $vista_interna = '../app/views/canchas/index.php';
        $titulo_pagina = "Inventario de Canchas";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Cancha($this->db);
            if ($modelo->guardar($_POST['nombre'], $_POST['precio'])) {
                header("Location: index.php?controller=Canchas&action=index&msg=save_ok");
            } else {
                echo "<script>alert('Error al guardar'); window.history.back();</script>";
            }
        }
    }

    // En CanchasController.php
   // En app/controllers/CanchasController.php

    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Cancha($this->db);
            $cancha = $modelo->obtenerPorId($_GET['id']);
            
            if ($cancha) {
                // CORRECCIÓN AQUÍ: Cambiamos 'editar.php' por 'edit.php'
                $vista_interna = '../app/views/canchas/edit.php'; 
                
                $titulo_pagina = "Editar Cancha";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                
                require_once '../app/views/dashboards/admin.php'; 
            } else {
                header("Location: index.php?controller=Canchas&action=index");
            }
        }
    }
    // --- FUNCIÓN ACTUALIZAR ---
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Cancha($this->db);
            // Llama a la función corregida del modelo
            if ($modelo->actualizar($_POST['id'], $_POST['nombre'], $_POST['precio'])) {
                header("Location: index.php?controller=Canchas&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $modelo = new Cancha($this->db);
            if($modelo->eliminar($_GET['id'])){
                 header("Location: index.php?controller=Canchas&action=index&msg=delete_ok");
            } else {
                 echo "<script>alert('No se puede eliminar: Esta cancha tiene reservas asociadas.'); window.location.href='index.php?controller=Canchas&action=index';</script>";
            }
        }
    }
}