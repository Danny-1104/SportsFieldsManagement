<?php
// app/models/Estado.php

class Estado {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM estado ORDER BY est_id ASC";
        return $this->db->select($sql);
    }

    // --- NUEVO ---
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM estado WHERE est_id = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    public function guardar($nombre) {
        $sqlCheck = "SELECT count(*) as total FROM estado WHERE est_nombre = ?";
        $check = $this->db->select($sqlCheck, [$nombre]);
        if ($check[0]['total'] > 0) return false;

        $sql = "INSERT INTO estado (est_nombre) VALUES (?)";
        return $this->db->insert($sql, [$nombre]);
    }

    // --- NUEVO ---
    public function actualizar($id, $nombre) {
        $sql = "UPDATE estado SET est_nombre = ? WHERE est_id = ?";
        return $this->db->insert($sql, [$nombre, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM estado WHERE est_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}