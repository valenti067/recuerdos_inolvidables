<?php
// controllers/UsuarioController.php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Usuario();
    }

    // [NUEVO] Método para proteger rutas sensibles (Solo Administradores)
    private function verificarAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_rol']) || ($_SESSION['user_rol'] != 1 && ($_SESSION['user_rol_nombre'] ?? '') !== 'Administrador')) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
    }

    // [ORIGINAL] Listar todos los usuarios
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $usuarios = $this->modelo->obtenerTodos();
        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    // [MODIFICADO] Formulario de creación (Protegido por verificarAdmin)
    public function crear() {
        $this->verificarAdmin();
        require_once __DIR__ . '/../views/usuarios/crear.php';
    }

    // [MODIFICADO] Guardar nuevo usuario (Protegido por verificarAdmin)
    public function guardar() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'nombre'   => $_POST['nombre'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'password' => $_POST['password'] ?? '123456',
                'id_rol'   => $_POST['id_rol'] ?? 2
            ];

            if (!empty($datos['nombre']) && !empty($datos['email'])) {
                $this->modelo->registrar($datos['nombre'], $datos['email'], $datos['telefono'], $datos['password'], $datos['id_rol']);
            }

            header("Location: index.php?controller=usuario&action=index");
            exit();
        }
    }

    // [MODIFICADO] Formulario de edición (Protegido por verificarAdmin)
    public function editar() {
        $this->verificarAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = $this->modelo->obtenerPorId($id);
            require_once __DIR__ . '/../views/usuarios/editar.php';
        } else {
            header("Location: index.php?controller=usuario&action=index");
            exit();
        }
    }

    // [MODIFICADO] Guardar actualización (Protegido por verificarAdmin)
    public function actualizar() {
        $this->verificarAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_usuario'] ?? null;
            $datos = [
                'nombre'   => $_POST['nombre'] ?? '',
                'email'    => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'id_rol'   => $_POST['id_rol'] ?? 2
            ];

            if ($id && !empty($datos['nombre'])) {
                $this->modelo->actualizar($id, $datos);
            }

            header("Location: index.php?controller=usuario&action=index");
            exit();
        }
    }

    // [MODIFICADO] Eliminar usuario (Protegido por verificarAdmin)
    public function eliminar() {
        $this->verificarAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?controller=usuario&action=index");
        exit();
    }
}
?>