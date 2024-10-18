<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" href="estilsDelProjecte.css">
</head>
<audio src="Canso de fons.mp3" autoplay loop></audio>
<body>
    <video class="video-fondo" autoplay loop muted>
        <source src="FonsDePortada.mp4" type="video/mp4">
    </video>

    <a href="Ranking.php"><button class="botones-vuelta">tornar</button></a>

    <div class="veureRanking">
    <?php
    $directorioBase = 'rankings/';

    $cancion = isset($_GET['cancion']) ? $_GET['cancion'] : '';

    if ($cancion) {
        $directorioCancion = $directorioBase . $cancion;
        $archivoRanking = $directorioCancion . '/ranking.json';

        if (file_exists($archivoRanking)) {
            $puntuaciones = json_decode(file_get_contents($archivoRanking), true);

            if (is_array($puntuaciones)) {
                usort($puntuaciones, function ($a, $b) {
                    return $b['puntuacion'] - $a['puntuacion'];
                });

                echo "<h1>" . htmlspecialchars($cancion) . "</h1>";
                echo "<h2>Top 5</h2>";
                echo "<p class='llegendaRanking'><span class='Posicio'>Posicio</span><span class='NomJugador'>Nom</span><span class='Puntuacio'>Puntuacio</span><span class='RangDelJugador'>Rang</span></p>";

                $top = array_slice($puntuaciones, 0, 5);
                echo "<ol class='lista-ranking'>";
                foreach ($top as $index => $puntuacion) {
                    echo "<li><span class='posicion'>" . ($index + 1) . ".</span> ";
                    echo "<span class='jugador'>" . htmlspecialchars($puntuacion['jugador']) . "</span>";
                    echo "<span class='puntuacion'>" . htmlspecialchars($puntuacion['puntuacion']) . " puntos</span> ";
                    echo "<span class='rango'>" . htmlspecialchars($puntuacion['rango']) . "</span>";
                    echo "</li>";
                }
                echo "</ol>";
            } else {
                echo "<p>No hay puntuaciones para esta canción.</p>";
            }
        } else {
            echo "<p>No hay ranking disponible para la canción " . htmlspecialchars($cancion) . ".</p>";
        }
    } else {
        echo "<p>No se ha seleccionado ninguna canción.</p>";
    }
    ?>
    </div>
</body>
</html>
