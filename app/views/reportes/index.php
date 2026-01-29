<div class="row">
    <div class="col-12">
        
        <div class="card card-outline card-info shadow-lg mb-4" style="border-radius: 12px;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                <h5 class="font-weight-bold text-dark mb-0">
                    <i class="fas fa-search-dollar mr-2 text-info" style="font-size: 1.2em;"></i> Filtros de Búsqueda Avanzada
                </h5>
            </div>
            <div class="card-body pt-2">
                <form action="index.php?controller=Reportes&action=index" method="POST" id="formReporte">
                    <div class="row align-items-end">
                        
                        <div class="col-md-3 form-group">
                            <label class="small font-weight-bold text-info text-uppercase">Desde</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-info text-info"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control border-info text-info font-weight-bold" name="fecha_inicio" value="<?= $f_inicio ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="small font-weight-bold text-info text-uppercase">Hasta</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-info text-info"><i class="far fa-calendar-check"></i></span>
                                </div>
                                <input type="date" class="form-control border-info text-info font-weight-bold" name="fecha_fin" value="<?= $f_fin ?>" required>
                            </div>
                        </div>

                        <div class="col-md-4 form-group">
                            <label class="small font-weight-bold text-info text-uppercase">Estado del Alquiler</label>
                            <div class="input-group shadow-sm">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-info text-white border-info">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="chkTodos" name="todos_estados" value="1" <?= ($estado_selec == 'todos') ? 'checked' : '' ?>>
                                            <label class="custom-control-label font-weight-bold" for="chkTodos" style="cursor: pointer;">Todos</label>
                                        </div>
                                    </div>
                                </div>
                                <select class="form-control border-info text-dark font-weight-bold" name="est_id" id="selEstados" <?= ($estado_selec == 'todos') ? 'disabled' : '' ?>>
                                    <?php foreach ($estados as $est): ?>
                                        <option value="<?= $est['est_id'] ?>" <?= ($estado_selec == $est['est_id']) ? 'selected' : '' ?>>
                                            <?= $est['est_nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-info btn-block font-weight-bold shadow-md text-white" style="height: 45px; border-radius: 8px;">
                                <i class="fas fa-filter mr-2"></i> Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!empty($resultados)): ?>
        <div class="card card-outline card-secondary shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
            
            <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="card-title font-weight-bold text-dark mb-1">
                        <i class="fas fa-clipboard-list text-info mr-2"></i> Resultados del Reporte
                    </h3>
                    <p class="text-muted small mb-0">Mostrando <?= count($resultados) ?> registros encontrados.</p>
                </div>
                
                <form action="index.php?controller=Reportes&action=imprimir" method="POST" target="_blank">
                    <input type="hidden" name="fecha_inicio" value="<?= $f_inicio ?>">
                    <input type="hidden" name="fecha_fin" value="<?= $f_fin ?>">
                    <?php if($estado_selec == 'todos'): ?>
                        <input type="hidden" name="todos_estados" value="1">
                    <?php else: ?>
                        <input type="hidden" name="est_id" value="<?= $estado_selec ?>">
                    <?php endif; ?>
                    
                    <button type="submit" class="btn btn-danger font-weight-bold shadow-sm px-4 badge-pill">
                        <i class="fas fa-file-pdf mr-2 fa-lg"></i> Exportar a PDF
                    </button>
                </form>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle text-nowrap">
                    <thead class="bg-info text-white text-uppercase text-xs">
                        <tr>
                            <th class="pl-4 py-3 border-0"><i class="fas fa-hashtag mr-1 opacity-50"></i> ID</th>
                            <th class="py-3 border-0"><i class="fas fa-user mr-1 opacity-50"></i> Cliente</th>
                            <th class="py-3 border-0"><i class="far fa-calendar-alt mr-1 opacity-50"></i> Fecha</th>
                            <th class="text-center py-3 border-0"><i class="far fa-clock mr-1 opacity-50"></i> Inicio</th>
                            <th class="text-center py-3 border-0"><i class="far fa-clock mr-1 opacity-50"></i> Fin</th>
                            <th class="text-center py-3 border-0"><i class="fas fa-toggle-on mr-1 opacity-50"></i> Estado</th>
                            <th class="text-center py-3 border-0"><i class="fas fa-hourglass-half mr-1 opacity-50"></i> Horas</th>
                            <th class="text-right pr-4 py-3 border-0"><i class="fas fa-dollar-sign mr-1 opacity-50"></i> Valor Pagado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_dinero = 0;
                            $total_horas = 0;
                        ?>
                        <?php foreach ($resultados as $row): 
                            $total_dinero += $row['alq_valor'];
                            $total_horas += $row['horas_jugadas'];
                        ?>
                        <tr>
                            <td class="pl-4 font-weight-bold text-muted">#<?= $row['alq_id'] ?></td>
                            <td class="font-weight-bold text-dark">
                                <i class="fas fa-user-circle text-info mr-1"></i> <?= htmlspecialchars($row['nombre_usu']) ?>
                            </td>
                            <td><?= date('d/m/Y', strtotime($row['alq_fecha'])) ?></td>
                            <td class="text-center"><span class="badge badge-light border"><?= substr($row['alq_hora_ini'], 0, 5) ?></span></td>
                            <td class="text-center"><span class="badge badge-light border"><?= substr($row['alq_hora_fin'], 0, 5) ?></span></td>
                            <td class="text-center">
                                <?php 
                                    $est = strtoupper($row['est_nombre']);
                                    $badge = 'secondary';
                                    if (strpos($est, 'APROBADO') !== false) $badge = 'success';
                                    elseif (strpos($est, 'REGISTRADO') !== false) $badge = 'warning';
                                    elseif (strpos($est, 'CANCELADO') !== false) $badge = 'danger';
                                    elseif (strpos($est, 'FINALIZADO') !== false) $badge = 'primary';
                                ?>
                                <span class="badge badge-<?= $badge ?> px-3 elevation-1"><?= $row['est_nombre'] ?></span>
                            </td>
                            <td class="text-center font-weight-bold"><?= number_format($row['horas_jugadas'], 1) ?> h</td>
                            <td class="text-right pr-4 text-success font-weight-bold">$<?= number_format($row['alq_valor'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    
                    <tfoot class="bg-light font-weight-bold text-dark border-top">
                        <tr style="font-size: 1.1em;">
                            <td colspan="6" class="text-right text-uppercase py-4 align-middle">
                                <span class="text-muted small mr-2">Resumen del Período:</span> Totales Generales <i class="fas fa-chevron-right ml-2 text-info"></i>
                            </td>
                            <td class="text-center py-4 align-middle">
                                <div class="bg-white border border-info rounded p-2 shadow-sm text-info">
                                    <i class="fas fa-stopwatch mr-1"></i> <?= number_format($total_horas, 1) ?> Horas
                                </div>
                            </td>
                            <td class="text-right pr-4 py-4 align-middle">
                                <div class="bg-white border border-success rounded p-2 shadow-sm text-success">
                                    <i class="fas fa-hand-holding-usd mr-1"></i> $<?= number_format($total_dinero, 2) ?>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<script>
    const chk = document.getElementById('chkTodos');
    const select = document.getElementById('selEstados');

    chk.addEventListener('change', function() {
        if(this.checked) {
            select.disabled = true;
        } else {
            select.disabled = false;
        }
    });
</script>