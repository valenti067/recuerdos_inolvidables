<?php
require_once __DIR__ . '/../config/database.php';

class Proveedor {
    private $conn;
    private $table_name = "proveedores";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM " . $this->table_name . " ORDER BY id_proveedor DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_proveedor = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function crear($datos) {
        try {
            $sql = "INSERT INTO " . $this->table_name . " (id_usuario, id_categoria, nombre_comercial, telefono, email, direccion, es_destacado, descripcion) 
                    VALUES (:id_usuario, :id_categoria, :nombre_comercial, :telefono, :email, :direccion, :es_destacado, :descripcion)";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id_usuario'   => !empty($datos['id_usuario']) ? $datos['id_usuario'] : null,
                ':id_categoria' => !empty($datos['id_categoria']) ? $datos['id_categoria'] : null,
                ':nombre_comercial' => $datos['nombre_comercial'],
                ':telefono'     => $datos['telefono'] ?? '',
                ':email'        => $datos['email'] ?? '',
                ':direccion'    => $datos['direccion'] ?? '',
                ':es_destacado' => !empty($datos['es_destacado']) ? 1 : 0,
                ':descripcion'  => $datos['descripcion'] ?? ''
            ]);
        } catch (PDOException $e) {
            echo "Error al crear proveedor: " . $e->getMessage();
            exit();
        }
    }

    public function actualizar($id, $datos) {
        try {
            $sql = "UPDATE " . $this->table_name . " SET 
                    id_categoria = :id_categoria,
                    nombre_comercial = :nombre_comercial, 
                    telefono = :telefono, 
                    email = :email, 
                    direccion = :direccion,
                    es_destacado = :es_destacado,
                    descripcion = :descripcion 
                    WHERE id_proveedor = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id_categoria' => !empty($datos['id_categoria']) ? $datos['id_categoria'] : null,
                ':nombre_comercial' => $datos['nombre_comercial'],
                ':telefono'     => $datos['telefono'],
                ':email'        => $datos['email'],
                ':direccion'    => $datos['direccion'],
                ':es_destacado' => !empty($datos['es_destacado']) ? 1 : 0,
                ':descripcion'  => $datos['descripcion'],
                ':id'           => $id
            ]);
        } catch (PDOException $e) {
            echo "Error al actualizar proveedor: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM " . $this->table_name . " WHERE id_proveedor = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Error al eliminar proveedor: " . $e->getMessage();
            return false;
        }
    }
}
?>