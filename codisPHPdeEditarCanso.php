<?php
$nomEdit = $_POST["nomEdit"];
$nomC = $_POST["nomC"];
$imatge = "./iconos/".$_POST["imatge"];
$musica = "./iconos/".$_POST["musica"];
$video = "./iconos/".$_POST["video"];


if (file_exists("cansonsGuardades.json")) {
    $contenido = file_get_contents("cansonsGuardades.json");
    $data = json_decode($contenido, true);
    foreach ($data as &$canso) {
        if ($canso["nomC"] === $nomEdit) {
            $canso["nomC"] = $nomC;
            $canso["imatge"] = $imatge;
            $canso["musica"] = $musica;
            $canso["video"] = $video;
            break;
        }
    }
    file_put_contents("cansonsGuardades.json", json_encode($data));

    echo "<script>alert('Canço editada correctament.');window.location.href = 'LlistatDeCansons.php';</script>";
}
?>




