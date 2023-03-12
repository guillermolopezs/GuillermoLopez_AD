<?php
session_start();
require_once("db_utils.php");
$conDb = conectarDB();
$vacio = false;
$victoria = false;
$intento = [];
if (isset($_POST['modo'])) {
    session_destroy();
    session_start();
    $_SESSION['palabras'] = [];
    $palabras = getPalabras($conDb);
    $numPalabras = count($palabras);
    $random = rand(0, $numPalabras - 1);
    $_SESSION['palabra'] = $palabras[$random]['PALABRA'];
    $_SESSION['array_palabra'] = str_split($_SESSION['palabra']);
    $_SESSION['numLetras'] = count($_SESSION['array_palabra']);
    $_SESSION['puntuacion'] = 0;
} elseif (isset($_POST['jugar'])) {
    for ($i = 0; $i < count($_SESSION['array_palabra']); $i++) {
        if ($_POST[(string)$i] == '') {
            $vacio = true;
        } else {
            $intento[] = strtolower($_POST[(string)$i]);
        }
    }
    if (!$vacio) {
        $_SESSION['puntuacion']++;
        if ($intento == $_SESSION['array_palabra']) {
            for ($i = 0; $i < count($intento); $i++) {
                $coloresIntento[$i] = [$intento[$i], "verde"];
            }
            $victoria = true;
        } else {
            $contPalabra = array_count_values($_SESSION['array_palabra']);
            $marcadas = [];
            foreach ($intento as $letra) {
                $marcadas[$letra] = 0;
            }
            $coloresIntento = [];
            //verdes
            for ($i = 0; $i < count($intento); $i++) {
                if ($intento[$i] == $_SESSION['array_palabra'][$i]) {
                    $coloresIntento[$i] = [$intento[$i], "verde"];
                    $marcadas[$intento[$i]]++;
                    $intento[$i] = "";
                }
            }
            //amarillos
            for ($i = 0; $i < count($intento); $i++) {
                if ($intento[$i] != "") {
                    if (in_array($intento[$i], $_SESSION['array_palabra'])) {
                        if ($marcadas[$intento[$i]] < $contPalabra[$intento[$i]]) {
                            $coloresIntento[$i] = [$intento[$i], "amarillo"];
                            $marcadas[$intento[$i]]++;
                            $intento[$i] = "";
                        } else {
                            $coloresIntento[$i] = [$intento[$i], "blanco"];
                            $intento[$i] = "";
                        }
                    } else {
                        $coloresIntento[$i] = [$intento[$i], "blanco"];
                    }
                }
            }
        }
        $_SESSION['palabras'][] = $coloresIntento;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Carter+One');

        a {
            cursor: url(https://greghub.github.io/coloron/public/svg/cursor.svg), pointer;
        }

        a:focus,
        a:active {
            cursor: url(https://greghub.github.io/coloron/public/svg/cursor-tap.svg), pointer;
        }

        .container {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
        }

        .game-full-flex {
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 99999;
        }

        .stop-game {
            justify-content: center;
        }

        .stop-game .score {
            display: inherit;
        }

        .stop-game .score-container {
            background-color: #424242;
            width: 433px;
            height: 386px;
            border-radius: 38px;
            text-align: center;
            justify-content: center;
        }

        .stop-game .score-container h1 {
            color: #fff;
            text-transform: uppercase;
            letter-spacing: -0.1em;
            margin-top: 20px;
            margin-bottom: 4px;
            font-size: 64px;
        }

        .stop-game .score-container .final-score {
            color: #fff;
            font-weight: 900;
            font-size: 90px;
            letter-spacing: -6px;
            line-height: 110px;
        }

        .stop-game .score-container .result {
            color: #54d440;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 30px;
        }

        .stop-game .score-container h4 {
            color: #fff;
            margin-top: 12px;
        }

        .stop-game .score-container .main-menu {
            background-color: #54d440;
            border: 2px solid #fff;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 900;
            letter-spacing: -1px;
            font-size: 26px;
            padding: 8px 24px;
            border-radius: 22px;
            margin: 9px 9px;
            display: inline-block;
        }

        .stop-game .score-container .main-menu:hover {
            background-color: #57c6ac;
        }



        input[type=text],
        select {
            width: 4%;
            padding: 14px 20px;
            margin: 14px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

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
            font-size: em;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>WORDLE</title>
</head>

<body style=" background: #171717;
            text-align: center;
            padding: 30px;">
    <?php
    if ($vacio) {
        echo '<center><div style="text-align:center;" class="alert alert-danger" role="alert">Rellena todas las casillas!</div></center><br>';
    }
    ?>
    <center>
        <br><br>
        <div class="center">
            <h1>
                <span>WORDLE</span>
                <span>WORDLE</span>
                <span>WORDLE</span>

            </h1>
        </div>
        <br>
        <?php
        if (!isset($_POST['modo'])) {
            if ($victoria) {
                echo '<div class="container">
                    <div class="stop-game game-full-flex">
                    <div class="score">

                        <div class="score-container">

                            <h1>' . $_SESSION['palabra'] . '</h1>
                            <div class="result">Puntuacion:</div>
                            <div class="final-score">' . $_SESSION['puntuacion'] . '</div>
                            <div>
                                <a class="main-menu" href="index.php"">Menu</a>
                            </div>

                        </div>

                    </div>

                    </div>

                </div>';
            } else {
                echo "<br>";
                foreach ($_SESSION['palabras'] as $try) {
                    for ($i = 0; $i < count($try); $i++) {
                        if ($try[$i][1] == "verde") {
                            echo ' <input value="' . $try[$i][0] . '" style="font-weight: bold;color:#ffffff;text-transform:uppercase;font-size:20px;background-color: #0f8c2d" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" readonly maxlength="1">&nbsp;';
                        } elseif ($try[$i][1] == "blanco") {
                            echo ' <input value="' . $try[$i][0] . '" style="font-weight: bold;text-transform:uppercase;font-size:20px;background-color: #ffffff" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" readonly maxlength="1">&nbsp;';
                        } elseif ($try[$i][1] == "amarillo") {
                            echo ' <input value="' . $try[$i][0] . '" style="font-weight: bold;color:#ffffff;text-transform:uppercase;font-size:20px;background-color: #e8e741" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" readonly maxlength="1">&nbsp;';
                        }
                    }
                    echo "<br>";
                }
            }
        }
        ?>
        <form id="mainform" method="post" action="juego.php">
            <?php
            echo "<br>";

            if (!$victoria) {
                $cont = 0;
                foreach ($_SESSION['array_palabra'] as $letra) {
                    echo ' <input name="' . $cont . '" style="font-weight: bold;text-transform:uppercase;font-size:20px" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" maxlength="1">&nbsp;';
                    $cont++;
                }
            }
            ?>
            <br>
            <?php
            if (!$victoria) {
                echo '<br><button name="jugar" style="--clr:#39FF14"><span>JUGAR</span><i></i></button>';
            }
            ?>
        </form>
        <br>
        <?php
        echo "<h1 style='color: #fff'>" . $_SESSION['puntuacion'] . "</h1><br>";
        ?>
    </center>
</body>

</html>