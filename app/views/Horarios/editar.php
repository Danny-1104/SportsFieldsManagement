<div class="row justify-content-center" style="margin-top: 20px; margin-bottom: 50px;">
    <div class="col-md-8"> <div class="card card-outline card-primary shadow-lg border-0" style="border-radius: 15px;">
            
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <div class="bg-primary rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 60px; height: 60px;">
                    <i class="fas fa-clock text-white fa-2x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Editar Horario</h4>
                <p class="text-muted small">Selecciona el nuevo bloque horario</p>
            </div>
            
            <form action="index.php?controller=Horarios&action=actualizar" method="POST">
                <div class="card-body px-4 pt-0 pb-4">
                    
                    <input type="hidden" name="id" value="<?= $horario['hor_id'] ?>">
                    <?php $hora_actual = substr($horario['hor_nombre'], 0, 5); ?>

                    <div class="row">
                        
                        <div class="col-md-6 border-right">
                            <h6 class="text-primary font-weight-bold text-center mb-3">
                                <i class="fas fa-sun mr-2"></i> Mañana
                            </h6>
                            <div class="d-flex flex-wrap justify-content-center">
                                <?php for($i = 6; $i <= 12; $i++): 
                                    $h = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                                    $isActive = ($h == $hora_actual) ? 'active btn-primary' : 'btn-outline-secondary';
                                    $isChecked = ($h == $hora_actual) ? 'checked' : '';
                                ?>
                                    <label class="btn <?= $isActive ?> m-1 shadow-sm" style="width: 80px; border-radius: 20px;">
                                        <input type="radio" name="hora" value="<?= $h ?>" <?= $isChecked ?> autocomplete="off" style="display:none;" onchange="actualizarEstilo(this)">
                                        <?= $h ?>
                                    </label>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-info font-weight-bold text-center mb-3 mt-3 mt-md-0">
                                <i class="fas fa-moon mr-2"></i> Tarde / Noche
                            </h6>
                            <div class="d-flex flex-wrap justify-content-center">
                                <?php for($i = 13; $i <= 23; $i++): 
                                    $h = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                                    $isActive = ($h == $hora_actual) ? 'active btn-primary' : 'btn-outline-secondary';
                                    $isChecked = ($h == $hora_actual) ? 'checked' : '';
                                ?>
                                    <label class="btn <?= $isActive ?> m-1 shadow-sm" style="width: 80px; border-radius: 20px;">
                                        <input type="radio" name="hora" value="<?= $h ?>" <?= $isChecked ?> autocomplete="off" style="display:none;" onchange="actualizarEstilo(this)">
                                        <?= $h ?>
                                    </label>
                                <?php endfor; ?>
                            </div>
                        </div>

                    </div> <hr class="mt-4 mb-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?controller=Horarios&action=index" class="btn btn-light text-muted font-weight-bold px-4" style="border-radius: 50px;">
                            <i class="fas fa-times mr-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success font-weight-bold px-5 shadow-lg" style="border-radius: 50px;">
                            <i class="fas fa-sync-alt mr-2"></i> Actualizar Hora
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
function actualizarEstilo(radioSeleccionado) {
    // 1. Quitar clase activa a todos los labels
    document.querySelectorAll('.btn').forEach(lbl => {
        lbl.classList.remove('btn-primary', 'active');
        lbl.classList.add('btn-outline-secondary');
    });

    // 2. Agregar clase activa al label del radio seleccionado
    // El label es el padre del input radio
    let labelPadre = radioSeleccionado.parentElement;
    labelPadre.classList.remove('btn-outline-secondary');
    labelPadre.classList.add('btn-primary', 'active');
}
</script>