<?php
// app/controllers/GestionAlquileresController.php
require_once '../app/models/Alquiler.php';

class GestionAlquileresController extends Controller {

    public function __construct() {
        parent::__construct();
        // Seguridad: Solo Admin puede entrar aquí
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Alquiler($this->db);
        // Usamos la función nueva que creamos en el paso 1
        $alquileres = $modelo->obtenerTodosAdmin();
        
        // Apuntamos a la NUEVA carpeta de vistas
        $vista_interna = '../app/views/gestion_alquileres/index.php';
        $titulo_pagina = "Gestión de Alquileres";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Alquiler($this->db);
            $alquiler = $modelo->obtenerPorIdAdmin($_GET['id']);
            $estados = $modelo->obtenerEstadosAdmin(); 
            
            if ($alquiler) {
                $vista_interna = '../app/views/gestion_alquileres/editar.php';
                $titulo_pagina = "Procesar Alquiler";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                require_once '../app/views/dashboards/admin.php';
            } else {
                header("Location: index.php?controller=GestionAlquileres&action=index");
            }
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Alquiler($this->db);
            
            // Recogemos datos (usando tus nombres de columna reales)
            $id = $_POST['alq_id'];
            $fecha = $_POST['alq_fecha'];
            $inicio = $_POST['alq_hora_ini'];
            $fin = $_POST['alq_hora_fin'];
            $valor = $_POST['alq_valor'];
            $est_id = $_POST['est_id'];

            if ($modelo->actualizarAdmin($id, $fecha, $inicio, $fin, $valor, $est_id)) {
                header("Location: index.php?controller=GestionAlquileres&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $modelo = new Alquiler($this->db);
            $modelo->eliminarAdmin($_GET['id']);
            header("Location: index.php?controller=GestionAlquileres&action=index&msg=delete_ok");
        }
    }
}