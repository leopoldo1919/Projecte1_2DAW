<?php
$nomEdit = $_POST["nomEdit"];
$nomCNou = $_POST["nomC"];
$iconosDir = './iconos/';

$imatgeNou = $iconosDir . basename($_FILES["imatgeNou"]["name"]);
$musicaNou = $iconosDir . basename($_FILES["musicaNou"]["name"]);
$videoNou = $iconosDir . basename($_FILES["videoNou"]["name"]);

if (move_uploaded_file($_FILES["imatgeNou"]["tmp_name"], $imatgeNou) &&
    move_uploaded_file($_FILES["musicaNou"]["tmp_name"], $musicaNou) &&
    move_uploaded_file($_FILES["videoNou"]["tmp_name"], $videoNou)) {

    if (file_exists("cansonsGuardades.json")) {
        $contingut = file_get_contents("cansonsGuardades.json");
        $data = json_decode($contingut, true);

        foreach ($data as &$canso) {
            if ($canso["nomC"] === $nomEdit) {
                $extensions = ['png', 'mp3', 'mp4'];
                foreach ($extensions as $ext) {
                    $filePath = $iconosDir . $nomEdit . '.' . $ext;
                    if (file_exists($filePath)) {
                        unlink($filePath); 
                    }
                }

                $canso["nomC"] = $nomCNou;
                $canso["imatge"] = $imatgeNou;
                $canso["musica"] = $musicaNou;
                $canso["video"] = $videoNou;
            }
        }

        file_put_contents("cansonsGuardades.json", json_encode($data, JSON_PRETTY_PRINT));
        echo "<script>alert('Cançó editada correctament.'); window.location.href = 'LlistatDeCansons.php';</script>";
    }
}
?>




