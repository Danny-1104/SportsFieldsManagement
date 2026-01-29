<?php
// app/models/Alquiler.php

class Alquiler {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // =========================================================
    //              ZONA CLIENTE
    // =========================================================

    public function obtenerEstadisticasCliente($id_usuario) {
        $sqlDinero = "SELECT SUM(alq_valor) as total_dinero FROM alquiler WHERE id_usu = ? AND est_id IN (2, 3)";
        $resDinero = $this->db->select($sqlDinero, [$id_usuario]);

        $sqlHoras = "SELECT SUM(TIMESTAMPDIFF(HOUR, alq_hora_ini, alq_hora_fin)) as total_horas FROM alquiler WHERE id_usu = ?";
        $resHoras = $this->db->select($sqlHoras, [$id_usuario]);

        return [
            'dinero' => $resDinero[0]['total_dinero'] ?? 0,
            'horas' => $resHoras[0]['total_horas'] ?? 0
        ];
    }

    public function obtenerUltimosAlquileres($id_usuario, $limite = 10) {
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

    public function obtenerPrecioCancha($can_id) {
        $sql = "SELECT can_precio_hora FROM cancha WHERE can_id = ?";
        $res = $this->db->select($sql, [$can_id]);
        return $res[0]['can_precio_hora'] ?? 0.00;
    }

    public function obtenerHorarios() {
        return $this->db->select("SELECT * FROM horario ORDER BY hor_nombre");
    }

    public function obtenerCanchas() {
        return $this->db->select("SELECT * FROM cancha");
    }

    public function verificarConflicto($can_id, $fecha, $hora_ini, $hora_fin) {
        $sql = "SELECT COUNT(*) as conflictos FROM alquiler 
                WHERE can_id = ? AND alq_fecha = ? AND est_id IN (2, 3) 
                AND (
                    (alq_hora_ini < ? AND alq_hora_fin > ?)
                )";
        $res = $this->db->select($sql, [$can_id, $fecha, $hora_fin, $hora_ini]);
        return $res[0]['conflictos'] > 0;
    }

    // =========================================================
    //              ZONA PÚBLICA (HOME)
    // =========================================================

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

    // =========================================================
    //              ZONA ADMINISTRADOR
    // =========================================================

    public function obtenerEstadisticasGlobales() {
        $stats = [
            'canchas' => $this->contarCanchas(),
            'usuarios' => $this->contarUsuarios(),
            'reservas' => $this->contarReservas(),
            'ingresos' => $this->sumarIngresos()
        ];
        return $stats;
    }

    public function contarCanchas() {
        $res = $this->db->select("SELECT COUNT(*) as total FROM cancha");
        return $res[0]['total'] ?? 0;
    }
    public function contarUsuarios() {
        $res = $this->db->select("SELECT COUNT(*) as total FROM usuario WHERE id_rol = 2"); 
        return $res[0]['total'] ?? 0;
    }
    public function contarReservas() {
        $res = $this->db->select("SELECT COUNT(*) as total FROM alquiler");
        return $res[0]['total'] ?? 0;
    }
    public function sumarIngresos() {
        $res = $this->db->select("SELECT SUM(alq_valor) as total FROM alquiler WHERE est_id = 2"); 
        return $res[0]['total'] ?? 0;
    }

    // En app/models/Alquiler.php

    public function obtenerTodosLosAlquileres() {
        // Usamos LEFT JOIN para que la reserva aparezca SÍ o SÍ,
        // aunque el usuario o la cancha tengan algún problema de ID.
        // También usamos IFNULL para que no falle si el nombre está vacío.
        
        $sql = "SELECT 
                    r.alq_id, 
                    r.alq_fecha, 
                    r.alq_hora_ini, 
                    r.alq_hora_fin, 
                    r.alq_valor, 
                    r.alq_comprobante,
                    -- Intentamos obtener el nombre, si no existe ponemos 'Desconocido'
                    IFNULL(u.nombre_usu, 'Usuario Desconocido') as usuario_nombre, 
                    IFNULL(c.can_nombre, 'Cancha Eliminada') as can_nombre, 
                    IFNULL(e.est_nombre, 'Sin Estado') as est_nombre
                FROM alquiler r
                LEFT JOIN usuario u ON r.id_usu = u.id_usu  -- OJO: Verifica si tu tabla usuario tiene id_usu o usu_id
                LEFT JOIN cancha c ON r.can_id = c.can_id
                LEFT JOIN estado e ON r.est_id = e.est_id
                ORDER BY 
                    r.alq_fecha DESC, 
                    r.alq_hora_ini ASC";
        
        return $this->db->select($sql);
    }

    public function obtenerPendientesAprobacion() {
        $sql = "SELECT a.*, u.usu_nombre, c.can_nombre 
                FROM alquiler a 
                JOIN usuario u ON a.id_usu = u.id_usu 
                JOIN cancha c ON a.can_id = c.can_id 
                WHERE a.est_id = 1
                ORDER BY a.alq_fecha ASC";
        return $this->db->select($sql);
    }

   // =========================================================
    //      FUNCIÓN PARA GUARDAR EN LA BASE DE DATOS
    // =========================================================
    
    public function registrarAlquiler($datos) {
        // SQL exacto según tu imagen de Base de Datos
        // Columnas: id_usu, can_id, alq_fecha, alq_hora_ini, alq_hora_fin, alq_valor, alq_comprobante, est_id
        $sql = "INSERT INTO alquiler (id_usu, can_id, alq_fecha, alq_hora_ini, alq_hora_fin, alq_valor, alq_comprobante, est_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Estado inicial: 1 = 'Registrado' (Según tu lógica de negocio)
        $estado_inicial = 1; 

        // Mapeo de los datos del array a los signos de interrogación (?)
        $params = [
            $datos['id_usuario'],   // Va a id_usu
            $datos['cancha'],       // Va a can_id
            $datos['fecha'],        // Va a alq_fecha
            $datos['hora_ini'],     // Va a alq_hora_ini
            $datos['hora_fin'],     // Va a alq_hora_fin
            $datos['valor_total'],  // Va a alq_valor
            $datos['comprobante'],  // Va a alq_comprobante
            $estado_inicial         // Va a est_id
        ];

        // Ejecutar inserción
        // Si tu clase de base de datos usa 'insert', déjalo así. Si usa 'execute', cámbialo.
        return $this->db->insert($sql, $params); 
    }

    // --- ESTADÍSTICAS PARA GRÁFICO (ADMIN) ---
    public function obtenerUsosPorMes() {
        // Esta consulta agrupa las reservas por Año-Mes de los últimos 12 meses
        $sql = "SELECT 
                    DATE_FORMAT(alq_fecha, '%Y-%m') as periodo,
                    COUNT(*) as total
                FROM alquiler
                WHERE alq_fecha >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                GROUP BY periodo
                ORDER BY periodo ASC";
        return $this->db->select($sql);
    }

    // ==========================================
    //      ZONA ADMINISTRADOR (NUEVO)
    // ==========================================

    // 1. ADMIN: Ver todas las reservas (con nombres de usuario, cancha y estado)
    public function obtenerTodosAdmin() {
        $sql = "SELECT a.*, u.nombre_usu, c.can_nombre, e.est_nombre 
                FROM alquiler a
                INNER JOIN usuario u ON a.id_usu = u.id_usu
                INNER JOIN cancha c ON a.can_id = c.can_id
                INNER JOIN estado e ON a.est_id = e.est_id
                ORDER BY a.alq_id DESC";
        return $this->db->select($sql);
    }

    // 2. ADMIN: Obtener una reserva por ID para editar
    public function obtenerPorIdAdmin($id) {
        $sql = "SELECT * FROM alquiler WHERE alq_id = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    // 3. ADMIN: Obtener lista de Estados para el Combo
    public function obtenerEstadosAdmin() {
        $sql = "SELECT * FROM estado ORDER BY est_id ASC";
        return $this->db->select($sql);
    }

    // 4. ADMIN: Actualizar Reserva
    public function actualizarAdmin($id, $fecha, $inicio, $fin, $valor, $est_id) {
        $sql = "UPDATE alquiler 
                SET alq_fecha = ?, alq_hora_ini = ?, alq_hora_fin = ?, alq_valor = ?, est_id = ? 
                WHERE alq_id = ?";
        return $this->db->insert($sql, [$fecha, $inicio, $fin, $valor, $est_id, $id]);
    }

    // 5. ADMIN: Eliminar Reserva
    public function eliminarAdmin($id) {
        $sql = "DELETE FROM alquiler WHERE alq_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}