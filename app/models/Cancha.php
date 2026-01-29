<?php
// app/models/Cancha.php

class Cancha {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM cancha ORDER BY can_id ASC";
        return $this->db->select($sql);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM cancha WHERE can_id = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    public function guardar($nombre, $precio) {
        $sql = "INSERT INTO cancha (can_nombre, can_precio_hora) VALUES (?, ?)";
        return $this->db->insert($sql, [$nombre, $precio]);
    }

    // --- CORRECCIÓN AQUÍ ---
    // Usamos $this->db->insert para ejecutar el UPDATE (según tu clase Database)
    public function actualizar($id, $nombre, $precio) {
        $sql = "UPDATE cancha SET can_nombre = ?, can_precio_hora = ? WHERE can_id = ?";
        return $this->db->insert($sql, [$nombre, $precio, $id]); 
    }

    public function eliminar($id) {
        $sql = "DELETE FROM cancha WHERE can_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}