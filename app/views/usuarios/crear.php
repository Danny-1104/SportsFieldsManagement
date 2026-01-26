<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Registrar Nuevo Cliente</h3>
    </div>
    <form action="index.php?controller=Usuarios&action=guardar" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label>Nombre Completo</label>
                <input type="text" name="nombre_usu" class="form-control" placeholder="Ej: Juan Pérez" required>
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="correo_usu" class="form-control" placeholder="juan@ejemplo.com" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password_usu" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php?controller=Usuarios&action=index" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>