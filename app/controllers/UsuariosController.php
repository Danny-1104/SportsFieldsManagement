<?php
// app/controllers/UsuariosController.php
require_once '../app/models/Usuario.php';

class UsuariosController extends Controller {

    public function __construct() {
        parent::__construct();
        // Seguridad: Solo Admin
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $usuarioModel = new Usuario($this->db);
        $usuarios = $usuarioModel->obtenerTodos(); // Esto ahora trae SOLO Clientes
        
        $vista_interna = '../app/views/usuarios/index.php';
        $titulo_pagina = "Gestión de Clientes";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function crear() {
        $vista_interna = '../app/views/usuarios/crear.php';
        $titulo_pagina = "Registrar Nuevo Cliente";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Usuario($this->db);
            // El modelo se encarga de ponerle Rol 3 automáticamente
            if ($model->registrar($_POST['nombre'], $_POST['correo'], $_POST['password'])) {
                header("Location: index.php?controller=Usuarios&action=index&msg=save_ok");
            } else {
                echo "<script>alert('Error: El correo ya existe'); window.history.back();</script>";
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $model = new Usuario($this->db);
            $usuario = $model->obtenerUsuarioPorId($_GET['id']);
            
            $vista_interna = '../app/views/usuarios/editar.php';
            $titulo_pagina = "Editar Cliente";
            $usuario_nombre = $_SESSION['usuario_nombre'];
            require_once '../app/views/dashboards/admin.php';
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_usu'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            
            // Si el campo password viene vacío, mandamos NULL
            $passHash = null;
            if (!empty($_POST['password'])) {
                $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            $model = new Usuario($this->db);
            
            // El modelo se encargará de decidir si actualiza la contraseña o no
            if ($model->editarUsuario($id, $nombre, $correo, $passHash)) {
                header("Location: index.php?controller=Usuarios&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $model = new Usuario($this->db);
            // Evitar que el admin se borre a sí mismo por error (aunque el filtro ya lo oculta)
            if ($_GET['id'] == $_SESSION['usuario_id']) {
                header("Location: index.php?controller=Usuarios&action=index&msg=error");
                exit;
            }
            $model->eliminar($_GET['id']);
            header("Location: index.php?controller=Usuarios&action=index&msg=delete_ok");
        }
    }
}