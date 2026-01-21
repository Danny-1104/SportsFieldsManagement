<?php
// app/controllers/AuthController.php

// Importamos el Modelo de Usuario para poder usarlo
require_once '../app/models/Usuario.php';

class AuthController extends Controller {
    
    /**
     * Muestra la página de Login o redirige si ya hay sesión
     */
    public function index() {
        if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true) {
            $this->redirigirPorRol($_SESSION['usuario_rol']);
        } else {
            $this->view('auth/login');
        }
    }

    /**
     * Procesa el inicio de sesión
     */
    public function login() {
        // Si es una petición POST, procesamos los datos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_usu = isset($_POST['nombre_usu']) ? trim($_POST['nombre_usu']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Instanciamos el modelo y pasamos la conexión a BD ($this->db viene del Controller padre)
            $usuarioModel = new Usuario($this->db);
            $resultado = $usuarioModel->autenticar($nombre_usu, $password);

            if ($resultado['success']) {
                // Guardamos datos críticos en la sesión
                $_SESSION['autenticado'] = true;
                $_SESSION['usuario_id'] = $resultado['usuario']['id_usu'];
                $_SESSION['usuario_nombre'] = $resultado['usuario']['nombre_usu'];
                $_SESSION['usuario_rol'] = $resultado['usuario']['rol']; // Ejemplo: 'Cliente', 'Administrador'

                // Redirigimos al dashboard correspondiente
                $this->redirigirPorRol($resultado['usuario']['rol']);
            } else {
                // Si falla, devolvemos al login con mensaje de error
                header('Location: index.php?controller=Auth&action=login&msg=error');
            }
        } else {
            // Si intentan entrar por GET a la acción login, mostramos la vista
            $this->index();
        }
    }

    /**
     * Procesa el registro de un nuevo usuario
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger datos del formulario
            $nombre_usu = isset($_POST['nombre_usu']) ? trim($_POST['nombre_usu']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

            // 1. Validar que las contraseñas coincidan
            if ($password !== $confirm) {
                header('Location: index.php?controller=Auth&action=register&msg=mismatch');
                exit;
            }

            // 2. Intentar registrar en la base de datos
            $usuarioModel = new Usuario($this->db);
            $resultado = $usuarioModel->registrar($nombre_usu, $email, $password);

            if ($resultado['success']) {
                // ÉXITO: Iniciamos el flujo de verificación de email
                
                // Generamos un código de prueba (En producción esto se enviaría por email real)
                $_SESSION['codigo_verificacion'] = 'ABC12345'; 
                $_SESSION['temp_email'] = $email;

                // Redirigimos a la pantalla de ingresar código
                header('Location: index.php?controller=Auth&action=verificaremail');
                exit;
            } else {
                // FALLO: Verificamos si es por usuario duplicado u otro error
                $msg = (strpos($resultado['message'], 'existe') !== false) ? 'exists' : 'error';
                header('Location: index.php?controller=Auth&action=register&msg=' . $msg);
                exit;
            }
        } else {
            // Mostrar formulario de registro
            $this->view('auth/register');
        }
    }

    /**
     * Pantalla y lógica para verificar el código de email
     */
    public function verificaremail() {
        // Si no hay código generado, no deberían estar aquí -> mandar al registro
        if (!isset($_SESSION['codigo_verificacion'])) {
            header('Location: index.php?controller=Auth&action=register');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_ingresado = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';
            $codigo_real = $_SESSION['codigo_verificacion'];

            // Comparación simple
            if ($codigo_ingresado === $codigo_real) {
                // Código correcto: Limpiamos variables temporales
                unset($_SESSION['codigo_verificacion']);
                unset($_SESSION['temp_email']);

                // Redirigimos al Login con mensaje de éxito
                header('Location: index.php?controller=Auth&action=login&msg=registrosuccess');
                exit;
            } else {
                // Código incorrecto: Recargamos la vista con error
                header('Location: index.php?controller=Auth&action=verificaremail&msg=codigoincorrecto');
                exit;
            }
        } else {
            // Mostrar la vista de verificación
            $this->view('auth/verificaremail');
        }
    }

    /**
     * Cierra la sesión y redirige al Home público
     */
    public function logout() {
        // Borra todas las variables de sesión
        session_unset(); 
        // Destruye la sesión completamente
        session_destroy();
        
        header('Location: index.php?controller=Home&action=index');
        exit;
    }

    /**
     * Función auxiliar privada para dirigir al usuario según su Rol
     */
    private function redirigirPorRol($rol) {
        switch ($rol) {
            case 'Administrador':
                header('Location: index.php?controller=Dashboard&action=admin');
                break;
            case 'Organizador':
                header('Location: index.php?controller=Dashboard&action=organizador');
                break;
            case 'Cliente':
                header('Location: index.php?controller=Dashboard&action=cliente');
                break;
            default:
                // Si el rol no es reconocido, lo mandamos al home por seguridad
                header('Location: index.php?controller=Home&action=index');
                break;
        }
        exit;
    }
}