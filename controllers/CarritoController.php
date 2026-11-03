
<?php

class CarritoController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['carrito']) ||
            !is_array($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    // Mostrar carrito
    public function index()
    {
        $carrito = $_SESSION['carrito'];

        require __DIR__ . '/../views/carrito/index.php';
    }

    // Agregar un servicio
    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=proveedor&action=index');
            exit;
        }

        $id = filter_var(
            $_POST['id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (!$id || $id < 1) {
            header('Location: index.php?controller=proveedor&action=index');
            exit;
        }

        $nombre = trim(
            (string) ($_POST['nombre'] ?? 'Servicio')
        );

        $correo = trim(
            (string) ($_POST['correo'] ?? '')
        );

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $correo = '';
        }

        $precio = filter_var(
            $_POST['precio'] ?? null,
            FILTER_VALIDATE_FLOAT
        );

        // Los servicios sin precio permanecen por cotizar.
        $precio = ($precio !== false && $precio > 0)
            ? (float) $precio
            : null;

        $cantidad = filter_var(
            $_POST['cantidad'] ?? 1,
            FILTER_VALIDATE_INT
        );

        $cantidad = ($cantidad && $cantidad > 0)
            ? min($cantidad, 100)
            : 1;

        if (isset($_SESSION['carrito'][$id])) {

            $_SESSION['carrito'][$id]['cantidad'] = min(
                100,
                $_SESSION['carrito'][$id]['cantidad']
                + $cantidad
            );

            if ($correo !== '') {
                $_SESSION['carrito'][$id]['correo'] = $correo;
            }

        } else {

            $_SESSION['carrito'][$id] = [
                'id' => $id,
                'nombre' => $nombre !== '' ? $nombre : 'Servicio',
                'precio' => $precio,
                'cantidad' => $cantidad,
                'correo' => $correo,
                'tipo' => $precio === null
                    ? 'cotizacion'
                    : 'precio_definido'
            ];
        }

        header('Location: index.php?controller=carrito&action=index');
        exit;
    }

    // Eliminar un servicio
    public function eliminar()
    {
        $id = filter_var(
            $_GET['id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if ($id && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }

        header('Location: index.php?controller=carrito&action=index');
        exit;
    }

    // Vaciar carrito
    public function vaciar()
    {
        $_SESSION['carrito'] = [];

        header('Location: index.php?controller=carrito&action=index');
        exit;
    }
}
