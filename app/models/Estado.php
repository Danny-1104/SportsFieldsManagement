<?php
class Estado {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM estado ORDER BY est_id ASC";
        return $this->db->select($sql);
    }

    public function registrar($nombre) {
        // Validamos duplicados antes de insertar
        $sqlCheck = "SELECT COUNT(*) as total FROM estado WHERE est_nombre = ?";
        $check = $this->db->select($sqlCheck, [$nombre]);

        if ($check[0]['total'] > 0) return false;

        $sql = "INSERT INTO estado (est_nombre) VALUES (?)";
        return $this->db->insert($sql, [$nombre]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM estado WHERE est_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}