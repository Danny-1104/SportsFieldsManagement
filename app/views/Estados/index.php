<div class="row">
    
    <div class="col-md-4">
        <div class="card card-purple card-outline shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 text-center">
                <div class="bg-gradient-purple rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 50px; height: 50px; background-color: #6f42c1; color: white;">
                    <i class="fas fa-tags fa-lg"></i>
                </div>
                <h5 class="font-weight-bold text-dark">Nuevo Estado</h5>
                <p class="text-muted small">Define un nuevo estado para las reservas</p>
            </div>
            
            <form action="index.php?controller=Estados&action=guardar" method="POST">
                <div class="card-body pt-0">
                    <div class="form-group">
                        <label class="font-weight-bold small text-secondary">Nombre del Estado</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-pen-nib" style="color: #6f42c1;"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control bg-light border-left-0" name="nombre" placeholder="Ej: EN REVISIÓN" required autocomplete="off">
                        </div>
                        <small class="text-muted mt-2 d-block text-xs">
                            <i class="fas fa-info-circle mr-1"></i> El color se asignará automáticamente.
                        </small>
                    </div>
                </div>

                <div class="card-footer bg-white border-0 pt-0 pb-4">
                    <button type="submit" class="btn btn-block text-white shadow-sm font-weight-bold" style="background-color: #6f42c1;">
                        <i class="fas fa-save mr-1"></i> Guardar Estado
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-secondary shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-tasks text-secondary mr-2"></i> Estados del Sistema
                </h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-uppercase text-secondary text-xs">
                        <tr>
                            <th class="pl-4 border-0" style="width: 10%;">ID</th>
                            <th class="border-0" style="width: 40%;">Nombre Técnico</th>
                            <th class="border-0 text-center" style="width: 30%;">Vista Previa (Color)</th>
                            <th class="border-0 text-center" style="width: 20%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($estados)): ?>
                            <?php foreach ($estados as $estado): ?>
                            <tr>
                                <td class="pl-4 text-muted font-weight-bold">
                                    #<?= $estado['est_id'] ?>
                                </td>
                                
                                <td class="font-weight-bold text-dark">
                                    <?= htmlspecialchars($estado['est_nombre']) ?>
                                </td>

                                <td class="text-center">
                                    <?php 
                                        $nombre = strtoupper($estado['est_nombre']);
                                        $clase = 'secondary'; $icono = 'circle';
                                        if (strpos($nombre, 'APROBADO') !== false) { $clase = 'success'; $icono = 'check'; }
                                        elseif (strpos($nombre, 'REGISTRADO') !== false) { $clase = 'warning'; $icono = 'clock'; }
                                        elseif (strpos($nombre, 'PENDIENTE') !== false) { $clase = 'warning'; $icono = 'hourglass-half'; }
                                        elseif (strpos($nombre, 'CANCELADO') !== false) { $clase = 'danger'; $icono = 'times'; }
                                        elseif (strpos($nombre, 'FINALIZADO') !== false) { $clase = 'info'; $icono = 'flag-checkered'; }
                                    ?>
                                    <span class="badge badge-<?= $clase ?> px-3 py-2 elevation-1">
                                        <i class="fas fa-<?= $icono ?> mr-1"></i> <?= $estado['est_nombre'] ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="index.php?controller=Estados&action=editar&id=<?= $estado['est_id'] ?>" class="btn btn-white btn-sm border-right" title="Editar">
                                            <i class="fas fa-pen text-primary"></i>
                                        </a>
                                        
                                        <button onclick="confirmarEliminar(<?= $estado['est_id'] ?>)" class="btn btn-white btn-sm text-danger" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    No hay estados configurados.
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
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Eliminar estado?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Estados&action=eliminar&id=${id}`;
            }
        })
    }
</script>