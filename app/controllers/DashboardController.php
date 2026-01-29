<?php
// app/controllers/DashboardController.php

require_once '../app/models/Alquiler.php'; 
require_once '../app/models/Usuario.php'; // <--- 1. IMPORTANTE: Cargar modelo Usuario

class DashboardController extends Controller {
    
    public function __construct() {
        parent::__construct();

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

        $alquilerModel = new Alquiler($this->db);
        $id_usuario = $_SESSION['usuario_id'];

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
        $usuarioModel = new Usuario($this->db); // <--- 2. Instanciar Modelo Usuario
        
        // 1. Estadísticas Generales (Canchas, Ingresos, Reservas)
        $stats = $alquilerModel->obtenerEstadisticasGlobales();

        // 3. AGREGAMOS EL CONTEO DE USUARIOS A $stats
        // Esto soluciona que la tarjeta salga en 0
       $stats['usuarios'] = $usuarioModel->contarClientes();

        // 2. Tabla de Historial
        $historial = $alquilerModel->obtenerTodosLosAlquileres();

        // 3. DATOS PARA EL GRÁFICO
        $datosGrafico = $alquilerModel->obtenerUsosPorMes();
        
        $labels = [];
        $data = [];
        $nombresMeses = [
            '01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr',
            '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago',
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'
        ];

        foreach ($datosGrafico as $fila) {
            $anio = substr($fila['periodo'], 0, 4);
            $mes = substr($fila['periodo'], 5, 2);
            $labels[] = $nombresMeses[$mes] . " " . $anio;
            $data[] = $fila['total'];
        }

        $this->view('dashboards/admin', [
            'stats' => $stats,
            'historial' => $historial,
            'usuario_nombre' => $_SESSION['usuario_nombre'],
            'graficoLabels' => json_encode($labels), 
            'graficoData' => json_encode($data)
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