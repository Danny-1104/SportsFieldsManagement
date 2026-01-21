<?php
// app/controllers/AlquilerController.php
require_once '../app/models/Alquiler.php';

class AlquilerController extends Controller {
    
    public function __construct() {
        parent::__construct(); // Cargar DB
        // Validar sesión
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Cliente') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    // 1. Mostrar el formulario (RF-CLI-02)
    public function crear() {
        $modelo = new Alquiler($this->db);
        
        $canchas = $modelo->obtenerCanchas();
        $precioHora = $modelo->obtenerPrecioHora();
        
        $this->view('alquiler/crear', [
            'canchas' => $canchas,
            'precioHora' => $precioHora,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ]);
    }

    // 2. Guardar la reserva
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $modelo = new Alquiler($this->db);

            // Datos del formulario
            $cancha = $_POST['cancha'];
            $fecha = $_POST['fecha'];
            $hora_ini = $_POST['hora_ini'];
            $hora_fin = $_POST['hora_fin'];
            $valor_calculado = $_POST['valor_total']; // Viene del JS, pero idealmente se recalcula en backend por seguridad
            
            // Procesar Archivo (Comprobante)
            $archivoNombre = '';
            if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] == 0) {
                $permitidos = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
                $tipo = $_FILES['comprobante']['type'];
                
                if (in_array($tipo, $permitidos)) {
                    $carpeta = '../public/uploads/comprobantes/';
                    if (!is_dir($carpeta)) mkdir($carpeta, 0777, true);
                    
                    // Generar nombre único: IDusuario_Fecha_Random.ext
                    $ext = pathinfo($_FILES['comprobante']['name'], PATHINFO_EXTENSION);
                    $archivoNombre = $_SESSION['usuario_id'] . '_' . date('YmdHis') . '.' . $ext;
                    
                    move_uploaded_file($_FILES['comprobante']['tmp_name'], $carpeta . $archivoNombre);
                }
            }

            // Guardar en BD
            $datos = [
                'id_usu' => $_SESSION['usuario_id'],
                'can_id' => $cancha,
                'fecha' => $fecha,
                'hora_ini' => $hora_ini,
                'hora_fin' => $hora_fin,
                'valor' => $valor_calculado,
                'comprobante' => $archivoNombre
            ];

            if ($modelo->registrarAlquiler($datos)) {
                // Éxito: Volver al dashboard
                header('Location: index.php?controller=Dashboard&action=cliente&msg=reservacreada');
            } else {
                echo "Error al guardar la reserva.";
            }
        }
    }
}