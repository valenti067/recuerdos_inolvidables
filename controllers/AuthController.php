
<?php
// controllers/AuthController.php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    // Mostrar y procesar Registro
    public function register()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre   = trim($_POST['nombre'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $password = $_POST['password'] ?? '';

            // Solo se permiten registros públicos de clientes
            // o proveedores. El administrador debe crearse de
            // forma controlada, no desde el formulario público.
            $id_rol = (int) ($_POST['id_rol'] ?? 2);

            if (!in_array($id_rol, [2, 3], true)) {
                $id_rol = 2;
            }

            // Validar campos obligatorios
            if ($nombre === '' || $email === '' || $password === '') {
                $error = 'Completa los campos obligatorios.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Ingresa un correo electrónico válido.';
            } elseif (
                strlen($password) < 8 ||
                !preg_match('/[A-ZÁÉÍÓÚÜÑ]/u', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[a-zA-ZÁÉÍÓÚÜÑáéíóúüñ]/u', $password)
            ) {
                $error = 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una letra y un número.';
            } else {
                $usuarioModel = new Usuario();

                if ($usuarioModel->emailExiste($email)) {
                    $error = 'El correo ya se encuentra registrado.';
                } else {
                    if (
                        $usuarioModel->registrar(
                            $nombre,
                            $email,
                            $telefono,
                            $password,
                            $id_rol
                        )
                    ) {
                        header(
                            'Location: index.php?controller=auth&action=login'
                        );
                        exit();
                    } else {
                        $error = 'Ocurrió un error al crear la cuenta.';
                    }
                }
            }
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    // Mostrar y procesar Login
    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'Ingresa tu correo y contraseña.';
            } else {
                $usuarioModel = new Usuario();
                $usuario = $usuarioModel->obtenerPorEmail($email);

                // Se conserva la verificación de contraseñas existente
                if (
                    $usuario &&
                    password_verify($password, $usuario['password'])
                ) {
                    session_regenerate_id(true);

                    $_SESSION['user_id'] = $usuario['id_usuario'];
                    $_SESSION['user_nombre'] = $usuario['nombre'];
                    $_SESSION['user_rol'] = $usuario['id_rol'];
                    $_SESSION['user_rol_nombre'] = $usuario['rol_nombre'];

                    // Redirección según el rol
                    if (
                        $usuario['id_rol'] == 1 ||
                        $usuario['rol_nombre'] === 'Administrador'
                    ) {
                        header(
                            'Location: index.php?controller=reporte&action=index'
                        );
                    } else {
                        header(
                            'Location: index.php?controller=proveedor&action=index'
                        );
                    }

                    exit();
                } else {
                    $error = 'Correo o contraseña incorrectos.';
                }
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    // Cerrar Sesión
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}
