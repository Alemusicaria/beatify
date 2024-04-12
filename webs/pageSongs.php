<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6102a80a3f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/estil.css">
    <link rel="stylesheet" href="../assets/css/pageSongs.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Beatify</title>
</head>

<body>
    <header>
        <ul class="menu">
            <li> <a href="./premium.php">Premium</a></li>
            <li> <a href="./asistencia.php">Asistencia</a></li>
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
        </ul>
    </header>
    <div class="contenedor-left">
        <div class="miniMenu">
            <ul id="menu">
                <li><a href="./index.php"><img src="../img/Logo_sense_fons.png" alt="">BEATIFY</a></li>
                <li><a href="./index.php"><i class="fa-solid fa-house" style="color: rgb(255, 255, 255);"></i>INICI</a>
                </li>
            </ul>
            <div class="buscar">
                <input type="text" id="searchInput" placeholder="Cerca" required />
                <div class="btn" id="search">
                    <i class="fas fa-search icon"></i>
                </div>
            </div>
        </div>
        <br>
        <div class="llistesUsuaris">
            <h2><i class="fa-solid fa-compact-disc"></i>Llistes Cançons</h2>
            <div id="primera">

                <?php
                if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
                    echo "<button onclick='location.href=\"./creaLlista.php\";'>Crea Llista</button>";
                } else {
                    echo "<button onclick='location.href=\"./login.html\";'>Crea Llista</button>";
                }
                ?>
            </div>
            <br>

            <?php

            // Conectar con la base de datos (ajusta las credenciales según tu configuración)
            $servername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "Beatify";

            $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }
            if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
                $sql = "SELECT * FROM llista_reproduccio WHERE ID_Usuari = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_COOKIE['UsuariID']);
                $stmt->execute();
                $result = $stmt->get_result();

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre cada lista de reproducción
                    while ($row = $result->fetch_assoc()) {
                        // Mostrar información de la lista de reproducción
                        echo '<div class="Llistes">';
                        echo '<h3>' . $row['Nom'] . '</h3>';
                        // Puedes mostrar más información si lo deseas, como la cantidad de canciones en la lista, etc.
                        echo '</div>';
                    }
                } else {
                    echo '<p>No se encontraron listas de reproducción para este usuario.</p>';
                }
            } else {
                echo '<p>Inicia sessió per a veure les teves llistes</p>';
            }
            ?>
        </div>
    </div>
    <div class="contenedor-right">
        <div class="infAC">
            <div class="foto">
                <img src="" alt="">
            </div>
            <div class="txt">
                <h2></h2>
            </div>
            <div class="artista">
                <h3></h3>
            </div>
        </div>
        <div class="lista">
            <div id="imgPlay"> <img src="../img/playImg.png" alt="" class="play"></div>
            <div>
                <h2>Més Cançons dels Artistes</h2>
            </div>
            <div id="tablaCanciones" class="scrollable-container">

            </div>
        </div>
    </div>

    <footer>
        <div class="reproductor-musica">
            <div class="reproductor-contenido">
                <div class="reproductor-info">
                    <img src="../img/simbols/black.jpg" alt="portada" id="reproductor-img">
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
                        <img src="../img/simbols/after.svg" alt="" class="icon" id="AfterSong">
                        <img src="../img/simbols/Backward.svg" alt="" class="icon" id="Back10">
                        <img src="../img/simbols/Play.svg" alt="" class="icon" id="PlayPause">
                        <img src="../img/simbols/Forward.svg" alt="" class="icon" id="Plus10">
                        <img src="../img/simbols/next.svg" alt="" class="icon" id="NextSong">
                    </div>
                </div>
                <div class="aleatori">
                    <img src="../img/simbols/random.svg" alt="" id="random">
                </div>
                <div class="volume-container">
                    <input type="range" id="volumeSlider" min="0" max="1" step="0.05" value="100">
                    <img id="volumeIcon" src="../img/simbols/volume.svg" alt="Volume">
                </div>
            </div>
        </div>
    </footer>
    <script>
    </script>
    <script src="../assets/js/infAlbumCancion.js"></script>
    <script src="../assets/js/audio.js"></script>
    <script src="../assets/js/code.js"></script>
    <script src="../assets/js/perfil.js"></script>
    <script src="../assets/js/cookies.js"></script>
    <script src="../assets/js/dadesUser.js"></script>
</body>

</html>