<?php
class Cancha {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function registrar($nombre, $precio) {
        $sql = "INSERT INTO cancha (can_nombre, can_precio_hora) VALUES (?, ?)";
        return $this->db->insert($sql, [$nombre, $precio]); 
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM cancha ORDER BY can_id DESC";
        return $this->db->select($sql);
    }

    // NUEVA FUNCIÓN: Permite borrar la cancha por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM cancha WHERE can_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}