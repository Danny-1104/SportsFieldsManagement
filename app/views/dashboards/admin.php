<!DOCTYPE html>
<html lang="es">
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador | Mi Panel</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
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

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Canchas Premium</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
           <img src="assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" onerror="this.src='https://via.placeholder.com/160'">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= htmlspecialchars($usuario_nombre ?? 'Administrador') ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item menu-open"> <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Gestión Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="index.php?controller=Usuarios&action=index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión Cliente</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?controller=Horarios&action=index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión Horario</p>
                </a>
              </li>
              
                <li class="nav-item">
  <a href="index.php?controller=Estados&action=index" class="nav-link">
    <i class="far fa-circle nav-icon"></i>
    <p>Gestión Estado</p>
  </a>
</li>
              </li>
              <li class="nav-item">
                <a href="index.php?controller=Canchas&action=index" class="nav-link">
                  <i class="far fa-circle nav-icon"></i> <p>Gestión Canchas</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?controller=Alquiler&action=index" class="nav-link">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>Gestión Alquileres</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?controller=Reportes&action=index" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Reportes Avanzados</p>
            </a>
          </li>

        </ul>
      </nav>
      </div>
  </aside>

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
            // SI NO HAY VISTA, MOSTRAMOS EL DASHBOARD POR DEFECTO (Tus stats y tabla de reservas)
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

            <div class="row">
              <div class="col-lg-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="m-0">Últimas Reservas</h5>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Cancha</th>
                                <th>Valor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($historial)): ?>
                                <?php foreach ($historial as $reserva): ?>
                                <tr>
                                    <td><?= htmlspecialchars($reserva['usuario_nombre'] ?? 'N/A') ?></td>
                                    <td><?= $reserva['alq_fecha'] ?></td>
                                    <td><?= substr($reserva['alq_hora_ini'], 0, 5) ?> - <?= substr($reserva['alq_hora_fin'], 0, 5) ?></td>
                                    <td><?= $reserva['can_nombre'] ?></td>
                                    <td>$<?= $reserva['alq_valor'] ?></td>
                                    <td>
                                        <?php 
                                            $badgeColor = 'secondary';
                                            if(($reserva['est_nombre'] ?? '') == 'Aprobado') $badgeColor = 'success';
                                            if(($reserva['est_nombre'] ?? '') == 'Registrado') $badgeColor = 'warning';
                                            if(($reserva['est_nombre'] ?? '') == 'Cancelado') $badgeColor = 'danger';
                                        ?>
                                        <span class="badge badge-<?= $badgeColor ?>">
                                            <?= $reserva['est_nombre'] ?? 'N/A' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No hay reservas registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                  </div>
                  <div class="card-footer">
                      <a href="index.php?controller=Reservas&action=validar" class="btn btn-primary">Ver Todas las Reservas</a>
                  </div>
                </div>
              </div>
            </div>
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
</body>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    
    if (msg === 'save_ok') {
        Swal.fire({
            icon: 'success',
            title: '¡Cancha Registrada!',
            text: 'Los datos se guardaron correctamente.',
            timer: 3000,
            showConfirmButton: false
        });
    }
</script>
</html>