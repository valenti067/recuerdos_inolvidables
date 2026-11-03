<?php
// models/Usuario.php
require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection(); 
    }

    // Verificar si el correo ya está registrado
    public function emailExiste($email) {
        $sql = "SELECT id_usuario FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    // Registrar un nuevo usuario
    public function registrar($nombre, $email, $telefono, $password, $id_rol) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, telefono, password, id_rol) 
                VALUES (:nombre, :email, :telefono, :password, :id_rol)";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nombre'   => $nombre,
            ':email'    => $email,
            ':telefono' => $telefono,
            ':password' => $passwordHash,
            ':id_rol'   => $id_rol
        ]);
    }

    // Obtener información de un usuario por email (para Login)
    public function obtenerPorEmail($email) {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.id_rol = r.id_rol 
                WHERE u.email = :email";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener información de un usuario por su ID
    public function obtenerPorId($id) {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u 
                LEFT JOIN roles r ON u.id_rol = r.id_rol 
                WHERE u.id_usuario = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener todos los usuarios (para listar Clientes / Usuarios)
    public function obtenerTodos() {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u 
                LEFT JOIN roles r ON u.id_rol = r.id_rol 
                ORDER BY u.id_usuario DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar los datos de un usuario (Soporta arreglo o parámetros individuales)
    public function actualizar($id, $nombreOrData = null, $email = null, $telefono = null, $id_rol = null) {
        if (is_array($nombreOrData)) {
            $nombre   = $nombreOrData['nombre'] ?? '';
            $email    = $nombreOrData['email'] ?? '';
            $telefono = $nombreOrData['telefono'] ?? '';
            $id_rol   = $nombreOrData['id_rol'] ?? $nombreOrData['rol_id'] ?? 2;
        } else {
            $nombre = $nombreOrData;
        }

        $sql = "UPDATE usuarios 
                SET nombre = :nombre, email = :email, telefono = :telefono, id_rol = :id_rol 
                WHERE id_usuario = :id";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'       => $id,
            ':nombre'   => $nombre,
            ':email'    => $email,
            ':telefono' => $telefono,
            ':id_rol'   => $id_rol
        ]);
    }

    // Eliminar un usuario por su ID
    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}