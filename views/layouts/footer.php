
<?php

$rolFooter = isset($_SESSION['user_id'])
    ? (int) ($_SESSION['user_rol'] ?? 0)
    : 0;

$esAdminFooter = $rolFooter === 1;
$esProveedorFooter = $rolFooter === 3;

?>

<!-- CIERRE DEL CONTENEDOR PRINCIPAL -->

</main>

<!-- PIE DE PÁGINA -->

<footer class="ri-footer">

    <div class="ri-footer-contenido">

        <!-- INFORMACIÓN DE LA PLATAFORMA -->

        <div class="ri-footer-columna">

            <h3>Recuerdos Inolvidables 15</h3>

            <p>
                Encuentra opciones para hacer de tu
                celebración de 15 años un recuerdo
                inolvidable.
            </p>

            <p>
                Explora vestidos, salones, fotografía,
                decoración y otros servicios para
                organizar una celebración a tu estilo.
            </p>

        </div>

        <!-- ENLACES RÁPIDOS -->

        <div class="ri-footer-columna">

            <h4>Enlaces rápidos</h4>

            <ul class="ri-footer-enlaces">

                <li>
                    <a href="index.php">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="index.php?controller=proveedor&amp;action=index">
                        Proveedores
                    </a>
                </li>

                <li>
                    <a href="index.php?controller=servicio&amp;action=index">
                        Productos y servicios
                    </a>
                </li>

                <?php if ($esAdminFooter): ?>

                    <li>
                        <a href="index.php?controller=categoria&amp;action=index">
                            Administrar categorías
                        </a>
                    </li>

                    <li>
                        <a href="index.php?controller=usuario&amp;action=index">
                            Clientes y usuarios
                        </a>
                    </li>

                    <li>
                        <a href="index.php?controller=reporte&amp;action=index">
                            Reportes
                        </a>
                    </li>

                    <li>
                        <a href="index.php?controller=evento&amp;action=index">
                            Administrar eventos
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

        <!-- CONTACTO -->

        <div class="ri-footer-columna">

            <h4>Contacto</h4>

            <div class="ri-footer-contacto">

                <p>
                    <span aria-hidden="true">✉</span>
                    contacto@recuerdosinolvidables.com
                </p>

                <p>
                    <span aria-hidden="true">☎</span>
                    +57 322 4800189
                </p>

                <p>
                    <span aria-hidden="true">⌖</span>
                    Bogotá, Colombia
                </p>

            </div>

        </div>

    </div>

    <!-- DERECHOS RESERVADOS -->

    <div class="ri-footer-inferior">

        &copy; <?= date('Y') ?>
        Recuerdos Inolvidables 15 —
        Todos los derechos reservados.
        SENA CDM

    </div>

</footer>

<style>

/* PIE DE PÁGINA ROMÁNTICO */

.ri-footer {
    width: 100%;
    margin-top: 55px;
    padding: 38px 20px 0;

    background: linear-gradient(
        120deg,
        #fffaf8,
        #fff3f7
    );

    border-top: 1px solid #e8c4d2;
    color: #6c5261;
}

.ri-footer-contenido {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;

    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 45px;
}

.ri-footer-columna {
    min-width: 0;
}

.ri-footer h3 {
    color: #a34670;
    font-family: Georgia, serif;
    font-size: 21px;
    font-weight: 600;
    margin: 0 0 16px;
}

.ri-footer h4 {
    display: inline-block;
    color: #853d5d;
    font-family: Georgia, serif;
    font-size: 17px;

    margin: 0 0 17px;
    padding-bottom: 7px;

    border-bottom: 1px solid #d9a1b8;
}

.ri-footer p {
    font-size: 14px;
    line-height: 1.8;
    margin: 0 0 12px;
    overflow-wrap: anywhere;
}

.ri-footer-enlaces {
    list-style: none;
    padding: 0;
    margin: 0;

    display: flex;
    flex-direction: column;
    gap: 12px;
}

.ri-footer-enlaces li {
    list-style: none;
}

.ri-footer-enlaces a {
    color: #765565;
    text-decoration: none;
    font-size: 14px;
}

.ri-footer-enlaces a:hover {
    color: #b4507b;
    text-decoration: underline;
}

.ri-footer-contacto p {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.ri-footer-contacto span {
    color: #b55680;
    font-size: 17px;
}

.ri-footer-inferior {
    max-width: 1200px;
    margin: 30px auto 0;
    padding: 18px 5px;

    border-top: 1px solid #ead5df;

    text-align: center;
    color: #998391;
    font-size: 12px;
    line-height: 1.6;
}

/* TABLETAS */

@media (max-width: 900px) {

    .ri-footer-contenido {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 30px;
    }

}

/* CELULARES */

@media (max-width: 600px) {

    .ri-footer {
        padding: 30px 20px 0;
    }

    .ri-footer-contenido {
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .ri-footer h3 {
        font-size: 20px;
    }

}

</style>

</body>
</html>
