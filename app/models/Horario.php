<?php
// app/models/Horario.php

class Horario {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Listar todos
    public function obtenerTodos() {
        $sql = "SELECT * FROM horario ORDER BY hor_nombre ASC";
        return $this->db->select($sql);
    }

    // --- NUEVO: Obtener por ID (Para cargar el formulario de edición) ---
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM horario WHERE hor_id = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    // Guardar nuevo
    public function guardar($hora) {
        // Validar duplicados
        $check = $this->db->select("SELECT count(*) as total FROM horario WHERE hor_nombre = ?", [$hora]);
        if ($check[0]['total'] > 0) return false;

        $sql = "INSERT INTO horario (hor_nombre) VALUES (?)";
        return $this->db->insert($sql, [$hora]);
    }

    // --- NUEVO: Actualizar Horario ---
    public function actualizar($id, $hora) {
        // Validamos que la nueva hora no esté ocupada por OTRO registro (excepto el actual)
        $sqlCheck = "SELECT count(*) as total FROM horario WHERE hor_nombre = ? AND hor_id != ?";
        $check = $this->db->select($sqlCheck, [$hora, $id]);
        
        if ($check[0]['total'] > 0) {
            return false; // Hora ocupada
        }

        // Usamos insert() si tu clase DB lo requiere para ejecutar UPDATE
        $sql = "UPDATE horario SET hor_nombre = ? WHERE hor_id = ?";
        return $this->db->insert($sql, [$hora, $id]);
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM horario WHERE hor_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}