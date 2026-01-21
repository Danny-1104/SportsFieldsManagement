<?php
// app/models/Alquiler.php

class Alquiler {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    /**
     * Obtiene estadísticas para las tarjetas del Dashboard Cliente
     */
    public function obtenerEstadisticasCliente($id_usuario) {
        // Asumimos ID 2=Aprobado, 3=Finalizado según tus datos semilla
        $sqlDinero = "SELECT SUM(alq_valor) as total_dinero 
                      FROM alquiler 
                      WHERE id_usu = ? AND est_id IN (2, 3)";
        $resDinero = $this->db->select($sqlDinero, [$id_usuario]);
        $totalDinero = $resDinero[0]['total_dinero'] ?? 0;

        // Sumamos la diferencia de horas real
        $sqlHoras = "SELECT SUM(TIMESTAMPDIFF(HOUR, alq_hora_ini, alq_hora_fin)) as total_horas
                     FROM alquiler 
                     WHERE id_usu = ? AND est_id IN (2, 3)";
        $resHoras = $this->db->select($sqlHoras, [$id_usuario]);
        $totalHoras = $resHoras[0]['total_horas'] ?? 0;

        return [
            'dinero' => $totalDinero,
            'horas' => $totalHoras
        ];
    }

    /**
     * Obtiene los últimos 10 arriendos para la tabla del Cliente
     */
    public function obtenerUltimosAlquileres($id_usuario, $limite = 10) {
        $sql = "SELECT a.alq_id, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin, a.alq_valor, 
                       c.can_nombre, e.est_nombre, e.est_id
                FROM alquiler a
                JOIN cancha c ON a.can_id = c.can_id
                JOIN estado e ON a.est_id = e.est_id
                WHERE a.id_usu = ?
                ORDER BY a.alq_fecha DESC, a.alq_hora_ini DESC
                LIMIT $limite";
        
        return $this->db->select($sql, [$id_usuario]);
    }

    /**
     * Obtiene la agenda pública (RF-PUB-02)
     * Solo reservas APROBADAS y FUTURAS para mostrar en el Home
     */
    public function obtenerAgendaPublica() {
        $sql = "SELECT c.can_nombre, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin
                FROM alquiler a
                JOIN cancha c ON a.can_id = c.can_id
                JOIN estado e ON a.est_id = e.est_id
                WHERE e.est_nombre = 'Aprobado' 
                AND a.alq_fecha >= CURDATE()
                ORDER BY a.alq_fecha ASC, a.alq_hora_ini ASC
                LIMIT 10"; 
        
        return $this->db->select($sql);
    }
}