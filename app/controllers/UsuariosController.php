<?php
// app/controllers/UsuariosController.php

class UsuariosController extends Controller {

    public function index() {
        $usuarioModel = $this->model('Usuario'); 
        $datos_usuarios = $usuarioModel->obtenerTodos();
        $vista_interna = '../app/views/usuarios/index.php';
        $titulo_pagina = "Gestión de Usuarios";
        require_once '../app/views/dashboards/admin.php';
    }

    public function crear() {
        $titulo_pagina = "Nuevo Cliente";
        $vista_interna = '../app/views/usuarios/crear.php';
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre_usu'];
            $correo = $_POST['correo_usu'];
            $pass = $_POST['password_usu'];

            $usuarioModel = $this->model('Usuario');
            $resultado = $usuarioModel->registrar($nombre, $correo, $pass);

            if ($resultado['success']) {
                header("Location: index.php?controller=Usuarios&action=index&msg=save_ok");
            } else {
                header("Location: index.php?controller=Usuarios&action=index&msg=error_dup");
            }
            exit;
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $usuarioModel = $this->model('Usuario');
            if ($usuarioModel->eliminar($_GET['id'])) {
                header("Location: index.php?controller=Usuarios&action=index&msg=delete_ok");
                exit;
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuarioModel = $this->model('Usuario');
            $usuario = $usuarioModel->obtenerPorId($id);

            $titulo_pagina = "Editar Usuario";
            $vista_interna = '../app/views/usuarios/editar.php';
            require_once '../app/views/dashboards/admin.php';
        }
    }

    public function modificar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_usu'];
            $nombre = $_POST['nombre_usu'];
            $correo = $_POST['correo_usu'];

            $usuarioModel = $this->model('Usuario');
            if ($usuarioModel->actualizar($id, $nombre, $correo)) {
                header("Location: index.php?controller=Usuarios&action=index&msg=edit_ok");
                exit;
            }
        }
    }
}