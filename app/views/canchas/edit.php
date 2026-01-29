<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card card-outline card-success shadow-lg border-0">
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <div class="bg-success rounded-circle d-inline-flex justify-content-center align-items-center mb-2 shadow-sm" style="width: 60px; height: 60px;">
                    <i class="fas fa-edit text-white fa-lg"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Editar Cancha</h4>
            </div>
            
            <form action="index.php?controller=Canchas&action=actualizar" method="POST">
                <div class="card-body pt-0">
                    <input type="hidden" name="id" value="<?= $cancha['can_id'] ?>">

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-secondary">Nombre de la Cancha</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-signature text-muted"></i></span>
                            </div>
                            <input type="text" class="form-control border-left-0 bg-light" name="nombre" value="<?= htmlspecialchars($cancha['can_nombre']) ?>" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="small font-weight-bold text-secondary">Precio por Hora ($)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-dollar-sign text-muted"></i></span>
                            </div>
                            <input type="number" step="0.01" class="form-control border-left-0 bg-light" name="precio" value="<?= $cancha['can_precio_hora'] ?>" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="index.php?controller=Canchas&action=index" class="btn btn-light text-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success px-4 shadow-sm font-weight-bold">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>