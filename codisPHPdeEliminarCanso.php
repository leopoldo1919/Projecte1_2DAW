<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomC = $_POST['nomC'];
    $jsonFile = 'cansonsGuardades.json';
    $iconosDir = 'iconos/';

    $jsonData = file_get_contents($jsonFile);
    $cansons = json_decode($jsonData, true);
    $cansonsFiltrades = array_filter($cansons, function($canso) use ($nomC) {
        return $canso['nomC'] !== $nomC;
    });
    $extensions = ['png', 'mp3', 'mp4'];
    foreach ($extensions as $ext) {
        $filePath = $iconosDir . $nomC . '.' . $ext;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    file_put_contents($jsonFile, json_encode(array_values($cansonsFiltrades), JSON_PRETTY_PRINT));

    echo "<script>alert('Canción y archivos relacionados eliminados correctamente.'); window.location.href = 'LlistatDeCansons.php';</script>";
}
?>
