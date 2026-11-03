<?php
// controllers/ProveedorController.php
require_once __DIR__ . '/../models/Proveedor.php';

class ProveedorController {
    private $modelo;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->modelo = new Proveedor();
    }

    private function verificarAdmin() {
        if (!isset($_SESSION['user_rol']) || ($_SESSION['user_rol'] != 1 && ($_SESSION['user_rol_nombre'] ?? '') !== 'Administrador')) {
            header("Location: index.php?controller=proveedor&action=index");
            exit();
        }
    }

    public function index() {
        $proveedores = $this->modelo->obtenerTodos();
        require_once __DIR__ . '/../views/proveedores/index.php';
    }

    public function crear() {
        $this->verificarAdmin();
        require_once __DIR__ . '/../views/proveedores/crear.php';
    }

    public function guardar() {
        $this->verificarAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;
            // Capturamos el nombre ingresado y lo asignamos a todos los nombres posibles de columna
            $nombre_ingresado = trim($_POST['nombre_empresa'] ?? $_POST['nombre'] ?? '');
            $datos['nombre'] = $nombre_ingresado;
            $datos['nombre_empresa'] = $nombre_ingresado;
            $datos['nombre_comercial'] = $nombre_ingresado;

            $this->modelo->registrar($datos);
            header("Location: index.php?controller=proveedor&action=index");
            exit();
        }
    }

    public function editar() {
        $this->verificarAdmin();
        
        $id = $_GET['id'] ?? null;
        if ($id) {
            $proveedor = $this->modelo->obtenerPorId($id);
            if ($proveedor) {
                require_once __DIR__ . '/../views/proveedores/editar.php';
            } else {
                header("Location: index.php?controller=proveedor&action=index");
                exit();
            }
        } else {
            header("Location: index.php?controller=proveedor&action=index");
            exit();
        }
    }

    public function actualizar() {
        $this->verificarAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_proveedor'] ?? $_POST['id'] ?? null; 
            if ($id) {
                $datos = $_POST;
                // Asignamos el valor a todas las variantes para asegurar que la consulta SQL lo reciba
                $nombre_ingresado = trim($_POST['nombre_empresa'] ?? $_POST['nombre'] ?? '');
                $datos['nombre'] = $nombre_ingresado;
                $datos['nombre_empresa'] = $nombre_ingresado;
                $datos['nombre_comercial'] = $nombre_ingresado;

                $this->modelo->actualizar($id, $datos);
            }
            header("Location: index.php?controller=proveedor&action=index");
            exit();
        }
    }

    public function eliminar() {
        $this->verificarAdmin();
        
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?controller=proveedor&action=index");
        exit();
    }
}
?>