<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <style>
        /* Afegit estil per als elements del formulari d'imatge */
        #formFotoPerfil {
            margin-top: 20px;
        }

        #inputFotoPerfil {
            margin-right: 10px;
        }

        #guardarCambios {
            margin-top: 10px;
        }

        /* Estil per als elements del dropdown */
        .perfil-dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .dropdown-list {
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            border: 1px solid #ddd;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            display: none;
        }

        .dropdown-list li {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-list li:hover {
            background-color: #f1f1f1;
        }
    </style>
    <title>El meu Perfil</title>
</head>

<body>
    <header>
        <h1 id="titol">Configuració Usuari - <a href="./index.php">Beatify</a></h1>
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
            <option value="../img/user/user.png">Predeterminada</option>
        </select>

        <script>
            // Obté les imatges de la carpeta ../img/user
            fetchImageOptions('../img/user/').then(options => {
                // Afegix les opcions al desplegable
                options.forEach(option => {
                    addOptionToSelect('opcionesImagen', option);
                });

                // Verifica si hi ha una cookie d'usuari i si és així, obté les imatges de la carpeta ../img/Nomusuari
                const nomUsuari = getCookie('NomUsuari');
                if (nomUsuari) {
                    fetchImageOptions(`../img/${nomUsuari}/`).then(options => {
                        options.forEach(option => {
                            addOptionToSelect('opcionesImagen', option);
                        });
                    });
                }
            }).catch(error => {
                console.error('Error en obtenir les opcions d\'imatge:', error);
            });

            // Funció per obtenir les opcions d'imatge d'una carpeta
            async function fetchImageOptions(folderPath) {
                try {
                    const response = await fetch(folderPath);
                    if (!response.ok) {
                        throw new Error(`Error de la petició: ${response.status}`);
                    }

                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        const data = await response.json();
                        return data;
                    } else {
                        throw new Error('La resposta no és JSON vàlid');
                    }
                } catch (error) {
                    throw error;
                }
            }

            // Funció per afegir una opció a un desplegable
            function addOptionToSelect(selectId, optionValue) {
                const select = document.getElementById(selectId);
                const option = document.createElement('option');
                option.value = optionValue;
                option.text = optionValue;
                select.add(option);
            }

            // Funció per obtenir el valor d'una cookie
            function getCookie(cookieName) {
                const name = `${cookieName}=`;
                const decodedCookie = decodeURIComponent(document.cookie);
                const cookieArray = decodedCookie.split(';');
                for (let i = 0; i < cookieArray.length; i++) {
                    let cookie = cookieArray[i];
                    while (cookie.charAt(0) === ' ') {
                        cookie = cookie.substring(1);
                    }
                    if (cookie.indexOf(name) === 0) {
                        return cookie.substring(name.length, cookie.length);
                    }
                }
                return '';
            }
        </script>

        <button id="guardarCambios">Guardar</button>
        <br>
        <br>

        <form id="formFotoPerfil" enctype="multipart/form-data">
            <input type="file" name="fotoPerfil" accept="image/*" id="inputFotoPerfil">
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
        function guardarFotoPerfil() {
            var formData = new FormData(document.getElementById('formFotoPerfil'));

            $.ajax({
                type: 'POST',
                url: '../assets/php/guardar_foto.php', // Crea un fitxer PHP per gestionar aquesta sol·licitud
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Manejar la resposta del servidor (pot ser un missatge de confirmació)
                    console.log(response);
                },
                error: function(error) {
                    console.log('Error en desar la foto de perfil: ' + error);
                }
            });
        }
    </script>
</body>

</html>