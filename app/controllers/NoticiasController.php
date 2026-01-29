<?php
// app/controllers/NoticiasController.php
require_once '../app/models/Noticia.php';

class NoticiasController extends Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Administrador') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    public function index() {
        $modelo = new Noticia($this->db);
        $noticias = $modelo->obtenerTodas();
        
        $vista_interna = '../app/views/noticias/index.php';
        $titulo_pagina = "Gestión de Noticias";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    public function crear() {
        $vista_interna = '../app/views/noticias/crear.php';
        $titulo_pagina = "Nueva Noticia";
        $usuario_nombre = $_SESSION['usuario_nombre'];
        require_once '../app/views/dashboards/admin.php';
    }

    // --- GUARDAR CON SUBIDA DE IMAGEN ---
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Noticia($this->db);
            
            // Procesar Imagen
            $ruta_imagen = ''; // Valor por defecto
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ruta_imagen = $this->subirImagen($_FILES['imagen']);
                if (!$ruta_imagen) {
                    echo "<script>alert('Error al subir la imagen. Intenta de nuevo.'); window.history.back();</script>";
                    return;
                }
            }

            if ($modelo->guardar($ruta_imagen, $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['descripcion'])) {
                header("Location: index.php?controller=Noticias&action=index&msg=save_ok");
            } else {
                echo "<script>alert('Error al guardar en BD'); window.history.back();</script>";
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $modelo = new Noticia($this->db);
            $noticia = $modelo->obtenerPorId($_GET['id']);
            
            if ($noticia) {
                $vista_interna = '../app/views/noticias/editar.php';
                $titulo_pagina = "Editar Noticia";
                $usuario_nombre = $_SESSION['usuario_nombre'];
                require_once '../app/views/dashboards/admin.php';
            } else {
                header("Location: index.php?controller=Noticias&action=index");
            }
        }
    }

    // --- ACTUALIZAR CON IMAGEN OPCIONAL ---
    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Noticia($this->db);
            $id = $_POST['id'];
            
            // 1. Obtener la imagen actual por si no sube una nueva
            $noticiaActual = $modelo->obtenerPorId($id);
            $ruta_final = $noticiaActual['not_imagen'];

            // 2. Si el usuario subió una NUEVA imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $nueva_ruta = $this->subirImagen($_FILES['imagen']);
                if ($nueva_ruta) {
                    $ruta_final = $nueva_ruta; // Reemplazamos la ruta anterior
                }
            }

            if ($modelo->actualizar($id, $ruta_final, $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['descripcion'])) {
                header("Location: index.php?controller=Noticias&action=index&msg=update_ok");
            } else {
                echo "<script>alert('Error al actualizar'); window.history.back();</script>";
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $modelo = new Noticia($this->db);
            $modelo->eliminar($_GET['id']);
            header("Location: index.php?controller=Noticias&action=index&msg=delete_ok");
        }
    }

    // --- FUNCIÓN PRIVADA PARA SUBIR IMÁGENES ---
    private function subirImagen($archivo) {
        // Carpeta destino (Asegúrate que exista: public/assets/img/noticias/)
        $carpeta_destino = 'assets/img/noticias/';
        
        // Generar nombre único para no sobreescribir
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = uniqid('noticia_') . '.' . $extension;
        $ruta_completa = $carpeta_destino . $nombre_archivo;

        // Mover el archivo de temporal a la carpeta final
        // NOTA: Usamos ../public/ porque el controlador suele estar en app/controllers
        // Ajusta esta ruta de 'move_uploaded_file' según tu estructura real.
        // Asumiendo que index.php está en public/, la ruta relativa es directa.
        if (move_uploaded_file($archivo['tmp_name'], $ruta_completa)) {
            return $ruta_completa; // Retornamos la ruta para guardar en BD
        }
        return false;
    }
}