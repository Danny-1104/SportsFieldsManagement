<?php
class Cancha {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function registrar($nombre, $precio, $descripcion) {
        // Añadimos '' para la columna can_foto para evitar el error de base de datos
        $sql = "INSERT INTO cancha (can_nombre, can_precio_hora, can_descripcion, can_foto) VALUES (?, ?, ?, ?)";
        return $this->db->insert($sql, [$nombre, $precio, $descripcion, '']); 
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM cancha ORDER BY can_id DESC";
        return $this->db->select($sql);
    }
}