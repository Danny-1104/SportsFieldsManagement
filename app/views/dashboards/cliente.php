<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zona Jugador | Canchas Premium</title>

  <?php include '../app/views/layouts/favicon.php'; ?>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">

  <style>
    /* Ocultar Scrollbar */
    .main-sidebar ::-webkit-scrollbar { width: 0px; background: transparent; }
    .main-sidebar { scrollbar-width: none; -ms-overflow-style: none; }

    /* Diseño Sport */
    .bg-gradient-sport {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
        color: white;
    }
    
    .nav-link.active-sport {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%) !important;
        color: white !important;
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.4);
        border: none;
    }

    .nav-pills .nav-link:not(.active):hover {
        background-color: rgba(255,255,255,0.05);
        color: #28a745 !important;
        transform: translateX(5px);
        transition: 0.2s;
    }

    .brand-link {
        border-bottom: 1px solid rgba(255,255,255,0.1) !important;
        background-color: #1a1c20 !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link font-weight-bold text-dark">Panel del Jugador</span>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-danger font-weight-bold" href="index.php?controller=Auth&action=logout">
          <i class="fas fa-sign-out-alt mr-1"></i> Salir
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #212529;">
    
    <a href="index.php?controller=Dashboard&action=index" class="brand-link text-center">
      <span class="brand-text font-weight-bold text-white text-uppercase" style="letter-spacing: 1px;">
        <i class="fas fa-futbol text-success mr-2"></i> Pato Sport
      </span>
    </a>

    <div class="sidebar">
      
      <div class="user-panel mt-4 pb-4 mb-4 d-flex justify-content-center border-bottom-0">
        <div class="image text-center w-100">
           <img src="assets/img/minilogo.png" class="img-fluid" style="max-height: 80px;">
           <div class="mt-2 text-white font-weight-bold"><?= explode(' ', $_SESSION['usuario_nombre'] ?? 'Usuario')[0] ?></div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
           
           <li class="nav-item">
               <a href="index.php?controller=Dashboard&action=index" class="nav-link active-sport">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>Mi Resumen</p>
               </a>
           </li>

           <li class="nav-item">
               <a href="index.php?controller=Alquiler&action=crear" class="nav-link">
                   <i class="nav-icon fas fa-calendar-plus text-success"></i>
                   <p>Nueva Reserva</p>
               </a>
           </li>

           <li class="nav-item">
               <a href="index.php?controller=Reservas&action=historial" class="nav-link">
                   <i class="nav-icon fas fa-history text-info"></i>
                   <p>Mis Partidos</p>
               </a>
           </li>

           <li class="nav-item">
               <a href="index.php?controller=Perfil&action=index" class="nav-link">
                   <i class="nav-icon fas fa-user-cog text-warning"></i>
                   <p>Mi Perfil</p>
               </a>
           </li>

        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper" style="background-color: #f4f6f9;">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 align-items-center">
          <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold text-dark">
              Bienvenido, <span class="text-success"><?= htmlspecialchars($usuario_nombre) ?></span>
            </h1>
            <p class="text-muted mb-0">Resumen de tu actividad deportiva.</p>
          </div>
          <div class="col-sm-6 text-right">
             <a href="index.php?controller=Alquiler&action=crear" class="btn btn-success font-weight-bold rounded-pill shadow-sm px-4">
               <i class="fas fa-plus mr-1"></i> Reservar Ahora
             </a>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-6 col-6">
            <div class="small-box bg-info shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="inner p-4">
                <h3><?= $stats['horas'] ?? 0 ?></h3>
                <p class="font-weight-bold mb-0">HORAS JUGADAS</p>
              </div>
              <div class="icon">
                <i class="fas fa-clock"></i>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6 col-6">
            <div class="small-box bg-gradient-sport shadow-sm" style="border-radius: 12px; overflow: hidden;">
              <div class="inner p-4">
                <h3>$<?= number_format($stats['dinero'] ?? 0, 2) ?></h3>
                <p class="font-weight-bold mb-0">INVERSIÓN TOTAL</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius: 12px;">
              <div class="card-header bg-white border-0 py-3">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-list-alt text-success mr-2"></i> Historial Reciente
                </h3>
                <div class="card-tools">
                   <span class="badge badge-light">Últimos 10 días</span>
                </div>
              </div>
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap align-middle">
                  <thead class="bg-light text-uppercase text-secondary text-xs">
                    <tr>
                      <th class="pl-4 border-0">Fecha</th>
                      
                      <th class="border-0 text-center">Lugar</th>
                      
                      <th class="border-0 text-center">Horario</th>
                      <th class="border-0 text-center">Pago</th>
                      <th class="border-0 text-center">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($historial)): ?>
                      <?php foreach ($historial as $res): ?>
                      <tr>
                        <td class="pl-4 font-weight-bold text-dark">
                            <i class="far fa-calendar-alt text-muted mr-1"></i> 
                            <?= date('d/m/Y', strtotime($res['alq_fecha'])) ?>
                        </td>
                        
                        <td class="text-center">
                            <span class="text-dark">
                                <i class="fas fa-map-marker-alt text-danger mr-1"></i> 
                                <?= htmlspecialchars($res['can_nombre']) ?>
                            </span>
                        </td>

                        <td class="text-center text-muted font-weight-bold">
                            <?= substr($res['alq_hora_ini'], 0, 5) ?> - <?= substr($res['alq_hora_fin'], 0, 5) ?>
                        </td>
                        <td class="text-center">
                             <?php if(!empty($res['alq_comprobante'])): ?>
                                <a href="uploads/comprobantes/<?= $res['alq_comprobante'] ?>" target="_blank" class="btn btn-xs btn-outline-info rounded-pill px-3">
                                    <i class="fas fa-eye mr-1"></i> Ver
                                </a>
                            <?php else: ?>
                                <span class="text-muted text-xs">Pendiente</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php 
                                $s = strtoupper($res['est_nombre']);
                                $color = 'secondary';
                                if(strpos($s, 'APROBADO')!==false) $color='success';
                                elseif(strpos($s, 'REGISTRADO')!==false) $color='warning';
                            ?>
                            <span class="badge badge-<?= $color ?> px-3"><?= $res['est_nombre'] ?></span>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan="5" class="text-center py-4 text-muted">No hay registros recientes.</td></tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
              
              <div class="card-footer bg-white text-center py-3 border-0">
                  <a href="index.php?controller=Alquiler&action=crear" class="text-success font-weight-bold small">
                      Ver todas las canchas disponibles <i class="fas fa-arrow-right ml-1"></i>
                  </a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-inline text-muted">
      Pasión por el deporte
    </div>
    <strong>Copyright &copy; 2026 <a href="#" class="text-success">Canchas Premium</a>.</strong>
  </footer>
</div>

<script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>