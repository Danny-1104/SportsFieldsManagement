<div class="row">
    <div class="col-md-4">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle"></i> Nueva Cancha</h3>
            </div>
            <form action="index.php?controller=Canchas&action=guardar" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre de la Cancha:</label>
                        <input type="text" name="can_nombre" class="form-control" placeholder="Ej: Cancha Central" required>
                    </div>
                    <div class="form-group">
                        <label>Precio por Hora ($):</label>
                        <input type="number" name="can_precio_hora" step="0.01" class="form-control" placeholder="0.00" required>
                    </div>
                    </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">Registrar Cancha</button>
                </div>
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
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($datos_canchas)): ?>
                            <?php foreach($datos_canchas as $c): ?>
                            <tr>
                                <td><?= $c['can_id'] ?></td>
                                <td><strong><?= $c['can_nombre'] ?></strong></td>
                                <td>
                                    <span class="badge badge-success" style="font-size: 0.9rem;">
                                        $<?= number_format($c['can_precio_hora'], 2) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="confirmarEliminarCancha(<?= $c['can_id'] ?>, '<?= $c['can_nombre'] ?>')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle"></i> No hay canchas registradas en el sistema.
                                </td>
                            </tr>
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

    // Configuración de Notificaciones Toast
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    // Mostrar alertas según la respuesta del controlador
    if (msg === 'save_ok') {
        Toast.fire({ icon: 'success', title: 'Cancha guardada correctamente' });
    } else if (msg === 'delete_ok') {
        Toast.fire({ icon: 'warning', title: 'Cancha eliminada del sistema' });
    } else if (msg === 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo procesar la solicitud. Verifica la base de datos.'
        });
    }

    // Función para confirmación de eliminación con SweetAlert2
    function confirmarEliminarCancha(id, nombre) {
        Swal.fire({
            title: '¿Eliminar cancha?',
            text: `¿Estás seguro de que deseas eliminar "${nombre}"? Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Canchas&action=eliminar&id=${id}`;
            }
        });
    }
</script>