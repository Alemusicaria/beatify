<?php
header('Content-Type: application/json');

// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Consulta SQL per obtenir la informació relacionada amb cançons, àlbums i artistes
$consulta = "SELECT CANCO.Ruta_canco, CANCO.Img, ALBUM.Nombre AS AlbumNombre, 
                    ARTISTA.Nom AS ArtistaNombre, ARTISTA.Foto AS ArtistaFoto
             FROM CANCO
             INNER JOIN ALBUM ON CANCO.ID_Album = ALBUM.ID
             INNER JOIN CREA_MUSICA ON CANCO.ID = CREA_MUSICA.ID_Canco
             INNER JOIN ARTISTA ON CREA_MUSICA.ID_Artista = ARTISTA.ID";
$resultado = $conn->query($consulta);

// Verifica si hi ha resultats
if ($resultado->num_rows > 0) {
    // Crea un array per emmagatzemar els resultats
    $datos = array();

    // Recorre els resultats i afegeix cada fila a l'array
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    // Retorna els resultats com a JSON
    echo json_encode($datos);
} else {
    // No hi ha resultats
    echo json_encode(array());
}

// Tanca la connexió
$conn->close();
