<?php
// app/controllers/ReportesController.php
require_once '../app/models/Reporte.php';

class ReportesController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Reporte($this->db);
        $estados = $modelo->obtenerEstados();
        $resultados = []; // Array vacío inicial
        
        // Valores por defecto (Mes actual)
        $f_inicio = date('Y-m-01');
        $f_fin = date('Y-m-t');
        $estado_selec = 'todos'; // Por defecto check marcado

        // Si se envió el formulario de búsqueda
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $f_inicio = $_POST['fecha_inicio'];
            $f_fin = $_POST['fecha_fin'];
            
            // Lógica del Checkbox: Si está marcado, enviamos null al modelo
            // Si NO está marcado, enviamos el ID del estado
            $filtro_estado = isset($_POST['todos_estados']) ? null : $_POST['est_id'];
            $estado_selec = isset($_POST['todos_estados']) ? 'todos' : $_POST['est_id'];

            $resultados = $modelo->generarReporte($f_inicio, $f_fin, $filtro_estado);
        }

        $vista_interna = '../app/views/reportes/index.php';
        $titulo_pagina = "Reportes Avanzados";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    // Acción para generar la vista de impresión (PDF)
    public function imprimir() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Reporte($this->db);
            
            $f_inicio = $_POST['fecha_inicio'];
            $f_fin = $_POST['fecha_fin'];
            $filtro_estado = isset($_POST['todos_estados']) ? null : $_POST['est_id'];
            
            // Obtenemos los mismos datos
            $datos = $modelo->generarReporte($f_inicio, $f_fin, $filtro_estado);
            
            // Cargamos una vista LIMPIA (sin dashboard, solo el reporte)
            require_once '../app/views/reportes/imprimir.php';
        }
    }
}