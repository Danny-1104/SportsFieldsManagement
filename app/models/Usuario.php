<?php
// app/models/Usuario.php

class Usuario {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Registrar usuario y asignarle rol Cliente
    public function registrar($nombre_usu, $email, $password) {
        // Validar datos básicos
        if (empty($nombre_usu) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Campos requeridos'];
        }

        // 1. Verificar si existe (por nombre o correo)
        $sqlCheck = "SELECT COUNT(*) as total FROM usuario WHERE nombre_usu = ? OR correo_usu = ?";
        $check = $this->db->select($sqlCheck, [$nombre_usu, $email]);

        if ($check && $check[0]['total'] > 0) {
            return ['success' => false, 'message' => 'El usuario o correo ya existe'];
        }

        // 2. Hash de contraseña
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // 3. Insertar Usuario
        $sqlUser = "INSERT INTO usuario (nombre_usu, correo_usu, password_usu) VALUES (?, ?, ?)";
        if ($this->db->insert($sqlUser, [$nombre_usu, $email, $hash])) {
            
            $id_usuario = $this->db->lastInsertId();

            // 4. Asignar Rol Cliente (ID 3 según tus datos semilla)
            // Asegúrate que en tu tabla 'rol' el Cliente tenga id_rol = 3
            $sqlRol = "INSERT INTO usuario_rol (id_usu, id_rol) VALUES (?, 3)";
            $this->db->insert($sqlRol, [$id_usuario]);

            return ['success' => true, 'message' => 'Registro exitoso'];
        }

        return ['success' => false, 'message' => 'Error al registrar usuario'];
    }

    // Autenticar usuario
    public function autenticar($usuario_o_correo, $password) {
        // Buscar por nombre o correo
        $sql = "SELECT id_usu, nombre_usu, password_usu, correo_usu 
                FROM usuario 
                WHERE nombre_usu = ? OR correo_usu = ?";
        
        $result = $this->db->select($sql, [$usuario_o_correo, $usuario_o_correo]);

        if (!$result || count($result) === 0) {
            return ['success' => false, 'message' => 'Usuario no encontrado'];
        }

        $user = $result[0];

        // Verificar Password
        if (password_verify($password, $user['password_usu'])) {
            
            // Obtener Rol
            $sqlRol = "SELECT r.nombre_rol 
                       FROM rol r 
                       JOIN usuario_rol ur ON r.id_rol = ur.id_rol 
                       WHERE ur.id_usu = ?";
            $resRol = $this->db->select($sqlRol, [$user['id_usu']]);
            $rol = $resRol ? $resRol[0]['nombre_rol'] : 'Cliente';

            return [
                'success' => true,
                'usuario' => [
                    'id_usu' => $user['id_usu'],
                    'nombre_usu' => $user['nombre_usu'],
                    'rol' => $rol
                ]
            ];
        }

        return ['success' => false, 'message' => 'Contraseña incorrecta'];
    }
}