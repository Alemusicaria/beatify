<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <title>El meu Perfil</title>
</head>

<body>
    <header>
        <div class="titol_Logo">
            <a href="./index.php"><img src="../img/Logo_sense_fons.png" alt="Logo" class="logo"> </a>
            <h1 id="titol">Configuració Usuari - <a href="./index.php">Beatify</a> </h1>
        </div>
        <div class="menu">
            <a href="./premium.php">Premium</a>
            <a href="./asistencia.php">Asistencia</a>
            <?php

            if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
                echo '
                <div class="perfil-dropdown">
                    <img src="../img/user/user.png" alt="" class="fotoPerfil" onclick="toggleDropdown()"/>
                </div>
    
                <ul class="dropdown-list">
                    <li><img src="../img/simbols/ajustes.png" alt="Ajustes"> <a href="./perfil.php">Configuració</a></li>
                    <li onclick="cerrarSesion()"><img src="../img/simbols/cerrar-sesion.png" alt="Cerrar sesión"><a href="#"> Tancar sessió </a></li>
                </ul>
            ';
            } else {
                echo "<li><button id=\"iniciarSessio\">Iniciar Sessió</button></li>";
            }
            ?>
        </div>
    </header>
    <div class="dadesUser">
        <h1>Dades de l'usuari</h1>
        <img src="" alt="" class="fotoPerfil" id="fotoPerfil">
        <p class="NomUsuari"></p>
        <p class="email"></p>
        <p class="premium"></p>

        <p id="select">Selecciona tu foto de perfil:</p>
        <!-- Nou bloc d'opcions generat dinàmicament amb JavaScript -->
        <select id="opcionesImagen">
        </select>

        <button id="guardarCambios">Seleccionar</button>
        <br>
        <br>

        <form id="formFotoPerfil" enctype="multipart/form-data">
            <input type="file" name="fotoPerfil" accept="image/*" id="inputFotoPerfil">
            <br>
            <button type="button" onclick="guardarFotoPerfil()">Guardar</button>
        </form>
    </div>

    <div class="profile-container">
        <h1>Botons</h1>
        <button id="btn-customize">Personalitzar</button>
        <div id="customize-options" class="hidden">
            <label for="button-shape">Forma dels botons:</label>
            <select id="button-shape">
                <option value="rounded">Arrodonit</option>
                <option value="square">Quadrat</option>
            </select>
            <label for="color-picker">Color:</label>
            <input type="color" id="color-picker">
            <label for="font-size">Mida de la lletra:</label>
            <select id="font-size">
                <option value="small">Petit</option>
                <option value="medium">Mitjà</option>
                <option value="large">Gran</option>
            </select>
            <button id="btn-save">Desar</button>
        </div>
    </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../assets/js/perfil.js"></script>
    <script src="../assets/js/dadesUser.js"></script>
    <script src="../assets/js/cookies.js"></script>
    <script>
        // Executar la funció en la càrrega de la pàgina
        window.onload = function() {
            generarOpcions();
        }

        function generarOpcions() {
            var select = document.getElementById('opcionesImagen');
            var nomUsuari = getCookie('NomUsuari');

            // Buidar les opcions existents
            while (select.options.length > 0) {
                select.remove(0);
            }
            // Afegir opcions per cada imatge a la carpeta de l'usuari
            $.ajax({
                type: 'POST',
                url: '../assets/php/obtenir_imatges.php', // Crea un fitxer PHP per gestionar aquesta sol·licitud
                data: {
                    nomUsuari: nomUsuari
                },
                success: function(response) {
                    var imatges = JSON.parse(response);
                    imatges.forEach(function(imatge) {
                        var option = document.createElement('option');
                        option.value = imatge;
                        option.text = imatge.split('/').pop(); // Només el nom de l'arxiu, no tota la ruta
                        option.setAttribute('data-imatge', imatge);
                        select.add(option);
                    });
                },
                error: function(error) {
                    console.log('Error en obtenir les imatges: ' + error);
                }
            });
        }

        function guardarFotoPerfil() {
            var formData = new FormData(document.getElementById('formFotoPerfil'));

            $.ajax({
                type: 'POST',
                url: '../assets/php/guardar_foto.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    // Actualitzar les opcions després de guardar la imatge
                    generarOpcions();
                },
                error: function(error) {
                    console.log('Error en desar la foto de perfil: ' + error);
                }
            });
        }

        // Funció per obtenir el valor d'una cookie
        function getCookie(name) {
            var cookieValue = null;
            if (document.cookie && document.cookie !== '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();
                    if (cookie.substring(0, name.length + 1) === (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    </script>

</body>

</html>