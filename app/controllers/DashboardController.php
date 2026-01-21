<?php
// app/controllers/DashboardController.php

require_once '../app/models/Alquiler.php'; 

class DashboardController extends Controller {
    
    public function __construct() {
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
            // Si NO está logueado, lo mandamos al Login
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    // Acción por defecto
    public function index() {
        $rol = $_SESSION['usuario_rol'] ?? 'Cliente';
        if($rol == 'Administrador') $this->admin();
        elseif($rol == 'Organizador') $this->organizador();
        else $this->cliente();
    }

    // 1. Dashboard CLIENTE (Este es el que faltaba)
    public function cliente() {
        if ($_SESSION['usuario_rol'] != 'Cliente') {
            $this->accesoDenegado();
            return;
        }

        $alquilerModel = new Alquiler($this->db);
        $id_usuario = $_SESSION['usuario_id'];

        // Datos para la vista
        $stats = $alquilerModel->obtenerEstadisticasCliente($id_usuario);
        $historial = $alquilerModel->obtenerUltimosAlquileres($id_usuario);

        $this->view('dashboards/cliente', [
            'stats' => $stats,
            'historial' => $historial,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ]);
    }

    // 2. Dashboard ADMINISTRADOR
    public function admin() {
        if ($_SESSION['usuario_rol'] != 'Administrador') {
            $this->accesoDenegado();
            return;
        }
        $this->view('dashboards/admin');
    }

    // 3. Dashboard ORGANIZADOR
    public function organizador() {
        if ($_SESSION['usuario_rol'] != 'Organizador') {
            $this->accesoDenegado();
            return;
        }
        $this->view('dashboards/organizador');
    }

    private function accesoDenegado() {
        echo "<h1>Acceso Denegado</h1><p>No tienes permiso.</p>";
        echo "<br><a href='index.php?controller=Auth&action=logout'>Cerrar Sesión</a>";
        exit;
    }
}