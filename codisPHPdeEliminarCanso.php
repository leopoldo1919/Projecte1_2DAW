<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomC = $_POST['nomC'];
    $jsonFile = 'cansonsGuardades.json';
    $jsonData = file_get_contents($jsonFile);
    $canciones = json_decode($jsonData, true);
    $cancionesFiltradas = array_filter($canciones, function($canso) use ($nomC) {
        return $canso['nomC'] !== $nomC;
    });
    file_put_contents($jsonFile, json_encode(array_values($cancionesFiltradas), JSON_PRETTY_PRINT));
    echo "<script>alert('Canción eliminada correctamente.'); window.location.href = 'LlistatDeCansons.php';</script>";
}
?>

