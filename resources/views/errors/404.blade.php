<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página No Encontrada</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .container {
        width: 100%;
        max-width: 1400px;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .block404 {
        position: relative;
        background-image: url(https://imgur.com/eHVyWTM.jpg);
        background-size: cover;
        background-position: center;
        width: 100%;
        max-width: 1248px;
        height: 620px;
        overflow: hidden;
        cursor: pointer;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease;
    }

    .block404:hover {
        transform: scale(1.02);
    }

    .t404 {
        position: absolute;
        width: 364px;
        height: 146px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-image: url(https://imgur.com/KPZo9YX.png);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 3;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
    }

    .obj {
        width: 204px;
        height: 209px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: animation-404 6s infinite ease-in-out;
        z-index: 2;
        filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.4));
    }

    .obj img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    @keyframes animation-404 {

        0%,
        100% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        50% {
            transform: translate(-53%, -42%) rotate(-5deg);
        }
    }

    .waves {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url(https://imgur.com/eHVyWTM.jpg);
        background-size: cover;
        background-position: center;
        filter: url("#glitch");
        z-index: 1;
    }

    /* Mensaje descriptivo */
    .error-message {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        z-index: 4;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8);
    }

    .error-message h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .error-message p {
        font-size: 16px;
        font-weight: 300;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    /* Botón de regreso */
    .back-home {
        display: inline-block;
        padding: 14px 35px;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: 2px solid rgba(255, 255, 255, 0.4);
        border-radius: 50px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .back-home::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .back-home:hover::before {
        width: 300px;
        height: 300px;
    }

    .back-home:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
    }

    .back-home span {
        position: relative;
        z-index: 1;
    }

    /* SVG oculto */
    .svg-filters {
        position: absolute;
        width: 0;
        height: 0;
    }

    /* Partículas flotantes */
    .particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
        z-index: 5;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        animation: float 6s infinite ease-in-out;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }

        10% {
            opacity: 1;
        }

        90% {
            opacity: 1;
        }

        100% {
            transform: translateY(-100vh) translateX(50px);
            opacity: 0;
        }
    }

    /* Responsive */
    @media (max-width: 1280px) {
        .block404 {
            max-width: 95%;
            height: 550px;
        }
    }

    @media (max-width: 768px) {
        .block404 {
            height: 450px;
            border-radius: 15px;
        }

        .t404 {
            width: 250px;
            height: 100px;
        }

        .obj {
            width: 150px;
            height: 150px;
        }

        .error-message {
            bottom: 80px;
        }

        .error-message h2 {
            font-size: 22px;
        }

        .error-message p {
            font-size: 14px;
        }

        .back-home {
            font-size: 12px;
            padding: 12px 25px;
        }
    }

    @media (max-width: 480px) {
        .block404 {
            height: 100vh;
            border-radius: 0;
        }

        .t404 {
            width: 200px;
            height: 80px;
        }

        .obj {
            width: 120px;
            height: 120px;
        }

        .error-message {
            bottom: 60px;
            padding: 0 20px;
        }

        .error-message h2 {
            font-size: 20px;
        }

        .error-message p {
            font-size: 13px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="block404">
            <div class="waves"></div>

            <!-- Partículas flotantes -->
            <div class="particles" id="particles"></div>

            <div class="obj">
                <img src="https://imgur.com/w0Yb4MX.png" alt="Objeto 404">
            </div>

            <div class="t404"></div>

            <div class="error-message">
                <h2>¡Oops! Página No Encontrada</h2>
                <p>Parece que te has perdido en el espacio digital</p>
                <a href="/" class="back-home">
                    <span>← Volver al Inicio</span>
                </a>
            </div>

            <svg class="svg-filters" xmlns="http://www.w3.org/2000/svg" version="1.1">
                <defs>
                    <filter id="glitch">
                        <feTurbulence type="fractalNoise" baseFrequency="0.01 0.03" numOctaves="1" result="warp"
                            id="turb" />
                        <feColorMatrix in="warp" result="huedturb" type="hueRotate" values="90">
                            <animate attributeType="XML" attributeName="values" values="0;180;360" dur="3s"
                                repeatCount="indefinite" />
                        </feColorMatrix>
                        <feDisplacementMap xChannelSelector="R" yChannelSelector="G" scale="50" in="SourceGraphic"
                            in2="huedturb" />
                    </filter>
                </defs>
            </svg>
        </div>
    </div>

    <script>
    // Crear partículas flotantes
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 20;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
            particlesContainer.appendChild(particle);
        }
    }

    // Efecto de pulso al hacer clic
    document.addEventListener('DOMContentLoaded', function() {
        createParticles();

        const block = document.querySelector('.block404');

        if (block) {
            block.addEventListener('click', function(e) {
                // Evitar que el clic en el botón active este efecto
                if (e.target.closest('.back-home')) {
                    return;
                }

                // Efecto de pulso en el objeto
                const obj = this.querySelector('.obj');
                obj.style.animation = 'none';
                setTimeout(() => {
                    obj.style.animation = 'animation-404 6s infinite ease-in-out';
                }, 10);

                // Crear onda de clic
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.5)';
                ripple.style.width = '20px';
                ripple.style.height = '20px';
                ripple.style.left = e.offsetX + 'px';
                ripple.style.top = e.offsetY + 'px';
                ripple.style.transform = 'translate(-50%, -50%)';
                ripple.style.animation = 'ripple 0.6s ease-out';
                ripple.style.pointerEvents = 'none';
                ripple.style.zIndex = '10';

                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        }
    });

    // Animación de onda
    const style = document.createElement('style');
    style.textContent = `
            @keyframes ripple {
                to {
                    width: 200px;
                    height: 200px;
                    opacity: 0;
                }
            }
        `;
    document.head.appendChild(style);

    // Efecto de movimiento del mouse
    document.addEventListener('mousemove', function(e) {
        const obj = document.querySelector('.obj');
        if (obj) {
            const x = (e.clientX / window.innerWidth - 0.5) * 20;
            const y = (e.clientY / window.innerHeight - 0.5) * 20;
            obj.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
        }
    });
    </script>
</body>

</html>