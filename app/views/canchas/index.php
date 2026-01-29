<div class="row">
    
    <div class="col-md-4">
        <div class="card card-success card-outline shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 text-center">
                <div class="bg-gradient-success rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 60px; height: 60px;">
                    <i class="fas fa-futbol fa-2x text-white"></i>
                </div>
                <h5 class="font-weight-bold text-dark">Nueva Cancha</h5>
                <p class="text-muted small">Registra un nuevo espacio deportivo</p>
            </div>
            
            <form action="index.php?controller=Canchas&action=guardar" method="POST">
                <div class="card-body pt-0">
                    
                    <div class="form-group">
                        <label class="font-weight-bold small text-secondary">Nombre / Identificador</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-signature text-success"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control bg-light border-left-0" name="nombre" placeholder="Ej: Cancha Sintética A" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold small text-secondary">Precio por Hora ($)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-dollar-sign text-success"></i>
                                </span>
                            </div>
                            <input type="number" step="0.01" class="form-control bg-light border-left-0" name="precio" placeholder="0.00" required>
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-white border-0 pt-0 pb-4">
                    <button type="submit" class="btn btn-success btn-block shadow-sm font-weight-bold">
                        <i class="fas fa-plus-circle mr-1"></i> Registrar Cancha
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-secondary shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-list text-secondary mr-2"></i> Canchas Disponibles
                </h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-uppercase text-secondary text-xs">
                        <tr>
                            <th class="pl-4 border-0" style="width: 10%;">ID</th>
                            <th class="border-0" style="width: 40%;">Nombre de la Cancha</th>
                            <th class="border-0" style="width: 25%;">Precio / Hora</th>
                            <th class="border-0 text-center" style="width: 25%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($canchas)): ?>
                            <?php foreach ($canchas as $cancha): ?>
                            <tr>
                                <td class="pl-4 text-muted font-weight-bold">
                                    #<?= $cancha['can_id'] ?>
                                </td>
                                
                                <td class="font-weight-bold text-dark">
                                    <i class="fas fa-map-marker-alt text-success mr-2"></i>
                                    <?= htmlspecialchars($cancha['can_nombre']) ?>
                                </td>

                                <td>
                                    <span class="badge badge-light border text-success font-weight-bold px-3 py-2" style="font-size: 1em;">
                                        $ <?= number_format($cancha['can_precio_hora'], 2) ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="index.php?controller=Canchas&action=editar&id=<?= $cancha['can_id'] ?>" class="btn btn-white btn-sm border-right" title="Editar">
                                            <i class="fas fa-pen text-primary"></i>
                                        </a>
                                        <button onclick="confirmarEliminar(<?= $cancha['can_id'] ?>)" class="btn btn-white btn-sm text-danger" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="far fa-futbol fa-3x mb-3 text-gray-300"></i><br>
                                    No hay canchas registradas.
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
            title: '¿Eliminar cancha?',
            text: "Cuidado: Si hay reservas pasadas en esta cancha, podría generar error.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: '<i class="fas fa-trash"></i> Eliminar',
            cancelButtonText: '<span class="text-dark">Cancelar</span>'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Canchas&action=eliminar&id=${id}`;
            }
        })
    }
</script>