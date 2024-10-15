<?php
$nomC = $_POST["nomC"];
$uploaded_files = ["imatge", "musica", "video","joc"];
$target_dir = "./iconos/";
$file_paths = [];
foreach ($uploaded_files as $key) {
    if (isset($_FILES[$key]) && $_FILES[$key]["error"] == 0) {
        $target_file = $target_dir . basename($_FILES[$key]["name"]);
        if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
            $file_paths[$key] = $target_file;
        } else {
            echo "Error al subir el archivo: " . $_FILES[$key]["name"];
        }
    } else {
        echo "No se ha subido archivo para $key o hubo un error.";
    }
}
$array = array(
    "nomC" => $nomC,
    "imatge" => $file_paths["imatge"] ?? null,
    "musica" => $file_paths["musica"] ?? null,
    "video" => $file_paths["video"] ?? null,
    "joc" => $file_paths["joc"] ?? null
);
if (file_exists("cansonsGuardades.json")) {
    $contenido = file_get_contents("cansonsGuardades.json");
    $data = json_decode($contenido, true);
    if (!is_array($data)) {
        $data = [];
    }
    
    array_push($data, $array);
    file_put_contents("cansonsGuardades.json", json_encode($data));
} else {
    $data = array($array);
    file_put_contents("cansonsGuardades.json", json_encode($data));
}
echo "<script>alert('Cançó afegida correctament.'); window.location.href = 'afagirCanso.php'</script>";
?>
