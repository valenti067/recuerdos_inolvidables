
<?php
// controllers/EventoController.php

require_once __DIR__ . '/../models/Evento.php';

class EventoController
{
    private $eventoModel;

    public function __construct()
    {
        // Comprobar que exista una sesión.
        if (!isset($_SESSION['user_id'])) {
            header(
                'Location: index.php?controller=auth&action=login'
            );
            exit;
        }

        // Solo el administrador (rol 1)
        // puede gestionar eventos.
        if (
            !isset($_SESSION['user_rol']) ||
            (int) $_SESSION['user_rol'] !== 1
        ) {
            header(
                'Location: index.php?controller=proveedor&action=index'
            );
            exit;
        }

        $this->eventoModel = new Evento();
    }

    // Consultar los eventos del usuario.
    public function index()
    {
        $user_id = $_SESSION['user_id'];

        $eventos = $this->eventoModel->obtenerPorUsuario(
            $user_id
        );

        require_once __DIR__ . '/../views/eventos/index.php';
    }

    // Crear un evento.
    public function crear()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre_evento = trim(
                $_POST['nombre_evento'] ?? ''
            );

            $fecha_evento = $_POST['fecha_evento'] ?? '';

            $presupuesto = !empty($_POST['presupuesto'])
                ? (float) $_POST['presupuesto']
                : 0.00;

            $lugar = trim($_POST['lugar'] ?? '');

            $estado = $_POST['estado'] ?? 'Planificando';

            if (
                $nombre_evento === '' ||
                $fecha_evento === ''
            ) {
                $error = 'El nombre y la fecha del evento son obligatorios.';
            } else {

                $creado = $this->eventoModel->crear(
                    $_SESSION['user_id'],
                    $nombre_evento,
                    $fecha_evento,
                    $presupuesto,
                    $lugar,
                    $estado
                );

                if ($creado) {
                    header(
                        'Location: index.php?controller=evento&action=index'
                    );
                    exit;
                }

                $error = 'Error al crear el evento. Inténtalo de nuevo.';
            }
        }

        require_once __DIR__ . '/../views/eventos/crear.php';
    }

    // Editar un evento.
    public function editar()
    {
        $id_evento = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        $user_id = $_SESSION['user_id'];

        $evento = $this->eventoModel->obtenerPorId(
            $id_evento,
            $user_id
        );

        if (!$evento) {
            header(
                'Location: index.php?controller=evento&action=index'
            );
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre_evento = trim(
                $_POST['nombre_evento'] ?? ''
            );

            $fecha_evento = $_POST['fecha_evento'] ?? '';

            $presupuesto = !empty($_POST['presupuesto'])
                ? (float) $_POST['presupuesto']
                : 0.00;

            $lugar = trim($_POST['lugar'] ?? '');

            $estado = $_POST['estado'] ?? 'Planificando';

            if (
                $nombre_evento === '' ||
                $fecha_evento === ''
            ) {
                $error = 'El nombre y la fecha del evento son obligatorios.';
            } else {

                $actualizado = $this->eventoModel->actualizar(
                    $id_evento,
                    $user_id,
                    $nombre_evento,
                    $fecha_evento,
                    $presupuesto,
                    $lugar,
                    $estado
                );

                if ($actualizado) {
                    header(
                        'Location: index.php?controller=evento&action=index'
                    );
                    exit;
                }

                $error = 'Error al actualizar el evento.';
            }
        }

        require_once __DIR__ . '/../views/eventos/editar.php';
    }

    // Eliminar un evento.
    public function eliminar()
    {
        $id_evento = isset($_GET['id'])
            ? (int) $_GET['id']
            : 0;

        $user_id = $_SESSION['user_id'];

        if ($id_evento > 0) {
            $this->eventoModel->eliminar(
                $id_evento,
                $user_id
            );
        }

        header(
            'Location: index.php?controller=evento&action=index'
        );
        exit;
    }
}
