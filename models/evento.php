<?php
// models/Evento.php
require_once __DIR__ . '/../config/database.php';

class Evento {
    private $conn;
    private $table_name = "eventos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtenemos los eventos asociados a un usuario
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT * FROM " . $this->table_name . " 
                WHERE id_usuario = :id_usuario 
                ORDER BY fecha_evento ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Obtener un evento específico validando que pertenezca al usuario
    public function obtenerPorId($id_evento, $id_usuario) {
        $sql = "SELECT * FROM " . $this->table_name . " 
                WHERE id_evento = :id_evento AND id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Crear un nuevo evento
    public function crear($id_usuario, $nombre_evento, $fecha_evento, $presupuesto, $lugar, $estado) {
        $sql = "INSERT INTO " . $this->table_name . " (id_usuario, nombre_evento, fecha_evento, presupuesto, lugar, estado) 
                VALUES (:id_usuario, :nombre_evento, :fecha_evento, :presupuesto, :lugar, :estado)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindValue(':nombre_evento', $nombre_evento);
        $stmt->bindValue(':fecha_evento', $fecha_evento);
        $stmt->bindValue(':presupuesto', $presupuesto);
        $stmt->bindValue(':lugar', $lugar);
        $stmt->bindValue(':estado', $estado);

        return $stmt->execute();
    }

    // Actualizar un evento existente
    public function actualizar($id_evento, $id_usuario, $nombre_evento, $fecha_evento, $presupuesto, $lugar, $estado) {
        $sql = "UPDATE " . $this->table_name . " 
                SET nombre_evento = :nombre_evento, 
                    fecha_evento = :fecha_evento, 
                    presupuesto = :presupuesto, 
                    lugar = :lugar, 
                    estado = :estado 
                WHERE id_evento = :id_evento AND id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindValue(':nombre_evento', $nombre_evento);
        $stmt->bindValue(':fecha_evento', $fecha_evento);
        $stmt->bindValue(':presupuesto', $presupuesto);
        $stmt->bindValue(':lugar', $lugar);
        $stmt->bindValue(':estado', $estado);

        return $stmt->execute();
    }

    // Eliminar un evento
    public function eliminar($id_evento, $id_usuario) {
        $sql = "DELETE FROM " . $this->table_name . " 
                WHERE id_evento = :id_evento AND id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);

        return $stmt->execute();
    }
}