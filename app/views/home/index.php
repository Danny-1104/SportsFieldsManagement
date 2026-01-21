<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canchas Premium - Reserva tu Cancha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/landinghome.css">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>Patos Sport</span>
            </div>
            <ul class="nav-links">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#canchas">Canchas</a></li>
                <li><a href="#agenda">Agenda</a></li> <li><a href="#contacto">Contacto</a></li>
                <li><a href="index.php?controller=Auth&action=login" class="btn-login">Iniciar Sesión</a></li>
                <li><a href="index.php?controller=Auth&action=register" class="btn-login">Registrarse</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero" id="inicio">
        <div class="hero-content">
            <p class="hero-subtitle">¡Reserva tu cancha sintética en el Valle!</p>
            <h1>Futbol en estado puro<br><span style="color: var(--primary)">Día y Noche</span></h1>
            <p>Disfruta de instalaciones profesionales, iluminación LED y el mejor ambiente deportivo. Organiza tu partido de fútbol 7 o fútbol 9 hoy mismo.</p>
            <a href="index.php?controller=Auth&action=register" class="btn-primary">Reservar Ahora <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="features">
        <h2 class="section-title">La Experiencia Premium</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-calendar-check"></i>
                <h3>Reserva Online</h3>
                <p>Olvídate de las llamadas. Sistema de reservas automático 24/7 desde tu celular.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-trophy"></i>
                <h3>Ligas Competitivas</h3>
                <p>Organizamos los mejores torneos con premios en efectivo y estadísticas en vivo.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Instalaciones Top</h3>
                <p>Césped sintético FIFA Quality, chalecos limpios y balones profesionales.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-video"></i>
                <h3>Partidos Grabados</h3>
                <p>Revive tus mejores jugadas con nuestro sistema de cámaras (Servicio opcional).</p>
            </div>
        </div>
    </section>

    <section class="canchas-gallery" id="canchas">
        <p class="section-subtitle">Conoce nuestras instalaciones</p>
        <h2 class="section-title dark">NUESTRAS CANCHAS</h2>
        
        <div class="gallery-list">
            
            <div class="cancha-row">
                <div class="cancha-img-wrapper">
                    <span class="cancha-label">La Favorita</span>
                    <img src="assets/img/home/cancha1.jpg" alt="Cancha Estadio">
                </div>
                <div class="cancha-info-wrapper">
                    <h3 class="cancha-title">Cancha A - Estadio</h3>
                    <p class="cancha-desc">
                        Nuestra cancha principal diseñada para fútbol 9. Cuenta con graderías para 200 personas y es el escenario principal de nuestras finales de campeonato. El césped es de última generación (60mm).
                    </p>
                    <div class="cancha-specs">
                        <div class="spec-item"><i class="fas fa-ruler-combined"></i> Medidas: 45m x 25m</div>
                        <div class="spec-item"><i class="fas fa-users"></i> Capacidad: 9 vs 9</div>
                        <div class="spec-item"><i class="fas fa-lightbulb"></i> Iluminación: LED 500 Lux</div>
                        <div class="spec-item"><i class="fas fa-shoe-prints"></i> Césped: Monofilamento</div>
                    </div>
                    <a href="index.php?controller=Auth&action=register" class="btn-reserve-small">Ver Disponibilidad</a>
                </div>
            </div>

            <div class="cancha-row">
                <div class="cancha-img-wrapper">
                    <span class="cancha-label">Entrenamiento</span>
                    <img src="assets/img/home/cancha2.jpg" alt="Cancha Técnica">
                </div>
                <div class="cancha-info-wrapper">
                    <h3 class="cancha-title">Cancha B - Técnica</h3>
                    <p class="cancha-desc">
                        Ideal para partidos rápidos de 7 vs 7. Es la preferida para entrenamientos tácticos y partidos entre amigos entre semana. Mantiene la misma calidad de superficie que la cancha principal.
                    </p>
                    <div class="cancha-specs">
                        <div class="spec-item"><i class="fas fa-ruler-combined"></i> Medidas: 35m x 18m</div>
                        <div class="spec-item"><i class="fas fa-users"></i> Capacidad: 7 vs 7</div>
                        <div class="spec-item"><i class="fas fa-stopwatch"></i> Marcador Digital</div>
                        <div class="spec-item"><i class="fas fa-wifi"></i> Zona WiFi</div>
                    </div>
                    <a href="index.php?controller=Auth&action=register" class="btn-reserve-small">Ver Disponibilidad</a>
                </div>
            </div>

            <div class="cancha-row">
                <div class="cancha-img-wrapper">
                    <span class="cancha-label">Indoor / Lluvia</span>
                    <img src="assets/img/home/cancha3.jpg" alt="Cancha Techada">
                </div>
                <div class="cancha-info-wrapper">
                    <h3 class="cancha-title">Cancha C - Techada</h3>
                    <p class="cancha-desc">
                        No dejes que la lluvia suspenda tu partido. Nuestra cancha techada ofrece protección total contra el clima, con ventilación natural para evitar el exceso de calor. Perfecta para fútbol rápido 5 vs 5.
                    </p>
                    <div class="cancha-specs">
                        <div class="spec-item"><i class="fas fa-ruler-combined"></i> Medidas: 28m x 15m</div>
                        <div class="spec-item"><i class="fas fa-users"></i> Capacidad: 5 vs 5</div>
                        <div class="spec-item"><i class="fas fa-umbrella"></i> 100% Cubierta</div>
                        <div class="spec-item"><i class="fas fa-music"></i> Audio Integrado</div>
                    </div>
                    <a href="index.php?controller=Auth&action=register" class="btn-reserve-small">Ver Disponibilidad</a>
                </div>
            </div>

        </div>
    </section>

    <section id="agenda" style="background: #0a0a0a; padding: 6rem 2rem; border-top: 1px solid #333;">
        <div class="container" style="max-width: 1000px; margin: 0 auto;">
            
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; color: white; text-transform: uppercase; font-weight: 900; margin-bottom: 0.5rem;">
                    Reserva de <span style="color: var(--primary);">Canchas</span>
                </h2>
                <p style="color: #888;">Consulta los horarios ocupados. Solo se muestran las reservas confirmadas.</p>
            </div>

            <div style="background: #151515; border-radius: 15px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.5); overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 600px; color: #fff;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--primary);">
                            <th style="text-align: left; padding: 1.2rem; color: var(--primary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Fecha</th>
                            <th style="text-align: left; padding: 1.2rem; color: var(--primary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Horario</th>
                            <th style="text-align: left; padding: 1.2rem; color: var(--primary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Cancha</th>
                            <th style="text-align: right; padding: 1.2rem; color: var(--primary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($agenda) && !empty($agenda)): ?>
                            <?php foreach ($agenda as $partido): ?>
                                <?php 
                                    // Formatear Fecha y Hora
                                    $fechaObj = new DateTime($partido['alq_fecha']);
                                    $horaIni = substr($partido['alq_hora_ini'], 0, 5);
                                    $horaFin = substr($partido['alq_hora_fin'], 0, 5);
                                ?>
                                <tr style="border-bottom: 1px solid #333;">
                                    <td style="padding: 1.2rem; font-weight: 600;">
                                        <i class="far fa-calendar-alt" style="color: #666; margin-right: 8px;"></i>
                                        <?= $fechaObj->format('d/m/Y') ?>
                                    </td>
                                    <td style="padding: 1.2rem;">
                                        <span style="background: #222; padding: 5px 12px; border-radius: 4px; font-size: 0.9rem; border: 1px solid #333;">
                                            <?= $horaIni ?> - <?= $horaFin ?>
                                        </span>
                                    </td>
                                    <td style="padding: 1.2rem; color: #ccc;">
                                        <?= htmlspecialchars($partido['can_nombre']) ?>
                                    </td>
                                    <td style="padding: 1.2rem; text-align: right;">
                                        <span style="color: #000; background: var(--primary); font-weight: 800; font-size: 0.75rem; padding: 4px 12px; border-radius: 20px; text-transform: uppercase;">
                                            OCUPADO
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="padding: 4rem; text-align: center; color: #666;">
                                    <i class="far fa-calendar-check" style="font-size: 3rem; margin-bottom: 1rem; color: #333;"></i>
                                    <p>No hay reservas aprobadas próximas.</p>
                                    <p style="color: var(--primary);">¡La cancha está libre para ti!</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="index.php?controller=Auth&action=register" class="btn-primary" style="padding: 1rem 3rem; font-size: 1.1rem; box-shadow: 0 0 20px rgba(0, 255, 136, 0.2);">
                    <i class="fas fa-futbol" style="margin-right: 10px;"></i> ¡Quiero Reservar!
                </a>
            </div>

        </div>
    </section>

 <footer class="footer" id="contacto">
        <div class="footer-container">
            
            <div class="footer-col">
                <h3>Canchas Premium</h3>
                <p class="owner-tag">
                    <i class="fas fa-user-tie"></i> Prop. Milton Montaluisa
                </p>
                <p class="footer-desc">
                    El mejor espacio deportivo para disfrutar con amigos y familia en el Valle.
                </p>
            </div>

            <div class="footer-col">
                <h4>Contacto y Ubicación</h4>
                <div class="contact-row">
                    <i class="fas fa-phone-alt"></i>
                    <span>098 457 7224</span>
                </div>
                <div class="contact-btn-area">
                    <a href="https://maps.app.goo.gl/2dPURPXLbCVnn1de7" target="_blank" class="map-btn">
                        <i class="fas fa-map-marked-alt"></i> Ver Ubicación en Maps
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Síguenos</h4>
                <div class="social-links">
                    <a href="https://vm.tiktok.com/ZMDkhc2pL/" target="_blank" class="social-btn tiktok" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://wa.me/593984577224" target="_blank" class="social-btn whatsapp" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="social-btn facebook" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn instagram" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Canchas Premium. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>