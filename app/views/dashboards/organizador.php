<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Organizador | Mi Panel</title>
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
            <a href="index.php?controller=Campeonatos&action=index" class="nav-link">
              <i class="nav-icon fas fa-trophy"></i>
              <p>Campeonatos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=Equipos&action=index" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Mis Equipos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=Partidos&action=calendario" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Calendario de Partidos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=Partidos&action=resultados" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>Resultados</p>
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
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $stats['campeonatos'] ?? 0 ?></h3>
                <p>Campeonatos Organizados</p>
              </div>
              <div class="icon">
                <i class="fas fa-trophy"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $stats['equipos'] ?? 0 ?></h3>
                <p>Mis Equipos</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $stats['partidos'] ?? 0 ?></h3>
                <p>Partidos Jugados</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Próximos Partidos</h5>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Equipo Local</th>
                            <th>Equipo Visitante</th>
                            <th>Cancha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($partidos)): ?>
                            <?php foreach ($partidos as $partido): ?>
                            <tr>
                                <td><?= $partido['par_fecha'] ?></td>
                                <td><?= substr($partido['par_hora'], 0, 5) ?></td>
                                <td><?= htmlspecialchars($partido['equipo_local']) ?></td>
                                <td><?= htmlspecialchars($partido['equipo_visitante']) ?></td>
                                <td><?= htmlspecialchars($partido['cancha_nombre'] ?? 'N/A') ?></td>
                                <td>
                                    <?php 
                                        $badgeColor = 'secondary';
                                        if($partido['estado'] == 'Programado') $badgeColor = 'info';
                                        if($partido['estado'] == 'En Juego') $badgeColor = 'warning';
                                        if($partido['estado'] == 'Finalizado') $badgeColor = 'success';
                                    ?>
                                    <span class="badge badge-<?= $badgeColor ?>">
                                        <?= $partido['estado'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">No tienes partidos próximos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
              </div>
              <div class="card-footer">
                  <a href="index.php?controller=Campeonatos&action=create" class="btn btn-primary">Crear Nuevo Campeonato</a>
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
