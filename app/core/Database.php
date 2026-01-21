<?php
// app/core/Database.php

class Database {
    private $conexion;

    public function __construct() {
        $dsn = "mysql:host=" . DB_SERVIDOR . ";dbname=" . DB_NOMBRE . ";charset=" . DB_CHARSET;
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->conexion = new PDO($dsn, DB_USUARIO, DB_PASSWORD, $opciones);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // SELECT
    public function select($query, $params = []) {
        try {
            $stmt = $this->conexion->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    // INSERT
    public function insert($query, $params = []) {
        try {
            $stmt = $this->conexion->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Obtener último ID
    public function lastInsertId() {
        return $this->conexion->lastInsertId();
    }
}