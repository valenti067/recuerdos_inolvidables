
<?php
require_once __DIR__ . '/../layouts/header.php';


$esAdmin = isset($_SESSION['user_id'])
    && isset($_SESSION['user_rol'])
    && in_array(
        (int) $_SESSION['user_rol'],
        [1, 3],
        true
    );


$esc = static function ($valor) {
    return htmlspecialchars(
        (string) ($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
};
?>

<link rel="stylesheet"
      href="css/catalogo-elegante.css?v=1">

<section class="catalogo-ri">

    <div class="catalogo-ri-encabezado">

        <div>
            <span class="catalogo-ri-etiqueta">
                RECUERDOS INOLVIDABLES
            </span>

            <h1>Productos y servicios</h1>

            <p>
                <?php if ($esAdmin): ?>
                    Consulta y administra los servicios
                    disponibles para las celebraciones.
                <?php else: ?>
                    Explora los servicios disponibles
                    para organizar tu fiesta de 15 años.
                <?php endif; ?>
            </p>
        </div>

        <?php if ($esAdmin): ?>

            <a class="catalogo-ri-nuevo"
               href="index.php?controller=servicio&amp;action=crear">
                + Nuevo producto o servicio
            </a>

        <?php endif; ?>

    </div>

    <div class="catalogo-ri-tabla-contenedor">

        <table class="catalogo-ri-tabla">

            <thead>
                <tr>
                    <?php if ($esAdmin): ?>
                        <th>ID</th>
                    <?php endif; ?>

                    <th>Producto o servicio</th>
                    <th>Categoría</th>
                    <th>Precio</th>

                    <?php if ($esAdmin): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($servicios)): ?>

                    <?php foreach ($servicios as $s): ?>

                        <tr>

                            <?php if ($esAdmin): ?>
                                <td>
                                    <?= $esc($s['id_servicio'] ?? '') ?>
                                </td>
                            <?php endif; ?>

                            <td>
                                <strong class="catalogo-ri-nombre">
                                    <?= $esc($s['nombre'] ?? '') ?>
                                </strong>

                                <?php if (!empty($s['descripcion'])): ?>
                                    <p class="catalogo-ri-descripcion">
                                        <?= $esc($s['descripcion']) ?>
                                    </p>
                                <?php endif; ?>
                            </td>

                            <td>
                                <span class="catalogo-ri-categoria">
                                    <?= $esc(
                                        $s['categoria'] ?? 'Sin categoría'
                                    ) ?>
                                </span>
                            </td>

                            <td>
                                <strong class="catalogo-ri-precio">
                                    $<?= number_format(
                                        (float) ($s['precio'] ?? 0),
                                        2,
                                        ',',
                                        '.'
                                    ) ?>
                                </strong>
                            </td>

                            <?php if ($esAdmin): ?>

                                <td>
                                    <div class="catalogo-ri-acciones">

                                        <a class="catalogo-ri-editar"
                                           href="index.php?controller=servicio&amp;action=editar&amp;id=<?= urlencode(
                                               (string) ($s['id_servicio'] ?? '')
                                           ) ?>">
                                            Editar
                                        </a>

                                        <a class="catalogo-ri-eliminar"
                                           href="index.php?controller=servicio&amp;action=eliminar&amp;id=<?= urlencode(
                                               (string) ($s['id_servicio'] ?? '')
                                           ) ?>"
                                           onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                                            Eliminar
                                        </a>

                                    </div>
                                </td>

                            <?php endif; ?>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="<?= $esAdmin ? 5 : 3 ?>"
                            class="catalogo-ri-vacio">
                            No hay productos o servicios
                            registrados por el momento.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</section>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
