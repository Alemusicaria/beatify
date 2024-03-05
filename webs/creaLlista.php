<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6102a80a3f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/estil2.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Beatify</title>
</head>

<body>
    <header>
        <ul class="menu">
            <li> <a href="./premium.php">Premium</a></li>
            <li> <a href="">Asistencia</a></li>
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
        </ul>
    </header>
    <div class="contenedor-left">
        <div class="miniMenu">
            <ul id="menu">
                <li><a href="./index.php"><img src="../img/Logo_sense_fons.png" alt="">BEATIFY</a></li>
                <li><a href="./index.php"><i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>INICI</a>
                </li>
                <li><a href="./index.php"><i class="fa-solid fa-magnifying-glass" style="color: rgb(255, 255, 255);"></i>Buscar cançons</a>
                </li>
            </ul>
        </div>
        <br>
    </div>
    <div class="contenedor-right" style="overflow-y: auto;">
        <hr>
        <h2>Busquem alguna cosa per a la teva llita</h2><br>
        <i class="fa-solid fa-magnifying-glass" style="color: rgb(255, 255, 255);"></i><input type="text"
            id="searchInput" placeholder="Buscar cançons">
        <div id="taula" class="scrollable-container">
        </div>
        <p>&copy; 2024 Beatify. Tots els drets reservats.</p>
    </div>

    <footer>
        <div class="reproductor-musica">
            <div class="reproductor-contenido">
                <div class="reproductor-info">
                    <img src="" alt="portada" id="reproductor-img">
                    <div class="info-text">
                        <h4 id="reproductor-title"></h4>
                        <p id="reproductor-artist"></p>
                    </div>
                </div>
                <div class="music-player-container">
                    <div class="controls-music-container">
                        <div class="progress-song-container">
                            <div class="progress-bar">
                                <span class="progress"></span>
                            </div>
                        </div>
                        <div class="time-container">
                            <span class="time-left" id="CurrentSongTime"></span>
                            <span class="time-left" id="SongLength"></span>
                        </div>
                    </div>
                    <audio controls preload="metadata" src="" id="reproductor-audio"></audio>
                    <div class="main-song-controls">
                        <img src="../img/simbols/Backward.svg" alt="" class="icon" id="Back10">
                        <img src="../img/simbols/Play.svg" alt="" class="icon" id="PlayPause">
                        <img src="../img/simbols/Forward.svg" alt="" class="icon" id="Plus10">
                    </div>
                </div>
                <div class="volume-container">
                    <input type="range" id="volumeSlider" min="0" max="1" step="0.05" value="100">
                    <img id="volumeIcon" src="../img/simbols/volume.svg" alt="Volume">
                </div>
            </div>
        </div>
    </footer>

    <script src="../assets/js/audio.js"></script>
    <script src="../assets/js/code.js"></script>
    <script src="../assets/js/carregarLlistaCancons.js"></script>
    <script src="../assets/js/perfil.js"></script>
    <script src="../assets/js/cookies.js"></script>
</body>

</html>