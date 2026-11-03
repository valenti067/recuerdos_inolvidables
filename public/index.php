
<?php
// Archivo principal de Recuerdos Inolvidables

session_start();

// Mostrar errores durante el desarrollo local
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Controlador predeterminado
$controllerName = isset($_GET['controller'])
    ? ucfirst($_GET['controller']) . 'Controller'
    : 'ProveedorController';

// Acción predeterminada
$action = $_GET['action'] ?? 'index';

// Buscar el archivo del controlador
$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

// Ejecutar el controlador una sola vez
if (file_exists($controllerFile)) {

    require_once $controllerFile;

    if (class_exists($controllerName)) {

        $controller = new $controllerName();

        if (method_exists($controller, $action)) {

            $controller->$action();

        } else {

            http_response_code(404);
            echo "Error 404: La acción solicitada no existe.";

        }

    } else {

        http_response_code(404);
        echo "Error 404: El controlador no existe.";

    }

} else {

    http_response_code(404);
    echo "Error 404: No se encontró el controlador solicitado.";

}
