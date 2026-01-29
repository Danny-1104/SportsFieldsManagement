<div class="row">
    <div class="col-12">
        
        <div class="card card-outline card-info shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
            
            <div class="card-header bg-white border-bottom-0 py-3">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-calendar-check text-info mr-2" style="font-size: 1.2em;"></i> 
                    Control de Reservas y Pagos
                </h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle text-nowrap">
                    
                    <thead class="bg-info text-white text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                        <tr>
                            <th class="pl-4 py-3 border-0" style="width: 5%;">
                                <i class="fas fa-hashtag opacity-50 mr-1"></i> ID
                            </th>
                            <th class="py-3 border-0" style="width: 20%;">
                                <i class="fas fa-user opacity-50 mr-1"></i> Cliente
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%;">
                                <i class="far fa-calendar-alt opacity-50 mr-1"></i> Fecha
                            </th>
                            <th class="text-center py-3 border-0" style="width: 10%;">
                                <i class="far fa-clock opacity-50 mr-1"></i> Inicio
                            </th>
                            <th class="text-center py-3 border-0" style="width: 10%;">
                                <i class="far fa-clock opacity-50 mr-1"></i> Fin
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%;">
                                <i class="fas fa-receipt opacity-50 mr-1"></i> Comprobante
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%;">
                                <i class="fas fa-toggle-on opacity-50 mr-1"></i> Estado
                            </th>
                            <th class="text-center py-3 border-0" style="width: 10%;">
                                <i class="fas fa-cogs opacity-50 mr-1"></i> Acciones
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white">
                        <?php if (!empty($alquileres)): ?>
                            <?php foreach ($alquileres as $row): ?>
                            <tr style="transition: all 0.2s;">
                                <td class="pl-4 font-weight-bold text-secondary">
                                    #<?= $row['alq_id'] ?>
                                </td>
                                
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center mr-2 shadow-sm" style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-info"></i>
                                        </div>
                                        <span class="font-weight-bold text-dark" style="font-size: 1rem;">
                                            <?= htmlspecialchars($row['nombre_usu']) ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center text-muted font-weight-bold">
                                    <?= date('d/m/Y', strtotime($row['alq_fecha'])) ?>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-light border px-3 py-2 text-dark">
                                        <?= substr($row['alq_hora_ini'], 0, 5) ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-light border px-3 py-2 text-dark">
                                        <?= substr($row['alq_hora_fin'], 0, 5) ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <?php if (!empty($row['alq_comprobante'])): ?>
                                        <a href="index.php?controller=GestionAlquileres&action=verImagen&img=<?= $row['alq_comprobante'] ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm font-weight-bold"
                                           style="border-width: 2px;">
                                            <i class="fas fa-eye mr-1"></i> Ver ($<?= $row['alq_valor'] ?>)
                                        </a>
                                    <?php else: ?>
                                        <span class="badge badge-secondary opacity-50 font-weight-normal px-3 py-2 rounded-pill">
                                            <i class="fas fa-times mr-1"></i> Pendiente
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <?php 
                                        $est = strtoupper($row['est_nombre']);
                                        $badge = 'secondary';
                                        $icon = 'circle';
                                        
                                        if (strpos($est, 'APROBADO') !== false) { $badge = 'success'; $icon = 'check-circle'; }
                                        elseif (strpos($est, 'REGISTRADO') !== false) { $badge = 'warning'; $icon = 'clock'; }
                                        elseif (strpos($est, 'CANCELADO') !== false) { $badge = 'danger'; $icon = 'times-circle'; }
                                        elseif (strpos($est, 'FINALIZADO') !== false) { $badge = 'primary'; $icon = 'flag-checkered'; }
                                    ?>
                                    <span class="badge badge-<?= $badge ?> px-3 py-2 elevation-1 rounded-pill">
                                        <i class="fas fa-<?= $icon ?> mr-1"></i> <?= $row['est_nombre'] ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="index.php?controller=GestionAlquileres&action=editar&id=<?= $row['alq_id'] ?>" 
                                           class="btn btn-light btn-sm shadow-sm border mr-1 text-info" 
                                           title="Gestionar" 
                                           style="border-radius: 5px;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmarEliminar(<?= $row['alq_id'] ?>)" 
                                                class="btn btn-light btn-sm shadow-sm border text-danger" 
                                                title="Eliminar"
                                                style="border-radius: 5px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted bg-light">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-inbox fa-3x mb-3 text-gray-300"></i>
                                        <h6 class="font-weight-bold">No hay reservas registradas</h6>
                                        <p class="small">Los nuevos alquileres aparecerán aquí.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white border-top-0 py-3">
                <div class="float-right text-muted small">
                    Total Registros: <strong><?= count($alquileres) ?></strong>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Eliminar Reserva?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: '<i class="fas fa-trash"></i> Eliminar',
            cancelButtonText: '<span class="text-dark">Cancelar</span>',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=GestionAlquileres&action=eliminar&id=${id}`;
            }
        })
    }
</script>