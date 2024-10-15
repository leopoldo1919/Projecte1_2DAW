<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailatron</title>
    <link rel="stylesheet" href="estilsDelProjecte.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
<audio src="Canso de fons.mp3" autoplay loop></audio>
<body>    
    <video class="video-fondo" autoplay loop muted>
        <source src="FonsDePortada.mp4" type="video/mp4">
    </video>
    <div class="content">
        <a href="Portada.html"><button class="botones-vuelta">Tornar</button></a>
    </div>
    <form class="cuadreLlistatCansons" action="codisPHPdeEliminarCanso.php" method="POST" id="formEliminarCanso" enctype="multipart/form-data">
        <h2>Llistat de cançons</h2>
        <div class="listadoCanciones">
            <ul>
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
        </div>
    </form>
    <div class="caixaDeBotonsLlistatCançons">
        <button class="jugarCanço" disabled onclick="iniciarJuego()">Jugar amb la cançó</button>
        <a href="editarCanso.php"><button class="editarCanço">Editar cançó</button></a>
        <button class="eliminarCanço" disabled type="submit" form="formEliminarCanso">Eliminar cançó</button>
    </div>

    <script>
        let cançoSeleccionada = null;

        function seleccionarCanso(element, nomC) {
            if (cançoSeleccionada) {
                cançoSeleccionada.classList.remove('selected');
            }
            cançoSeleccionada = element;
            cançoSeleccionada.classList.add('selected');
            document.querySelector('.jugarCanço').disabled = false;
            document.querySelector('.eliminarCanço').disabled = false;
            document.getElementById('nomC').value = nomC;
        }

        function iniciarJuego() {
            const cancionSeleccionada = document.getElementById('nomC').value;

            if (cancionSeleccionada) {
                const nombreJugador = prompt('Por favor, introduce tu nombre:');
                
                if (nombreJugador) {
                    window.location.href = `Joc.php?cancion=${encodeURIComponent(cancionSeleccionada)}&jugador=${encodeURIComponent(nombreJugador)}`;
                }
            } else {
                alert('Primero selecciona una canción.');
            }
        }
    </script>
</body>
</html>
