<div class="row justify-content-center mt-3">
    
    <div class="col-md-7">
        <div class="card card-outline card-info shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h4 class="font-weight-bold text-dark"><i class="fas fa-tasks text-info mr-2"></i> Gestionar Alquiler #<?= $alquiler['alq_id'] ?></h4>
            </div>
            
            <form action="index.php?controller=GestionAlquileres&action=actualizar" method="POST">
                <div class="card-body pt-0">
                    <input type="hidden" name="alq_id" value="<?= $alquiler['alq_id'] ?>">

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="small font-weight-bold text-primary text-uppercase">Nuevo Estado</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-primary text-primary"><i class="fas fa-toggle-on"></i></span>
                                </div>
                                <select name="est_id" class="form-control font-weight-bold border-primary text-primary">
                                    <?php foreach ($estados as $est): ?>
                                        <option value="<?= $est['est_id'] ?>" <?= ($est['est_id'] == $alquiler['est_id']) ? 'selected' : '' ?>>
                                            <?= $est['est_nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="small font-weight-bold text-secondary">Fecha</label>
                            <input type="date" class="form-control bg-light" name="alq_fecha" value="<?= $alquiler['alq_fecha'] ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-secondary">Inicio</label>
                            <input type="time" class="form-control" name="alq_hora_ini" value="<?= $alquiler['alq_hora_ini'] ?>" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-secondary">Fin</label>
                            <input type="time" class="form-control" name="alq_hora_fin" value="<?= $alquiler['alq_hora_fin'] ?>" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-secondary">Valor ($)</label>
                            <input type="number" step="0.01" class="form-control" name="alq_valor" value="<?= $alquiler['alq_valor'] ?>" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                        <a href="index.php?controller=GestionAlquileres&action=index" class="btn btn-light rounded-pill px-4">Volver</a>
                        <button type="submit" class="btn btn-info font-weight-bold rounded-pill px-5 shadow-lg">
                            <i class="fas fa-save mr-2"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-outline card-secondary shadow-sm">
            <div class="card-header bg-white text-center">
                <h6 class="font-weight-bold mb-0 text-muted">Comprobante Adjunto</h6>
            </div>
            <div class="card-body text-center bg-light d-flex flex-column align-items-center justify-content-center" style="min-height: 350px;">
                
                <?php 
                    // CORRECCIÓN AQUÍ TAMBIÉN
                    $ruta_img = 'uploads/comprobantes/' . $alquiler['alq_comprobante']; 
                ?>

                <?php if (!empty($alquiler['alq_comprobante'])): ?>
                    <div class="w-100 position-relative">
                        <img src="<?= $ruta_img ?>" 
                            class="img-fluid rounded shadow-sm border mb-3" 
                            alt="Comprobante" 
                            style="max-height: 400px; width: auto;">
                        
                        <br>
                        <a href="<?= $ruta_img ?>" target="_blank" class="btn btn-sm btn-dark shadow-sm">
                            <i class="fas fa-search-plus mr-1"></i> Abrir Imagen Completa
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-muted">
                        <i class="fas fa-file-invoice-dollar fa-4x mb-3 text-gray-300"></i>
                        <p>No hay comprobante cargado.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div> 
</div>