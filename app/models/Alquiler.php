<?php
// app/models/Alquiler.php

class Alquiler {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // --- CLIENTE: ESTADÍSTICAS ---
    public function obtenerEstadisticasCliente($id_usuario) {
        $sqlDinero = "SELECT SUM(alq_valor) as total_dinero FROM alquiler WHERE id_usu = ? AND est_id IN (2, 3)";
        $resDinero = $this->db->select($sqlDinero, [$id_usuario]);

        $sqlHoras = "SELECT SUM(TIMESTAMPDIFF(HOUR, alq_hora_ini, alq_hora_fin)) as total_horas FROM alquiler WHERE id_usu = ? AND est_id IN (2, 3)";
        $resHoras = $this->db->select($sqlHoras, [$id_usuario]);

        return [
            'dinero' => $resDinero[0]['total_dinero'] ?? 0,
            'horas' => $resHoras[0]['total_horas'] ?? 0
        ];
    }

    // --- CLIENTE: HISTORIAL (RF-CLI-01 Actualizado) ---
    public function obtenerUltimosAlquileres($id_usuario, $limite = 10) {
        // Agregamos 'a.alq_comprobante' a la consulta
        $sql = "SELECT a.alq_id, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin, a.alq_valor, a.alq_comprobante,
                       c.can_nombre, e.est_nombre, e.est_id
                FROM alquiler a
                JOIN cancha c ON a.can_id = c.can_id
                JOIN estado e ON a.est_id = e.est_id
                WHERE a.id_usu = ?
                ORDER BY a.alq_fecha DESC, a.alq_hora_ini DESC
                LIMIT $limite";
        
        return $this->db->select($sql, [$id_usuario]);
    }

    // --- CLIENTE: FORMULARIO DE RESERVA (RF-CLI-02) ---
    
    // 1. Obtener precio por hora global
    public function obtenerPrecioHora() {
        $sql = "SELECT valor_hora FROM configuracion LIMIT 1";
        $res = $this->db->select($sql);
        return $res[0]['valor_hora'] ?? 15.00; // Si no hay config, cobra $15 por defecto
    }

    // 2. Obtener lista de canchas
    public function obtenerCanchas() {
        return $this->db->select("SELECT * FROM cancha");
    }

    // 3. Guardar la reserva (INSERT)
    public function registrarAlquiler($datos) {
        $sql = "INSERT INTO alquiler (id_usu, can_id, est_id, alq_fecha, alq_hora_ini, alq_hora_fin, alq_valor, alq_comprobante) 
                VALUES (?, ?, 1, ?, ?, ?, ?, ?)";
        // est_id = 1 significa "Registrado" (Pendiente) automáticamente
        
        $params = [
            $datos['id_usu'],
            $datos['can_id'],
            $datos['fecha'],
            $datos['hora_ini'],
            $datos['hora_fin'],
            $datos['valor'],
            $datos['comprobante']
        ];
        
        // Usamos query/execute directamente porque insert no devuelve filas
        $this->db->query($sql);
        foreach ($params as $k => $v) $this->db->bind($k+1, $v);
        return $this->db->execute();
    }

    // --- PÚBLICO: AGENDA HOME ---
    public function obtenerAgendaPublica() {
        $sql = "SELECT c.can_nombre, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin
                FROM alquiler a
                JOIN cancha c ON a.can_id = c.can_id
                JOIN estado e ON a.est_id = e.est_id
                WHERE e.est_nombre = 'Aprobado' 
                AND a.alq_fecha >= CURDATE()
                ORDER BY a.alq_fecha ASC, a.alq_hora_ini ASC LIMIT 10"; 
        return $this->db->select($sql);
    }

    // --- ADMIN ---
    public function obtenerEstadisticasGlobales() {
        $sql = "SELECT SUM(alq_valor) as total_recaudado, SUM(TIMESTAMPDIFF(HOUR, alq_hora_ini, alq_hora_fin)) as total_horas FROM alquiler WHERE est_id IN (2, 3)";
        $res = $this->db->select($sql);
        return ['dinero' => $res[0]['total_recaudado'] ?? 0, 'horas' => $res[0]['total_horas'] ?? 0];
    }

    public function obtenerPendientesAprobacion() {
        $sql = "SELECT a.alq_id, a.alq_fecha, a.alq_hora_ini, a.alq_hora_fin, u.nombre_usu, c.can_nombre, a.alq_valor, a.alq_comprobante FROM alquiler a JOIN usuario u ON a.id_usu = u.id_usu JOIN cancha c ON a.can_id = c.can_id WHERE a.est_id = 1 ORDER BY a.created_at DESC";
        return $this->db->select($sql);
    }
}