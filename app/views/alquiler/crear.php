<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nueva Reserva | Canchas Premium</title>
  
  <?php include '../app/views/layouts/favicon.php'; ?>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">

  <style>
    /* Estilos Sport Premium (Mismos del Dashboard) */
    .main-sidebar ::-webkit-scrollbar { width: 0px; background: transparent; }
    .main-sidebar { scrollbar-width: none; -ms-overflow-style: none; }
    
    .nav-link.active-sport {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%) !important;
        color: white !important;
        box-shadow: 0 4px 6px rgba(40, 167, 69, 0.4);
        border-radius: 5px;
    }
    .nav-pills .nav-link:not(.active):hover { color: #28a745 !important; }
    
    /* Estilos del Formulario */
    .card-sport {
        border-top: 4px solid #28a745;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    .input-group-text {
        background-color: #fff;
        border-right: 0;
        color: #6c757d;
    }
    .form-control {
        border-left: 0;
    }
    .form-control:focus {
        border-color: #ced4da;
        box-shadow: none;
    }
    /* Enfoque visual al escribir */
    .input-group:focus-within .input-group-text {
        border-color: #28a745;
        color: #28a745;
    }
    .input-group:focus-within .form-control {
        border-color: #28a745;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link font-weight-bold text-secondary">Realizar Reserva</span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="index.php?controller=Dashboard&action=index" class="btn btn-default btn-sm font-weight-bold">
                <i class="fas fa-arrow-left mr-1"></i> Volver al Panel
            </a>
        </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #212529;">
    <a href="#" class="brand-link text-center">
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
           <li class="nav-item"><a href="index.php?controller=Dashboard&action=index" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Mi Resumen</p></a></li>
           <li class="nav-item"><a href="#" class="nav-link active-sport"><i class="nav-icon fas fa-calendar-plus"></i><p>Nueva Reserva</p></a></li>
           <li class="nav-item"><a href="index.php?controller=Reservas&action=historial" class="nav-link"><i class="nav-icon fas fa-history text-info"></i><p>Mis Partidos</p></a></li>
           <li class="nav-item"><a href="index.php?controller=Perfil&action=index" class="nav-link"><i class="nav-icon fas fa-user-cog text-warning"></i><p>Mi Perfil</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper" style="background-color: #f4f6f9;">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font-weight-bold text-dark"><i class="fas fa-running text-success mr-2"></i>Arrendar Cancha</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?php if($_GET['error'] == 'horario_ocupado'): ?>
                    <strong>¡Ups!</strong> Ese horario ya está reservado. Intenta con otro.
                <?php elseif($_GET['error'] == 'duracion_invalida'): ?>
                    <strong>Horario inválido.</strong> La duración mínima es 1 hora y el fin debe ser después del inicio.
                <?php endif; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-11">
                
                <div class="card card-sport">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-secondary">Formulario de Reserva</h3>
                    </div>
                    
                    <form action="index.php?controller=Alquiler&action=guardar" method="POST" enctype="multipart/form-data">
                        <div class="card-body bg-light">
                            
                            <h6 class="text-success font-weight-bold mb-3"><i class="fas fa-info-circle mr-1"></i> Detalles del Encuentro</h6>
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Cancha</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt text-success"></i></span></div>
                                                <select name="cancha" id="cancha" class="form-control" required onchange="cargarPrecio()">
                                                    <option value="" disabled selected>-- Selecciona cancha --</option>
                                                    <?php foreach($canchas as $c): ?>
                                                        <option value="<?= $c['can_id'] ?>" data-precio="<?= $c['can_precio_hora'] ?>">
                                                            <?= $c['can_nombre'] ?> ($<?= $c['can_precio_hora'] ?>/h)
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Fecha del Partido</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt text-primary"></i></span></div>
                                                <input type="date" name="fecha" class="form-control" min="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Hora Inicio</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-clock text-info"></i></span></div>
                                                <select name="hora_ini" id="hora_ini" class="form-control" required onchange="calcularPrecio()">
                                                    <option value="">-- Inicio --</option>
                                                    <?php foreach($horarios as $h): ?>
                                                        <option value="<?= $h['hor_nombre'] ?>"><?= $h['hor_nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Hora Fin</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-history text-danger"></i></span></div>
                                                <select name="hora_fin" id="hora_fin" class="form-control" required onchange="calcularPrecio()">
                                                    <option value="">-- Fin --</option>
                                                    <?php foreach($horarios as $h): ?>
                                                        <option value="<?= $h['hor_nombre'] ?>"><?= $h['hor_nombre'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-light border d-flex justify-content-between align-items-center mt-2 mb-0">
                                        <span class="text-muted"><i class="fas fa-tag mr-2"></i>Tarifa estimada:</span>
                                        <div class="input-group" style="width: 150px;">
                                            <div class="input-group-prepend"><span class="input-group-text bg-transparent border-0 font-weight-bold text-success">$</span></div>
                                            <input type="text" name="valor_total" id="valor_total" class="form-control bg-transparent border-0 font-weight-bold text-success text-right" readonly value="0.00" style="font-size: 1.2em;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-success font-weight-bold mb-3"><i class="fas fa-wallet mr-1"></i> Pago y Confirmación</h6>
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Método de Pago</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-credit-card text-secondary"></i></span></div>
                                                <select name="metodo_pago" class="form-control" required>
                                                    <option value="" disabled selected>-- Seleccione --</option>
                                                    <option value="transferencia">Transferencia Bancaria</option>
                                                    <option value="debito">Tarjeta de Débito/Crédito</option>
                                                    <option value="efectivo_local">Pago en Local (Presencial)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label class="small font-weight-bold">Comprobante (Foto)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="comprobante" class="custom-file-input" id="comprobante" accept=".pdf, .jpg, .png, .jpeg" required>
                                                    <label class="custom-file-label" for="comprobante">Subir archivo...</label>
                                                </div>
                                            </div>
                                            <small class="text-muted">Formatos: JPG, PNG, PDF.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer bg-white text-right py-3">
                            <a href="index.php?controller=Dashboard&action=index" class="btn btn-light rounded-pill px-4 mr-2">Cancelar</a>
                            <button type="submit" class="btn btn-success rounded-pill px-5 font-weight-bold shadow-sm" onclick="return validarFormulario()">
                                <i class="fas fa-check mr-2"></i> Confirmar Reserva
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
      </div>
    </section>
  </div>
  
  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-inline">Pasión por el fútbol</div>
    <strong>Copyright &copy; 2026 <a href="#" class="text-success">Canchas Premium</a>.</strong>
  </footer>
</div>

<script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
$(function () {
  bsCustomFileInput.init();
});

let precioPorHora = 0;

function cargarPrecio() {
    const canchaSelect = document.getElementById('cancha');
    const selectedOption = canchaSelect.options[canchaSelect.selectedIndex];
    precioPorHora = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
    calcularPrecio();
}

function calcularPrecio() {
    const ini = document.getElementById('hora_ini').value;
    const fin = document.getElementById('hora_fin').value;
    const inputTotal = document.getElementById('valor_total');

    if(ini && fin && precioPorHora > 0) {
        // Usamos una fecha base para comparar solo las horas
        const d1 = new Date("2000-01-01 " + ini);
        const d2 = new Date("2000-01-01 " + fin);
        
        let diff = (d2 - d1) / 1000 / 60 / 60; // Diferencia en horas
        
        if (diff >= 1) {
            const total = diff * precioPorHora;
            inputTotal.value = total.toFixed(2);
        } else {
            inputTotal.value = '0.00';
        }
    } else {
        inputTotal.value = '0.00';
    }
}

function validarFormulario() {
    const ini = document.getElementById('hora_ini').value;
    const fin = document.getElementById('hora_fin').value;
    
    // Validar campos obligatorios básicos
    if (!ini || !fin) {
        alert('Por favor completa el horario de inicio y fin.');
        return false;
    }

    const d1 = new Date("2000-01-01 " + ini);
    const d2 = new Date("2000-01-01 " + fin);
    const diff = (d2 - d1) / 1000 / 60 / 60;

    if (diff < 1) {
        alert('La duración mínima del alquiler es de 1 hora.');
        return false;
    }
    
    return true;
}
</script>
</body>
</html>