
<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-container">
    <div class="auth-box">
        <h2>Crear Cuenta</h2>
        <p>Únete para planificar tu evento o registrar tus servicios como proveedor.</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success); ?>
                <a href="index.php?controller=auth&action=login">
                    Iniciar sesión
                </a>
            </div>
        <?php endif; ?>

        <form
            action="index.php?controller=auth&action=register"
            method="POST"
            class="auth-form"
            id="formRegistro"
        >
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    required
                    placeholder="Ej: Maria Lopez"
                >
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="tu@email.com"
                >
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono / WhatsApp</label>
                <input
                    type="text"
                    id="telefono"
                    name="telefono"
                    placeholder="555-0000"
                >
            </div>

            <!-- CONTRASEÑA CON REQUISITOS -->
            <div class="form-group">
                <label for="password">Contraseña</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    placeholder="Crea una contraseña"
                    aria-describedby="requisitosPassword"
                >

                <div
                    id="requisitosPassword"
                    class="requisitos-password"
                    aria-live="polite"
                >
                    <p id="reqMayuscula" class="requisito">
                        ○ Una letra mayúscula
                    </p>

                    <p id="reqLongitud" class="requisito">
                        ○ Mínimo 8 caracteres
                    </p>

                    <p id="reqNumero" class="requisito">
                        ○ Al menos un número
                    </p>

                    <p id="reqLetra" class="requisito">
                        ○ Al menos una letra
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label for="id_rol">Tipo de Cuenta</label>

                <select
                    name="id_rol"
                    id="id_rol"
                    class="form-select"
                >
                    
                    <option value="2">
                        Organizador / Quinceañera (Cliente)
                    </option>
                    <option value="3">
                        Proveedor de Servicios
                    </option>
                </select>
            </div>

            <button type="submit" class="btn-primary">
                Registrarse
            </button>
        </form>

        <p class="auth-switch">
            ¿Ya tienes cuenta?
            <a href="index.php?controller=auth&action=login">
                Inicia sesión
            </a>
        </p>
    </div>
</section>

<style>
    .requisitos-password {
        margin-top: 10px;
        font-size: 13px;
    }

    .requisitos-password p {
        margin: 5px 0;
        color: #c62828;
    }

    .requisitos-password p.cumplido {
        color: #198754;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const formulario = document.getElementById('formRegistro');

    const requisitos = [
        {
            elemento: document.getElementById('reqMayuscula'),
            comprobar: valor => /[A-ZÁÉÍÓÚÜÑ]/.test(valor),
            texto: 'Una letra mayúscula'
        },
        {
            elemento: document.getElementById('reqLongitud'),
            comprobar: valor => valor.length >= 8,
            texto: 'Mínimo 8 caracteres'
        },
        {
            elemento: document.getElementById('reqNumero'),
            comprobar: valor => /[0-9]/.test(valor),
            texto: 'Al menos un número'
        },
        {
            elemento: document.getElementById('reqLetra'),
            comprobar: valor => /[A-Za-zÁÉÍÓÚÜÑáéíóúüñ]/.test(valor),
            texto: 'Al menos una letra'
        }
    ];

    function validarPassword() {
        const valor = password.value;
        let todosCumplidos = true;

        requisitos.forEach(function (requisito) {
            const cumple = requisito.comprobar(valor);

            requisito.elemento.classList.toggle('cumplido', cumple);

            requisito.elemento.textContent =
                (cumple ? '✓ ' : '○ ') + requisito.texto;

            if (!cumple) {
                todosCumplidos = false;
            }
        });

        return todosCumplidos;
    }

    password.addEventListener('input', validarPassword);

    formulario.addEventListener('submit', function (evento) {
        if (!validarPassword()) {
            evento.preventDefault();
            password.focus();
        }
    });
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
