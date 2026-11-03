<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-container">
    <div class="auth-box">
        <h2>Editar Evento</h2>
        <p>Actualiza la información de tu celebración.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=evento&action=editar&id=<?php echo $evento['id_evento']; ?>" method="POST" class="auth-form">
            <div class="form-group">
                <label for="nombre_evento">Nombre del Evento *</label>
                <input type="text" id="nombre_evento" name="nombre_evento" value="<?php echo htmlspecialchars($evento['nombre_evento']); ?>" required>
            </div>

            <div class="form-group">
                <label for="fecha_evento">Fecha del Evento *</label>
                <input type="date" id="fecha_evento" name="fecha_evento" value="<?php echo htmlspecialchars($evento['fecha_evento']); ?>" required>
            </div>

            <div class="form-group">
                <label for="presupuesto">Presupuesto ($)</label>
                <input type="number" step="0.01" id="presupuesto" name="presupuesto" value="<?php echo htmlspecialchars($evento['presupuesto']); ?>">
            </div>

            <div class="form-group">
                <label for="lugar">Lugar / Salón</label>
                <input type="text" id="lugar" name="lugar" value="<?php echo htmlspecialchars($evento['lugar']); ?>">
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="Planificando" <?php echo ($evento['estado'] === 'Planificando') ? 'selected' : ''; ?>>Planificando</option>
                    <option value="Confirmado" <?php echo ($evento['estado'] === 'Confirmado') ? 'selected' : ''; ?>>Confirmado</option>
                    <option value="Finalizado" <?php echo ($evento['estado'] === 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                    <option value="Cancelado" <?php echo ($evento['estado'] === 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Guardar Cambios</button>
            <a href="index.php?controller=evento&action=index" class="btn-secondary">Cancelar</a>
        </form>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>