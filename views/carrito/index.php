
<?php
require_once __DIR__ . '/../layouts/header.php';

$esc = static function ($valor) {
    return htmlspecialchars(
        (string) ($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
};

$moneda = static function ($valor) {
    return '$' . number_format(
        (float) $valor,
        0,
        ',',
        '.'
    );
};

$total = 0;
$pendientes = 0;
$conPrecio = 0;

foreach ($carrito as $item) {
    $precio = isset($item['precio'])
        ? (float) $item['precio']
        : 0;

    $cantidad = max(1, (int) ($item['cantidad'] ?? 1));

    if ($precio > 0) {
        $total += $precio * $cantidad;
        $conPrecio++;
    } else {
        $pendientes++;
    }
}
?>

<style>
/* ESTILOS EXCLUSIVOS DEL CARRITO */

.ri-carrito-pagina {
    max-width: 1120px;
    margin: 38px auto 60px;
    padding: 0 16px;
    color: #694459;
}

.ri-carrito-pagina h1 {
    font-family: Georgia, serif;
    font-weight: normal;
    font-size: clamp(27px, 3vw, 38px);
    color: #8b3b60;
    margin: 8px 0;
}

.ri-carrito-etiqueta {
    letter-spacing: 2px;
    font-size: 11px;
    font-weight: bold;
    color: #b25e84;
}

.ri-carrito-subtitulo {
    color: #816d79;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 25px;
}

.ri-carrito-tarjeta {
    background: white;
    border: 1px solid #ecd6e0;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 8px 24px rgba(125, 67, 96, .07);
}

.ri-carrito-tabla-contenedor {
    overflow-x: auto;
}

.ri-carrito-tabla {
    width: 100%;
    min-width: 650px;
    border-collapse: collapse;
}

.ri-carrito-tabla th {
    text-align: left;
    font-size: 13px;
    color: #884365;
    background: #f9edf2;
    padding: 15px 12px;
}

.ri-carrito-tabla td {
    padding: 20px 12px;
    border-bottom: 1px solid #f0e0e7;
    font-size: 14px;
    vertical-align: middle;
}

.ri-carrito-nombre {
    display: block;
    font-weight: bold;
    color: #884061;
    margin-bottom: 8px;
}

.ri-carrito-pendiente {
    color: #a44a72;
    font-weight: 600;
}

.ri-carrito-cantidad {
    text-align: center;
}

.ri-carrito-eliminar {
    color: #a74a70;
    text-decoration: none;
    font-size: 13px;
}

.ri-carrito-contactar {
    display: inline-block;
    background: #f5e7f0;
    color: #894165;
    border: 1px solid #e7cde0;
    border-radius: 20px;
    padding: 9px 14px;
    text-decoration: none;
    font-size: 12px;
    font-weight: bold;
    margin: 5px 0;
}

.ri-carrito-contactar:hover {
    background: #edd8e6;
}

.ri-carrito-resumen {
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid #ecdbe4;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.ri-carrito-total {
    text-align: right;
}

.ri-carrito-total span {
    display: block;
    color: #75606b;
    font-size: 13px;
}

.ri-carrito-total strong {
    display: block;
    color: #98446b;
    font-size: 27px;
    margin-top: 5px;
}

.ri-carrito-aviso {
    margin-top: 20px;
    padding: 16px 18px;
    background: #fff7fa;
    border: 1px solid #eed4df;
    border-radius: 12px;
    color: #775b6b;
    font-size: 13px;
    line-height: 1.7;
}

.ri-carrito-botones {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 25px;
}

.ri-carrito-boton {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 12px 20px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: bold;
    text-decoration: none;
}

.ri-carrito-primario {
    background: #a74d77;
    color: white;
}

.ri-carrito-primario:hover {
    background: #873858;
    color: white;
}

.ri-carrito-secundario {
    color: #9f4771;
    background: white;
    border: 1px solid #d8a5bc;
}

.ri-carrito-vacio {
    text-align: center;
    padding: 45px 20px;
}

@media (max-width: 650px) {
    .ri-carrito-resumen {
        align-items: flex-start;
        flex-direction: column;
    }

    .ri-carrito-total {
        text-align: left;
    }

    .ri-carrito-tarjeta {
        padding: 16px;
    }
}
</style>

<section class="ri-carrito-pagina">

    <span class="ri-carrito-etiqueta">
        RECUERDOS INOLVIDABLES
    </span>

    <h1>Mi carrito y cotizaciones</h1>

    <p class="ri-carrito-subtitulo">
        Consulta tus servicios seleccionados.
        Los que no tienen precio definido
        deben cotizarse directamente con el proveedor.
    </p>

    <div class="ri-carrito-tarjeta">

        <?php if (!empty($carrito)): ?>

            <div class="ri-carrito-tabla-contenedor">

                <table class="ri-carrito-tabla">

                    <thead>
                        <tr>
                            <th>Servicio o producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($carrito as $item): ?>

                            <?php
                            $precio = isset($item['precio'])
                                ? (float) $item['precio']
                                : 0;

                            $cantidad = max(
                                1,
                                (int) ($item['cantidad'] ?? 1)
                            );

                            $esCotizacion = $precio <= 0;

                            $correo = $item['correo'] ?? '';

                            $correoValido = filter_var(
                                $correo,
                                FILTER_VALIDATE_EMAIL
                            );

                            $asunto = 'Solicitud de cotización - Recuerdos Inolvidables';

                            $mensaje = 'Hola, deseo solicitar una cotización del servicio: '
                                . ($item['nombre'] ?? 'Servicio')
                                . '. Agradezco información sobre precios y condiciones.';

                            $enlaceCorreo = $correoValido
                                ? 'mailto:' . $correo
                                  . '?subject=' . rawurlencode($asunto)
                                  . '&body=' . rawurlencode($mensaje)
                                : '';
                            ?>

                            <tr>

                                <td>

                                    <span class="ri-carrito-nombre">
                                        <?= $esc($item['nombre'] ?? 'Servicio') ?>
                                    </span>

                                    <?php if (
                                        $esCotizacion &&
                                        $correoValido
                                    ): ?>

                                        <a
                                            class="ri-carrito-contactar"
                                            href="<?= $esc($enlaceCorreo) ?>"
                                        >
                                            Solicitar cotización por correo
                                        </a>

                                    <?php elseif ($esCotizacion): ?>

                                        <span class="ri-carrito-pendiente">
                                            Consulta el precio con el proveedor
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?php if ($esCotizacion): ?>
                                        <span class="ri-carrito-pendiente">
                                            Por cotizar
                                        </span>
                                    <?php else: ?>
                                        <?= $moneda($precio) ?>
                                    <?php endif; ?>
                                </td>

                                <td class="ri-carrito-cantidad">
                                    <?= $cantidad ?>
                                </td>

                                <td>
                                    <?php if ($esCotizacion): ?>
                                        <span class="ri-carrito-pendiente">
                                            Pendiente
                                        </span>
                                    <?php else: ?>
                                        <strong>
                                            <?= $moneda(
                                                $precio * $cantidad
                                            ) ?>
                                        </strong>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a
                                        class="ri-carrito-eliminar"
                                        href="index.php?controller=carrito&amp;action=eliminar&amp;id=<?= urlencode(
                                            (string) ($item['id'] ?? '')
                                        ) ?>"
                                        onclick="return confirm('¿Quitar este servicio del carrito?');"
                                    >
                                        Eliminar
                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <div class="ri-carrito-resumen">

                <a
                    class="ri-carrito-eliminar"
                    href="index.php?controller=carrito&amp;action=vaciar"
                    onclick="return confirm('¿Deseas vaciar todo el carrito?');"
                >
                    Vaciar carrito
                </a>

                <div class="ri-carrito-total">

                    <span>
                        Total de servicios con precio definido
                    </span>

                    <strong>
                        <?= $moneda($total) ?>
                    </strong>

                </div>

            </div>

            <?php if ($pendientes > 0): ?>

                <div class="ri-carrito-aviso">

                    Tienes <?= $pendientes ?>
                    servicio(s) pendientes de cotización.

                    Estos servicios no están incluidos
                    en el total mostrado.

                    Para conocer su valor, comunícate
                    con el proveedor y solicita
                    una cotización.

                    Agregar un servicio al carrito
                    no significa que hayas realizado
                    una compra o un pago.

                </div>

            <?php else: ?>

                <div class="ri-carrito-aviso">

                    Los valores mostrados son informativos.
                    Todavía no se ha confirmado
                    ningún pago desde este carrito.

                </div>

            <?php endif; ?>

            <div class="ri-carrito-botones">

                <a
                    class="ri-carrito-boton ri-carrito-primario"
                    href="index.php?controller=proveedor&amp;action=index"
                >
                    Seguir explorando servicios
                </a>

            </div>

        <?php else: ?>

            <div class="ri-carrito-vacio">

                <h2>Tu carrito está vacío</h2>

                <p>
                    Explora los proveedores disponibles
                    y agrega los servicios que te interesen.
                </p>

                <a
                    class="ri-carrito-boton ri-carrito-primario"
                    href="index.php?controller=proveedor&amp;action=index"
                >
                    Explorar proveedores
                </a>

            </div>

        <?php endif; ?>

    </div>

</section>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
