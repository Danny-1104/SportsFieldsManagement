<?php
class HorariosController extends Controller {

    public function index() {
        $horarioModel = $this->model('Horario');
        $datos_horarios = $horarioModel->obtenerTodos();

        $titulo_pagina = "Configuración de Horas Operativas";
        $vista_interna = '../app/views/horarios/index.php';
        
        require_once '../app/views/dashboards/admin.php';
    }

    // app/controllers/HorariosController.php

public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['hor_nombre'])) {
        $hora = $_POST['hor_nombre'];
        $horarioModel = $this->model('Horario');
        
        // Verificamos si ya existe
        $sqlCheck = "SELECT COUNT(*) as total FROM horario WHERE hor_nombre = ?";
        $check = $this->db->select($sqlCheck, [$hora]);

        if ($check[0]['total'] > 0) {
            // Redirigimos con un parámetro de error
            header("Location: index.php?controller=Horarios&action=index&error=duplicado");
        } else {
            $horarioModel->registrar($hora);
            header("Location: index.php?controller=Horarios&action=index&success=true");
        }
    }
}

    public function eliminar() {
        if (isset($_GET['id'])) {
            $horarioModel = $this->model('Horario');
            $horarioModel->eliminar($_GET['id']);
            header("Location: index.php?controller=Horarios&action=index");
        }
    }
}