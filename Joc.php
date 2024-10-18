<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailatron</title>
    <link rel="stylesheet" href="cssDelJoc.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
<body class="body_joc" onload="iniciarJuego()">
<?php
    $cancion = isset($_GET['cancion']) ? $_GET['cancion'] : 'Sin cancion';
    $jugador = isset($_GET['jugador']) ? $_GET['jugador'] : 'Anónimo';
    $videoFons = "iconos/" . $cancion . ".mp4";
    $cansofons = "iconos/" . $cancion . ".mp3";
    $joc = "iconos/" . $cancion . ".txt";

    $Teclas = [];

    if (file_exists($joc)) {
        $textarea_content = file_get_contents($joc);
        $lines = explode("\n", trim($textarea_content));

        if (count($lines) > 0) {
            $numero_de_teclas = (int)$lines[0];
            for ($i = 1; $i <= $numero_de_teclas; $i++) {
                if (isset($lines[$i])) {
                    list($tecla, $tiempo_inicio, $tiempo_fin) = explode(' # ', $lines[$i]);
                    $Teclas[] = [
                        "tecla" => (int)$tecla,
                        "tiempo_inicio" => (float)$tiempo_inicio,
                        "tiempo_fin" => (float)$tiempo_fin,
                    ];
                }
            }
        }
    } else {
        echo "El archivo de la canción no existe.";
    }
?>

    <div class="cancoSelecionadaEnMarxa">
        <video class="video-fondo" autoplay muted>
            <source src="<?php echo $videoFons; ?>" type="video/mp4">
            El video no es pot reproduir
        </video>
        <audio id="audio-cancion" src="<?php echo $cansofons; ?>" autoplay>
            Audio no es pot reproduir
        </audio>
    </div>
    <progress id="barra-progreso" value="0" max="100"></progress>

    <div class="recuadrePuntuacio">
        <a href="LlistatDeCansons.php"><button class="botones-vuelta">tornar</button></a>
        <h2><?php echo $cancion; ?></h2>
        <h3>Puntuacio actual: <span id="puntuacion-actual">0</span> <span id="rango-actual">Sin rango</span></h3>
    </div>

    <div id="teclas" class="simbolos"></div> 
    <div id="ocult" class="ocult">
        <div class="ocult-content">
            <h3>¡Juego Terminado!</h3>
            <p>Puntuación: <span id="puntuacion-final">0</span></p>
            <p>Aciertos: <span id="aciertos-final">0</span></p>
            <p>Errores: <span id="errores-final">0</span></p>
            <p>Rango: <span id="rango-final">Sin rango</span></p>
            <div class="button-center">
                <button onclick="reintentar()" class="ocult-buttons">Reintentar</button>
                <button onclick="verRanking()" class="ocult-buttons">Guardar intento y ver Ranking</button>
            </div>
        </div>
    </div>

    <form id="form-ranking" action="guardarPuntuacion.php" method="POST" style="display:none;">
        <input type="hidden" name="jugador" value="<?php echo $jugador; ?>">
        <input type="hidden" name="puntuacion" id="input-puntuacion">
        <input type="hidden" name="rango" id="input-rango">
        <input type="hidden" name="cancion" value="<?php echo $cancion; ?>">
    </form>
    <div id="contenedor-teclas" class="contenedor-teclas"></div>

    <script>
let teclas = <?php echo json_encode($Teclas); ?>;
let teclaActual = 0;
let puntuacion = 0;
let movimientos = 0;
let aciertos = 0;
let errores = 0;
let rango = "Sin rango";

function crearTeclas() {
    const contenedorTeclas = document.getElementById('contenedor-teclas');
    contenedorTeclas.innerHTML = '';
    const teclasActivas = teclas.slice(teclaActual, teclaActual + 4);
    teclasActivas.forEach((teclaObj, index) => {
        const boton = document.createElement('div');
        boton.textContent = String.fromCharCode(teclaObj.tecla);
        boton.id = `tecla-${teclaActual + index}`;
        boton.className = 'tecla-guia';
        contenedorTeclas.appendChild(boton);
    });
}

document.addEventListener('keydown', (event) => {
    const teclaPresionada = event.key.toLowerCase(); 
    actualizarPuntuacion(teclaPresionada.charCodeAt(0));
});

function actualizarPuntuacion(teclaPresionada) {
    if (teclaActual >= teclas.length) return;

    const teclaEsperada = teclas[teclaActual].tecla;

    let tiempoActual = document.getElementById('audio-cancion').currentTime;

    if (teclaPresionada === teclaEsperada && 
        tiempoActual >= teclas[teclaActual]['tiempo_inicio'] &&
        tiempoActual <= teclas[teclaActual]['tiempo_fin']) {
        
        document.getElementById(`tecla-${teclaActual}`).classList.add('correcta');
        puntuacion += 100; 
        aciertos++;
    } else {
        puntuacion -= 50; 
        errores++;
    }

    movimientos++;
    mostrarPuntuacion();
    mostrarRango();
}

function mostrarPuntuacion() {
    document.getElementById('puntuacion-actual').textContent = puntuacion;
}

function mostrarRango() {
    const porcentajeAciertos = (aciertos / movimientos) * 100;

    if (porcentajeAciertos === 100) {
        rango = "S";
    } else if (porcentajeAciertos >= 90) {
        rango = "A";
    } else if (porcentajeAciertos >= 70) {
        rango = "B";
    } else if (porcentajeAciertos >= 50) {
        rango = "C";
    } else if (porcentajeAciertos >= 25) {
        rango = "D";
    } else {
        rango = "E";
    }

    document.getElementById('rango-actual').textContent = rango;
}

function actualizarBarraProgreso() {
    const audio = document.getElementById('audio-cancion');
    const barraProgreso = document.getElementById('barra-progreso');
    barraProgreso.value = (audio.currentTime / audio.duration) * 100;

    if (audio.ended) {
        mostrarOcult();
    }
}

function mostrarOcult() {
    document.getElementById('ocult').style.display = 'flex';
    document.getElementById('puntuacion-final').textContent = puntuacion;
    document.getElementById('aciertos-final').textContent = aciertos;
    document.getElementById('errores-final').textContent = errores;
    document.getElementById('rango-final').textContent = rango;
}

function iniciarJuego() {
    crearTeclas();
    setInterval(actualizarBarraProgreso, 1000);
    resaltarTeclaEnTiempo();
}

function resaltarTeclaEnTiempo() {
    const audio = document.getElementById('audio-cancion');
    setInterval(() => {
        let tiempoActual = audio.currentTime;
        console.log(`Tiempo actual: ${tiempoActual}`);

        const teclasGuia = document.querySelectorAll('.tecla-guia');
        if (teclaActual < teclas.length) {
            if (tiempoActual >= teclas[teclaActual].tiempo_inicio && tiempoActual <= teclas[teclaActual].tiempo_fin) {
                teclasGuia[0].classList.add('resaltada'); 
            } else {
                teclasGuia[0].classList.remove('resaltada');  
            }
        }
        if (teclaActual + 1 < teclas.length && tiempoActual > teclas[teclaActual].tiempo_fin) {
            teclaActual++;
            crearTeclas(); 
        }
    }, 100);  
}

function verRanking() {
    document.getElementById('input-puntuacion').value = puntuacion;
    document.getElementById('input-rango').value = rango;

    document.getElementById('form-ranking').submit();
}

function reintentar() {
    const nombre = prompt("Ingresa tu nombre para reintentar:");
    if (nombre) {
        window.location.href = `Joc.php?cancion=<?php echo $cancion; ?>&jugador=${encodeURIComponent(nombre)}`;
    } else {
        console.log("No se ingresó un nombre");
    }
}
</script>



</body>
</html>
