<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container" style="padding: 40px 20px; min-height: 50vh;">
    <h2 style="color: #e6196e;">Agregar Nuevo Producto o Servicio</h2>
    
    <form action="index.php?controller=servicio&action=guardar" method="POST" style="max-width: 450px; display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
        
        <div>
            <label style="font-weight: bold;">Nombre del Producto/Servicio:</label><br>
            <input type="text" name="nombre" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;" placeholder="Ej. Paquete de Fotografía Profesional">
        </div>

        <div>
            <label style="font-weight: bold;">Categoría:</label><br>
            <select name="id_categoria" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                <?php foreach($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label style="font-weight: bold;">Precio ($):</label><br>
            <input type="number" step="0.01" name="precio" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;" placeholder="0.00">
        </div>

        <div>
            <label style="font-weight: bold;">Descripción:</label><br>
            <textarea name="descripcion" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;" placeholder="Detalles del paquete o servicio..."></textarea>
        </div>

        <button type="submit" style="padding: 12px; background: #e6196e; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 16px;">Guardar Producto</button>
        <a href="index.php?controller=servicio&action=index" style="text-align: center; color: #666; text-decoration: none;">Cancelar</a>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>