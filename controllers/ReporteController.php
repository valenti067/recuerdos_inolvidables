
<?php
require_once __DIR__ . '/../config/database.php';

class ReporteController
{
    public function index()
    {
        // Acceso exclusivo para administradores.
        if (
            !isset($_SESSION['user_id']) ||
            (int) ($_SESSION['user_rol'] ?? 0) !== 1
        ) {
            http_response_code(403);
            echo 'Acceso restringido a administradores.';
            return;
        }

        // Conexión a la base de datos.
        $db = new Database();
        $pdo = $db->getConnection();

        // Total de usuarios registrados.
        $totalUsuarios = (int) $pdo->query(
            'SELECT COUNT(*) FROM usuarios'
        )->fetchColumn();

        // Total de proveedores.
        $totalProveedores = (int) $pdo->query(
            'SELECT COUNT(*) FROM proveedores'
        )->fetchColumn();

        // Total de productos y servicios.
        $totalServicios = (int) $pdo->query(
            'SELECT COUNT(*) FROM servicios'
        )->fetchColumn();

        // Total de compras completadas.
        $totalCompras = (int) $pdo->query(
            "SELECT COUNT(*)
             FROM ventas
             WHERE LOWER(TRIM(estado)) = 'completado'"
        )->fetchColumn();

        // Ingresos acumulados.
        $ingresosTotales = (float) $pdo->query(
            "SELECT COALESCE(SUM(monto), 0)
             FROM ventas
             WHERE LOWER(TRIM(estado)) = 'completado'"
        )->fetchColumn();

        // Compras e ingresos del mes actual.
        $consultaMes = $pdo->prepare(
            "SELECT
                COUNT(*) AS compras,
                COALESCE(SUM(monto), 0) AS ingresos
             FROM ventas
             WHERE LOWER(TRIM(estado)) = 'completado'
               AND fecha_venta >= :inicio
               AND fecha_venta < :fin"
        );

        $inicio = date('Y-m-01');

        $fin = date(
            'Y-m-01',
            strtotime('first day of next month')
        );

        $consultaMes->execute([
            'inicio' => $inicio,
            'fin' => $fin
        ]);

        $resumenMes = $consultaMes->fetch(PDO::FETCH_ASSOC)
            ?: [
                'compras' => 0,
                'ingresos' => 0
            ];

        // Estadísticas mensuales de ventas.
        $consultaMensual = $pdo->query(
            "SELECT
                DATE_FORMAT(fecha_venta, '%Y-%m') AS periodo,
                COUNT(*) AS compras,
                COALESCE(SUM(monto), 0) AS ingresos
             FROM ventas
             WHERE LOWER(TRIM(estado)) = 'completado'
               AND fecha_venta >= DATE_SUB(
                   CURDATE(),
                   INTERVAL 11 MONTH
               )
             GROUP BY DATE_FORMAT(fecha_venta, '%Y-%m')
             ORDER BY periodo ASC"
        );

        $ventasMensuales = $consultaMensual->fetchAll(
            PDO::FETCH_ASSOC
        );

        // Últimas ocho ventas registradas.
        $ultimasVentas = $pdo->query(
            "SELECT
                id_venta,
                concepto,
                monto,
                fecha_venta,
                estado
             FROM ventas
             ORDER BY fecha_venta DESC, id_venta DESC
             LIMIT 8"
        )->fetchAll(PDO::FETCH_ASSOC);

        // Actualmente la tabla ventas no guarda
        // qué productos contiene cada compra.
        $productosMasVendidosDisponibles = false;

        // Mostrar el panel.
        require __DIR__ . '/../views/reportes/index.php';
    }
}
