<div class="row justify-content-center" style="margin-top: 40px; margin-bottom: 50px;">
    <div class="col-md-5">
        
        <div class="card shadow-lg border-0" style="border-radius: 15px; border-top: 5px solid #6a11cb;">
            
            <div class="card-header text-center bg-white border-bottom-0 pt-5 pb-0">
                <div class="rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-lg" 
                     style="width: 90px; height: 90px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white;">
                    <i class="fas fa-user-edit fa-3x"></i>
                </div>
                <h3 class="font-weight-bold text-dark mt-2">Editar Cliente</h3>
                <p class="text-muted small">Actualiza la información personal y de acceso</p>
            </div>
            
            <form action="index.php?controller=Usuarios&action=actualizar" method="POST">
                <div class="card-body px-5 py-4">
                    
                    <input type="hidden" name="id" value="<?= $usuario['id_usu'] ?>">

                    <div class="form-group mb-4">
                        <label class="small font-weight-bold text-secondary text-uppercase">Nombre Completo</label>
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-0 pl-3">
                                    <i class="fas fa-user text-primary" style="color: #6a11cb !important;"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control bg-light border-0 py-4" 
                                   name="nombre" 
                                   value="<?= htmlspecialchars($usuario['nombre_usu']) ?>" 
                                   placeholder="Ej: Juan Pérez" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="small font-weight-bold text-secondary text-uppercase">Correo Electrónico</label>
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-0 pl-3">
                                    <i class="fas fa-envelope text-primary" style="color: #6a11cb !important;"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control bg-light border-0 py-4" 
                                   name="email" 
                                   value="<?= htmlspecialchars($usuario['email_usu'] ?? $usuario['correo_usu']) ?>" 
                                   placeholder="ejemplo@correo.com" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="small font-weight-bold text-secondary text-uppercase">Nueva Contraseña</label>
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-0 pl-3">
                                    <i class="fas fa-lock text-primary" style="color: #6a11cb !important;"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control bg-light border-0 py-4" 
                                   name="password" 
                                   placeholder="Dejar en blanco para mantener la actual">
                        </div>
                        <small class="text-muted mt-2 ml-1">
                            <i class="fas fa-info-circle mr-1"></i> Solo llena este campo si deseas cambiar la clave.
                        </small>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php?controller=Usuarios&action=index" 
                           class="btn btn-light text-muted font-weight-bold px-4 rounded-pill shadow-sm">
                            <i class="fas fa-arrow-left mr-2"></i> Cancelar
                        </a>
                        <button type="submit" 
                                class="btn text-white font-weight-bold px-5 rounded-pill shadow-lg transform-zoom"
                                style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); border: none;">
                            Guardar Cambios <i class="fas fa-check-circle ml-2"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>