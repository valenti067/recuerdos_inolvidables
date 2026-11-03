
<?php
$titulo = '¿Quiénes somos?';

require_once __DIR__ . '/../layouts/header.php';
?>

<section class="quienes-somos">
    <h1>¿Quiénes somos?</h1>

    <p>
        Somos el equipo detrás de Recuerdos Inolvidables,
        una plataforma que ayuda a organizar celebraciones
        de quince años y encontrar proveedores.
    </p>

    <div class="integrantes">

        <article class="integrante">
            <img
                src="img/FOTO_MARY.jpg"
                alt="Foto del primer integrante"
            >
            <h2>MARIELYS AZOCAR</h2>
            <p>Integrante del proyecto</p>
        </article>

        <article class="integrante">
            <img
                src="img/FOTO_VALENTINA.jpg"
                alt="Foto del segundo integrante"
            >
            <h2>VALENTINA FORERO</h2>
            <p>Integrante del proyecto</p>
        </article>

    </div>
</section>

<style>
.quienes-somos {
    padding: 35px 20px;
    text-align: center;
}

.integrantes {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 25px;
    margin-top: 30px;
}

.integrante {
    width: 220px;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.10);
}

.integrante img {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 50%;
}

.integrante h2 {
    font-size: 18px;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
