<div class="row">
    <div class="col-md-4">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock"></i> Agregar Hora Operativa</h3>
            </div>
            <form action="index.php?controller=Horarios&action=guardar" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Seleccione la hora (Formato 24h):</label>
                        <input type="time" name="hor_nombre" class="form-control" required>
                        <small class="text-muted">Ejemplo: 14:00, 21:30</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Habilitar esta Hora</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Horas que aparecerán al Cliente</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hora Registrada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($datos_horarios)): ?>
                            <?php foreach ($datos_horarios as $h): ?>
                            <tr>
                                <td><?= $h['hor_id'] ?></td>
                                <td><span class="badge badge-info" style="font-size: 1rem;"><?= $h['hor_nombre'] ?></span></td>
                                <td>
                                    <a href="index.php?controller=Horarios&action=eliminar&id=<?= $h['hor_id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Deseas deshabilitar esta hora?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center text-muted">No has agregado horas operativas todavía.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if(isset($_GET['error']) && $_GET['error'] == 'duplicado'): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Hora duplicada!',
            text: 'La hora seleccionada ya ha sido habilitada anteriormente.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Entendido'
        });
    </script>
<?php endif; ?>

<?php if(isset($_GET['success'])): ?>
    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true
        });

        Toast.fire({
          icon: 'success',
          title: 'Hora guardada correctamente'
        });
    </script>
<?php endif; ?>