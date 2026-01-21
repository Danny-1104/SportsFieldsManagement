<?php
// app/controllers/DashboardController.php

// Cargamos el modelo para poder mostrar las estadísticas
require_once '../app/models/Alquiler.php'; 

class DashboardController extends Controller {
    
    public function __construct() {
        // 1. ¡ESTA ES LA LÍNEA MÁGICA QUE FALTABA!
        // Inicializa la base de datos ($this->db) del Controlador padre
        parent::__construct();

        // 2. Ahora sí, verificamos seguridad
        if (!isset($_SESSION['autenticado']) || !$_SESSION['autenticado']) {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $rol = $_SESSION['usuario_rol'] ?? 'Cliente';
        
        if ($rol == 'Administrador') {
            $this->admin();
        } elseif ($rol == 'Organizador') {
            $this->organizador();
        } else {
            $this->cliente();
        }
    }

    // --- DASHBOARD CLIENTE ---
    public function cliente() {
        if ($_SESSION['usuario_rol'] != 'Cliente') {
            $this->accesoDenegado();
            return;
        }

        // Instanciamos el modelo pasando la conexión (que ahora sí existe)
        $alquilerModel = new Alquiler($this->db);
        $id_usuario = $_SESSION['usuario_id'];

        // Obtenemos datos
        $stats = $alquilerModel->obtenerEstadisticasCliente($id_usuario);
        $historial = $alquilerModel->obtenerUltimosAlquileres($id_usuario);

        $this->view('dashboards/cliente', [
            'stats' => $stats,
            'historial' => $historial,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ]);
    }

    // --- DASHBOARD ADMIN ---
    public function admin() {
        if ($_SESSION['usuario_rol'] != 'Administrador') {
            $this->accesoDenegado();
            return;
        }

        $alquilerModel = new Alquiler($this->db);
        $stats = $alquilerModel->obtenerEstadisticasGlobales();
        $pendientes = $alquilerModel->obtenerPendientesAprobacion();

        $this->view('dashboards/admin', [
            'stats' => $stats,
            'pendientes' => $pendientes,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ]);
    }

    // --- DASHBOARD ORGANIZADOR ---
    public function organizador() {
        if ($_SESSION['usuario_rol'] != 'Organizador') {
            $this->accesoDenegado();
            return;
        }
        $this->view('dashboards/organizador');
    }

    private function accesoDenegado() {
        echo "<div style='text-align:center; padding:50px;'>";
        echo "<h1>⛔ Acceso Denegado</h1>";
        echo "<p>No tienes permisos para ver esta sección.</p>";
        echo "<a href='index.php?controller=Auth&action=logout'>Cerrar Sesión</a>";
        echo "</div>";
        exit;
    }
}