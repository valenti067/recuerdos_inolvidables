<?php
require_once __DIR__ . '/../config/database.php';

class Categoria {
    private $conn;
    private $table_name = "categorias";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Buscar todas las categorías
    public function obtenerTodas() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Crear una nueva categoría
    public function crear($nombre) {
        try {
            $sql = "INSERT INTO " . $this->table_name . " (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':nombre' => $nombre]);
        } catch (PDOException $e) {
            echo "Error SQL en el modelo de Categoría: " . $e->getMessage();
            exit();
        }
    }

    // Buscar una sola categoría por su ID (para poder editarla)
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_categoria = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Actualizar una categoría existente
    public function actualizar($id, $nombre) {
        try {
            $sql = "UPDATE " . $this->table_name . " SET nombre = :nombre WHERE id_categoria = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':nombre' => $nombre, ':id' => $id]);
        } catch (PDOException $e) {
            echo "Error al actualizar: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar una categoría
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM " . $this->table_name . " WHERE id_categoria = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Error al eliminar: " . $e->getMessage();
            return false;
        }
    }
}
?>