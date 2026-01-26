<?php
// app/models/Usuario.php

class Usuario {
    private $db;

public function __construct($database) {
    $this->db = $database;
}


    // --- CÓDIGO EXISTENTE (Registro y Login) ---

    // Registrar usuario y asignarle rol Cliente
    public function registrar($nombre_usu, $email, $password) {
        if (empty($nombre_usu) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Campos requeridos'];
        }

        $sqlCheck = "SELECT COUNT(*) as total FROM usuario WHERE nombre_usu = ? OR correo_usu = ?";
        $check = $this->db->select($sqlCheck, [$nombre_usu, $email]);

        if ($check && $check[0]['total'] > 0) {
            return ['success' => false, 'message' => 'El usuario o correo ya existe'];
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $sqlUser = "INSERT INTO usuario (nombre_usu, correo_usu, password_usu) VALUES (?, ?, ?)";
        if ($this->db->insert($sqlUser, [$nombre_usu, $email, $hash])) {
            
            $id_usuario = $this->db->lastInsertId();

            // Rol Cliente (ID 3)
            $sqlRol = "INSERT INTO usuario_rol (id_usu, id_rol) VALUES (?, 3)";
            $this->db->insert($sqlRol, [$id_usuario]);

            return ['success' => true, 'message' => 'Registro exitoso'];
        }

        return ['success' => false, 'message' => 'Error al registrar usuario'];
    }

    // Autenticar usuario
    public function autenticar($usuario_o_correo, $password) {
        $sql = "SELECT id_usu, nombre_usu, password_usu, correo_usu 
                FROM usuario 
                WHERE nombre_usu = ? OR correo_usu = ?";
        
        $result = $this->db->select($sql, [$usuario_o_correo, $usuario_o_correo]);

        if (!$result || count($result) === 0) {
            return ['success' => false, 'message' => 'Usuario no encontrado'];
        }

        $user = $result[0];

        if (password_verify($password, $user['password_usu'])) {
            
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

    // --- NUEVO CÓDIGO AGREGADO PARA EL ADMINISTRADOR ---

    // 1. Obtener TODOS los usuarios (Para la tabla de Gestión Clientes)
    public function obtenerTodos() {
        $sql = "SELECT * FROM usuario";
        // Retorna el array de usuarios directamente usando tu clase Database
        return $this->db->select($sql);
    }

    // 2. Obtener UN usuario por ID (Para cuando quieras editar uno)
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuario WHERE id_usu = ?";
        $result = $this->db->select($sql, [$id]);
        return $result ? $result[0] : null;
    }

    // 3. Eliminar usuario (Para el botón rojo de la tabla)
    public function eliminar($id) {
        $sql = "DELETE FROM usuario WHERE id_usu = ?";
        // Usamos insert porque tu clase Database usa 'execute' dentro de insert, sirve para DELETE también
        return $this->db->insert($sql, [$id]); 
    }
    //metodo actualizar 
    public function actualizar($id, $nombre, $correo) {
    $sql = "UPDATE usuario SET nombre_usu = ?, correo_usu = ? WHERE id_usu = ?";
    return $this->db->insert($sql, [$nombre, $correo, $id]); // Tu DB usa insert para ejecutar
}
}