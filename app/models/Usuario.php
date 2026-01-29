<?php
// app/models/Usuario.php

class Usuario {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // --- 1. OBTENER CLIENTES (Con Fecha de Registro) ---
    public function obtenerTodos() {
        // Traemos created_at para mostrar la fecha
        $sql = "SELECT u.id_usu, u.nombre_usu, u.correo_usu, u.password_usu, u.created_at
                FROM usuario u
                INNER JOIN usuario_rol ur ON u.id_usu = ur.id_usu
                WHERE ur.id_rol = 3 
                ORDER BY u.id_usu DESC";
        return $this->db->select($sql);
    }

    // --- 2. OBTENER UN USUARIO POR ID ---
    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuario WHERE id_usu = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    // --- 3. EDITAR USUARIO (Nombre, Correo y Contraseña Opcional) ---
    public function editarUsuario($id, $nombre, $correo, $password = null) {
        if ($password) {
            // Si el admin escribió una nueva contraseña, actualizamos TODO
            $sql = "UPDATE usuario SET nombre_usu = ?, correo_usu = ?, password_usu = ? WHERE id_usu = ?";
            return $this->db->update($sql, [$nombre, $correo, $password, $id]);
        } else {
            // Si dejó la contraseña vacía, solo actualizamos nombre y correo
            $sql = "UPDATE usuario SET nombre_usu = ?, correo_usu = ? WHERE id_usu = ?";
            return $this->db->update($sql, [$nombre, $correo, $id]);
        }
    }

    // --- 4. REGISTRAR y ELIMINAR (Se mantienen igual que antes) ---
    public function registrar($nombre, $correo, $password) {
        $sqlCheck = "SELECT COUNT(*) as total FROM usuario WHERE correo_usu = ?";
        $check = $this->db->select($sqlCheck, [$correo]);
        if ($check[0]['total'] > 0) return false;

        $sqlUser = "INSERT INTO usuario (nombre_usu, correo_usu, password_usu) VALUES (?, ?, ?)";
        if (strlen($password) < 50) $password = password_hash($password, PASSWORD_BCRYPT);

        if ($this->db->insert($sqlUser, [$nombre, $correo, $password])) {
            $id_usuario = $this->db->lastInsertId();
            $sqlRol = "INSERT INTO usuario_rol (id_usu, id_rol) VALUES (?, 3)";
            return $this->db->insert($sqlRol, [$id_usuario]);
        }
        return false;
    }

    public function eliminar($id) {
        $this->db->insert("DELETE FROM usuario_rol WHERE id_usu = ?", [$id]);
        return $this->db->insert("DELETE FROM usuario WHERE id_usu = ?", [$id]);
    }
    
    // Autenticar (Login) se queda igual...
    public function autenticar($usuario_o_correo, $password) {
        // ... (Tu código de login que ya funcionaba) ...
         $sql = "SELECT id_usu, nombre_usu, password_usu, correo_usu FROM usuario WHERE nombre_usu = ? OR correo_usu = ?";
         $result = $this->db->select($sql, [$usuario_o_correo, $usuario_o_correo]);
         if (!$result) return ['success' => false, 'message' => 'Usuario no encontrado'];
         $user = $result[0];
         if (password_verify($password, $user['password_usu'])) {
             $sqlRol = "SELECT ur.id_rol FROM usuario_rol ur WHERE ur.id_usu = ?";
             $resRol = $this->db->select($sqlRol, [$user['id_usu']]);
             $id_rol = $resRol ? $resRol[0]['id_rol'] : 3;
             return ['success' => true, 'usuario' => ['id_usu' => $user['id_usu'], 'nombre_usu' => $user['nombre_usu'], 'rol' => ($id_rol==1?'Administrador':'Cliente'), 'id_rol' => $id_rol]];
         }
         return ['success' => false, 'message' => 'Contraseña incorrecta'];
    }

    // Función para contar SOLO Clientes (Corregida)
    public function contarClientes() {
        // ERROR ANTERIOR: "WHERE usu_rol = 'Cliente'" (Esa columna no existe)
        
        // SOLUCIÓN: Contamos cuántas personas tienen el rol 3 (Cliente) en la tabla usuario_rol
        $sql = "SELECT COUNT(*) as total FROM usuario_rol WHERE id_rol = 3";

        $resultado = $this->db->select($sql);
        return $resultado[0]['total'] ?? 0;
    }
}