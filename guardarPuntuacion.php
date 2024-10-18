<?php
// Directorio base donde se guardarán las puntuaciones
$directorioBase = 'rankings/';

// Recogemos los datos enviados por POST
$jugador = $_POST['jugador'];
$puntuacion = $_POST['puntuacion'];
$rango = $_POST['rango'];
$cancion = $_POST['cancion'];

// Creamos la carpeta de la canción si no existe
$directorioCancion = $directorioBase . $cancion;
if (!is_dir($directorioCancion)) {
    mkdir($directorioCancion, 0777, true); // Crear la carpeta con permisos adecuados
}

// Ruta del archivo de ranking de la canción
$archivoRanking = $directorioCancion . '/ranking.json';

// Comprobar si el archivo existe, si no, lo creamos vacío
if (!file_exists($archivoRanking)) {
    file_put_contents($archivoRanking, json_encode([], JSON_PRETTY_PRINT));
}

// Leemos el contenido actual del archivo JSON
$puntuaciones = json_decode(file_get_contents($archivoRanking), true);

// Si no es un array, lo inicializamos
if (!is_array($puntuaciones)) {
    $puntuaciones = [];
}

// Agregamos la nueva puntuación al array
$nuevaPuntuacion = [
    'jugador' => $jugador,
    'puntuacion' => $puntuacion,
    'rango' => $rango
];
$puntuaciones[] = $nuevaPuntuacion;

// Guardamos el contenido de vuelta al archivo JSON
file_put_contents($archivoRanking, json_encode($puntuaciones, JSON_PRETTY_PRINT));

echo "<script>alert('Cançó guardada correctament.'); window.location.href = 'ranking.php'</script>";
?>
