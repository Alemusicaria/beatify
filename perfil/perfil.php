<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./perfil.css">
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <script src="../perfil.js" defer></script>
    <title>Mi Perfil</title>
</head>

<body>
    <header>
        <h1 id="titol">Configuració Usuari - <a href="../index.php">Beatify</a></h1>
        <div class="menu">
            <a href="./premium.html">Premium</a>
            <a href="">Asistencia</a>
            <?php

            if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
                echo '
                <div class="perfil-dropdown">
                    <img src="../img/user/user.png" alt="" onclick="toggleDropdown()"/>
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

        <p>Selecciona tu foto de perfil:</p>
        <select id="opcionesImagen">
            <option value="../img/user/user.png">Predeterminada</option>
            <option value="../img/user/1.png">Opción 1</option>
            <option value="../img/user/2.png">Opción 2</option>
            <!-- Agrega más opciones según sea necesario -->
        </select>

        <button id="guardarCambios">Guardar</button>
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
    <script>
        $('#iniciarSessio').on('click', function () {
            window.location.href = '../login/login.html';
        });

        function cerrarSesion() {
            // Eliminar la cookie
            document.cookie = "NomUsuari=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "personalizacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Contrasenya=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

            // Redirigir a la página de inicio de sesión o a otra página relevante
            window.location.href = '../login/unlogin.php';
        }
    </script>
    <script src="../perfil.js"></script>
    <script src="dadesUser.js"></script>
</body>

</html>