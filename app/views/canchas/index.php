<div class="row">
    <div class="col-md-4">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle"></i> Nueva Cancha</h3>
            </div>
           <form action="index.php?controller=Canchas&action=guardar" method="POST">
    <div class="form-group">
        <label>Nombre de la Cancha:</label>
        <input type="text" name="can_nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Precio por Hora:</label>
        <input type="number" name="can_precio_hora" step="0.01" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Descripción:</label>
        <textarea name="can_descripcion" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Registrar Cancha</button>
</form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Inventario de Canchas</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio/Hora</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($datos_canchas)): foreach($datos_canchas as $c): ?>
                        <tr>
                            <td><?= $c['can_id'] ?></td>
                            <td><strong><?= $c['can_nombre'] ?></strong></td>
                            <td><span class="badge badge-success" style="font-size: 1rem;">$<?= number_format($c['can_precio_hora'], 2) ?></span></td>
                            <td><?= substr($c['can_descripcion'], 0, 30) ?>...</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="confirmarEliminarCancha(<?= $c['can_id'] ?>, '<?= $c['can_nombre'] ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay canchas registradas.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    if (msg === 'save_ok') Toast.fire({ icon: 'success', title: 'Cancha guardada correctamente' });
    if (msg === 'delete_ok') Toast.fire({ icon: 'warning', title: 'Cancha eliminada del sistema' });

    function confirmarEliminarCancha(id, nombre) {
        Swal.fire({
            title: '¿Eliminar cancha?',
            text: `Se borrará la "${nombre}". Esto podría afectar reportes históricos.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Canchas&action=eliminar&id=${id}`;
            }
        });
    }
</script>