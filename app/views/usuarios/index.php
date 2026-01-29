<div class="row">
    <div class="col-12">
        
        <div class="card shadow-lg border-0" style="border-radius: 15px; border-top: 5px solid #17a2b8;">
            
            <div class="card-header bg-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title font-weight-bold text-dark mb-0">
                            <i class="fas fa-users-cog mr-2 text-info"></i> 
                            Directorio de Clientes
                        </h3>
                    </div>
                    
                    <a href="index.php?controller=Usuarios&action=crear" 
                       class="btn btn-info shadow-sm font-weight-bold px-4 rounded-pill" 
                       style="background: linear-gradient(90deg, #17a2b8 0%, #138496 100%); border: none;">
                        <i class="fas fa-user-plus mr-2"></i> Nuevo Cliente
                    </a>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle text-nowrap mb-0">
                    
                    <thead class="bg-info text-white text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                        <tr>
                            <th class="pl-4 py-3 border-0" style="width: 5%; border-top-left-radius: 10px;">
                                <i class="fas fa-hashtag opacity-50 mr-1"></i> ID
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%;">
                                <i class="far fa-calendar-check opacity-50 mr-1"></i> Registro
                            </th>
                            <th class="py-3 border-0" style="width: 25%;">
                                <i class="fas fa-user-tag opacity-50 mr-1"></i> Cliente
                            </th>
                            <th class="py-3 border-0" style="width: 25%;">
                                <i class="fas fa-envelope opacity-50 mr-1"></i> Correo Electrónico
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%;">
                                <i class="fas fa-shield-alt opacity-50 mr-1"></i> Acceso
                            </th>
                            <th class="text-center py-3 border-0" style="width: 15%; border-top-right-radius: 10px;">
                                <i class="fas fa-sliders-h opacity-50 mr-1"></i> Acciones
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $user): ?>
                            <tr>
                                <td class="pl-4 text-muted font-weight-bold">
                                    #<?= $user['id_usu'] ?>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge badge-light border text-info px-3 py-2" style="font-weight: 600;">
                                        <?= date('d/m/Y', strtotime($user['created_at'] ?? 'now')) ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center mr-3 text-white shadow-sm" 
                                             style="width: 40px; height: 40px; background-color: #17a2b8; font-size: 1.1em; border: 2px solid #fff; box-shadow: 0 0 0 1px #17a2b8;">
                                            <?= strtoupper(substr($user['nombre_usu'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <span class="d-block font-weight-bold text-dark" style="font-size: 1rem;">
                                                <?= htmlspecialchars($user['nombre_usu']) ?>
                                            </span>
                                            <small class="text-muted"><i class="fas fa-check-circle text-success mr-1" style="font-size: 10px;"></i>Activo</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="text-secondary font-weight-bold" style="font-size: 0.95rem;">
                                        <i class="far fa-envelope-open mr-2 text-muted"></i>
                                        <?= htmlspecialchars($user['email_usu'] ?? $user['correo_usu']) ?> 
                                        </div>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-pill badge-light border text-muted px-3" data-toggle="tooltip" title="Contraseña Segura">
                                        <i class="fas fa-lock mr-1 text-warning"></i> ••••••••
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="index.php?controller=Usuarios&action=editar&id=<?= $user['id_usu'] ?>" 
                                           class="btn btn-light btn-sm text-info border-right" 
                                           title="Editar Datos"
                                           style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <button onclick="confirmarEliminar(<?= $user['id_usu'] ?>)" 
                                                class="btn btn-light btn-sm text-danger" 
                                                title="Eliminar Cuenta"
                                                style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted opacity-50">
                                        <i class="fas fa-users-slash fa-3x mb-3 text-info"></i>
                                        <p class="mb-0 font-weight-bold">No hay clientes en el sistema.</p>
                                        <small>Haz clic en "Nuevo Cliente" para agregar uno.</small>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer bg-white py-3 border-top-0">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Total Registros: <strong><?= count($usuarios) ?></strong></small>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Eliminar Cliente?',
            text: "Se borrará su cuenta y todo su historial de reservas.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: '<i class="fas fa-trash"></i> Sí, eliminar',
            cancelButtonText: '<span class="text-dark">Cancelar</span>'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Usuarios&action=eliminar&id=${id}`;
            }
        })
    }
    
    // Activar tooltips si usas Bootstrap
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>