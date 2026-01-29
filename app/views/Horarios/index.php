<div class="row">
    
    <div class="col-md-4">
        <div class="card card-primary card-outline shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 text-center">
                <h5 class="font-weight-bold text-dark">
                    <i class="fas fa-clock text-primary mr-2"></i> Nuevo Horario
                </h5>
                <p class="text-muted small mb-0">Habilita una hora para reservas</p>
            </div>
            
            <form action="index.php?controller=Horarios&action=guardar" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold small text-secondary">Selecciona la Hora (Fija)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="far fa-clock text-muted"></i>
                                </span>
                            </div>
                            <select name="hora" class="form-control bg-light border-left-0" required>
                                <option value="" disabled selected>--:00</option>
                                <?php for($i = 6; $i <= 23; $i++): $h = str_pad($i, 2, '0', STR_PAD_LEFT).":00"; ?>
                                    <option value="<?= $h ?>"><?= $h ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            <i class="fas fa-info-circle mr-1"></i> Bloques de 1 hora exacta.
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <button type="submit" class="btn btn-primary btn-block shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> Agregar Horario
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-secondary shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-list-ul text-secondary mr-2"></i> Horarios Disponibles
                </h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-uppercase text-secondary text-xs">
                        <tr>
                            <th class="pl-4 border-0">Orden</th>
                            <th class="border-0 text-center">Hora Registrada</th>
                            <th class="border-0 text-center">Estado</th>
                            <th class="border-0 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($horarios)): ?>
                            <?php foreach ($horarios as $index => $hora): ?>
                            <tr>
                                <td class="pl-4 text-muted font-weight-bold">#<?= $index + 1 ?></td>
                                <td class="text-center">
                                    <span class="badge badge-light border px-3 py-2 text-dark" style="font-size: 1.1em;">
                                        <i class="far fa-clock mr-2 text-primary"></i> 
                                        <?= substr($hora['hor_nombre'], 0, 5) ?> 
                                    </span>
                                </td>
                                <td class="text-center"><span class="badge badge-success px-2">Activo</span></td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="index.php?controller=Horarios&action=editar&id=<?= $hora['hor_id'] ?>" class="btn btn-white btn-sm border-right" title="Editar">
                                            <i class="fas fa-pen text-primary"></i>
                                        </a>
                                        <button onclick="confirmarEliminar(<?= $hora['hor_id'] ?>)" class="btn btn-white btn-sm text-danger" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-5 text-muted">No hay horarios.</td></tr>
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
            title: '¿Eliminar horario?',
            text: "Los clientes ya no podrán reservar a esta hora.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: '<i class="fas fa-trash"></i> Eliminar',
            cancelButtonText: '<span class="text-dark">Cancelar</span>'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Horarios&action=eliminar&id=${id}`;
            }
        })
    }
</script>