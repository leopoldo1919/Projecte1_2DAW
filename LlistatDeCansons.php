<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailatron</title>
    <link rel="stylesheet" href="estilsDelProjecte.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
<body>    
    <video class="video-fondo" autoplay loop muted>
        <source src="FonsDePortada.mp4" type="video/mp4">
    </video>
    <div class="content">
        <a href="Portada.html"><button class="botones-vuelta">Tornar</button></a>
    </div>
    <form class="cuadreLlistatCansons" action="codisPHPdeEliminarCanso.php" method="POST" id="formEliminarCanso">
        <h2>Llistat de cançons</h2>
        <ul id="listadoCanciones">
            <?php
                $jsonFile = 'cansonsGuardades.json';
                $jsonData = file_get_contents($jsonFile);
                $canciones = json_decode($jsonData, true);
                foreach ($canciones as $canso) {
                    echo '<li class="canso-item" onclick="seleccionarCanso(this, \''. $canso['nomC'] .'\')">';
                    echo '<img src="'. $canso['imatge'] .'" alt="Icono de '. $canso['nomC'] .'">';
                    echo '<div class="canso-detall">';
                    echo '<p>'. $canso['nomC'] .'</p>';
                    echo '</div>';
                    echo '</li>';
                }
            ?>
        </ul>
        <input type="hidden" name="nomC" id="nomC">
    </form>
    <div class="caixaDeBotonsLlistatCançons">
        <a href="Joc.html"><button class="jugarCanço" disabled>Jugar amb la cançó</button></a>
        <a href="editarCanso.php"><button class="editarCanço">Editar cançó</button></a>
        <button class="eliminarCanço" disabled type="submit" form="formEliminarCanso">Eliminar cançó</button>
    </div>
    <script>
        let cançoSeleccionada = null;
        function seleccionarCanso(elemento, nomC) {
            if (cançoSeleccionada) {
                cançoSeleccionada.classList.remove('selected');
            }
            cançoSeleccionada = elemento;
            cançoSeleccionada.classList.add('selected');
            document.querySelector('.jugarCanço').disabled = false;
            document.querySelector('.eliminarCanço').disabled = false;
            document.getElementById('nomC').value = nomC;
        }
    </script>
</body>
</html>
