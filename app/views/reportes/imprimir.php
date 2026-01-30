<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Financiero - Pato Sport</title>
    <?php include '../app/views/layouts/favicon.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* ESTILOS GENERALES Y DE IMPRESIÓN */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: white; 
            color: #333;
        }

        /* Forzar impresión de colores de fondo (Chrome/Edge/Safari) */
        @media print {
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .no-print { display: none; }
            .bg-primary-dark { background-color: #003366 !important; color: white !important; }
            .bg-info-light { background-color: #e3f2fd !important; }
        }

        /* Cabecera */
        .header-strip {
            height: 10px;
            background: linear-gradient(90deg, #003366 0%, #17a2b8 100%);
            width: 100%;
        }
        
        .logo-section img {
            max-height: 80px; /* Ajuste para el minilogo */
            object-fit: contain;
        }

        /* Cajas de Resumen (KPIs) */
        .kpi-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #f8f9fa;
        }
        .kpi-title { font-size: 12px; text-transform: uppercase; color: #666; letter-spacing: 1px; }
        .kpi-value { font-size: 24px; font-weight: bold; color: #003366; }

        /* Tabla */
        .custom-table thead th {
            background-color: #003366; /* Azul Oscuro Profesional */
            color: white;
            border: none;
            text-transform: uppercase;
            font-size: 11px;
            padding: 12px;
        }
        .custom-table tbody tr:nth-of-type(even) {
            background-color: #f2f2f2;
        }
        .custom-table td {
            font-size: 13px;
            vertical-align: middle;
            padding: 10px;
            border-color: #dee2e6;
        }

        /* Totales y Firma */
        .total-row td {
            background-color: #e3f2fd; /* Azul muy claro */
            color: #003366;
            font-weight: bold;
            font-size: 15px;
            border-top: 2px solid #003366;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            width: 250px;
            margin: 0 auto;
            margin-top: 60px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header-strip"></div>

    <div class="container-fluid p-5">
        
        <div class="row align-items-center mb-5">
            <div class="col-3 logo-section">
                <img src="assets/img/minilogo.png" alt="Logo Pato Sport">
            </div>
            <div class="col-6 text-center">
                <h2 class="font-weight-bold" style="color: #003366;">REPORTE DE INGRESOS</h2>
                <h5 class="text-muted">Complejo Deportivo "Pato Sport"</h5>
                <p class="small text-muted mb-0">RUC: 123456789001 | Dir: Av. Principal S/N</p>
            </div>
            <div class="col-3 text-right">
                <div class="badge badge-light border p-2 text-left w-100">
                    <small class="d-block text-muted">FECHA DE EMISIÓN</small>
                    <strong><?= date('d/m/Y H:i') ?></strong>
                    <small class="d-block text-muted mt-2">GENERADO POR</small>
                    <strong><?= strtoupper($_SESSION['usuario_nombre']) ?></strong>
                </div>
            </div>
        </div>

        <?php 
            $total_dinero = 0;
            $total_horas = 0;
            foreach ($datos as $row) {
                $total_dinero += $row['alq_valor'];
                $total_horas += $row['horas_jugadas'];
            }
        ?>

        <div class="row mb-4">
            <div class="col-8">
                <div class="alert alert-secondary m-0 h-100 d-flex flex-column justify-content-center">
                    <h6 class="font-weight-bold mb-2"><i class="fas fa-filter mr-1"></i> Parámetros del Reporte:</h6>
                    <ul class="mb-0 pl-3 small">
                        <li><strong>Rango de Fechas:</strong> Del <?= date('d/m/Y', strtotime($f_inicio)) ?> al <?= date('d/m/Y', strtotime($f_fin)) ?></li>
                        <li><strong>Filtro Aplicado:</strong> <?= ($filtro_estado == null) ? 'Todos los estados' : 'Estado específico' ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="kpi-card">
                    <div class="kpi-title">Horas Totales</div>
                    <div class="kpi-value text-info"><?= number_format($total_horas, 1) ?></div>
                </div>
            </div>
            <div class="col-2">
                <div class="kpi-card">
                    <div class="kpi-title">Ingreso Total</div>
                    <div class="kpi-value text-success">$<?= number_format($total_dinero, 2) ?></div>
                </div>
            </div>
        </div>

        <table class="table custom-table table-bordered">
            <thead class="bg-primary-dark">
                <tr>
                    <th class="text-center" style="width: 5%;">ID</th>
                    <th style="width: 25%;">CLIENTE</th>
                    <th class="text-center" style="width: 15%;">FECHA</th>
                    <th class="text-center" style="width: 20%;">HORARIO JUEGO</th>
                    <th class="text-center" style="width: 15%;">ESTADO</th>
                    <th class="text-center" style="width: 10%;">HORAS</th>
                    <th class="text-right" style="width: 10%;">VALOR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $row): ?>
                <tr>
                    <td class="text-center text-muted small">#<?= $row['alq_id'] ?></td>
                    <td class="font-weight-bold text-uppercase"><?= htmlspecialchars($row['nombre_usu']) ?></td>
                    <td class="text-center"><?= date('d/m/Y', strtotime($row['alq_fecha'])) ?></td>
                    <td class="text-center small">
                        <i class="far fa-clock text-muted mr-1"></i>
                        <?= substr($row['alq_hora_ini'], 0, 5) ?> - <?= substr($row['alq_hora_fin'], 0, 5) ?>
                    </td>
                    <td class="text-center">
                        <?php 
                            // Texto simple para impresión, sin badges de colores de fondo oscuros
                            echo strtoupper($row['est_nombre']);
                        ?>
                    </td>
                    <td class="text-center"><?= number_format($row['horas_jugadas'], 1) ?></td>
                    <td class="text-right">$<?= number_format($row['alq_valor'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row bg-info-light">
                    <td colspan="5" class="text-right text-uppercase">Totales Finales:</td>
                    <td class="text-center"><?= number_format($total_horas, 1) ?> h</td>
                    <td class="text-right">$<?= number_format($total_dinero, 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="row" style="margin-top: 80px;">
            <div class="col-6 text-center">
                <div class="signature-line"></div>
                <small class="font-weight-bold">ADMINISTRADOR / GERENCIA</small>
            </div>
            <div class="col-6 text-center">
                <div class="signature-line"></div>
                <small class="font-weight-bold">CONTABILIDAD</small>
            </div>
        </div>

        <div class="fixed-bottom p-3 text-center text-muted small border-top bg-white">
            Sistema de Gestión "Canchas Premium" - Documento generado automáticamente.
        </div>

    </div>
</body>
</html>