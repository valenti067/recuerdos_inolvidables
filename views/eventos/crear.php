<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-container">
    <div class="auth-box">
        <h2>Crear Nuevo Evento</h2>
        <p>Registra la información clave de la celebración.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=evento&action=crear" method="POST" class="auth-form">
            <div class="form-group">
                <label for="nombre_evento">Nombre del Evento *</label>
                <input type="text" id="nombre_evento" name="nombre_evento" required placeholder="Ej: Mis 15 Años - Valeria">
            </div>

            <div class="form-group">
                <label for="fecha_evento">Fecha del Evento *</label>
                <input type="date" id="fecha_evento" name="fecha_evento" required>
            </div>

            <div class="form-group">
                <label for="presupuesto">Presupuesto estimado ($)</label>
                <input type="number" step="0.01" id="presupuesto" name="presupuesto" placeholder="0.00">
            </div>

            <div class="form-group">
                <label for="lugar">Lugar / Salón</label>
                <input type="text" id="lugar" name="lugar" placeholder="Ej: Salón Jardin Real">
            </div>

            <div class="form-group">
                <label for="estado">Estado inicial</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="Planificando">Planificando</option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Guardar Evento</button>
            <a href="index.php?controller=evento&action=index" class="btn-secondary">Cancelar</a>
        </form>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>