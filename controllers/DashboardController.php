<?php
require_once __DIR__ . '/../config/database.php';

class DashboardController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        // Obtener mes y año actual o seleccionados
        $mes = $_GET['mes'] ?? date('m');
        $anio = $_GET['anio'] ?? date('Y');

        // 1. Clientes registrados en el mes seleccionado
        $stmtClientes = $this->conn->prepare("SELECT COUNT(*) as total FROM usuarios WHERE MONTH(created_at) = :mes AND YEAR(created_at) = :anio");
        $stmtClientes->execute([':mes' => $mes, ':anio' => $anio]);
        $totalClientesMes = $stmtClientes->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // 2. Ventas totales del mes seleccionado
        $stmtVentas = $this->conn->prepare("SELECT SUM(monto) as total_monto, COUNT(*) as total_ventas FROM ventas WHERE MONTH(fecha_venta) = :mes AND YEAR(fecha_venta) = :anio");
        $stmtVentas->execute([':mes' => $mes, ':anio' => $anio]);
        $resVentas = $stmtVentas->fetch(PDO::FETCH_ASSOC);
        $totalMontoMes = $resVentas['total_monto'] ?? 0.00;
        $cantidadVentasMes = $resVentas['total_ventas'] ?? 0;

        // 3. Listado para el reporte mensual de ventas
        $stmtReporte = $this->conn->prepare("SELECT * FROM ventas WHERE MONTH(fecha_venta) = :mes AND YEAR(fecha_venta) = :anio ORDER BY fecha_venta DESC");
        $stmtReporte->execute([':mes' => $mes, ':anio' => $anio]);
        $reporteVentas = $stmtReporte->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}
?>