<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilsDelProjecte.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
<audio src="Canso de fons.mp3" autoplay loop ></audio>
<body class="body_video">    
    <video class="video-fondo" autoplay loop muted>
        <source src="FonsDePortada.mp4" type="video/mp4">
    </video> 
</body>
<body class="body_principal">
    <div class="content">
        <a href="LlistatDeCansons.php"><button class="botones-vuelta">tornar</button></a>

    </div>
    
    <form class="from_EditarCanço" action="codisPHPdeEditarCanso.php" method="post" enctype="multipart/form-data">
    <h2>Editar la canço</h2>
    <div class="Nom_canço_AEditar">
        <input class="input_class" name="nomEdit" type="text" placeholder="Nom de la canço que vols editar" required>
    </div>
    <div class="Nom_canço">
        <input class="input_class" name="nomC" type="text" placeholder="Nou nom de la canço" required>
    </div>
    <div class="Nom_canço">
        <label for="musica" class="indicacio">Musica</label>
        <input class="file_buton" name="musicaNou" type="file" required>
        <label for="video" class="indicacio">Video</label>
        <input class="file_buton" name="videoNou" type="file" required>
        <label for="imatge" class="indicacio">Imatge</label>
        <input class="file_buton" name="imatgeNou" type="file" required>
        <input class="input_submit" type="submit" title="pujar la canço" value="Editar la canço">  
    </div>
</form>

    
        
</body>
</html>