<?php 
// se hace la modificacion del index de forma temporal
require_once __DIR__ . '/../layouts/header.php'; 
?>

<section class="events-header">
    <div class="header-action">
        <h1>Mis Eventos de 15 Años</h1>
        <a href="index.php?controller=evento&action=crear" class="btn-primary">+ Nuevo Evento</a>
    </div>
</section>

<section class="events-list">
    <?php if (!empty($eventos)): ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nombre del Evento</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Presupuesto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $e): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($e['nombre_evento']); ?></strong></td>
                            <td><?php echo date('d/m/Y', strtotime($e['fecha_evento'])); ?></td>
                            <td><?php echo htmlspecialchars($e['lugar'] ?: 'Por definir'); ?></td>
                            <td>$<?php echo number_format($e['presupuesto'], 2); ?></td>
                            <td>
                                <span class="badge-status status-<?php echo strtolower($e['estado']); ?>">
                                    <?php echo htmlspecialchars($e['estado']); ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="index.php?controller=evento&action=editar&id=<?php echo $e['id_evento']; ?>" class="btn-edit">Editar</a>
                                <a href="index.php?controller=evento&action=eliminar&id=<?php echo $e['id_evento']; ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <p>No tienes eventos registrados todavía.</p>
            <a href="index.php?controller=evento&action=crear" class="btn-primary">Crear mi primer evento</a>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>