<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container" style="padding: 40px 20px; min-height: 50vh;">
    <h2 style="color: #e6196e;">Directorio de Categorías</h2>
    <p>Administra las categorías de tus proveedores.</p>
    
    <a href="index.php?controller=categoria&action=crear" style="display: inline-block; padding: 10px 20px; background: #e6196e; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">+ Nueva Categoría</a>

    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left; background: white;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="padding: 12px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Nombre de la Categoría</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $cat): ?>
            <tr>
                <td style="padding: 12px; border: 1px solid #ddd;"><?= $cat['id_categoria'] ?></td>
                <td style="padding: 12px; border: 1px solid #ddd;"><?= $cat['nombre'] ?></td>
                <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                    <!-- Botón de Editar (Rosa sólido) -->
                    <a href="index.php?controller=categoria&action=editar&id=<?= $cat['id_categoria'] ?>" style="display: inline-block; padding: 6px 12px; background: #e6196e; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; margin-right: 8px;">✏️ Editar</a>
                    
                    <!-- Botón de Eliminar (Borde rosa) -->
                    <a href="index.php?controller=categoria&action=eliminar&id=<?= $cat['id_categoria'] ?>" style="display: inline-block; padding: 6px 12px; background: white; color: #e6196e; border: 1px solid #e6196e; text-decoration: none; border-radius: 4px; font-size: 14px;" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">🗑️ Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>