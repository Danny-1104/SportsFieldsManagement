<div class="row">
    <div class="col-md-4">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tag"></i> Nuevo Estado</h3>
            </div>
            <form action="index.php?controller=Estados&action=guardar" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre del Estado:</label>
                        <input type="text" name="est_nombre" class="form-control" placeholder="Ej: REGISTRADO" required>
                        <small class="text-muted">Se recomienda: REGISTRADO, APROBADO, CANCELADO, FINALIZADO.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Guardar Estado</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Estados Cargados en el Sistema</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th>Estado</th>
                            <th style="width: 100px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($datos_estados)): foreach($datos_estados as $e): ?>
                        <tr>
                            <td><?= $e['est_id'] ?></td>
                            <td>
                                <span class="badge badge-secondary" style="font-size: 0.9rem;">
                                    <?= $e['est_nombre'] ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="confirmarEliminarEstado(<?= $e['est_id'] ?>, '<?= $e['est_nombre'] ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center">No hay estados configurados.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    if (msg === 'save_ok') Toast.fire({ icon: 'success', title: 'Estado guardado correctamente' });
    if (msg === 'delete_ok') Toast.fire({ icon: 'info', title: 'Estado eliminado' });
    if (msg === 'error_dup') Swal.fire({ icon: 'error', title: '¡Ya existe!', text: 'Ese nombre de estado ya está registrado.' });

    function confirmarEliminarEstado(id, nombre) {
        Swal.fire({
            title: '¿Eliminar estado?',
            text: `El estado "${nombre}" dejará de estar disponible para nuevos registros.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Estados&action=eliminar&id=${id}`;
            }
        });
    }
</script>