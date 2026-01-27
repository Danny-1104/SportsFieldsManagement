<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nueva Reserva | Canchas Premium</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="index.php?controller=Dashboard&action=cliente" class="btn btn-default btn-sm">Volver al Dashboard</a></li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link"><span class="brand-text font-weight-light">Canchas Premium</span></a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex"><div class="info"><a href="#" class="d-block"><?= $usuario_nombre ?></a></div></div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
             <li class="nav-item"><a href="index.php?controller=Dashboard&action=cliente" class="nav-link"><i class="fas fa-arrow-left nav-icon"></i><p>Volver</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid"><h1><i class="fas fa-futbol"></i> Arrendar Cancha</h1></div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <?php if(isset($_GET['error']) && $_GET['error'] == 'horario_ocupado'): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error:</strong> El horario seleccionado ya está ocupado. Por favor, elige otro horario.
            </div>
        <?php elseif(isset($_GET['error']) && $_GET['error'] == 'duracion_invalida'): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error:</strong> La duración debe ser al menos 1 hora. La hora de fin debe ser posterior a la de inicio.
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <div class="card card-primary">
                    <div class="card-header"><h3 class="card-title">Formulario de Reserva</h3></div>
                    
                    <form action="index.php?controller=Alquiler&action=guardar" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label>1. Selecciona la Cancha</label>
                                <select name="cancha" id="cancha" class="form-control" required onchange="cargarPrecio()">
                                    <option value="">Selecciona una cancha</option>
                                    <?php foreach($canchas as $c): ?>
                                        <option value="<?= $c['can_id'] ?>" data-precio="<?= $c['can_precio_hora'] ?>"><?= $c['can_nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>2. Fecha del Partido</label>
                                <input type="date" name="fecha" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Hora Inicio</label>
                                        <select name="hora_ini" id="hora_ini" class="form-control" required onchange="calcularPrecio()">
                                            <option value="">Selecciona hora inicio</option>
                                            <?php foreach($horarios as $h): ?>
                                                <option value="<?= $h['hor_nombre'] ?>"><?= $h['hor_nombre'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Hora Fin</label>
                                        <select name="hora_fin" id="hora_fin" class="form-control" required onchange="calcularPrecio()">
                                            <option value="">Selecciona hora fin</option>
                                            <?php foreach($horarios as $h): ?>
                                                <option value="<?= $h['hor_nombre'] ?>"><?= $h['hor_nombre'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Valor de Hora ($)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="text" name="valor_total" id="valor_total" class="form-control" readonly value="0.00">
                                </div>
                                <small class="text-muted" id="tarifa">Selecciona una cancha para ver la tarifa por hora.</small>
                            </div>

                            <div class="form-group">
                                <label>3. Subir Comprobante de Pago</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="comprobante" class="custom-file-input" id="comprobante" accept=".pdf, .jpg, .png, .jpeg" required>
                                        <label class="custom-file-label" for="comprobante">Seleccionar archivo (PDF o Imagen)</label>
                                    </div>
                                </div>
                                <small class="text-info">Sube una foto de la transferencia o depósito.</small>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" onclick="return validarFormulario()">Guardar Reserva</button>
                            <a href="index.php?controller=Dashboard&action=cliente" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/adminlte/dist/js/adminlte.min.js"></script>
<script src="assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
$(function () {
  bsCustomFileInput.init(); // Para que el input file se vea bonito
});

let precioPorHora = 0;

function cargarPrecio() {
    const canchaSelect = document.getElementById('cancha');
    const selectedOption = canchaSelect.options[canchaSelect.selectedIndex];
    precioPorHora = parseFloat(selectedOption.getAttribute('data-precio')) || 0;
    document.getElementById('tarifa').textContent = `Tarifa por hora: $${precioPorHora.toFixed(2)}`;
    calcularPrecio();
}

function calcularPrecio() {
    const ini = document.getElementById('hora_ini').value;
    const fin = document.getElementById('hora_fin').value;
    const inputTotal = document.getElementById('valor_total');

    if(ini && fin && precioPorHora > 0) {
        // Convertir horas a objetos fecha para restar
        const d1 = new Date("2000-01-01 " + ini);
        const d2 = new Date("2000-01-01 " + fin);
        
        // Diferencia en horas
        let diff = (d2 - d1) / 1000 / 60 / 60;
        
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

    if (!ini || !fin) {
        alert('Por favor, selecciona hora de inicio y fin.');
        return false;
    }

    const d1 = new Date("2000-01-01 " + ini);
    const d2 = new Date("2000-01-01 " + fin);
    const diff = (d2 - d1) / 1000 / 60 / 60;

    if (diff < 1) {
        alert('La hora de fin debe ser al menos 1 hora después de la hora de inicio.');
        return false;
    }

    return true;
}
</script>
</body>
</html>