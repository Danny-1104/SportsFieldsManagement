<?php
// app/controllers/AlquilerController.php
require_once '../app/models/Alquiler.php';

class AlquilerController extends Controller {
    
    public function __construct() {
        parent::__construct(); // Cargar conexión a DB
        
        // Validar sesión: Solo Clientes pueden reservar
        if (!isset($_SESSION['autenticado']) || $_SESSION['usuario_rol'] != 'Cliente') {
            header('Location: index.php?controller=Auth&action=login');
            exit;
        }
    }

    // 1. Mostrar el formulario
    public function crear() {
        $modelo = new Alquiler($this->db);
        
        // Obtenemos datos para llenar los selectores
        $canchas = $modelo->obtenerCanchas();
        $horarios = $modelo->obtenerHorarios();
        $precioHora = 0; // Se puede manejar dinámico con JS en la vista
        
        $this->view('alquiler/crear', [
            'canchas' => $canchas,
            'horarios' => $horarios,
            'precioHora' => 15.00, // Precio base referencia si se necesita en vista
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ]);
    }

    // 2. Guardar la reserva
    public function guardar() {
        // Verificar si se enviaron datos por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // --- A. PROCESAR ARCHIVO (COMPROBANTE) ---
            $nombreArchivo = '';
            
            // Verificamos si se subió un archivo sin errores
            if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
                $directorio = '../public/uploads/comprobantes/';
                
                // Crear carpeta si no existe
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                // Validar extensión
                $ext = pathinfo($_FILES['comprobante']['name'], PATHINFO_EXTENSION);
                // Generar nombre único: ID_Fecha_Random.ext
                $nombreArchivo = $_SESSION['usuario_id'] . '_' . uniqid() . '.' . $ext;
                
                if (!move_uploaded_file($_FILES['comprobante']['tmp_name'], $directorio . $nombreArchivo)) {
                    die("Error al guardar el archivo en el servidor.");
                }
            }

            // --- B. PREPARAR DATOS PARA EL MODELO ---
            // IMPORTANTE: Estas llaves coinciden con las que pusimos en Alquiler.php
            $datos = [
                'id_usuario'  => $_SESSION['usuario_id'],
                'cancha'      => $_POST['cancha'],
                'fecha'       => $_POST['fecha'],
                'hora_ini'    => $_POST['hora_ini'],
                'hora_fin'    => $_POST['hora_fin'],
                'valor_total' => $_POST['valor_total'], // Viene del input readonly del formulario
                'comprobante' => $nombreArchivo
            ];

            // --- C. GUARDAR EN BASE DE DATOS ---
            $alquilerModel = new Alquiler($this->db);
            
            // Opcional: Verificar conflicto de horario antes de guardar (Doble seguridad)
            if ($alquilerModel->verificarConflicto($datos['cancha'], $datos['fecha'], $datos['hora_ini'], $datos['hora_fin'])) {
                 echo "<script>alert('Error: El horario seleccionado ya está ocupado.'); window.history.back();</script>";
                 exit;
            }

            if ($alquilerModel->registrarAlquiler($datos)) {
                // Éxito: Redirigir al Dashboard del Cliente
                header('Location: index.php?controller=Dashboard&action=cliente&msg=save_ok');
                exit;
            } else {
                echo "Error al guardar la reserva en la Base de Datos.";
            }

        } else {
            // Si intentan entrar directo sin POST, devolver al formulario
            header('Location: index.php?controller=Alquiler&action=crear');
        }
    }
}