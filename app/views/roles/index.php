<div class="row">
    <div class="col-12">
        <div class="card card-outline card-indigo shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="card-title font-weight-bold text-dark">
                    <i class="fas fa-user-tag text-indigo mr-2" style="color: #6610f2;"></i> Control de Roles y Permisos
                </h3>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-uppercase text-secondary text-xs">
                        <tr>
                            <th class="pl-4 border-0">ID</th>
                            <th class="border-0">Usuario</th>
                            <th class="border-0">Fecha Registro</th>
                            <th class="border-0 text-center">Rol Actual</th>
                            <th class="border-0 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td class="pl-4 text-muted font-weight-bold">#<?= $u['id_usu'] ?></td>
                                
                                <td class="font-weight-bold text-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center mr-2" style="width: 30px; height: 30px;">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                        <?= htmlspecialchars($u['nombre_usu']) ?>
                                    </div>
                                </td>

                                <td class="text-muted">
                                    <i class="far fa-calendar-alt mr-1"></i> 
                                    <?= date('d/m/Y', strtotime($u['created_at'] ?? 'now')) ?>
                                </td>

                                <td class="text-center">
                                    <?php 
                                        $badge = 'secondary';
                                        if($u['id_rol'] == 1) $badge = 'danger'; // Admin
                                        if($u['id_rol'] == 2) $badge = 'primary'; // Organizador
                                        if($u['id_rol'] == 3) $badge = 'info'; // Cliente
                                    ?>
                                    <span class="badge badge-<?= $badge ?> px-3 py-2 elevation-1">
                                        <?= $u['nombre_rol'] ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="btn-group shadow-sm">
                                        <a href="index.php?controller=Roles&action=editar&id=<?= $u['id_usu'] ?>" class="btn btn-white btn-sm border-right" title="Cambiar Rol">
                                            <i class="fas fa-pen" style="color: #6610f2;"></i>
                                        </a>
                                        <button onclick="confirmarEliminar(<?= $u['id_usu'] ?>)" class="btn btn-white btn-sm text-danger" title="Eliminar Usuario">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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
            title: '¿Eliminar usuario?',
            text: "Se borrará permanentemente del sistema.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#f8f9fa',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: '<span class="text-dark">Cancelar</span>'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Roles&action=eliminar&id=${id}`;
            }
        })
    }
</script>