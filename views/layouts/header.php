


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Recuerdos Inolvidables | Mis 15 Años</title>

    <!-- ESTILOS GENERALES -->
    <link
        rel="stylesheet"
        href="/recuerdos_inolvidables/public/css/styles.css?v=5"
    >

    <!-- DISEÑO ROMÁNTICO DEL ENCABEZADO -->
    <link
        rel="stylesheet"
        href="/recuerdos_inolvidables/public/css/encabezado-elegante.css?v=3"
    >
</head>

<body>

<?php
// Identificar sesión y tipo de usuario.

$usuarioConectado = isset($_SESSION['user_id']);

$rolUsuario = $usuarioConectado
    ? (int) ($_SESSION['user_rol'] ?? 0)
    : 0;

$esAdministrador = $rolUsuario === 1;
$esProveedor = $rolUsuario === 3;
$esComprador = $rolUsuario === 2;

// Ruta absoluta del logo desde la raíz del servidor.
$rutaLogo = '/recuerdos_inolvidables/public/img/logo_recuerdos_sin_fondo.png';
?>

<!-- ENCABEZADO ROMÁNTICO -->

<header class="ri-header-doble">

    <!-- NIVEL SUPERIOR -->

    <div class="ri-header-superior">

        <div
            class="ri-decoracion ri-decoracion-izquierda"
            aria-hidden="true"
        >
            ✿
        </div>

        <div
            class="ri-decoracion ri-decoracion-derecha"
            aria-hidden="true"
        >
            ✿
        </div>

        <div class="ri-identidad">

            <!-- LOGO -->

            <a
                href="index.php"
                class="ri-logo-enlace"
                aria-label="Ir al inicio"
            >

                <img
                    src="<?= htmlspecialchars(
                        $rutaLogo,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    alt="Logo de Recuerdos Inolvidables"
                    class="ri-logo-principal"
                >

            </a>

            <!-- NOMBRE Y DECORACIÓN -->

            <div class="ri-identidad-texto">

                <span
                    class="ri-corona-superior"
                    aria-hidden="true"
                >
                    ♕
                </span>

                <a
                    href="index.php"
                    class="ri-titulo-enlace"
                >

                    <span class="ri-nombre-principal">
                        Recuerdos Inolvidables
                    </span>

                </a>

                <div
                    class="ri-linea-corazon"
                    aria-hidden="true"
                >
                    <span></span>
                    <span>♡</span>
                    <span></span>
                </div>

                <p class="ri-subtitulo">
                    CELEBRACIONES DE 15 AÑOS
                </p>

            </div>

        </div>

    </div>

    <!-- SEGUNDO NIVEL: MENÚ -->

    <div class="ri-barra-navegacion">

        <div class="ri-barra-interior">

            <nav
                class="ri-nav"
                aria-label="Menú principal"
            >

                <ul class="ri-menu-lista">

                    <!-- INICIO -->

                    <li>
                        <a
                            href="index.php"
                            class="ri-enlace-inicio"
                        >
                            <span aria-hidden="true">⌂</span>
                            Inicio
                        </a>
                    </li>

                    <!-- QUIÉNES SOMOS -->

                    <li>
                        <a href="index.php?controller=quienesSomos&amp;action=index">
                            Quiénes somos
                        </a>
                    </li>

                    <!-- TRATAMIENTO DE DATOS -->

                    <li>
                        <a
                            href="#"
                            id="abrirDatosMenu"
                        >
                            Tratamiento de datos
                        </a>
                    </li>

                    <!-- EVENTOS: SOLO ADMINISTRADOR -->

                    <?php if ($esAdministrador): ?>

                        <li>
                            <a href="index.php?controller=evento&amp;action=index">
                                Eventos
                            </a>
                        </li>

                    <?php endif; ?>

                    <!-- CARRITO -->

                    <li>
                        <a href="index.php?controller=carrito&amp;action=index">
                            🛒 Carrito
                        </a>
                    </li>

                    <!-- OPCIONES ADMINISTRATIVAS -->

                    <?php if ($esAdministrador): ?>

                        <li>
                            <a href="index.php?controller=reporte&amp;action=index">
                                Reportes
                            </a>
                        </li>

                        <li>
                            <a href="index.php?controller=usuario&amp;action=index">
                                Clientes
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </nav>

            <!-- USUARIO -->

            <div class="ri-zona-usuario">

                <?php if ($usuarioConectado): ?>

                    <span class="ri-saludo-usuario">

                        Hola,
                        <?= htmlspecialchars(
                            $_SESSION['user_nombre'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </span>

                    <a
                        href="index.php?controller=auth&amp;action=logout"
                        class="ri-boton-sesion"
                    >
                        Cerrar Sesión
                    </a>

                <?php else: ?>

                    <a
                        href="index.php?controller=auth&amp;action=login"
                        class="ri-iniciar-sesion"
                    >
                        Iniciar Sesión
                    </a>

                    <a
                        href="index.php?controller=auth&amp;action=register"
                        class="ri-boton-sesion"
                    >
                        Registro
                    </a>

                <?php endif; ?>

            </div>

        </div>

    </div>

</header>

<!-- AVISO DE TRATAMIENTO DE DATOS -->

<div
    id="avisoDatos"
    class="datos-overlay"
    role="dialog"
    aria-modal="true"
    aria-labelledby="tituloDatos"
    hidden
>

    <div class="datos-modal">

        <div class="datos-cabecera">

            <h2 id="tituloDatos">
                Tratamiento de datos
            </h2>

            <button
                type="button"
                id="cerrarDatos"
                class="datos-cerrar"
                aria-label="Cerrar aviso"
            >
                &times;
            </button>

        </div>

        <div class="datos-contenido">

            <p>
                En <strong>Recuerdos Inolvidables</strong>,
                los datos personales que proporciones
                se utilizarán para gestionar tu cuenta,
                organizar solicitudes y facilitar
                el contacto con proveedores,
                de acuerdo con las finalidades
                informadas por la plataforma.
            </p>

            <p>
                Tus datos personales deben utilizarse
                únicamente para las finalidades
                autorizadas, conforme a la política
                de tratamiento de datos aplicable.
            </p>

            <p>
                Consulta la política de privacidad
                para conocer el tratamiento de tus
                datos y cómo ejercer tus derechos.
            </p>

        </div>

        <div class="datos-acciones">

            <button
                type="button"
                id="entendidoDatos"
            >
                Entendido
            </button>

        </div>

    </div>

</div>

<!-- ESTILOS DEL AVISO -->

<style>

.datos-overlay[hidden] {
    display: none !important;
}

.datos-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999;
    background: rgba(0, 0, 0, 0.55);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 16px;
}

.datos-modal {
    width: 100%;
    max-width: 480px;
    background: #fffafc;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    color: #333;
}

.datos-cabecera {
    background: #95476b;
    color: white;
    padding: 15px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.datos-cabecera h2 {
    color: white;
    font-size: 18px;
    margin: 0;
}

.datos-cerrar {
    background: transparent;
    color: white;
    border: none;
    font-size: 28px;
    cursor: pointer;
}

.datos-contenido {
    padding: 20px;
    font-size: 14px;
    line-height: 1.7;
}

.datos-acciones {
    padding: 0 18px 18px;
    display: flex;
    justify-content: flex-end;
}

#entendidoDatos {
    background: #ad5478;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 22px;
    font-weight: bold;
    cursor: pointer;
}

#entendidoDatos:hover {
    background: #873956;
}

</style>

<!-- FUNCIONAMIENTO DEL AVISO -->

<script>
(function () {

    const aviso = document.getElementById('avisoDatos');
    const cerrar = document.getElementById('cerrarDatos');
    const entendido = document.getElementById('entendidoDatos');
    const abrirMenu = document.getElementById('abrirDatosMenu');

    if (!aviso || !cerrar || !entendido || !abrirMenu) {
        return;
    }

    function mostrarAviso() {
        aviso.hidden = false;
        entendido.focus();
    }

    function cerrarAviso() {
        aviso.hidden = true;

        try {
            localStorage.setItem('avisoDatosVisto', '1');
        } catch (e) {
            // El aviso puede cerrarse sin almacenamiento.
        }
    }

    abrirMenu.addEventListener('click', function (evento) {
        evento.preventDefault();
        mostrarAviso();
    });

    cerrar.addEventListener('click', cerrarAviso);
    entendido.addEventListener('click', cerrarAviso);

    try {
        if (localStorage.getItem('avisoDatosVisto') !== '1') {
            mostrarAviso();
        }
    } catch (e) {
        mostrarAviso();
    }

    document.addEventListener('keydown', function (evento) {
        if (evento.key === 'Escape' && !aviso.hidden) {
            cerrarAviso();
        }
    });

})();
</script>

<!-- CONTENEDOR PRINCIPAL -->

<main class="container">
