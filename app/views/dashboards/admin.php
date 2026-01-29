<!DOCTYPE html>
<html lang="es">
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador | Mi Panel</title>
  <?php include '../app/views/layouts/favicon.php'; ?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?controller=Home&action=index" class="nav-link">Volver al Inicio</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-danger" href="index.php?controller=Auth&action=logout">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" 
       style="background: #1a1a2e; position: fixed; top: 0; bottom: 0; left: 0; height: 100vh; overflow-y: auto; z-index: 1038;">
    
    <a href="index.php?controller=Dashboard&action=index" class="brand-link text-center border-bottom-0" style="background-color: #16213e;">
        <span class="brand-text font-weight-bold text-white" style="letter-spacing: 2px;">Patos Sport</span>
    </a>

    <div class="sidebar">
      
      <div class="user-panel mt-4 pb-4 mb-4 d-flex justify-content-center border-bottom-0">
        <div class="image text-center w-100">
           <img src="assets/img/minilogo.png" 
                alt="Logo Pato Sport" 
                class="img-fluid" 
                style="max-height: 100px; width: auto; filter: drop-shadow(0 0 5px rgba(255,255,255,0.2));">
           <div class="mt-3 text-white small font-weight-bold opacity-50" style="letter-spacing: 1px;">
               ADMINISTRADOR
           </div>
        </div>
      </div>

      <nav class="mt-2 pb-5"> <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item mb-2">
            <a href="index.php?controller=Dashboard&action=index" class="nav-link active-gradient">
              <i class="nav-icon fas fa-home"></i>
              <p>Principal</p>
            </a>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link bg-secondary-gradient">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Gestión Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?controller=Usuarios&action=index" class="nav-link">
                  <i class="fas fa-users nav-icon text-info"></i>
                  <p>Gestión Cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?controller=Roles&action=index" class="nav-link">
                  <i class="fas fa-user-tag nav-icon text-warning"></i>
                  <p>Gestión de Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?controller=Noticias&action=index" class="nav-link">
                  <i class="fas fa-newspaper nav-icon text-danger"></i>
                  <p>Gestión Noticias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?controller=Horarios&action=index" class="nav-link">
                  <i class="fas fa-clock nav-icon text-success"></i>
                  <p>Gestión Horario</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="index.php?controller=Estados&action=index" class="nav-link">
                    <i class="fas fa-toggle-on nav-icon text-primary"></i>
                    <p>Gestión Estado</p>
                  </a>
               </li>
              <li class="nav-item">
                <a href="index.php?controller=Canchas&action=index" class="nav-link">
                  <i class="fas fa-futbol nav-icon text-white"></i>
                  <p>Gestión Canchas</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header text-uppercase text-muted font-weight-bold mt-2 small">Operaciones</li>

          <li class="nav-item">
            <a href="index.php?controller=GestionAlquileres&action=index" class="nav-link">
              <i class="nav-icon fas fa-calendar-check text-cyan"></i>
              <p>Gestión Alquileres</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?controller=Reportes&action=index" class="nav-link">
              <i class="nav-icon fas fa-chart-pie text-orange"></i>
              <p>Reportes Avanzados</p>
            </a>
          </li>
          
          <li class="nav-item mb-5"></li>

        </ul>
      </nav>
    </div>
</aside>

<style>
      .main-sidebar { font-family: 'Segoe UI', sans-serif; }
      
      .nav-link.active-gradient {
          background: linear-gradient(90deg, #2f3765 0%, #5c6bc0 100%) !important;
          color: white !important;
          box-shadow: 0 4px 6px rgba(0,0,0,0.2);
          border-radius: 5px;
      }

      .bg-secondary-gradient {
          background-color: rgba(255,255,255,0.08) !important;
      }

      .nav-treeview .nav-link:hover {
          background-color: rgba(255,255,255,0.05);
          color: #fff !important;
          transform: translateX(5px);
          transition: transform 0.2s;
      }

      .nav-icon {
          filter: drop-shadow(0px 0px 3px rgba(13, 5, 5, 0.5));
      }
</style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= isset($titulo_pagina) ? $titulo_pagina : 'Bienvenido, ' . htmlspecialchars($usuario_nombre ?? 'Admin') ?></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        
        <?php 
        // Si el controlador envió una vista interna (ej: la tabla de clientes), la mostramos
        if (isset($vista_interna) && file_exists($vista_interna)) {
            include $vista_interna;
        } else {
            // =========================================================
            //      DASHBOARD HOME (Diseño Informativo + Gráfico)
            // =========================================================
        ?>
        
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $stats['canchas'] ?? 0 ?></h3>
                    <p>Canchas</p>
                  </div>
                  <div class="icon"><i class="fas fa-futbol"></i></div>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= $stats['usuarios'] ?? 0 ?></h3>
                    <p>Usuarios Registrados</p>
                  </div>
                  <div class="icon"><i class="fas fa-users"></i></div>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?= $stats['reservas'] ?? 0 ?></h3>
                    <p>Reservas Totales</p>
                  </div>
                  <div class="icon"><i class="fas fa-calendar"></i></div>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>$<?= number_format($stats['ingresos'] ?? 0, 2) ?></h3>
                    <p>Ingresos Totales</p>
                  </div>
                  <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                  <div class="card-header bg-white border-0 pt-4">
                    <h3 class="card-title font-weight-bold text-dark">
                        <i class="fas fa-clipboard-list text-primary mr-2"></i> Últimas Reservas
                    </h3>
                    <div class="card-tools">
                        <a href="index.php?controller=Alquiler&action=index" class="btn btn-tool text-primary">
                            Ver Historial <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                  </div>

                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="pl-4 border-0"><i class="fas fa-user mr-2"></i> Cliente</th>
                                <th class="border-0"><i class="far fa-calendar-alt mr-2"></i> Fecha</th>
                                <th class="border-0"><i class="far fa-clock mr-2"></i> Horario</th>
                                <th class="border-0"><i class="fas fa-map-marker-alt mr-2"></i> Cancha</th>
                                <th class="border-0"><i class="fas fa-tag mr-2"></i> Valor</th>
                                <th class="border-0 text-center"><i class="fas fa-info-circle mr-2"></i> Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($historial)): ?>
                                <?php foreach ($historial as $reserva): ?>
                                <tr>
                                    <td class="pl-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-gradient-primary rounded-circle d-flex justify-content-center align-items-center mr-3 shadow-sm" style="width: 35px; height: 35px; color: white; font-weight: bold;">
                                                <?= strtoupper(substr($reserva['usuario_nombre'] ?? 'U', 0, 1)) ?>
                                            </div>
                                            <span class="font-weight-bold text-dark">
                                                <?= htmlspecialchars($reserva['usuario_nombre'] ?? 'Desconocido') ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-secondary"><?= date('d/m/Y', strtotime($reserva['alq_fecha'])) ?></td>
                                    <td><span class="badge badge-light border px-2 py-1"><?= substr($reserva['alq_hora_ini'], 0, 5) ?> - <?= substr($reserva['alq_hora_fin'], 0, 5) ?></span></td>
                                    <td><small class="text-uppercase font-weight-bold text-muted"><?= $reserva['can_nombre'] ?></small></td>
                                    <td class="text-success font-weight-bold">$ <?= number_format($reserva['alq_valor'], 2) ?></td>
                                    <td class="text-center">
                                        <?php 
                                            $estado = $reserva['est_nombre'] ?? '';
                                            $badge = 'secondary';
                                            $icon = 'question';
                                            if($estado == 'Aprobado') { $badge = 'success'; $icon = 'check'; }
                                            if($estado == 'Registrado') { $badge = 'warning'; $icon = 'hourglass-half'; }
                                            if($estado == 'Cancelado') { $badge = 'danger'; $icon = 'times'; }
                                        ?>
                                        <span class="badge badge-<?= $badge ?> px-3 py-2 elevation-1">
                                            <i class="fas fa-<?= $icon ?> mr-1"></i> <?= $estado ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted"><i class="fas fa-inbox fa-3x mb-3 text-gray-300"></i><p>No hay reservas recientes.</p></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4 mb-4">
              <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                  <div class="card-header bg-white border-0 pt-4">
                    <h3 class="card-title font-weight-bold text-dark">
                        <i class="fas fa-chart-bar text-success mr-2"></i> Usos por Mes (Últimos 12 Meses)
                    </h3>
                  </div>
                  <div class="card-body">
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="graficoOcupacion"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Si no hay datos, evitamos error JS
                    <?php if(isset($graficoLabels) && isset($graficoData)): ?>
                        var ctx = document.getElementById('graficoOcupacion').getContext('2d');
                        var labels = <?= $graficoLabels ?>; 
                        var data = <?= $graficoData ?>;

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Reservas Mensuales',
                                    data: data,
                                    backgroundColor: 'rgba(40, 167, 69, 0.6)',
                                    borderColor: 'rgba(40, 167, 69, 1)',
                                    borderWidth: 1,
                                    borderRadius: 5,
                                    barPercentage: 0.6
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: { callbacks: { label: function(c) { return c.raw + ' Reservas'; }}}
                                },
                                scales: {
                                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' }},
                                    x: { grid: { display: false }}
                                }
                            }
                        });
                    <?php endif; ?>
                });
            </script>

        <?php 
        } // Cierre del ELSE 
        ?>
        
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Tu pasión, nuestro compromiso.
    </div>
    <strong>Copyright &copy; 2026 <a href="#">Canchas Premium</a>.</strong>
  </footer>
</div>

<script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    
    if (msg === 'save_ok') {
        Swal.fire({
            icon: 'success',
            title: '¡Operación Exitosa!',
            text: 'Los cambios se guardaron correctamente.',
            timer: 3000,
            showConfirmButton: false
        });
    }
</script>
</body>
</html>