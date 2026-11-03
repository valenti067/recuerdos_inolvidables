<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-container">
    <div class="auth-box">
        <h2>Iniciar Sesión</h2>
        <p>Ingresa a tu cuenta para gestionar tu evento de 15 años.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=login" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required placeholder="tu@email.com">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="******">
            </div>

            <button type="submit" class="btn-primary">Entrar</button>
        </form>

        <p class="auth-switch">¿Aún no tienes cuenta? <a href="index.php?controller=auth&action=register">Regístrate aquí</a></p>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>