<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailatron</title>
    <link rel="stylesheet" href="cssDelJoc.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
    <?php
        $cancion = isset($_GET['cancion']) ? $_GET['cancion'] : 'Sin cancion';
        $jugador = isset($_GET['jugador']) ? $_GET['jugador'] : 'Anónimo';
        $videoFons = "iconos/" . $cancion . ".mp4";
        $cansofons ="iconos/" . $cancion . ".mp3";
    ?>
<body class="body_joc">
    <div class="cancoSelecionadaEnMarxa">
        <?php
            $jsonFile = 'cansonsGuardades.json';
            $jsonData = file_get_contents($jsonFile);
            $canciones = json_decode($jsonData, true);
                echo '<video class="video-fondo" autoplay loop muted>';
                echo '<source src="' . $videoFons . '" type="video/mp4">';
                echo 'El video no es pot reproduir';
                echo '</video>';
                echo '<audio src="'.$cansofons.'" autoplay loop>';
                echo 'Audio no es pot reproduir';
                echo '</audio>';
        ?>
    </div>
    <div class="recuadrePuntuacio">
        <?php
        echo '<h2>'. $cancion . '</h2>';
        echo '<h3>Puntuacio actual</h3>';
        
        ?>
    </div>
</body>
</html>
