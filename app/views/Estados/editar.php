<div class="row justify-content-center" style="margin-top: 40px; margin-bottom: 50px;">
    <div class="col-md-5">
        <div class="card card-outline card-purple shadow-lg border-0" style="border-radius: 15px;">
            
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <div class="bg-gradient-purple rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: #6f42c1; color: white;">
                    <i class="fas fa-tags fa-2x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Editar Estado</h4>
                <p class="text-muted small">Modifica el nombre del estado</p>
            </div>
            
            <form action="index.php?controller=Estados&action=actualizar" method="POST">
                <div class="card-body px-4 pt-2 pb-4">
                    
                    <input type="hidden" name="id" value="<?= $estado['est_id'] ?>">

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-secondary small text-uppercase">Nombre del Estado</label>
                        <div class="input-group shadow-sm" style="border-radius: 10px;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0" style="border-radius: 10px 0 0 10px; border-color: #ced4da;">
                                    <i class="fas fa-pen-nib" style="color: #6f42c1;"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control border-left-0" name="nombre" 
                                   value="<?= htmlspecialchars($estado['est_nombre']) ?>" 
                                   required style="border-radius: 0 10px 10px 0; border-color: #ced4da; height: 45px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="index.php?controller=Estados&action=index" class="btn btn-light text-muted font-weight-bold px-4" style="border-radius: 50px;">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn text-white font-weight-bold px-5 shadow-lg" style="border-radius: 50px; background-color: #6f42c1; border: none; min-width: 150px;">
                            <i class="fas fa-save mr-2"></i> Guardar
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>