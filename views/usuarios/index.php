
<?php
require_once __DIR__ . '/../layouts/header.php';

$esAdmin = isset($_SESSION['user_id'])
    && (int) ($_SESSION['user_rol'] ?? 0) === 1;

$esc = static function ($valor) {
    return htmlspecialchars(
        (string) ($valor ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
};

$totalUsuarios = count($usuarios ?? []);
?>

<style>
/* DIRECTORIO DE CLIENTES */

.ri-clientes {
    width: 100%;
    max-width: 1180px;
    margin: 35px auto 65px;
    padding: 0 18px;
    font-family: "Segoe UI", Arial, sans-serif;
    color: #68475b;
}

.ri-clientes-cabecera {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 22px;
    margin-bottom: 25px;
}

.ri-clientes-etiqueta {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #b46e8e;
}

.ri-clientes h1 {
    font-family: Georgia, serif;
    font-size: clamp(29px, 3vw, 40px);
    font-weight: normal;
    color: #8b3d60;
    margin: 8px 0;
}

.ri-clientes-descripcion {
    font-size: 14px;
    line-height: 1.6;
    color: #806a77;
    margin: 0;
}

.ri-clientes-agregar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 21px;
    background: #a94f78;
    color: #fff !important;
    border-radius: 26px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background-color .2s ease;
}

.ri-clientes-agregar:hover {
    background: #853b5e;
}

/* RESUMEN */

.ri-clientes-resumen {
    background: linear-gradient(
        110deg,
        #fff9fa,
        #f8e6ee
    );
    border: 1px solid #edd5df;
    border-radius: 18px;
    padding: 22px 26px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.ri-clientes-resumen span {
    color: #806474;
    font-size: 14px;
}

.ri-clientes-resumen strong {
    color: #964466;
    font-family: Georgia, serif;
    font-size: 32px;
}

/* TABLA */

.ri-clientes-tabla-contenedor {
    background: #fff;
    border: 1px solid #ecd6df;
    border-radius: 18px;
    overflow-x: auto;
    box-shadow: 0 8px 24px rgba(123, 65, 90, .07);
}

.ri-clientes-tabla {
    width: 100%;
    min-width: 750px;
    border-collapse: collapse;
}

.ri-clientes-tabla thead {
    background: #f7e6ed;
}

.ri-clientes-tabla th {
    text-align: left;
    padding: 19px 17px;
    color: #84405f;
    font-size: 13px;
    font-weight: 700;
    border-bottom: 1px solid #ecd3df;
}

.ri-clientes-tabla td {
    padding: 19px 17px;
    border-bottom: 1px solid #f2e5eb;
    font-size: 13px;
    vertical-align: middle;
    color: #73596b;
}

.ri-clientes-tabla tbody tr:last-child td {
    border-bottom: none;
}

.ri-clientes-tabla tbody tr:hover {
    background: #fff8fb;
}

.ri-cliente-id {
    color: #b58a9e;
    font-size: 12px;
}

.ri-cliente-nombre {
    font-weight: 600;
    color: #803c5d;
    font-size: 14px;
}

.ri-cliente-correo {
    overflow-wrap: anywhere;
}

.ri-cliente-acciones {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 9px;
}

.ri-cliente-editar,
.ri-cliente-eliminar {
    display: inline-block;
    padding: 9px 15px;
    border-radius: 20px;
    text-decoration: none;
    text-align: center;
    font-size: 12px;
    font-weight: 600;
    transition: background-color .2s ease;
}

.ri-cliente-editar {
    background: #a94f78;
    color: white !important;
}

.ri-cliente-editar:hover {
    background: #873b5e;
}

.ri-cliente-eliminar {
    color: #ad4a70 !important;
    border: 1px solid #dca9be;
    background: white;
}

.ri-cliente-eliminar:hover {
    background: #fff0f5;
}

.ri-clientes-vacio {
    padding: 40px !important;
    text-align: center;
    color: #826b77;
}

/* DISPOSITIVOS MÓVILES */

@media (max-width: 650px) {

    .ri-clientes {
        margin-top: 25px;
        padding: 0 12px;
    }

    .ri-clientes-cabecera {
        flex-direction: column;
        align-items: flex-start;
    }

    .ri-clientes-resumen {
        padding: 18px;
    }

    .ri-clientes-tabla th,
    .ri-clientes-tabla td {
        padding: 14px 12px;
    }
}
</style>

<section class="ri-clientes">

    <!-- CABECERA -->

    <div class="ri-clientes-cabecera">

        <div>
            <span class="ri-clientes-etiqueta">
                RECUERDOS INOLVIDABLES · ADMINISTRACIÓN
            </span>

            <h1>Gestión de usuarios</h1>

            <p class="ri-clientes-descripcion">
                Consulta y administra la información
                de los usuarios registrados.
            </p>
        </div>

        <?php if ($esAdmin): ?>

            <a
                class="ri-clientes-agregar"
                href="index.php?controller=usuario&amp;action=crear"
            >
                + Agregar usuario
            </a>

        <?php endif; ?>

    </div>

    <!-- RESUMEN -->

    <div class="ri-clientes-resumen">

        <div>
            <span>Usuarios registrados</span>
            <p class="ri-clientes-descripcion">
                Total de cuentas en el directorio
            </p>
        </div>

        <strong>
            <?= $totalUsuarios ?>
        </strong>

    </div>

    <!-- DIRECTORIO -->

    <div class="ri-clientes-tabla-contenedor">

        <table class="ri-clientes-tabla">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Teléfono</th>

                    <?php if ($esAdmin): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($usuarios)): ?>

                    <?php foreach ($usuarios as $u): ?>

                        <tr>

                            <td>
                                <span class="ri-cliente-id">
                                    #<?= $esc($u['id_usuario']) ?>
                                </span>
                            </td>

                            <td>
                                <span class="ri-cliente-nombre">
                                    <?= $esc($u['nombre']) ?>
                                </span>
                            </td>

                            <td class="ri-cliente-correo">
                                <?= $esc($u['email']) ?>
                            </td>

                            <td>
                                <?= $esc(
                                    $u['telefono'] ?: 'Sin registrar'
                                ) ?>
                            </td>

                            <?php if ($esAdmin): ?>

                                <td>
                                    <div class="ri-cliente-acciones">

                                        <a
                                            class="ri-cliente-editar"
                                            href="index.php?controller=usuario&amp;action=editar&amp;id=<?= urlencode(
                                                (string) $u['id_usuario']
                                            ) ?>"
                                        >
                                            Editar
                                        </a>

                                        <a
                                            class="ri-cliente-eliminar"
                                            href="index.php?controller=usuario&amp;action=eliminar&amp;id=<?= urlencode(
                                                (string) $u['id_usuario']
                                            ) ?>"
                                            onclick="return confirm('¿Seguro que deseas eliminar este usuario?');"
                                        >
                                            Eliminar
                                        </a>

                                    </div>
                                </td>

                            <?php endif; ?>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td
                            colspan="<?= $esAdmin ? 5 : 4 ?>"
                            class="ri-clientes-vacio"
                        >
                            No hay usuarios registrados.
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
