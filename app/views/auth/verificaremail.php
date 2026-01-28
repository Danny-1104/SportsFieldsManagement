<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Email - Canchas Premium</title>
    <?php include '../app/views/layouts/favicon.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

    <div class="auth-page">
        <a href="index.php?controller=Home&action=index" class="home-btn"><i class="fas fa-arrow-left"></i> Volver al Inicio</a>
        
        <div class="auth-container">
            <div class="auth-header">
                <h1>Verificar Email</h1>
                <p>Ingresa el código que enviamos</p>
            </div>

            <div class="auth-content">
                <div style="text-align: center; margin-bottom: 1.5rem; font-size: 3rem; color: var(--primary);">
                    <i class="fas fa-envelope-open"></i>
                </div>

                <p style="text-align: center; color: #666; margin-bottom: 2rem;">
                    Hemos enviado un código de verificación a tu correo electrónico. 
                    Por favor ingresa el código de 8 caracteres.
                </p>

                <?php if(isset($_SESSION['codigo_verificacion'])): ?>
                    <div style="background: #fffacd; border-left: 4px solid #f39c12; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;">
                        <p style="margin: 0; color: #f39c12; font-weight: 600;">🔧 DESARROLLO - Código de Prueba:</p>
                        <p style="margin: 0.5rem 0 0 0; color: #333; font-size: 1.2rem; font-weight: bold; font-family: monospace; letter-spacing: 3px;">
                            <?php echo $_SESSION['codigo_verificacion']; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['msg']) && $_GET['msg'] == 'codigoincorrecto'): ?>
                    <div class="error-msg"><i class="fas fa-exclamation-circle"></i> Código incorrecto o expirado</div>
                <?php endif; ?>

                <form id="verify-form" action="index.php?controller=Auth&action=verificaremail" method="POST">
                    <div class="form-group">
                        <label><i class="fas fa-key"></i> Código de Verificación</label>
                        <input id="codigo-input" class="form-control" type="text" name="codigo" placeholder="XXXXXXXX" required maxlength="8" autocomplete="off" style="text-align: center; letter-spacing: 3px; font-weight: bold; text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();">
                        <small style="display: block; margin-top: 0.5rem; color: #999; text-align: center;">Revisa tu email si no ves el código</small>
                    </div>

                    <button class="btn-auth" type="submit"><i class="fas fa-check"></i> Verificar Código</button>
                </form>

                <div class="switch-link">
                    <a href="index.php?controller=Auth&action=register"><i class="fas fa-arrow-left"></i> Volver al registro</a>
                </div>

                <div class="footer-box">
                    <i class="fas fa-info-circle"></i> El código expira en 10 minutos
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
    <script>
        // Normalizar el código antes de enviar: quitar espacios y forzar mayúsculas
        (function(){
            var form = document.getElementById('verify-form');
            var input = document.getElementById('codigo-input');
            if(form && input){
                form.addEventListener('submit', function(e){
                    input.value = input.value.trim().toUpperCase();
                });
            }
        })();
    </script>
</body>
</html>