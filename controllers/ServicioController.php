
<?php
require_once __DIR__ . '/../models/Servicio.php';

class ServicioController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Servicio();
    }

   
private function esAdministrador()
{
    return isset($_SESSION['user_id'])
        && isset($_SESSION['user_rol'])
        && in_array(
            (int) $_SESSION['user_rol'],
            [1, 3],
            true
        );
}


    private function exigirAdministrador()
    {
        if (!$this->esAdministrador()) {
            http_response_code(403);

            echo '<h2>Acceso no autorizado</h2>';
            echo '<p>No tienes permiso para modificar productos o servicios.</p>';
            echo '<a href="index.php?controller=servicio&amp;action=index">';
            echo 'Volver al catálogo</a>';

            exit;
        }
    }

    public function index()
    {
        $servicios = $this->modelo->obtenerTodos();

        require __DIR__ . '/../views/servicios/index.php';
    }

    public function crear()
    {
        $this->exigirAdministrador();

        $categorias = $this->modelo->obtenerCategorias();

        require __DIR__ . '/../views/servicios/crear.php';
    }

    public function guardar()
    {
        $this->exigirAdministrador();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=servicio&action=index');
            exit;
        }

        $datos = [
            'id_proveedor' => (
                !empty($_POST['id_proveedor']) &&
                (int) $_POST['id_proveedor'] > 0
            ) ? (int) $_POST['id_proveedor'] : null,

            'id_categoria' => (
                !empty($_POST['id_categoria']) &&
                (int) $_POST['id_categoria'] > 0
            ) ? (int) $_POST['id_categoria'] : null,

            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio' => $_POST['precio'] ?? 0
        ];

        if ($datos['nombre'] !== '') {
            $this->modelo->crear($datos);
        }

        header('Location: index.php?controller=servicio&action=index');
        exit;
    }

    public function editar()
    {
        $this->exigirAdministrador();

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            header('Location: index.php?controller=servicio&action=index');
            exit;
        }

        $servicio = $this->modelo->obtenerPorId($id);

        if (!$servicio) {
            http_response_code(404);
            echo 'Producto no encontrado.';
            exit;
        }

        $categorias = $this->modelo->obtenerCategorias();

        require __DIR__ . '/../views/servicios/editar.php';
    }

    public function actualizar()
    {
        $this->exigirAdministrador();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=servicio&action=index');
            exit;
        }

        $id = filter_var(
            $_POST['id_servicio'] ?? null,
            FILTER_VALIDATE_INT
        );

        $datos = [
            'id_categoria' => (
                !empty($_POST['id_categoria']) &&
                (int) $_POST['id_categoria'] > 0
            ) ? (int) $_POST['id_categoria'] : null,

            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio' => $_POST['precio'] ?? 0
        ];

        if ($id && $datos['nombre'] !== '') {
            $this->modelo->actualizar($id, $datos);
        }

        header('Location: index.php?controller=servicio&action=index');
        exit;
    }

    public function eliminar()
    {
        $this->exigirAdministrador();

        /*
         * Se conserva temporalmente la ruta de eliminación
         * utilizada por el proyecto.
         */
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if ($id) {
            $this->modelo->eliminar($id);
        }

        header('Location: index.php?controller=servicio&action=index');
        exit;
    }
}
