<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <style>
        button {
            position: relative;
            background: #222;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            border: none;
            letter-spacing: 0.1rem;
            font-size: 1rem;
            padding: 1rem 3rem;
            transition: 0.2s;
        }

        button:hover {
            letter-spacing: 0.2rem;
            padding: 1.1rem 3.1rem;
            background: var(--clr);
            color: var(--clr);
            /* box-shadow: 0 0 35px var(--clr); */
            animation: box 3s infinite;
        }

        button::before {
            content: "";
            position: absolute;
            inset: 2px;
            background: #363636;
        }

        button span {
            position: relative;
            z-index: 1;
        }

        button i {
            position: absolute;
            inset: 0;
            display: block;
        }

        button i::before {
            content: "";
            position: absolute;
            width: 10px;
            height: 2px;
            left: 80%;
            top: -2px;
            border: 2px solid var(--clr);
            background: #444;
            transition: 0.2s;
        }

        button:hover i::before {
            width: 15px;
            left: 20%;
            animation: move 3s infinite;
        }

        button i::after {
            content: "";
            position: absolute;
            width: 10px;
            height: 2px;
            left: 20%;
            bottom: -2px;
            border: 2px solid var(--clr);
            background: #222;
            transition: 0.2s;
        }

        button:hover i::after {
            width: 15px;
            left: 80%;
            animation: move 3s infinite;
        }

        @keyframes move {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes box {
            0% {
                box-shadow: #27272c;
            }

            50% {
                box-shadow: 0 0 25px var(--clr);
            }

            100% {
                box-shadow: #27272c;
            }
        }

        .center {
            width: 2%;
            height: 2%;
            transform: prespective(200px) translate(-50%, -50%);
            transform: skewY(15deg);
            transition: 0.5s;
        }

        .center:hover {
            transform: prespective(200px) translate(-50%, -50%);
            transform: skewY(0deg);
        }

        .center h1 span {
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            font-size: 2em;
            color: #fff;
            transform-style: preserve-3d;
            transition: 0.8s;
        }

        .center h1 span:nth-child(1) {
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
        }



        .center h1 span:nth-child(2) {
            color: #54d440;
            transform: translate(-50%, -50%) skewX(-60deg);
            left: -5px;
            clip-path: polygon(0 45%, 100% 45%, 100% 55%, 0 55%);
        }

        .center h1 span:nth-child(3) {
            transform: translate(-50%, -50%) skewY(0deg);
            left: -5px;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
        }

        .center:hover h1 span:nth-child(2),
        .center:hover h1 span:nth-child(3) {
            transform: translate(-50%, -50%) skewX(0deg);
            left: 0;
            color: #fff;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>

<body style="background: #222;">
    <br><br><br><br><br>
    <center>
        <div class="center">
            <h1>
                <span>WORDLE</span>
                <span>WORDLE</span>
                <span>WORDLE</span>

            </h1>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form method="POST" action="juego.php">
            <button name="modo" style="--clr:#39FF14"><span>JUGAR</span><i></i></button>
        </form>
    </center>
</body>

</html>