<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Editar Cliente: <?= htmlspecialchars($usuario['nombre_usu']) ?></h3>
    </div>
    <form action="index.php?controller=Usuarios&action=modificar" method="POST">
        <input type="hidden" name="id_usu" value="<?= $usuario['id_usu'] ?>">
        <div class="card-body">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre_usu" class="form-control" value="<?= htmlspecialchars($usuario['nombre_usu']) ?>" required>
            </div>
            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo_usu" class="form-control" value="<?= htmlspecialchars($usuario['correo_usu']) ?>" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Actualizar Cambios</button>
            <a href="index.php?controller=Usuarios&action=index" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>