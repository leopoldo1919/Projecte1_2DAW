<?php

$nomC = $_POST["nomC"];
$imatge = $_POST["imatge"];
$musica = $_POST["musica"];

$array = array("nomC" => $nomC,"imatge" => $imatge,"musica" => $musica);

if(file_exists("cançonsGuardades.json")){
$contenido = file_get_contents("cançonsGuardades.json");
$data = json_decode($contenido);
array_push($data, $array);
file_put_contents("cançonsGuardades.json", json_encode($data));
}else{
$data = array();
array_push($data, $array);
$f = fopen("cançonsGuardades.json", "w");
fwrite($f, json_encode($data));
fclose($f);
}

header("Location: afagirCanso.php");
