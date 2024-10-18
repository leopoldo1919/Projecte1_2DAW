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

    <a href="Portada.html"><button class="botones-vuelta">tornar</button></a>
    <div class="cuadreRanking">
        <h2>Selecciona una cançó per veure el seu ranking</h2>
    <div class="Ranking">
        

        <?php
        $directorioBase = 'rankings/';
        $directorioIconos = 'iconos/';

        if (is_dir($directorioBase)) {
            $carpetasCanciones = scandir($directorioBase);

            foreach ($carpetasCanciones as $carpeta) {
                if ($carpeta !== '.' && $carpeta !== '..') {
                    $icono = $directorioIconos . $carpeta . '.png';

                    if (file_exists($icono)) {
                        $imgTag = "<img src='" . htmlspecialchars($icono) . "' alt='" . htmlspecialchars($carpeta) . " icono' class='icono-cancion'>";
                    } else {
                        $imgTag = "<img src='iconos/default.png' alt='Icono por defecto' class='icono-cancion'>";
                    }

                    echo "<form action='verRanking.php' method='GET' class='caixa-cansons'>";
                    echo "<input type='hidden' name='cancion' value='" . htmlspecialchars($carpeta) . "'>";
                    echo "<button type='submit' class='boton-cancion'>" . $imgTag . htmlspecialchars($carpeta) . "</button>";
                    echo "</form>";
                }
            }
        } else {
            echo "<p>No hay canciones registradas aún.</p>";
        }
        ?>
    </div>
    </div>
</body>
</html>
