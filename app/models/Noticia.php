<?php
// app/models/Noticia.php

class Noticia {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Listar todas las noticias (Más recientes primero)
    public function obtenerTodas() {
        $sql = "SELECT * FROM noticia ORDER BY not_id DESC";
        return $this->db->select($sql);
    }

    // Obtener una por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM noticia WHERE not_id = ?";
        $res = $this->db->select($sql, [$id]);
        return $res[0] ?? null;
    }

    // Guardar nueva
    public function guardar($imagen, $inicio, $fin, $descripcion) {
        $sql = "INSERT INTO noticia (not_imagen, not_fecha_inicio, not_fecha_fin, not_descripcion) VALUES (?, ?, ?, ?)";
        return $this->db->insert($sql, [$imagen, $inicio, $fin, $descripcion]);
    }

    // Actualizar
    public function actualizar($id, $imagen, $inicio, $fin, $descripcion) {
        $sql = "UPDATE noticia SET not_imagen = ?, not_fecha_inicio = ?, not_fecha_fin = ?, not_descripcion = ? WHERE not_id = ?";
        return $this->db->insert($sql, [$imagen, $inicio, $fin, $descripcion, $id]);
    }

    // Eliminar
    public function eliminar($id) {
        $sql = "DELETE FROM noticia WHERE not_id = ?";
        return $this->db->insert($sql, [$id]);
    }
}