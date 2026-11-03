
<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $modelo;

    public function __construct()
    {
        /*
         * Solo el administrador puede gestionar categorías.
         *
         * Rol 1: Administrador
         * Rol 2: Quinceañera / Comprador
         * Rol 3: Proveedor
         */

        if (
            !isset($_SESSION['user_id']) ||
            !isset($_SESSION['user_rol']) ||
            (int) $_SESSION['user_rol'] !== 1
        ) {
            header(
                'Location: index.php?controller=proveedor&action=index'
            );
            exit;
        }

        $this->modelo = new Categoria();
    }

    // Mostrar todas las categorías
    public function index()
    {
        $categorias = $this->modelo->obtenerTodas();

        require_once __DIR__ . '/../views/categorias/index.php';
    }

    // Mostrar formulario para crear una categoría
    public function crear()
    {
        require_once __DIR__ . '/../views/categorias/crear.php';
    }

    // Guardar una nueva categoría
    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: index.php?controller=categoria&action=index'
            );
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre !== '') {
            $this->modelo->crear($nombre);
        }

        header(
            'Location: index.php?controller=categoria&action=index'
        );
        exit;
    }

    // Mostrar formulario de edición
    public function editar()
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            header(
                'Location: index.php?controller=categoria&action=index'
            );
            exit;
        }

        $categoria = $this->modelo->obtenerPorId($id);

        if (!$categoria) {
            http_response_code(404);
            echo 'Categoría no encontrada.';
            exit;
        }

        require_once __DIR__ . '/../views/categorias/editar.php';
    }

    // Actualizar una categoría
    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header(
                'Location: index.php?controller=categoria&action=index'
            );
            exit;
        }

        $id = filter_var(
            $_POST['id_categoria'] ?? null,
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre'] ?? '');

        if ($id && $nombre !== '') {
            $this->modelo->actualizar($id, $nombre);
        }

        header(
            'Location: index.php?controller=categoria&action=index'
        );
        exit;
    }

    // Eliminar una categoría
    public function eliminar()
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if ($id) {
            $this->modelo->eliminar($id);
        }

        header(
            'Location: index.php?controller=categoria&action=index'
        );
        exit;
    }
}
