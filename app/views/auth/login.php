<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Canchas Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-page">
        <a href="index.php?controller=Home&action=index" class="home-btn"><i class="fas fa-arrow-left"></i> Volver</a>
        
        <div class="auth-container">
            <div class="auth-header">
                <h1>Bienvenido</h1>
                <p>Ingresa a tu cuenta para reservar</p>
            </div>

            <div class="auth-content">
                <?php if(isset($_GET['msg'])): ?>
                    <?php if($_GET['msg'] == 'registrosuccess'): ?>
                        <div class="success-msg"><i class="fas fa-check"></i> Registro exitoso. Inicia sesión.</div>
                    <?php elseif($_GET['msg'] == 'error'): ?>
                        <div class="error-msg"><i class="fas fa-times"></i> Credenciales incorrectas.</div>
                    <?php endif; ?>
                <?php endif; ?>

                <form action="index.php?controller=Auth&action=login" method="POST">
                    <div class="form-group">
                        <label>Usuario o Correo</label>
                        <input class="form-control" type="text" name="nombre_usu" required>
                    </div>
                    <div class="form-group input-wrap">
                        <label>Contraseña</label>
                        <input id="login-pass" class="form-control" type="password" name="password" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('login-pass')"><i class="fas fa-eye"></i></button>
                    </div>
                    <button class="btn-auth" type="submit">Entrar</button>
                </form>

                <div class="switch-link">
                    ¿No tienes cuenta? <a href="index.php?controller=Auth&action=register">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/auth.js"></script>
</body>
</html>