

<?php
require_once __DIR__ . '/../layouts/header.php';

/*
 * IMÁGENES DE LOS NUEVE PROVEEDORES
 *
 * Se conserva la distribución de fotografías.
 */

$imagenes = [
    'img/paquetes/vestido.jpg',
    'img/paquetes/salon.jpg',
    'img/paquetes/fotografia.jpg',
    'img/paquetes/decoracion.jpg',
    'img/paquetes/default.jpg',
    'img/paquetes/paquete6.jpg',
    'img/paquetes/paquete7.jpg',
    'img/paquetes/paquete8.jpg',
    'img/paquetes/paquete9.jpg'
];

$indice_proveedor = 0;

// Permisos de usuario.

$esAdministradorProveedor =
    isset($_SESSION['user_id']) &&
    (int) ($_SESSION['user_rol'] ?? 0) === 1;

// Función para mostrar textos de forma segura.

$esc = static function ($valor) {
    return htmlspecialchars(
        (string) ($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
};
?>

<!-- ESTILOS DE LA PORTADA ROMÁNTICA -->

<link
    rel="stylesheet"
    href="css/portada-romantica.css?v=4"
>


<!-- ===================================== -->
<!-- PORTADA PRINCIPAL                     -->
<!-- ===================================== -->

<section
    class="ri-hero"
    aria-labelledby="ri-hero-titulo"
>

    <div class="ri-hero-contenido">

        <span class="ri-sobretitulo">
            Recuerdos Inolvidables · Mis 15 años
        </span>

        <h1 id="ri-hero-titulo">
            Haz de tus <em>15 años</em>
            un recuerdo inolvidable
        </h1>

        <p>
            Encuentra proveedores para organizar
            una celebración a tu estilo.
        </p>

        <div class="ri-hero-acciones">

            <a
                class="ri-boton ri-boton-primario"
                href="#directorio-proveedores"
            >
                Explorar proveedores
            </a>

            <!-- EVENTOS: SOLO ADMINISTRADOR -->

            <?php if ($esAdministradorProveedor): ?>

                <a
                    class="ri-boton ri-boton-secundario"
                    href="index.php?controller=evento&amp;action=index"
                >
                    Ver eventos
                </a>

            <?php endif; ?>

        </div>

    </div>

    <!-- ILUSTRACIÓN DE 15 AÑOS -->

    <div
        class="ri-hero-ilustracion"
        aria-hidden="true"
    >
        <span>✦</span>
        <strong>15</strong>
        <span>✦</span>
    </div>

</section>


<!-- ===================================== -->
<!-- DIRECTORIO DE PROVEEDORES             -->
<!-- ===================================== -->

<section
    class="ri-directorio"
    id="directorio-proveedores"
    aria-labelledby="ri-directorio-titulo"
>

    <div class="ri-seccion-cabecera">

        <div>

            <span class="ri-sobretitulo">
                ENCUENTRA LO QUE NECESITAS
            </span>

            <h2 id="ri-directorio-titulo">
                Directorio de proveedores
            </h2>

            <p>
                Explora opciones para vestidos,
                salones, fotografía, decoración y más.
            </p>

        </div>


        <!-- CREAR PROVEEDOR: SOLO ADMINISTRADOR -->

        <?php if ($esAdministradorProveedor): ?>

            <a
                class="ri-boton ri-boton-primario ri-admin-crear"
                href="index.php?controller=proveedor&amp;action=crear"
            >
                + Nuevo proveedor
            </a>

        <?php endif; ?>

    </div>


    <!-- ================================= -->
    <!-- TARJETAS DE PROVEEDORES           -->
    <!-- ================================= -->

    <div class="ri-proveedores-grid">

        <?php if (!empty($proveedores)): ?>

            <?php foreach ($proveedores as $p): ?>

                <?php

                // ==================================
                // NOMBRE DEL PROVEEDOR
                // ==================================

                $nombre_proveedor = '';

                $posibles_campos = [
                    'nombre_comercial',
                    'nombre_empresa',
                    'empresa',
                    'nombre_proveedor',
                    'nombre',
                    'razon_social',
                    'titulo'
                ];

                foreach ($posibles_campos as $campo) {

                    if (!empty($p[$campo])) {
                        $nombre_proveedor = trim(
                            (string) $p[$campo]
                        );
                        break;
                    }

                }

                if ($nombre_proveedor === '') {
                    $nombre_proveedor = 'Proveedor sin nombre';
                }


                // ==================================
                // CATEGORÍA
                // ==================================

                $categoria_proveedor = 'Proveedor';

                foreach (
                    [
                        'categoria',
                        'nombre_categoria',
                        'tipo'
                    ] as $campo
                ) {

                    if (!empty($p[$campo])) {
                        $categoria_proveedor = trim(
                            (string) $p[$campo]
                        );
                        break;
                    }

                }


                // ==================================
                // DESCRIPCIÓN
                // ==================================

                $descripcion_proveedor =
                    $p['descripcion']
                    ?? $p['descripcion_servicio']
                    ?? 'Sin descripción disponible';


                // ==================================
                // DIRECCIÓN
                // ==================================

                $direccion_proveedor =
                    !empty($p['direccion'])
                    ? $p['direccion']
                    : (
                        $p['ubicacion']
                        ?? 'Sin dirección registrada'
                    );


                // ==================================
                // TELÉFONO
                // ==================================

                $telefono_proveedor =
                    !empty($p['telefono'])
                    ? $p['telefono']
                    : (
                        $p['celular']
                        ?? 'Sin teléfono registrado'
                    );


                // ==================================
                // CORREO ELECTRÓNICO
                // ==================================

                $correo_proveedor =
                    !empty($p['email'])
                    ? trim((string) $p['email'])
                    : (
                        !empty($p['correo'])
                        ? trim((string) $p['correo'])
                        : ''
                    );

                $correo_valido = filter_var(
                    $correo_proveedor,
                    FILTER_VALIDATE_EMAIL
                );


                // ==================================
                // IDENTIFICADOR
                // ==================================

                $id_proveedor =
                    $p['id_proveedor']
                    ?? $p['id']
                    ?? '';


                // ==================================
                // PRECIO
                // ==================================

                /*
                 * Los proveedores que no tengan un
                 * precio definido se envían al carrito
                 * con valor 0, que allí se mostrará
                 * como "Por cotizar".
                 */

                $precio_proveedor =
                    isset($p['precio']) &&
                    is_numeric($p['precio']) &&
                    (float) $p['precio'] > 0
                    ? (float) $p['precio']
                    : 0;


                // ==================================
                // IMAGEN DE LA TARJETA
                // ==================================

                $imagen_proveedor = $imagenes[
                    $indice_proveedor % count($imagenes)
                ];

                $indice_proveedor++;

                ?>


                <!-- ============================= -->
                <!-- TARJETA INDIVIDUAL            -->
                <!-- ============================= -->

                <article class="ri-proveedor-card">


                    <!-- IMAGEN -->

                    <div class="ri-proveedor-imagen">

                        <img
                            src="<?= $esc($imagen_proveedor) ?>"
                            alt="Imagen ilustrativa de <?= $esc($nombre_proveedor) ?>"
                            loading="lazy"
                        >

                    </div>


                    <!-- CATEGORÍA -->

                    <div class="ri-proveedor-superior">

                        <span class="ri-categoria">
                            <?= $esc($categoria_proveedor) ?>
                        </span>

                        <?php if (
                            !empty($p['destacado']) ||
                            !empty($p['es_destacado'])
                        ): ?>

                            <span class="ri-destacado">
                                ★ Destacado
                            </span>

                        <?php endif; ?>

                    </div>


                    <!-- INFORMACIÓN -->

                    <div class="ri-proveedor-contenido">

                        <h3>
                            <?= $esc($nombre_proveedor) ?>
                        </h3>

                        <p class="ri-descripcion">
                            <?= $esc($descripcion_proveedor) ?>
                        </p>


                        <!-- DIRECCIÓN -->

                        <p class="ri-dato">

                            <span aria-hidden="true">
                                ⌖
                            </span>

                            <?= $esc($direccion_proveedor) ?>

                        </p>


                        <!-- TELÉFONO -->

                        <p class="ri-dato">

                            <span aria-hidden="true">
                                ☎
                            </span>

                            <?= $esc($telefono_proveedor) ?>

                        </p>


                        <!-- CORREO -->

                        <p class="ri-dato">

                            <span aria-hidden="true">
                                ✉
                            </span>

                            <?= $correo_valido
                                ? $esc($correo_proveedor)
                                : 'Correo no disponible'
                            ?>

                        </p>

                    </div>


                    <!-- ========================= -->
                    <!-- BOTONES DEL PROVEEDOR     -->
                    <!-- ========================= -->

                    <div class="ri-proveedor-acciones">


                        <!-- SOLICITAR COTIZACIÓN -->

                        <?php if ($correo_valido): ?>

                            <?php

                            $asunto = 'Solicitud de cotización - Recuerdos Inolvidables';

                            $mensaje = 'Hola, deseo solicitar una cotización para el servicio de '
                                . $nombre_proveedor
                                . '. Agradezco información sobre precios y condiciones.';

                            $enlace_cotizacion =
                                'mailto:' . $correo_proveedor
                                . '?subject=' . rawurlencode($asunto)
                                . '&body=' . rawurlencode($mensaje);

                            ?>

                            <a
                                class="ri-boton ri-boton-primario"
                                href="<?= $esc($enlace_cotizacion) ?>"
                            >
                                Solicitar cotización
                            </a>

                        <?php else: ?>

                            <span
                                class="ri-boton ri-boton-primario"
                                style="opacity:.65; cursor:not-allowed;"
                            >
                                Correo no disponible
                            </span>

                        <?php endif; ?>


                        <!-- AGREGAR AL CARRITO -->

                        <form
                            action="index.php?controller=carrito&amp;action=agregar"
                            method="POST"
                        >

                            <!-- ID -->

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $esc($id_proveedor) ?>"
                            >


                            <!-- NOMBRE -->

                            <input
                                type="hidden"
                                name="nombre"
                                value="<?= $esc($nombre_proveedor) ?>"
                            >


                            <!-- PRECIO -->

                            <input
                                type="hidden"
                                name="precio"
                                value="<?= $esc($precio_proveedor) ?>"
                            >


                            <!-- CORREO DEL PROVEEDOR -->

                            <input
                                type="hidden"
                                name="correo"
                                value="<?= $esc(
                                    $correo_valido
                                        ? $correo_proveedor
                                        : ''
                                ) ?>"
                            >


                            <!-- CANTIDAD INICIAL -->

                            <input
                                type="hidden"
                                name="cantidad"
                                value="1"
                            >


                            <button
                                type="submit"
                                class="ri-boton ri-boton-carrito"
                            >
                                Agregar al carrito
                            </button>

                        </form>


                        <!-- ===================== -->
                        <!-- ADMINISTRACIÓN        -->
                        <!-- ===================== -->

                        <?php if ($esAdministradorProveedor): ?>

                            <div class="ri-acciones-admin">

                                <!-- EDITAR -->

                                <a
                                    href="index.php?controller=proveedor&amp;action=editar&amp;id=<?= urlencode(
                                        (string) $id_proveedor
                                    ) ?>"
                                >
                                    Editar
                                </a>


                                <!-- ELIMINAR -->

                                <a
                                    href="index.php?controller=proveedor&amp;action=eliminar&amp;id=<?= urlencode(
                                        (string) $id_proveedor
                                    ) ?>"
                                    onclick="return confirm('¿Seguro que deseas eliminar este proveedor?');"
                                >
                                    Eliminar
                                </a>

                            </div>

                        <?php endif; ?>

                    </div>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="ri-vacio">
                No hay proveedores registrados
                por el momento.
            </p>

        <?php endif; ?>

    </div>

</section>


<!-- ===================================== -->
<!-- BENEFICIOS DE LA PLATAFORMA           -->
<!-- ===================================== -->

<section
    class="ri-beneficios"
    aria-label="Ventajas de Recuerdos Inolvidables"
>

    <div>

        <strong>
            ♡ A tu estilo
        </strong>

        <p>
            Compara las opciones disponibles
            y elige las que prefieras.
        </p>

    </div>


    <div>

        <strong>
            ✧ Organiza tu celebración
        </strong>

        <p>
            Consulta proveedores y servicios
            en un mismo lugar.
        </p>

    </div>


    <div>

        <strong>
            ◇ Encuentra inspiración
        </strong>

        <p>
            Descubre ideas para planear
            tus 15 años.
        </p>

    </div>

</section>


<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
