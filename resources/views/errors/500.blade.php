<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error Interno del Servidor</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #000;
        overflow-x: hidden;
        font-family: "Roboto", sans-serif;
        font-optical-sizing: auto;
        color: black;
    }

    #message {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 90%;
        height: 90%;
        z-index: 10;
        animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #m1 {
        font-size: clamp(24px, 5vw, 35px);
        font-weight: 600;
        margin: 1%;
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
    }

    #m2 {
        font-size: clamp(60px, 12vw, 80px);
        font-weight: 700;
        margin: 1%;
        background: linear-gradient(45deg, #ff6b6b, #ee5a6f);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 0 40px rgba(255, 107, 107, 0.5);
    }

    #m3 {
        font-size: clamp(13px, 2vw, 15px);
        width: 90%;
        max-width: 600px;
        text-align: center;
        margin: 1%;
        line-height: 1.6;
        opacity: 0.9;
    }

    #m4 {
        font-size: clamp(13px, 2vw, 15px);
        width: 90%;
        max-width: 600px;
        text-align: center;
        margin: 1%;
        line-height: 1.6;
        opacity: 0.8;
        font-style: italic;
    }

    .home-button {
        margin-top: 30px;
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid black;
        color: black;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-radius: 50px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        cursor: pointer;
        display: inline-block;
    }

    .home-button:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: black;
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
    }

    #charactersDiv {
        position: absolute;
        width: 99%;
        height: 95%;
        overflow: hidden;
    }

    .characters {
        width: 18%;
        height: 18%;
        position: absolute;
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        max-width: 150px;
        max-height: 150px;
        min-width: 80px;
        min-height: 80px;
    }

    #canvas {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }

    /* Loading animation */
    .loading-dots {
        display: inline-flex;
        gap: 5px;
        margin-left: 5px;
    }

    .loading-dots span {
        width: 8px;
        height: 8px;
        background: black;
        border-radius: 50%;
        animation: bounce 1.4s infinite ease-in-out;
    }

    .loading-dots span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .loading-dots span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
            opacity: 0.5;
        }

        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {

        #m3,
        #m4 {
            width: 95%;
        }

        .characters {
            width: 25%;
            height: 25%;
        }
    }
    </style>
</head>

<body>
    <div id="message">
        <div id="m1">Internal Server Error</div>
        <div id="m2">500</div>
        <div id="m3">
            The server encountered an internal error or misconfiguration and was unable to complete your request.
        </div>
        <div id="m4">
            Our "experts" are trying to fix the problem, please stand by
            <span class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </div>
        <a href="/" class="home-button">← Back to Home</a>
    </div>

    <div id="charactersDiv"></div>
    <canvas id="canvas"></canvas>

    <script>
    // Clase para los círculos
    class Circulo {
        constructor(x, y, size) {
            this.x = x;
            this.y = y;
            this.size = size;
        }
    }

    let circulos = [];
    const canvas = document.querySelector("canvas");
    const context = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Inicializar array de círculos
    function initArr() {
        circulos.length = 0;
        for (let index = 0; index < 300; index++) {
            let randomX = Math.floor(Math.random() * ((canvas.width * 3) - (canvas.width * 1.2) + 1)) + (canvas.width *
                1.2);
            let randomY = Math.floor(Math.random() * ((canvas.height) - (canvas.height * (-0.2) + 1)) + (canvas.height *
                (-0.2)));
            let size = canvas.width / 1000;
            circulos.push(new Circulo(randomX, randomY, size));
        }
    }

    // Manejar redimensionamiento
    window.addEventListener("resize", () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        timer = 0;
        cancelAnimationFrame(requestID);
        context.reset();
        initArr();
        draw();
        document.getElementById("charactersDiv").innerHTML = "";
        charactersAnimate();
    });

    let timer = 0;
    let requestID;
    initArr();

    // Dibujar círculos animados
    function draw() {
        timer++;
        context.setTransform(1, 0, 0, 1, 0, 0);
        let distanceX = canvas.width / 80;
        let growthRate = canvas.width / 1000;
        context.fillStyle = "white";
        context.clearRect(0, 0, canvas.width, canvas.height);

        circulos.forEach((circulo) => {
            context.beginPath();
            if (timer < 65) {
                circulo.x = circulo.x - distanceX;
                circulo.size = circulo.size + growthRate;
            }
            if (timer > 65 && timer < 500) {
                circulo.x = circulo.x - (distanceX * 0.02);
                circulo.size = circulo.size + (growthRate * 0.2);
            }
            context.arc(circulo.x, circulo.y, circulo.size, 0, 360);
            context.fill();
        });

        requestID = requestAnimationFrame(draw);

        if (timer > 500) {
            cancelAnimationFrame(requestID);
        }
    }

    draw();

    // Animar personajes stick
    function charactersAnimate() {
        for (let index = 0; index < 6; index++) {
            let stick = new Image();
            stick.classList.add("characters");
            let speedX;
            let speedRotation;

            switch (index) {
                case 0:
                    stick.style.top = "0%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg";
                    stick.style.transform = "rotateZ(-90deg)";
                    speedX = 1500;
                    break;
                case 1:
                    stick.style.top = "10%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick1.svg";
                    speedX = 3000;
                    speedRotation = 2000;
                    break;
                case 2:
                    stick.style.top = "20%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick2.svg";
                    speedX = 5000;
                    speedRotation = 1000;
                    break;
                case 3:
                    stick.style.top = "25%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg";
                    speedX = 2500;
                    speedRotation = 1500;
                    break;
                case 4:
                    stick.style.top = "35%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg";
                    speedX = 2000;
                    speedRotation = 300;
                    break;
                case 5:
                    stick.style.bottom = "5%";
                    stick.src =
                        "https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick3.svg";
                    break;
                default:
                    break;
            }

            document.getElementById("charactersDiv").appendChild(stick);

            if (index == 5) return;

            stick.animate(
                [{
                    left: "100%"
                }, {
                    left: "-20%"
                }], {
                    duration: speedX,
                    easing: "linear",
                    fill: "forwards"
                }
            );

            if (index == 0) continue;

            stick.animate(
                [{
                    transform: "rotate(0deg)"
                }, {
                    transform: "rotate(-360deg)"
                }], {
                    duration: speedRotation,
                    iterations: Infinity,
                    easing: "linear"
                }
            );
        }
    }

    charactersAnimate();
    </script>
</body>

</html>