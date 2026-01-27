<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../app/views/layouts/favicon.php'; ?>
    <title>Iniciar Sesión - Canchas Premium</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <style>
        body { 
            margin: 0;
            padding: 0;
            background: #f5f5f5; 
        }
        
        .auth-page { 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 2rem;
            background: url('assets/img/background1.webp') center/cover fixed;
            position: relative;
            overflow: hidden;
        }

        .auth-container { 
            background: #fff; 
            border-radius: 20px; 
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); 
            width: 100%; 
            max-width: 550px; 
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary) 0%, #00b85f 100%);
            padding: 2rem;
            color: #000;
            text-align: center;
        }

        .auth-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 1.8rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        .auth-header p {
            margin: 0;
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .auth-content { 
            padding: 3rem 2.5rem;
            position: relative;
        }

        .auth-title { 
            text-align: center; 
            font-size: 1.8rem; 
            font-weight: 900; 
            margin-bottom: 0.3rem; 
            color: #111;
        }

        .auth-sub { 
            text-align: center; 
            color: #999; 
            margin-bottom: 2rem; 
            font-size: 0.95rem; 
        }

        .form-group { 
            margin-bottom: 1.2rem; 
        }

        .form-group label { 
            display: block; 
            margin-bottom: 0.5rem; 
            color: #444; 
            font-weight: 600; 
            font-size: 0.9rem; 
        }

        .form-control { 
            width: 100%; 
            padding: 0.85rem 1rem; 
            border-radius: 10px; 
            border: 1px solid #ddd; 
            outline: none; 
            font-size: 0.95rem; 
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-control:focus { 
            border-color: var(--primary); 
            box-shadow: 0 0 0 3px rgba(0, 255, 136, 0.1);
        }

        .btn-auth { 
            width: 100%; 
            padding: 0.95rem; 
            border-radius: 30px; 
            border: none; 
            background: var(--primary); 
            color: #000; 
            font-weight: 800; 
            font-size: 1rem; 
            cursor: pointer; 
            margin-top: 0.8rem; 
            transition: all 0.3s;
        }

        .btn-auth:hover { 
            background: #00b85f; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(0, 255, 136, 0.3);
        }

        .switch-link { 
            text-align: center; 
            margin-top: 1.5rem; 
            color: #999; 
            font-size: 0.9rem; 
        }

        .switch-link a { 
            color: var(--primary); 
            text-decoration: none; 
            font-weight: 600; 
            cursor: pointer;
        }

        .switch-link a:hover {
            text-decoration: underline;
        }

        .home-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.9) 0%, rgba(0, 200, 100, 0.9) 100%);
            color: #000;
            padding: 0.9rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 700;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 15px rgba(0, 255, 136, 0.4);
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .home-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .home-btn:hover {
            background: linear-gradient(135deg, #00ff88 0%, #00cc6a 100%);
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 255, 136, 0.5);
            color: #000;
        }

        .home-btn:hover::before {
            left: 100%;
        }

        .home-btn:active {
            transform: translateY(-2px) scale(1.02);
        }

        .footer-box {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        .eye-btn { 
            background: transparent; 
            border: none; 
            position: absolute; 
            right: 12px; 
            top: 36px; 
            cursor: pointer; 
            color: #999;
            padding: 5px;
        }

        .eye-btn:hover {
            color: var(--primary);
        }

        .input-wrap { 
            position: relative; 
        }

        .error-msg { 
            color: #e74c3c; 
            font-size: 0.85rem; 
            text-align: center; 
            background: #fadbd8; 
            padding: 0.5rem; 
            border-radius: 8px; 
            margin-bottom: 1rem;
        }

        .success-msg { 
            color: #27ae60; 
            font-size: 0.85rem; 
            text-align: center; 
            background: #d5f4e6; 
            padding: 0.5rem; 
            border-radius: 8px; 
            margin-bottom: 1rem;
        }

        .form-group small {
            display: block;
            margin-top: 0.3rem;
        }

        @media (max-width: 480px) {
            .auth-container { width: 95%; }
            .auth-content { padding: 2rem 1.5rem; }
            .auth-header { padding: 1.5rem; }
            .auth-header h1 { font-size: 1.4rem; }
        }
    </style>
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
                        <input class="form-control" type="text" name="nombre_usu" placeholder="Tu usuario o correo electrónico" required autocomplete="username">
                    </div>
                    <div class="form-group input-wrap">
                        <label>Contraseña</label>
                        <input id="login-password" class="form-control" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
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
