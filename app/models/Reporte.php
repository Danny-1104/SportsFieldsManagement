<?php
// app/models/Reporte.php

class Reporte {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Obtener Estados para el ComboBox
    public function obtenerEstados() {
        return $this->db->select("SELECT * FROM estado ORDER BY est_id ASC");
    }

    // Lógica principal del Reporte
    public function generarReporte($inicio, $fin, $est_id = null) {
        $sql = "SELECT a.alq_id, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin, a.alq_valor, 
                       u.nombre_usu, e.est_nombre,
                       -- Calculamos la diferencia de horas en SQL
                       TIMESTAMPDIFF(MINUTE, a.alq_hora_ini, a.alq_hora_fin) / 60 as horas_jugadas
                FROM alquiler a
                INNER JOIN usuario u ON a.id_usu = u.id_usu
                INNER JOIN estado e ON a.est_id = e.est_id
                WHERE a.alq_fecha BETWEEN ? AND ?";

        $params = [$inicio, $fin];

        // Si NO es "Todos" (es decir, $est_id tiene un valor), filtramos por estado
        if ($est_id != null) {
            $sql .= " AND a.est_id = ?";
            $params[] = $est_id;
        }

        $sql .= " ORDER BY a.alq_fecha DESC, a.alq_hora_ini ASC";

        return $this->db->select($sql, $params);
    }
}