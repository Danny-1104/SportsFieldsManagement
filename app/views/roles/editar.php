<div class="row justify-content-center" style="margin-top: 40px;">
    <div class="col-md-5">
        <div class="card card-outline card-indigo shadow-lg border-0" style="border-radius: 15px;">
            
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <div class="rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 70px; height: 70px; background-color: #6610f2; color: white;">
                    <i class="fas fa-user-cog fa-2x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Modificar Permisos</h4>
                <p class="text-muted small">Cambia el nivel de acceso del usuario</p>
            </div>
            
            <form action="index.php?controller=Roles&action=actualizar" method="POST">
                <div class="card-body px-4 pt-2 pb-4">
                    
                    <input type="hidden" name="id_usu" value="<?= $usuario['id_usu'] ?>">

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-secondary">Usuario</label>
                        <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($usuario['nombre_usu']) ?>" readonly style="cursor: not-allowed; opacity: 0.7;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-secondary">Fecha de Registro</label>
                        <input type="text" class="form-control bg-light" value="<?= date('d/m/Y H:i', strtotime($usuario['created_at'] ?? 'now')) ?>" readonly style="cursor: not-allowed; opacity: 0.7;">
                    </div>

                    <hr>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-indigo small text-uppercase" style="color: #6610f2;">Asignar Nuevo Rol</label>
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0">
                                    <i class="fas fa-crown" style="color: #6610f2;"></i>
                                </span>
                            </div>
                            <select name="rol" class="form-control border-left-0 font-weight-bold">
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol['id_rol'] ?>" <?= ($rol['id_rol'] == $usuario['id_rol']) ? 'selected' : '' ?>>
                                        <?= $rol['nombre_rol'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="index.php?controller=Roles&action=index" class="btn btn-light text-muted font-weight-bold px-4" style="border-radius: 50px;">
                            Cancelar
                        </a>
                        <button type="submit" class="btn text-white font-weight-bold px-5 shadow-lg" style="border-radius: 50px; background-color: #6610f2; border: none;">
                            <i class="fas fa-check-circle mr-2"></i> Aplicar Rol
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>