<?php
$nomC = $_POST["nomC"];
$imatge = "./iconos/".$_POST["imatge"];
$musica = "./iconos/".$_POST["musica"];
$video = "./iconos/".$_POST["video"];
$array = array("nomC" => $nomC,"imatge" => $imatge,"musica" => $musica, "video" => $video);
if(file_exists("cansonsGuardades.json")){
$contenido = file_get_contents("cansonsGuardades.json");
$data = json_decode($contenido);
array_push($data, $array);
file_put_contents("cansonsGuardades.json", json_encode($data));
}else{
$data = array();
array_push($data, $array);
$f = fopen("cansonsGuardades.json", "w");
fwrite($f, json_encode($data));
fclose($f);
}
echo "<script>alert('Canço afegida correctament.'); window.location.href = 'afagirCanso.php';</script>";
