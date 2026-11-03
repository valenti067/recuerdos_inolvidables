<?php
require_once __DIR__ . '/../config/database.php';

class Servicio {
    private $conn;
    private $table_name = "servicios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los productos con el nombre de su categoría
    public function obtenerTodos() {
        $sql = "SELECT s.*, c.nombre AS categoria 
                FROM " . $this->table_name . " s
                LEFT JOIN categorias c ON s.id_categoria = c.id_categoria
                ORDER BY s.id_servicio DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Obtener un solo producto por ID
    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id_servicio = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Crear un nuevo producto relacionando la categoría
    public function crear($datos) {
    $sql = "INSERT INTO servicios (id_proveedor, id_categoria, nombre, descripcion, precio) 
            VALUES (:id_proveedor, :id_categoria, :nombre, :descripcion, :precio)";
    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':id_proveedor' => $datos['id_proveedor'],
        ':id_categoria' => $datos['id_categoria'],
        ':nombre'       => $datos['nombre'],
        ':descripcion'  => $datos['descripcion'],
        ':precio'       => $datos['precio']
    ]);
}

    // Actualizar producto y su categoría
    public function actualizar($id, $datos) {
        try {
            $sql = "UPDATE " . $this->table_name . " SET 
                    id_categoria = :id_categoria,
                    nombre = :nombre, 
                    descripcion = :descripcion, 
                    precio = :precio 
                    WHERE id_servicio = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':id_categoria' => !empty($datos['id_categoria']) ? $datos['id_categoria'] : null,
                ':nombre' => $datos['nombre'],
                ':descripcion' => $datos['descripcion'],
                ':precio' => $datos['precio'],
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            echo "Error al actualizar servicio: " . $e->getMessage();
            return false;
        }
    }

    // Eliminar producto
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM " . $this->table_name . " WHERE id_servicio = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo "Error al eliminar servicio: " . $e->getMessage();
            return false;
        }
    }

    // Obtener categorías para los selects
    public function obtenerCategorias() {
        $stmt = $this->conn->prepare("SELECT * FROM categorias ORDER BY nombre ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>