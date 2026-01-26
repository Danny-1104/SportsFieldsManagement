<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Listado de Usuarios Registrados</h3>
        <div class="card-tools">
            <a href="index.php?controller=Usuarios&action=crear" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Agregar nuevo cliente
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>IDENTIFICACIÓN</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($datos_usuarios)): ?>
                    <?php foreach ($datos_usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id_usu'] ?></td>
                            <td><?= htmlspecialchars($usuario['nombre_usu']) ?></td>
                            <td><?= htmlspecialchars($usuario['correo_usu']) ?></td>
                            <td>
                                <code title="<?= $usuario['password_usu'] ?>">
                                    <?= substr($usuario['password_usu'], 0, 15) ?>...
                                </code>
                            </td>
                            <td>
                                <a href="index.php?controller=Usuarios&action=editar&id=<?= $usuario['id_usu'] ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminar(<?= $usuario['id_usu'] ?>, '<?= htmlspecialchars($usuario['nombre_usu']) ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No se encontraron clientes.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Configuración de Toast para notificaciones automáticas
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    if (msg === 'save_ok') {
        Toast.fire({ icon: 'success', title: '¡Cliente registrado con éxito!' });
    } else if (msg === 'delete_ok') {
        Toast.fire({ icon: 'warning', title: 'Usuario eliminado correctamente' });
    } else if (msg === 'error_dup') {
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'El correo electrónico ya está registrado con otro usuario.',
            confirmButtonColor: '#d33'
        });
    }

    // 2. Función para confirmar eliminación con SweetAlert2
    function confirmarEliminar(id, nombre) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: `Vas a eliminar al usuario: ${nombre}. ¡Esta acción no se puede deshacer!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir al controlador para ejecutar la eliminación
                window.location.href = `index.php?controller=Usuarios&action=eliminar&id=${id}`;
            }
        });
    }
</script>