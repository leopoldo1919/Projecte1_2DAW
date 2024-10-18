<?php
$directorioBase = 'rankings/';

$jugador = $_POST['jugador'];
$puntuacion = $_POST['puntuacion'];
$rango = $_POST['rango'];
$cancion = $_POST['cancion'];

$directorioCancion = $directorioBase . $cancion;
if (!is_dir($directorioCancion)) {
    mkdir($directorioCancion, 0777, true); 
}

$archivoRanking = $directorioCancion . '/ranking.json';

if (!file_exists($archivoRanking)) {
    file_put_contents($archivoRanking, json_encode([], JSON_PRETTY_PRINT));
}

$puntuaciones = json_decode(file_get_contents($archivoRanking), true);

if (!is_array($puntuaciones)) {
    $puntuaciones = [];
}

$nuevaPuntuacion = [
    'jugador' => $jugador,
    'puntuacion' => $puntuacion,
    'rango' => $rango
];
$puntuaciones[] = $nuevaPuntuacion;

file_put_contents($archivoRanking, json_encode($puntuaciones, JSON_PRETTY_PRINT));

echo "<script>alert('Cançó guardada correctament.'); window.location.href = 'Ranking.php'</script>";
?>
