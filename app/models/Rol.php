<?php
// app/models/Rol.php

class Rol {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Obtener usuarios con su rol actual
    public function obtenerUsuariosConRoles() {
        $sql = "SELECT u.id_usu, u.nombre_usu, r.id_rol, r.nombre_rol 
            FROM usuario u
                INNER JOIN usuario_rol ur ON u.id_usu = ur.id_usu
                INNER JOIN rol r ON ur.id_rol = r.id_rol
                ORDER BY u.id_usu ASC";
        $res = $this->db->select($sql);
        return $res ?: [];
    }

    // Lista de roles para el select
    public function obtenerListaRoles() {
        $sql = "SELECT * FROM rol";
        return $this->db->select($sql);
    }

    // Datos para el formulario de edición
    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT u.id_usu, u.nombre_usu, ur.id_rol 
            FROM usuario u
                INNER JOIN usuario_rol ur ON u.id_usu = ur.id_usu
                WHERE u.id_usu = ?";
        $res = $this->db->select($sql, [$id]);
        if (is_array($res) && isset($res[0])) return $res[0];
        return null;
    }

    // Actualizar SOLO el rol en la tabla intermedia
    public function actualizarRolUsuario($id_usuario, $id_nuevo_rol) {
        $sql = "UPDATE usuario_rol SET id_rol = ? WHERE id_usu = ?";
        // Usamos insert porque tu clase DB usa execute dentro de insert
        return $this->db->insert($sql, [$id_nuevo_rol, $id_usuario]);
    }
    
    // Eliminar usuario
    public function eliminarUsuario($id) {
        $this->db->insert("DELETE FROM usuario_rol WHERE id_usu = ?", [$id]);
        return $this->db->insert("DELETE FROM usuario WHERE id_usu = ?", [$id]);
    }
}