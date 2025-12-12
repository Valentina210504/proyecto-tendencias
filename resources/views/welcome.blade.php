<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Sistema de Flota Municipal') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700" rel="stylesheet">

    {{-- Cargar Bootstrap y scripts compilados con Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;
        font-family: 'Nunito', sans-serif;
    }

    /* Fondo con imagen y animación de zoom */
    .background-image {
        position: fixed;
        inset: 0;
        background-image: url('https://eventos.ufpso.edu.co/VII_ENCUENTRO/assets/img/slide/slide-2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        animation: zoomIn 2s ease-in forwards;
        z-index: 1;
    }

    @keyframes zoomIn {
        from {
            transform: scale(1.2);
        }

        to {
            transform: scale(1);
        }
    }

    /* Overlay oscuro para mejor contraste */
    .overlay {
        position: fixed;
        inset: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.85) 0%, rgba(118, 75, 162, 0.85) 100%);
        z-index: 2;
    }

    .hero-section {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        padding: 20px;
    }

    .main-container {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 30px;
        max-width: 1400px;
        width: 100%;
        align-items: center;
    }

    .left-section {
        color: white;
    }

    .logo-container {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .logo-container svg {
        width: 40px;
        height: 40px;
        fill: white;
    }

    .location-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .main-title {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 15px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .subtitle {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.95;
        line-height: 1.5;
    }

    .right-section {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 30px;
        padding: 40px;
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .auth-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 35px;
    }

    .btn-primary-custom {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-outline-custom {
        flex: 1;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 15px 30px;
        border-radius: 15px;
        font-weight: 600;
        background: transparent;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .btn-outline-custom:hover {
        background: #667eea;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .feature-box {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 25px 15px;
        text-align: center;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-color: #667eea;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .feature-icon svg {
        width: 24px;
        height: 24px;
        fill: white;
    }

    .feature-box h6 {
        color: #2d3748;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .feature-box p {
        color: #718096;
        font-size: 0.85rem;
        margin: 0;
        line-height: 1.4;
    }

    .footer-text {
        text-align: center;
        color: #a0aec0;
        font-size: 0.85rem;
        margin: 0;
    }

    @media (max-width: 1200px) {
        .main-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .left-section {
            text-align: center;
        }

        .logo-container {
            margin-left: auto;
            margin-right: auto;
        }

        .main-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .features-grid {
            grid-template-columns: 1fr;
        }

        .auth-buttons {
            flex-direction: column;
        }

        .main-title {
            font-size: 2rem;
        }
    }
    </style>
</head>

<body>

    <div class="background-image"></div>
    <div class="overlay"></div>

    <div class="hero-section">
        <div class="main-container">

            <div class="left-section">
                <div class="logo-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M17 5H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zM3 17V7h14v10H3z" />
                        <path d="M6 10h2v2H6zm4 0h2v2h-2zm4 0h2v2h-2z" />
                        <circle cx="5" cy="18.5" r="1.5" />
                        <circle cx="15" cy="18.5" r="1.5" />
                    </svg>
                </div>

                <span class="location-badge">
                    📍 Ocaña, Norte de Santander
                </span>

                <h1 class="main-title">
                    Sistema de Gestión<br>Flota Municipal
                </h1>

                <p class="subtitle">
                    Plataforma integral para la administración y control de la flota de busetas del municipio. Control
                    en tiempo real, gestión de rutas y análisis completo.
                </p>
            </div>


            <div class="right-section">
                <div class="auth-buttons">
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary-custom">
                        Iniciar Sesión
                    </a>
                    @endif
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-custom">
                        Crear Cuenta
                    </a>
                    @endif
                </div>

                <div class="features-grid">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <h6>Control de Rutas</h6>
                        <p>Gestión completa de rutas y horarios</p>
                    </div>

                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <h6>Personal</h6>
                        <p>Administración de conductores y empleados</p>
                    </div>

                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                            </svg>
                        </div>
                        <h6>Reportes</h6>
                        <p>Estadísticas y análisis en tiempo real</p>
                    </div>
                </div>

                <p class="footer-text">
                    © 2024 Alcaldía Municipal de Ocaña
                </p>
            </div>
        </div>
    </div>
</body>

</html>