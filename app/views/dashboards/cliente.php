<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cliente | Mi Panel</title>
<?php include '../app/views/layouts/favicon.php'; ?>
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
          <a href="#" class="d-block"><?= htmlspecialchars($usuario_nombre) ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Mi Resumen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=Alquiler&action=crear" class="nav-link">
              <i class="nav-icon fas fa-calendar-plus"></i>
              <p>Arrendar Cancha</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>Historial</p>
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
            <h1 class="m-0">Bienvenido, <?= htmlspecialchars($usuario_nombre) ?></h1>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $stats['horas'] ?></h3>
                <p># Horas Alquiladas</p>
              </div>
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>$<?= number_format($stats['dinero'], 2) ?></h3>
                <p>Valor Pagado</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Historial Reciente (últimos 10 días)</h5>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cancha</th>
                            <th>Hora Inicial</th>
                            <th>Hora Final</th>
                            <th>Pago</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($historial)): ?>
                            <?php foreach ($historial as $reserva): ?>
                            <tr>
                                <td><?= $reserva['alq_fecha'] ?></td>
                                <td><?= $reserva['can_nombre'] ?></td>
                                <td><?= substr($reserva['alq_hora_ini'], 0, 5) ?></td>
                                <td><?= substr($reserva['alq_hora_fin'], 0, 5) ?></td>
                                <td>
                                    <?php if(!empty($reserva['alq_comprobante'])): ?>
                                        <a href="uploads/comprobantes/<?= $reserva['alq_comprobante'] ?>" target="_blank" class="btn btn-xs btn-outline-info">
                                            <i class="fas fa-paperclip"></i> Ver
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted text-xs">Sin archivo</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        $badgeColor = 'secondary';
                                        if($reserva['est_nombre'] == 'Aprobado') $badgeColor = 'success';
                                        if($reserva['est_nombre'] == 'Registrado') $badgeColor = 'warning';
                                        if($reserva['est_nombre'] == 'Finalizado') $badgeColor = 'primary';
                                        if($reserva['est_nombre'] == 'Cancelado') $badgeColor = 'danger';
                                    ?>
                                    <span class="badge badge-<?= $badgeColor ?>">
                                        <?= $reserva['est_nombre'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No tienes reservas en los últimos 10 días.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
              </div>
              <div class="card-footer">
                  <a href="index.php?controller=Alquiler&action=crear" class="btn btn-primary">Arrendar Nueva Cancha</a>
              </div>
            </div>
          </div>
        </div>
        
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
</html>