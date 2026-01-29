<?php
// app/controllers/RolesController.php
require_once '../app/models/Rol.php';

class RolesController extends Controller {

    public function __construct() {
        parent::__construct();
        // Seguridad
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Rol($this->db);
        $usuarios = $modelo->obtenerUsuariosConRoles();
        
        $vista_interna = '../app/views/roles/index.php';
        $titulo_pagina = "Gestión de Roles";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Rol($this->db);
            $usuario = $modelo->obtenerUsuarioPorId($_GET['id']);
            $roles = $modelo->obtenerListaRoles();
            
            if ($usuario) {
                $vista_interna = '../app/views/roles/editar.php';
                $titulo_pagina = "Cambiar Rol de Usuario";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                require_once '../app/views/dashboards/admin.php';
            } else {
                header("Location: index.php?controller=Roles&action=index");
            }
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usu = $_POST['id_usu'];
            $id_rol = $_POST['rol'];

            // Protección: No quitarse el admin a sí mismo
            if ($id_usu == $_SESSION['usuario_id'] && $id_rol != 1) {
                 echo "<script>alert('Error: No puedes quitarte tu propio rol de Administrador.'); window.history.back();</script>";
                 exit;
            }

            $modelo = new Rol($this->db);
            if ($modelo->actualizarRolUsuario($id_usu, $id_rol)) {
                header("Location: index.php?controller=Roles&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }
    
    public function eliminar() {
        if (isset($_GET['id'])) {
            if ($_GET['id'] == $_SESSION['usuario_id']) {
                 echo "<script>alert('No puedes eliminar tu propia cuenta.'); window.location.href='index.php?controller=Roles&action=index';</script>";
                 exit;
            }
            $modelo = new Rol($this->db);
            $modelo->eliminarUsuario($_GET['id']);
            header("Location: index.php?controller=Roles&action=index&msg=delete_ok");
        }
    }
}