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
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <div class="card card-primary">
                    <div class="card-header"><h3 class="card-title">Formulario de Reserva</h3></div>
                    
                    <form action="index.php?controller=Alquiler&action=guardar" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label>1. Selecciona la Cancha</label>
                                <select name="cancha" class="form-control" required>
                                    <?php foreach($canchas as $c): ?>
                                        <option value="<?= $c['can_id'] ?>"><?= $c['can_nombre'] ?></option>
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
                                        <input type="time" name="hora_ini" id="hora_ini" class="form-control" required onchange="calcularPrecio()">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Hora Fin</label>
                                        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required onchange="calcularPrecio()">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Valor a Pagar ($)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                    <input type="text" name="valor_total" id="valor_total" class="form-control" readonly value="0.00">
                                </div>
                                <small class="text-muted">Tarifa por hora: $<?= $precioHora ?></small>
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
                            <button type="submit" class="btn btn-success">Guardar Reserva</button>
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

const precioPorHora = <?= $precioHora ?>;

function calcularPrecio() {
    const ini = document.getElementById('hora_ini').value;
    const fin = document.getElementById('hora_fin').value;
    const inputTotal = document.getElementById('valor_total');

    if(ini && fin) {
        // Convertir horas a objetos fecha para restar
        const d1 = new Date("2000-01-01 " + ini);
        const d2 = new Date("2000-01-01 " + fin);
        
        // Diferencia en horas
        let diff = (d2 - d1) / 1000 / 60 / 60;
        
        if (diff < 0) diff = 0; // Evitar negativos si ponen la hora al revés

        const total = diff * precioPorHora;
        inputTotal.value = total.toFixed(2);
    }
}
</script>
</body>
</html>