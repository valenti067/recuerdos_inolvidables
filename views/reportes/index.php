
<?php
require_once __DIR__ . '/../layouts/header.php';

$moneda = static function ($valor) {
    return '$' . number_format(
        (float) $valor,
        0,
        ',',
        '.'
    );
};

$esc = static function ($valor) {
    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES,
        'UTF-8'
    );
};

$maxIngresos = 0;

foreach ($ventasMensuales as $fila) {
    $maxIngresos = max(
        $maxIngresos,
        (float) $fila['ingresos']
    );
}
?>

<style>

/* PANEL DE ADMINISTRACIÓN */

.ri-panel {
    max-width: 1200px;
    margin: 35px auto 65px;
    padding: 0 18px;
    color: #6c4259;
    font-family: Arial, sans-serif;
}

.ri-panel h1,
.ri-panel h2 {
    font-family: Georgia, serif;
    color: #873d61;
}

.ri-panel h1 {
    font-size: 36px;
    margin: 7px 0 8px;
}

.ri-panel h2 {
    font-size: 22px;
    margin: 0 0 17px;
}

.ri-panel .ri-sub {
    color: #806b78;
    font-size: 14px;
    margin: 0 0 24px;
}

.ri-panel .ri-eyebrow {
    color: #b25d83;
    font-size: 11px;
    letter-spacing: 2px;
    font-weight: bold;
}

/* TARJETAS ESTADÍSTICAS */

.ri-metricas {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 25px;
}

.ri-metrica,
.ri-panel-seccion {
    background: #fff;
    border: 1px solid #ecd8e2;
    border-radius: 16px;
    box-shadow: 0 4px 16px #ad54780d;
}

.ri-metrica {
    padding: 20px;
}

.ri-metrica span {
    display: block;
    color: #816879;
    font-size: 13px;
}

.ri-metrica strong {
    display: block;
    font-size: 26px;
    color: #95466e;
    margin: 11px 0 2px;
}

/* SECCIONES */

.ri-panel-seccion {
    padding: 24px;
    margin-bottom: 22px;
}

.ri-panel-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* ENLACES ADMINISTRATIVOS */

.ri-admin-links {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.ri-admin-links a {
    background: #faf0f5;
    border: 1px solid #ebd4df;
    border-radius: 12px;
    padding: 16px;
    color: #873d61;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
}

.ri-admin-links a:hover {
    background: #f4dfeb;
}

/* TABLAS */

.ri-panel table {
    border-collapse: collapse;
    width: 100%;
    font-size: 13px;
}

.ri-panel th,
.ri-panel td {
    text-align: left;
    padding: 10px 8px;
    border-bottom: 1px solid #f1e2e9;
}

.ri-panel th {
    color: #8c4969;
    background: #fcf5f8;
}

/* GRÁFICOS DE VENTAS */

.ri-bar-row {
    display: grid;
    grid-template-columns: 75px 1fr 115px;
    gap: 12px;
    align-items: center;
    font-size: 13px;
    margin-bottom: 14px;
}

.ri-bar-track {
    height: 18px;
    border-radius: 8px;
    background: #f8eaf0;
    overflow: hidden;
}

.ri-bar {
    height: 100%;
    background: linear-gradient(
        90deg,
        #d68aaa,
        #a84b78
    );
    border-radius: 8px;
}

.ri-empty {
    font-size: 14px;
    line-height: 1.65;
    color: #806a77;
}

/* ADAPTACIÓN A TABLETAS */

@media (max-width: 800px) {

    .ri-metricas {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .ri-panel-grid {
        grid-template-columns: 1fr;
    }

    .ri-admin-links {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

/* ADAPTACIÓN A CELULARES */

@media (max-width: 480px) {

    .ri-metricas,
    .ri-admin-links {
        grid-template-columns: 1fr;
    }

    .ri-bar-row {
        grid-template-columns: 60px 1fr;
        gap: 6px;
    }

    .ri-bar-row strong {
        grid-column: 2;
    }
}

</style>


<!-- PANEL PRINCIPAL -->

<section class="ri-panel"
         aria-labelledby="titulo-panel">

    <span class="ri-eyebrow">
        RECUERDOS INOLVIDABLES · ADMINISTRACIÓN
    </span>

    <h1 id="titulo-panel">
        Panel de administración
    </h1>

    <p class="ri-sub">
        Resumen calculado a partir de la base de datos.
        Solo se cuentan como ingresos las ventas
        en estado Completado.
    </p>


    <!-- TARJETAS DE ESTADÍSTICAS -->

    <div class="ri-metricas">

        <div class="ri-metrica">

            <span>Ingresos del mes</span>

            <strong>
                <?= $moneda($resumenMes['ingresos']) ?>
            </strong>

            <span>
                <?= (int) $resumenMes['compras'] ?>
                compras completadas
            </span>

        </div>

        <div class="ri-metrica">

            <span>Ingresos acumulados</span>

            <strong>
                <?= $moneda($ingresosTotales) ?>
            </strong>

            <span>
                <?= $totalCompras ?>
                compras completadas
            </span>

        </div>

        <div class="ri-metrica">

            <span>Proveedores</span>

            <strong>
                <?= $totalProveedores ?>
            </strong>

            <span>Registrados</span>

        </div>

        <div class="ri-metrica">

            <span>Usuarios</span>

            <strong>
                <?= $totalUsuarios ?>
            </strong>

            <span>
                <?= $totalServicios ?>
                productos o servicios
            </span>

        </div>

    </div>


    <!-- ADMINISTRACIÓN -->

    <section class="ri-panel-seccion">

        <h2>Gestión del sistema</h2>

        <div class="ri-admin-links">

            <a href="index.php?controller=servicio&amp;action=index">
                Productos y servicios
            </a>

            <a href="index.php?controller=proveedor&amp;action=index">
                Proveedores
            </a>

            <a href="index.php?controller=categoria&amp;action=index">
                Categorías
            </a>

            <a href="index.php?controller=usuario&amp;action=index">
                Usuarios y personal
            </a>

            <a href="index.php?controller=evento&amp;action=index">
                Eventos
            </a>

            <a href="index.php?controller=reporte&amp;action=index">
                Actualizar estadísticas
            </a>

        </div>

    </section>


    <!-- GRÁFICOS Y PRODUCTOS -->

    <div class="ri-panel-grid">

        <!-- VENTAS MENSUALES -->

        <section class="ri-panel-seccion">

            <h2>Ventas por mes</h2>

            <?php if (empty($ventasMensuales)): ?>

                <p class="ri-empty">
                    Todavía no hay ventas completadas
                    registradas para mostrar en el gráfico.
                </p>

            <?php else: ?>

                <?php foreach ($ventasMensuales as $fila): ?>

                    <?php
                    $ancho = $maxIngresos > 0
                        ? round(
                            100 * (float) $fila['ingresos']
                            / $maxIngresos,
                            1
                        )
                        : 0;
                    ?>

                    <div class="ri-bar-row">

                        <span>
                            <?= $esc($fila['periodo']) ?>
                        </span>

                        <div class="ri-bar-track">

                            <div
                                class="ri-bar"
                                style="width:<?= $ancho ?>%">
                            </div>

                        </div>

                        <strong>
                            <?= $moneda($fila['ingresos']) ?>
                        </strong>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </section>


        <!-- PRODUCTOS MÁS VENDIDOS -->

        <section class="ri-panel-seccion">

            <h2>Productos más vendidos</h2>

            <p class="ri-empty">
                Esta estadística aún no puede calcularse:
                la tabla de ventas registra el monto total,
                pero no los productos ni las cantidades
                de cada compra.
            </p>

            <p class="ri-empty">
                Para generar esta clasificación necesitamos
                registrar el detalle de los artículos
                vendidos al confirmar cada pago.
            </p>

        </section>

    </div>


    <!-- ÚLTIMAS VENTAS -->

    <section class="ri-panel-seccion">

        <h2>Últimas ventas registradas</h2>

        <?php if (empty($ultimasVentas)): ?>

            <p class="ri-empty">
                No hay ventas registradas todavía.
            </p>

        <?php else: ?>

            <div style="overflow-x:auto">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($ultimasVentas as $venta): ?>

                            <tr>

                                <td>
                                    <?= $esc($venta['id_venta']) ?>
                                </td>

                                <td>
                                    <?= $esc($venta['fecha_venta']) ?>
                                </td>

                                <td>
                                    <?= $esc($venta['concepto']) ?>
                                </td>

                                <td>
                                    <?= $moneda($venta['monto']) ?>
                                </td>

                                <td>
                                    <?= $esc($venta['estado']) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </section>

</section>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
