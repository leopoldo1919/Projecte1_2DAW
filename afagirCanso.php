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
        <a href="Portada.html"><button class="botones-vuelta">tornar</button></a>

    </div>
    
    
    <form class="from_afegirCanço"action="codisPHPdeAfegirCanso.php" method="POST" enctype="multipart/form-data">
        <h2>
            Afegeix una canço
        </h2>
        <div class="Nom_canço">
            <label for="nomC" class="indicacio">Nom de la canço:</label>
            <input class="input_class"type="text" name="nomC" id="nomC" placeholder="Nom canço" required><br>
        </div>
        <div class="Nom_canço">

            <label for="imatge" class="indicacio">Imatge:</label>
            <input type="file" class="file_buton" name="imatge" id="imatge" accept=".png" required><br>

            <label for="musica" class="indicacio">Musica:</label>
            <input type="file" class="file_buton" name="musica" id="musica" accept=".mp3" required><br>

            <label for="video" class="indicacio">Video:</label>
            <input type="file" class="file_buton" name="video" id="video" accept=".mp4" required><br>

            <label for="joc" class="indicacio">Arxiu Joc:</label>
            <input type="file" class="file_buton" name="joc" id="joc" accept=".txt" required><br>

            <input class="input_submit" type="submit" value="Pujar">
        </div>
    </form>
    
        
</body>
</html>