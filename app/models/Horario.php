<?php
class Horario {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function obtenerTodos() {
        // Ordenamos por hora para que al usuario le aparezcan en orden cronológico
        $sql = "SELECT * FROM horario ORDER BY hor_nombre ASC";
        return $this->db->select($sql);
    }

    public function registrar($hora) {
        $sql = "INSERT INTO horario (hor_nombre) VALUES (?)";
        return $this->db->insert($sql, [$hora]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM horario WHERE hor_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}