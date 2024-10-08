<!DOCTYPE html>
<html lang="es">
    <script>
    function validarFormulario() {
        // Obtener los valores de los campos de archivo
        var archivoMusica = document.forms["formularioCancion"]["musica"].value;
        var archivoImagen = document.forms["formularioCancion"]["imatge"].value;

        // Verificar tipo de archivo de música
        var extensionMusica = archivoMusica.split('.').pop().toLowerCase();
        var extensionesPermitidasMusica = ["mp3", "wav", "ogg"];
        if (extensionesPermitidasMusica.indexOf(extensionMusica) === -1) {
            alert("Por favor, selecciona un archivo de música válido (mp3, wav, ogg).");
            return false;
        }

        // Verificar tipo de archivo de imagen
        var extensionImagen = archivoImagen.split('.').pop().toLowerCase();
        var extensionesPermitidasImagen = ["jpg", "jpeg", "png", "gif"];
        if (extensionesPermitidasImagen.indexOf(extensionImagen) === -1) {
            alert("Por favor, selecciona una imagen válida (jpg, jpeg, png, gif).");
            return false;
        }

        // Si todo está bien, se envía el formulario
        return true;
    }


    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilsDelProjecte.css">
    <link rel="icon" href="iconoPortada.png" type="image/png">
</head>
<body class="body_video">    
    <video class="video-fondo" autoplay loop muted>
        <source src="FonsDePortada.mp4" type="video/mp4">
    </video> 
</body>
<body class="body_principal">
    <div class="content">
        <a href="Portada.html"><button class="botones-vuelta">tornar</button></a>

    </div>
    
    <form class="from_afegirCanço" action="codisPHPdelProgecte.php" method="post">
        <h2>
            Afegeix una canço
        </h2>
        <div class="Nom_canço">
            <input class="input_class" name="nomC" type="text" placeholder="Nom de la canço" required>
        </div>
        <div class="Nom_canço">
            <label for="musica" class="indicacio">Musica</label>
            <input class="file_buton" name="musica" type="file" required>
            <label for="imatge" class="indicacio">Imatge</label>
            <input class="file_buton" name="imatge" type="file" required>
            <input class="input_submit" type="submit" title="pujar la canço" value="Afegir la canço">  
        </div>
    </form>
    
        
</body>
</html>