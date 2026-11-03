<?php require_once __DIR__ . '/../includes/header.php'; ?>

<div class="container my-5">
    <!-- Encabezado del Dashboard -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h2 fw-bold m-0" style="color: #e6196e;">Panel de Control</h1>
            <p class="text-muted m-0">Bienvenido/a, <?= htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Administrador'); ?> | Resumen general y reporte mensual</p>
        </div>

        <!-- Filtro por Mes y Año -->
        <form method="GET" action="index.php" class="d-flex gap-2 align-items-center">
            <input type="hidden" name="controller" value="dashboard">
            <input type="hidden" name="action" value="index">
            
            <select name="mes" class="form-select form-select-sm shadow-sm" style="min-width: 130px;">
                <?php
                $meses = [
                    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
                    '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
                    '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
                ];
                $mesSeleccionado = $_GET['mes'] ?? date('m');
                foreach ($meses as $num => $nombre): ?>
                    <option value="<?= $num; ?>" <?= $mesSeleccionado == $num ? 'selected' : ''; ?>>
                        <?= $nombre; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="anio" class="form-select form-select-sm shadow-sm" style="min-width: 100px;">
                <?php
                $anioSeleccionado = $_GET['anio'] ?? date('Y');
                for ($y = date('Y'); $y >= 2024; $y--): ?>
                    <option value="<?= $y; ?>" <?= $anioSeleccionado == $y ? 'selected' : ''; ?>><?= $y; ?></option>
                <?php endfor; ?>
            </select>

            <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #e6196e;">
                Filtrar
            </button>
        </form>
    </div>

    <!-- Tarjetas de Métricas del Mes -->
    <div class="row g-4 mb-4">
        <!-- Nuevos Clientes -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 text-center h-100" style="background-color: #faf8f5;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <span class="text-muted fw-semibold mb-1">Nuevos Clientes este Mes</span>
                    <h2 class="display-5 fw-bold m-0" style="color: #e6196e;"><?= $totalClientesMes ?? 0; ?></h2>
                    <a href="index.php?controller=usuario&action=index" class="btn btn-link btn-sm text-decoration-none mt-2" style="color: #e6196e;">Gestionar Clientes &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Total Ventas Realizadas -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 text-center h-100" style="background-color: #faf8f5;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <span class="text-muted fw-semibold mb-1">Nº Ventas del Mes</span>
                    <h2 class="display-5 fw-bold text-dark m-0"><?= $cantidadVentasMes ?? 0; ?></h2>
                    <span class="small text-muted mt-2">Transacciones completadas</span>
                </div>
            </div>
        </div>

        <!-- Total Recaudado -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 text-center h-100" style="background-color: #faf8f5;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <span class="text-muted fw-semibold mb-1">Total Recaudado</span>
                    <h2 class="display-5 fw-bold text-success m-0">$<?= number_format($totalMontoMes ?? 0, 2); ?></h2>
                    <span class="small text-muted mt-2">Ingresos del periodo</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos a Módulos CRUD -->
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <a href="index.php?controller=usuario&action=index" class="btn btn-outline-dark w-100 py-2 shadow-sm fw-semibold">
                👥 CRUD Clientes / Usuarios
            </a>
        </div>
        <div class="col-md-4">
            <a href="index.php?controller=servicio&action=index" class="btn btn-outline-dark w-100 py-2 shadow-sm fw-semibold">
                🎁 CRUD Productos / Servicios
            </a>
        </div>
        <div class="col-md-4">
            <a href="index.php?controller=proveedor&action=index" class="btn btn-outline-dark w-100 py-2 shadow-sm fw-semibold">
                🏷️ CRUD Categorías & Proveedores
            </a>
        </div>
    </div>

    <!-- Reporte Mensual Detallado de Ventas -->
    <div class="card border-0 shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold m-0" style="color: #e6196e;">Reporte Mensual de Ventas</h5>
            <span class="badge" style="background-color: #e6196e;">Periodo: <?= $mesSeleccionado; ?>/<?= $anioSeleccionado; ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto / Servicio</th>
                        <th class="text-end">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reporteVentas)): ?>
                        <?php foreach ($reporteVentas as $venta): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($venta['fecha_venta'])); ?></td>
                                <td><?= htmlspecialchars($venta['concepto']); ?></td>
                                <td class="text-end fw-bold text-success">$<?= number_format($venta['monto'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                No hay ventas registradas en el periodo seleccionado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>