<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Canchas Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-page">
        <a href="index.php?controller=Home&action=index" class="home-btn"><i class="fas fa-arrow-left"></i> Volver</a>
        
        <div class="auth-container">
            <div class="auth-header">
                <h1>Crear Cuenta</h1>
                <p>Únete a nuestra comunidad deportiva</p>
            </div>

            <div class="auth-content">
                <?php if(isset($_GET['msg']) && $_GET['msg'] == 'exists'): ?>
                    <div class="error-msg"><i class="fas fa-exclamation"></i> El usuario o correo ya existe.</div>
                <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'mismatch'): ?>
                    <div class="error-msg"><i class="fas fa-exclamation"></i> Las contraseñas no coinciden.</div>
                <?php endif; ?>

                <form action="index.php?controller=Auth&action=register" method="POST">
                    <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input class="form-control" type="text" name="nombre_usu" required>
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>
                    <div class="form-group input-wrap">
                        <label>Contraseña</label>
                        <input id="reg-password" class="form-control" type="password" name="password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('reg-password')"><i class="fas fa-eye"></i></button>
                    </div>
                    
                    <div style="margin-bottom:1rem;">
                        <div id="strength-length" class="strength-item"><i class="fas fa-circle"></i> 8 caracteres</div>
                        <div id="strength-upper" class="strength-item"><i class="fas fa-circle"></i> Mayúscula</div>
                        <div id="strength-lower" class="strength-item"><i class="fas fa-circle"></i> Minúscula</div>
                        <div id="strength-number" class="strength-item"><i class="fas fa-circle"></i> Número</div>
                        <div id="strength-special" class="strength-item"><i class="fas fa-circle"></i> Símbolo</div>
                    </div>

                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input id="confirm-password" class="form-control" type="password" name="password_confirm" required>
                    </div>

                    <button id="submit-btn" class="btn-auth" type="submit" disabled>Registrarse</button>
                </form>

                <div class="switch-link">
                    ¿Ya tienes cuenta? <a href="index.php?controller=Auth&action=login">Inicia Sesión</a>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/auth.js"></script>
</body>
</html>