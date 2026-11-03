<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container" style="padding: 40px 20px; min-height: 50vh;">
    <h2 style="color: #e6196e;">Registrar Nuevo Cliente</h2>
    
    <form action="index.php?controller=usuario&action=guardar" method="POST" style="max-width: 400px; display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
        <div>
            <label style="font-weight: bold;">Nombre Completo:</label><br>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
        </div>

        <div>
            <label style="font-weight: bold;">Correo Electrónico:</label><br>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
        </div>

        <div>
            <label style="font-weight: bold;">Teléfono:</label><br>
            <input type="text" name="telefono" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
        </div>

        <div>
            <label style="font-weight: bold;">Contraseña:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
        </div>

        <button type="submit" style="padding: 12px; background: #e6196e; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px;">Guardar Cliente</button>
        <a href="index.php?controller=usuario&action=index" style="text-align: center; color: #666; text-decoration: none;">Cancelar</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>